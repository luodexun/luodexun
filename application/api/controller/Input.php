<?php
namespace app\api\controller;
//ajax 跨域访问
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT');
class Input extends Base {
    public function index($params)
    {
//        config('server.svn',[
//         'username'=>'ldx'
//        ]);
        $config=config($params['name']);

        return $config;
    }
}