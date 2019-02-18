<?php
namespace app\index\controller;
use Think\Controller;
use think\Db;
class Input extends Base {
    public function index()
    {
//        config('server.svn',[
//         'username'=>'ldx'
//        ]);
        $config=config('server');

        return $config;
    }
}