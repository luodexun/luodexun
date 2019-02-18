<?php
namespace app\index\controller;
use app\DAO\Data\memberData;
//ajax 跨域访问
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS');
class User extends Base {
    public function index()
    {
        $condition = [

        ];
        $field     = [

        ];
        $data=memberData::index($condition,$field);
        $service =input('post.Action');
//        $serviceArr=json_decode($service,true);
        return $this->setCode(1000)->setMsg('数据请求成功')->setData($service)->renderOutput();
  }
}