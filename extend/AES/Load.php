<?php
/**
 * Created by PhpStorm.
 * User: ldx
 * Date: 2019/2/27
 * Time: 12:01 PM
 */

namespace AES;
class Load{
    protected $header;
    protected $data;
    public function __construct(){
        $this->header=json_decode(openssl_decrypt(request()->header('sign'), 'AES-128-CBC', '07bad5311d5108d4', 4,'fbd19b9cae6615a1'),true);
        $this->data=json_decode(openssl_decrypt(file_get_contents("php://input"), 'AES-128-CBC', substr($header['sign'],0,16), 4,substr($header['sign'],16,16)),true);
       }
    public function run($address){
        $address['url']='api/'.$this->data['Action'];
        config('app_id',$this->header['app_id']);
        config('time',$this->header['time']);
        config('sign',$this->header['sign']);
        if(isset($this->data['pagination'])){
            $_POST['pagination']=$this->data['pagination'];
        }
        if(isset($this->data['order'])){
            $_POST['order']=$this->data['order'];
        }
        if(isset($this->data['params'])){
            $_POST['params']=$this->data['params'];
        }

       }
}