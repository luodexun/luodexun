<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
$url=null;
if(request()->isOptions()){
    $url='api/Index/index';
}else if(request()->isPost()){
    $header=json_decode(openssl_decrypt(header('sign'), 'AES-128-CBC', '07bad5311d5108d4', 4,'fbd19b9cae6615a1'),true);
    $decrypted = openssl_decrypt(file_get_contents("php://input"), 'AES-128-CBC', substr($header['sign'],0,16), 4,substr($header['sign'],16,16));
    $data=json_decode($decrypted,true);
    $url='api/'.$data['Action'];
    $_POST['params']=$data['params'];
}
Route::domain('api',$url);
Route::domain('www','admin');
Route::domain('ldx','index');