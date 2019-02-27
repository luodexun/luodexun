<?php
namespace app\api\controller;
use app\model\apiData\goodsData;
//ajax 跨域访问
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, sign");
header('Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS');
class Goods extends Base {
    public function index(){

        $decrypted = openssl_decrypt(header('sign'), 'AES-128-CBC', '07bad5311d5108d4', 4,'fbd19b9cae6615a1');
        dump($decrypted);
        dump(json_decode($decrypted,true));exit();
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