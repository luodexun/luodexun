<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/23
 * Time: 10:27
 */
namespace app\index\controller;

class Article extends Base{

   public function index(){
       $id=input("id");
       $data=db('goods')
           ->alias('a')//别名
           ->join('cate c','c.id=a.goods_id','left')
           ->find($id);
       $pic=db('image')->where(['goods_id'=>$id])->select();
//       dump($pic);
//       exit;
       $this->assign('data',$data);
       $this->assign('pic',$pic);


       return $this->fetch('article');
   }






}
