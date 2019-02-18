<?php
namespace app\index\controller;
use app\index\model\Goods;
use function PHPSTORM_META\type;

class Lis extends Base
{
    public function lis(){

        $cate=input('id');
        $cate=array_filter(array_unique(explode(',',$cate)));
        $data=Goods::cate($cate);
//
//        $data2=implode(',',$cate);
        $data1=$cate[0];
        $this->assign('data1',$data1);
        $data2=$cate[0];
        if(count($cate)>1){
            $data2=$cate[1];
        }
        $this->assign('data2',$data2);
        $this->assign('data',$data);
        return $this->fetch();
        //        $this->load($cateName);
    }
    public function load(){
             $cate=$_POST['cate'];
//                 dump($cate);
//            exit();
//        $cateName=array_filter(array_unique(explode(',',$cateName)));
        $data=Goods::search($cate);
//        dump($cateName);exit();
//        $data=Goods::goods();
        $cc=new Car();
        $order=$cc->Inquire();
//        dump($order);exit();
           return [$data,$order];
//        dump( $data);exit();
//        $this->assign('data', $data);
//        Goodsdata::goods($cateName);
//        return $this->fetch('Lis/goods');
    }
}