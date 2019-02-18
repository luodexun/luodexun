<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

namespace think\worker;

use Workerman\Worker;
use Workerman\Lib\Timer;
/**
 * Worker控制器扩展类
 */
abstract class Server
{
    protected $ws_worker;
    protected $text_worker;
    protected $heart_time = 200;
    protected $protocol  = 'http';
    protected $host      = '0.0.0.0';
    protected $port      = '5100';
    protected $processes = 1;

    /**
     * 架构函数
     * @access public
     */
    public function __construct(){
        // 实例化 Websocket 服务
        $this->ws_worker = new Worker($this->socket);
        // 设置进程数
        $this->ws_worker->count = $this->processes;
        // 初始化
        $this->ws_worker->connection_uids=array();
        // 用户列表
        $this->ws_worker->uids=array();
        $this->init();

        // 设置回调
        foreach (['onWorkerStart', 'onConnect', 'onMessage', 'onClose', 'onError', 'onBufferFull', 'onBufferDrain', 'onWorkerStop', 'onWorkerReload'] as $event) {
            if (method_exists($this, $event)) {
                $this->ws_worker->$event = [$this, $event];
            }
        }
        // Run worker
        Worker::runAll();
    }

    protected function init(){

    }
    /**
     * 每个进程启动
     * @param $worker
     */
    public function onWorkerStart($worker){
        Timer::add(30, function()use($worker){
            $time_now = time();
            foreach($worker->connections as $connection) {
                dump($time_now - $connection->lastMessageTime);
                // 有可能该connection还没收到过消息，则lastMessageTime设置为当前时间
                if (empty($connection->lastMessageTime)) {
                    $connection->lastMessageTime = $time_now;
                    continue;
                }
                // 上次通讯时间间隔大于心跳间隔，则认为客户端已经下线，关闭连接
                if ($time_now - $connection->lastMessageTime >$this->heart_time) {
                    $connection->close();
                }
            }
        });
        $this->text_worker = new Worker('Text://0.0.0.0:5200');
        $this->text_worker->onMessage=function($connection, $buffer){
            $d=json_decode($buffer);
            switch($d->type){
                case 'send':
                    if($d->to=='all'){
                        echo "向全部用户发送消息\n";
                        $this->broadcast(['type'=>'message','data'=>$d->message]);
                    }else{
                        echo "向用户{$d->to}发送消息\n";
                        $this->sendMessageByUid($d->to,$d->message);
                    }
                    break;
                default:
                    break;

            }
        };
        $this->text_worker->listen();
    }
    protected function broadcast($data){
        foreach($this->ws_worker->connections as $conn){
            $conn->send(json_encode($data));
        }
    }
    protected function sendMessageByUid($uid,$data){
        if(isset($this->ws_worker->connection_uids[$uid])){
            $conn=$this->ws_worker->connection_uids[$uid];
            $conn->send(json_encode(['type'=>'message','data'=>$data]));
        }else{
           return false;
        }
    }

}
