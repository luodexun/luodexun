<?php
/**
 * Created by PhpStorm.
 * User: dalin
 * Date: 2017/9/23
 * Time: 14:20
 */
namespace app\model\apiData;
class Broadcast{
    public static function send($data){
        $fp=$client = stream_socket_client('tcp://0.0.0.0:5200', $errno, $errmsg, 1);
        // 推送的数据，包含uid字段，表示是给这个uid推送
        fwrite($client, json_encode($data)."\n");
        $res=fclose($fp);
        return $res;
    }
}
