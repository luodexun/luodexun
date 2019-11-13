<?php
/**
 * Created by PhpStorm.
 * User: ldx
 * Date: 2019/2/27
 * Time: 12:01 PM
 */

namespace AES;
class Load{
    public function run($address){
        $header=json_decode(openssl_decrypt(request()->header('sign'), 'AES-128-CBC', '07bad5311d5108d4', 4,'fbd19b9cae6615a1'),true);
        $data=json_decode(openssl_decrypt(file_get_contents("php://input"), 'AES-128-CBC', substr($header['sign'],0,16), 4,substr($header['sign'],16,16)),true);
        dump($data);exit();
        $address['url']='api/'.$data['Action'];
        session('app_id',$header['app_id']);
        session('time',$header['time']);
        session('sign',$header['sign']);
        if(isset($data['pagination'])){
            $_POST['pagination']=$data['pagination'];
        }
        if(isset($data['order'])){
            $_POST['order']=$data['order'];
        }
        if(isset($data['params'])){
            $_POST['params']=$data['params'];
        }
       }
}