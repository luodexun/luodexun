<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/22
 * Time: 18:12
 */
namespace app\index\controller;
use app\index\model\GoodsCL;
use app\index\model\Car as kk;
class Car extends Base {

    /*
     * 跳转到购物车详情页后做的一些事情
     */
    public function index(){
        $cc=new Car();
        $order=$cc->Inquire();
        //如果商品数据不为空
        if(!empty($order)){
            //通过二维数据把goods_id拿出来    1,2
            $goods_ids=[];
            foreach($order as $k=>$val){
                array_push($goods_ids,$k);
            }
            $arr = GoodsCL::goodsItems($goods_ids);
//            dump( $arr);exit();
            foreach ($arr as $key=>$val){
                foreach ($order as $k=>$v){
                    if($val['goods_id'] ==$k){
                        //把数量放到$arr里面
                        $arr[$key]['goods_num']= $v;
                    }
                }
            }
            //总计
            $total = '';

            foreach ($arr as $k=>$v){
                $total += $v['sell_price']*$v['goods_num'];
            }
            $data = [
                'total'=>$total,
                'data'=>$arr,
            ];
            $data = $data?$data:[];
            $this->assign('data',$data);
            return $this->fetch('car');
        }else{
            //如果没有商品信息 跳转到空购物车页面
            return $this->fetch('nocar/nocar');
        }


    }
//    订单查询
    public function Inquire(){
     //判断是否登录
     $isLogin=$this->isLogin();
     if($isLogin){
         $order=[];
         //已登录
         //直接查表，返回二维数组
         $data = GoodsCL::goodsByMemberId($isLogin['member_id']);
         foreach ($data as $k=>$val){
             $order[$val['goods_id']]=$val['goods_num'];
         }
     }else{
         //未登录
         $order=[];
         $data = cookie('car');
         $data = unserialize($data);
         if (!empty($data)){
             foreach ($data as $k=>$val){
                 $order[$val['goods_id']]=$val['goods_num'];
             }
         }
     }
//     dump($order);exit();
     return $order;
}
    /*
     * 点击加入购物车时候做的一些事情
    *页面通过ajax跳转过来 结尾处返回success
    */
    public function car($goods_id,$goods_num){
        //接收参数
//        $goods_id=input('goods_id');
//        $goods_num=input('goods_num');
//        dump($goods_id);
//        dump( $goods_num);
//        exit();
        $rul=kk::carData($goods_id,$goods_num);
        $order=$this->Inquire();
        return [$rul,$order];
    }
    /*
 *
 * 结算页面
 */
    public function pay(){
        //判断是否登录
        $login = $this->isLogin();
        //未登录用户，不能来这里
        if(!$login){
            //下次要跳转的页面
            $next_url = 'Pay/index';
            session('next_url',$next_url);
            return $this->redirect('Login/index');
        }
        //没有选中的商品的也不能来这里,直接跳到购物车
        $data = GoodsCL::seletedGoods($login['member_id']);
        if(empty($data) || !$data){
            return $this->redirect('Car/index');
        }
        return $this->redirect('Pay/index');
    }

/*
 * 清空购物车
 *
 * */
public function emptying(){
    $isLogin=$this->isLogin();
    if(!$isLogin){
        cookie('car',null);
    }else{
        db('car')->where(['member_id'=>$isLogin['member_id']])->delete();
    }
    return json([
       'status'=>'success'
    ]);

}

}