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
    $decrypted = openssl_decrypt(file_get_contents("php://input"), 'AES-128-CBC', '8NONwyJtHesysWpM', 4,'12345678a0123f56');
    $data=json_decode($decrypted,true);
    $url='api/'.$data['Action'];
    $_POST['params']=$data['params'];
}
Route::domain('api',$url);
Route::domain('www','admin');
Route::domain('ldx','index');