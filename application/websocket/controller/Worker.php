<?php

namespace app\websocket\controller;

use think\worker\Server;
class Worker extends Server{
    protected $socket = 'websocket://0.0.0.0:5100';
    protected $processes = 1;
    protected $uids=array();
    /**
     * 收到信息
     * @param $connection
     * @param $data
     */
    public function onMessage($connection, $data){
        $connection->lastMessageTime = time();
        $req=json_decode($data);
        switch($req->type){
            case 'login':
                array_push($this->uids,$req->uid);
                $this->uids=array_values(array_unique($this->uids));
                $connection->uid=$req->uid;
                $this->ws_worker->connection_uids[$req->uid]=$connection;
                $this->broadcast(['type'=>'add','data'=>$req->uid]);
                break;
            case 'send':
                if($req->to=='all'){
                    echo "向全部用户发送消息\n";
                    $this->broadcast(['type'=>'message','data'=>$req->message]);
                }else{
                    echo "向用户{$req->to}发送消息\n";
                    $this->sendMessageByUid($req->to,$req->message);
                }
                break;
            case 'heart':
                echo "心跳链接\n";
                $connection->send(json_encode(['type'=>'heart','data'=>'success']));
                break;
            default:
                break;

        }
    }

    /**
     * 当连接建立时触发的回调函数
     * @param $connection
     */
    public function onConnect($connection){
        $connection->send(json_encode(['type'=>'connect','data'=>$this->uids]));
        echo "客户端连接\n";
    }
    /**
     * 当连接断开时触发的回调函数
     * @param $connection
     */
    public function onClose($connection){
        $this->broadcast(['type'=>'break','data'=>$connection->uid]);
        $this->uids=array_values(array_diff($this->uids,[$connection->uid]));
        echo "$connection->uid 断开连接\n";
    }
    /**
     * 当客户端的连接上发生错误时触发
     * @param $connection
     * @param $code
     * @param $msg
     */
    public function onError($connection, $code, $msg)
    {
        echo "error $code $msg\n";
    }
}
