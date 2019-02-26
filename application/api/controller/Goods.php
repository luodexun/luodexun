<?php
namespace app\api\controller;
use app\model\apiData\goodsData;
//ajax 跨域访问
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS');
class Goods extends Base {
    public function index($params){

        $decrypted=openssl_decrypt('GTdDSZ5+ly40Dp2FQz41N1rrH+GbTaljjHxhqVFcn0HyulEa3dFCAs9rfV41hh5q',"AES-128-CBC",'8NONwyJtHesysWpM',1,'12345678a0123f56');
        dump($decrypted);exit();
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