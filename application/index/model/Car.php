<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/23
 * Time: 11:31
 */
namespace app\index\model;
use think\Controller;
use app\index\controller\Base;
class Car extends Controller{
   static public function carData($goods_id,$goods_num){
        $isLogin =Base::isLogin();
        if(!$isLogin){
            //未登录
            //获取cookie里的商品数据  看是否为空
            $car=unserialize(cookie('car'));
            //如果是空的 二维数组直接拿输入数据，序列化后存入到cookie
            //如果非空  判断是否已有相同的商品
            if(empty($car)){
                //没有商品的购物车
                $car=[
                    [
                    'goods_id'=>$goods_id,
                    'goods_num'=>$goods_num,
                    'selected'=>1
                ]
                ];
                cookie('car',serialize($car));
            }else{
                //加载有商品的购物车数据
                foreach ($car as $key=>$val){
                    $carData[$val['goods_id']]=$val;
                }
                if(array_key_exists($goods_id,$carData)){
                    $carData[$goods_id]['goods_num']=$goods_num;
                    $car=array_values($carData);
                }else{
                    array_push($car,[
                        'goods_id'=>$goods_id,
                        'goods_num'=>$goods_num,
                        'selected'=>1
                    ]);
                }
                cookie('car',serialize($car));
            }
        }else{
            //已登录
            //查出登录用户购物车中的所有数据
            $carData=db('car')->where(['member_id'=>$isLogin['member_id']])->select();
            if(empty($carData)){
                //购物车是空的
                $arr=[
                    'goods_id'=>$goods_id,
                    'goods_num'=>$goods_num,
                    'selected'=>1,
                    'member_id'=>$isLogin['member_id']
                ];
                db('car')->insert($arr);
            }else{
                //购物车不是空的
                foreach ($carData as $key=>$val){
                    $carData[$val['goods_id']]=$val;
                }
                if(array_key_exists($goods_id,$carData)){
                    //购物车里已有该商品
                    if($goods_num==0){
                        db('car')->delete($carData[$goods_id]["car_id"]);
                    }else{
                        $carData[$goods_id]['goods_num']=$goods_num;
                        db('car')->update($carData[$goods_id]);
                    }
                }else{
                    //购物车里没有该商品
                    db('car')->insert([
                        'goods_id'=>$goods_id,
                        'goods_num'=>$goods_num,
                        'selected'=>1,
                        'member_id'=>$isLogin['member_id']
                    ]);
                }

            }
        }
        return json([
            'status'=>'success',
            'msg'=>'添加成功'
        ]);
    }

}