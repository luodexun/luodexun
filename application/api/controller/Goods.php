<?php
namespace app\api\controller;
use app\model\apiData\goodsData;
//ajax 跨域访问
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS');
class Goods extends Base {
    public function index($params){
        $iv= md5(time(). uniqid(),true);
        dump($iv);exit();
        $decrypted = openssl_decrypt($params, 'AES-128-CBC', 'v466vazrnpeng66r',true,$iv);
        $condition = [
            'store'=> ['gt', $params['store']]
        ];
        $field=[
            'goods_id',
            'goods_name',
            'sell_price',
            'store',
            'keywords',
            'create_time',
            'desc'
        ];
        session('params',$params);
       $data=goodsData::index($condition,$field);
       return $this->setCode(1000)->setMsg('数据请求成功')->setData($data)->renderOutput();
    }
    public function content($params){
        $condition = [
            'goods_id'=>$params['goods_id']
        ];
        $field     = [
            'content'
        ];
        session('params',$params);
        $data=goodsData::index($condition,$field);
        return $this->setCode(1000)->setMsg('数据请求成功')->setData($data)->renderOutput();
    }
}