<?php
namespace app\api\controller;
use app\model\apiData\goodsData;
//ajax 跨域访问
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS');
class Goods extends Base {
    public function index($params){

        dump(phpversion());
        $decrypted = openssl_decrypt('qGsTo6wD6Mece/hfkcVsAMabKMYLSgqrSB+c8gn2m1ClHJTpEdh1T4uZ5dbdzpDUZwkw2UR+LqAJr4hKxy82AQ==', 'AES-128-CBC', '8NONwyJtHesysWpM', OPENSSL_DONT_ZERO_PAD_KEY,'12345678a0123f56');
        dump($decrypted);
        dump(json_decode($decrypted));exit();
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