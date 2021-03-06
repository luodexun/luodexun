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
use AES\Load;
$url=null;
if(request()->isOptions()){
    $url='api/Index/index';
}else if(request()->isPost()){
    $address=['url'=>&$url];
    $aes=new Load();
    $aes->run($address);
}
Route::domain('api',$url);
Route::domain('www','admin');
Route::domain('ldx','index');