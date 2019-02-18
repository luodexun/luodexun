<?php
namespace app\index\controller;
use app\DAO\Data\goodsData;
//ajax 跨域访问
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT');
class Goods extends Base {
    public function index($params){
        $condition = [
            'store'=> ['gt', $params['store']]
        ];
        $field     = [
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
            'store'=> ['gt', $params['store']],
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