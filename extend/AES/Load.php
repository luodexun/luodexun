<?php
/**
 * Created by PhpStorm.
 * User: ldx
 * Date: 2019/2/27
 * Time: 12:01 PM
 */

namespace AES;
class Load{
    public function __construct(){

       }
    public function run(){
           $decrypted = openssl_decrypt(file_get_contents("php://input"), 'AES-128-CBC', '8NONwyJtHesysWpM', 4,'12345678a0123f56');
           $data=json_decode($decrypted,true);
           $url='api/'.$data['Action'];
           $_POST['params']=$data['params'];
       }
}