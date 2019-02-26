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
$Action=request()->isOptions()?'Index/index':input("post.Action");
if(request()->isPost()){
    $decrypted = openssl_decrypt('GTdDSZ5+ly40Dp2FQz41N1rrH+GbTaljjHxhqVFcn0HyulEa3dFCAs9rfV41hh5q', 'AES-128-CBC', '8NONwyJtHesysWpM', 2,'12345678a0123f56');
    dump($decrypted);exit();
}
$url='api/'.$Action;
Route::domain('api',$url);
Route::domain('www','admin');
Route::domain('ldx','index');