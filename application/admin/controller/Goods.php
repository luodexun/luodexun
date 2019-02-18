<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/21
 * Time: 10:48
 */

namespace app\admin\controller;

use app\admin\model\Goodsdata;
use app\admin\model\imageData;

class Goods extends Base
{


    //商品列表
    public function index()
    {
        //查询所有商品信息
        $data = Goodsdata::allGoods();
        //把变量分配到模版

        $this->assign('goodsData', $data);
        return $this->fetch('Admin/list');
    }

    //商品添加
    public function add()
    {
        if (request()->isPost()) {
            //接受函数
            $data = [
                'goods_name' => input('goods_name'),
                'sell_price' => input('sell_price'),
                'market_price' => input('market_price'),
                'cate_id'=>input('cate_id'),
                'store' => input('store'),
                'desc' => input('desc'),
                'content' => input('content'),
            ];
            //判断是否上架
            if (input('maketable') == 'on') {
                $data['maketable'] = 1;
            } else {
                $data['maketable'] = 0;
            }

            //判断是否冻结库存
            if (input('freez') == 'on') {
                $data['freez'] = 1;
            } else {
                $data['freez'] = 0;
            }

            //判断是否热销
            if (input('is_hot') == 'on') {
                $data['is_hot'] = 1;
            } else {
                $data['is_hot'] = 0;
            }

            //判断是否新品
            if (input('is_new') == 'on') {
                $data['is_new'] = 1;
            } else {
                $data['is_new'] = 0;
            }

            //判断商品状态
               if (input('recycle') == 'on') {
                   $data['recycle'] = 1;
               } else {
                   $data['recycle'] = 0;
               }
            //添加时间
            $data['create_time']=time();
            //最近更新时间
            $data['last_modify']=time();

            //接收关键字
            $keyword = input('keywords');
            $arr = str_replace('，', ',', $keyword);
            $data['keywords'] = $arr;
            $image=Goodsdata::img();
            //验证
//            $validate= validate('Goodsdata'); //获取表中的数据 Admin是类名 必须首字母大写
//            if(!$validate->scene('add')->check($data)){//加了验证场景 并验证数据
//                return $this->error($validate->getError());//自动验证提示错误
//            }



            //最近更新管理员名字
//            选择数据处理
            //判断商品状态
            if (input('sustainable') == 'true') {
                $select['sustainable'] = 1;
            } else {
                $select['sustainable'] = 0;
            }
            //判断商品状态
            if (input('farmer') == 'true') {
                $select['farmer'] = 1;
            } else {
                $select['farmer'] = 0;
            }
            //判断商品状态
            if (input('natural') == 'true') {
                $select['natural'] = 1;
            } else {
                $select['natural'] = 0;
            }
            //判断商品状态
            if (input('local') == 'true') {
                $select['local'] = 1;
            } else {
                $select['local'] = 0;
            }
            //判断商品状态
            if (input('visit') == 'true') {
                $select['visit'] = 1;
            } else {
                $select['visit'] = 0;
            }
            //判断商品状态
            if (input('ancient') == 'true') {
                $select['ancient'] = 1;
            } else {
                $select['ancient'] = 0;
            }
            //判断商品状态
            if (input('negative') == 'true') {
                $select['negative'] = 1;
            } else {
                $select['negative'] = 0;
            }
            //判断商品状态
            if (input('agriculture') == 'true') {
                $select['agriculture'] = 1;
            } else {
                $select['agriculture'] = 0;
            }
            //判断商品状态
            if (input('origin') == 'true') {
                $select['origin'] = 1;
            } else {
                $select['origin'] = 0;
            }
            //判断商品状态
            if (input('gluten') == 'true') {
                $select['gluten'] = 1;
            } else {
                $select['gluten'] = 0;
            }
            //判断商品状态
            if (input('material') == 'true') {
                $select['material'] = 1;
            } else {
                $select['material'] = 0;
            }
            //判断商品状态
            if (input('gmo') == 'true') {
                $select['gmo'] = 1;
            } else {
                $select['gmo'] = 0;
            }
            //判断商品状态
            if (input('produce') == 'true') {
                $select['produce'] = 1;
            } else {
                $select['produce'] = 0;
            }

            //操作数据库
//            dump($data);
//            dump($image);
//            dump($select);exit();
            $res=Goodsdata::add($data,$image,$select);
            //
            //返回结果
            if($res){
                return $this->success('添加成功',url('Goods/index'));//成功返回
            }
            else{
                return $this->error('添加失败');//失败返回
            }
        }
        //分类下拉
        $data=Goodsdata::allCate();
        $this->assign('goodsAdd',$data);
        return $this->fetch('Admin/list');
    }

    //商品编辑
    public function edit(){
        if(request()->isPost()){
            //接收参数
            $data=[
                'goods_id'=>input('goods_id'),
                'goods_name' => input('goods_name'),
                'sell_price' => input('sell_price'),
                'market_price' => input('market_price'),
                'cate_id'=>input('cate_id'),
                'store' => input('store'),
                'desc' => input('desc'),
                'content' => input('content'),
            ];
            //判断是否上架
            if (input('maketable') == 'on') {
                $data['maketable'] = 1;
            } else {
                $data['maketable'] = 0;
            }

            //判断是否冻结库存
            if (input('freez') == 'on') {
                $data['freez'] = 1;
            } else {
                $data['freez'] = 0;
            }

            //判断是否热销
            if (input('is_hot') == 'on') {
                $data['is_hot'] = 1;
            } else {
                $data['is_hot'] = 0;
            }

            //判断是否新品
            if (input('is_new') == 'on') {
                $data['is_new'] = 1;
            } else {
                $data['is_new'] = 0;
            }

            //判断商品状态
            if (input('recycle') == 'on') {
                $data['recycle'] = 1;
            } else {
                $data['recycle'] = 0;
            }

            //接收关键字
            $keyword = input('keywords');
            $arr = str_replace('，', ',', $keyword);
            $data['keywords'] = $arr;
            //最近更新时间
            $data['last_modify']=time();
//            选择数据处理
            //判断商品状态
            if (input('sustainable') == 'true') {
                $select['sustainable'] = 1;
            } else {
                $select['sustainable'] = 0;
            }
            //判断商品状态
            if (input('farmer') == 'true') {
                $select['farmer'] = 1;
            } else {
                $select['farmer'] = 0;
            }
            //判断商品状态
            if (input('natural') == 'true') {
                $select['natural'] = 1;
            } else {
                $select['natural'] = 0;
            }
            //判断商品状态
            if (input('local') == 'true') {
                $select['local'] = 1;
            } else {
                $select['local'] = 0;
            }
            //判断商品状态
            if (input('visit') == 'true') {
                $select['visit'] = 1;
            } else {
                $select['visit'] = 0;
            }
            //判断商品状态
            if (input('ancient') == 'true') {
                $select['ancient'] = 1;
            } else {
                $select['ancient'] = 0;
            }
            //判断商品状态
            if (input('negative') == 'true') {
                $select['negative'] = 1;
            } else {
                $select['negative'] = 0;
            }
            //判断商品状态
            if (input('agriculture') == 'true') {
                $select['agriculture'] = 1;
            } else {
                $select['agriculture'] = 0;
            }
            //判断商品状态
            if (input('origin') == 'true') {
                $select['origin'] = 1;
            } else {
                $select['origin'] = 0;
            }
            //判断商品状态
            if (input('gluten') == 'true') {
                $select['gluten'] = 1;
            } else {
                $select['gluten'] = 0;
            }
            //判断商品状态
            if (input('material') == 'true') {
                $select['material'] = 1;
            } else {
                $select['material'] = 0;
            }
            //判断商品状态
            if (input('gmo') == 'true') {
                $select['gmo'] = 1;
            } else {
                $select['gmo'] = 0;
            }
            //判断商品状态
            if (input('produce') == 'true') {
                $select['produce'] = 1;
            } else {
                $select['produce'] = 0;
            }
            $select['select_id']=input('select_id');


            //验证
//            $validate= validate('Goodsdata'); //获取表中的数据 Admin是类名 必须首字母大写
//            if(!$validate->scene('edit')->check($data)){     //加了验证场景 并验证数据
//                return $this->error($validate->getError());      //自动验证提示错误
//            }


            //最近更新管理员名字

            //操作数据库
//            dump($data);
//            dump($select);
//            exit();
            $res=Goodsdata::edit($data,$select);

            //返回结果
            if($res){
                return $this->success('修改成功',url('Goods/index'));//成功返回
            }
            else{
                return $this->error('修改失败');//失败返回
            }


        }
        $id=input('id');
        //查出分类信息
        $data=Goodsdata::getGoodsById($id);
        //分类下拉
//        dump($data);exit();
        $this->assign('goodsEdit',$data);
        return $this->fetch('Admin/list');
    }


    //信息删除
    public function del(){
        //接收参数
        $id=input('id');
        //操作数据库
        $res=Goodsdata::del($id);
        //返回结果

        if($res){
            return $this->success('操作成功',url('Goods/index'));//成功返回
        }
        else{
            return $this->error('操作失败');//失败返回
        }



    }

    public function imageIndex(){

        $id=input('id');

        //查询所有图片信息
        $data = imageData::allGoods($id);
        //把变量分配到模版

//        dump($data  );exit();
        $this->assign('imageData', $data);

        return $this->fetch('Admin/list');
    }

    public function change(){
        //接收参数
        $i_id=input('i_id');
        $g_id=input('g_id');



        //操作数据库
        $res=imageData::upd($i_id,$g_id);

        return $this->redirect('Goods/imageIndex',['id'=>$g_id]);
    }

    public function addImage()
    {
        //获取参数
        $id=input('id');
        $data=imageData::getGoods($id);
        $this->assign('imageAdd',$data);
//        dump($data);exit();
        //判断是否为post传的
        if (request()->isPost()) {
            $data=Goodsdata::img();
            $data['goods_id']=input('id');
            $data['is_face']=0;

            //操作数据库
            $res=imageData::add($data);

            //判断添加是否成功
            if($res!==false){
                return $this->success('添加成功',url('Goods/index',['id'=>$id]));//成功返回
            }
            else{
                return $this->error('添加失败');//失败返回
            }

        }

        return $this->fetch('Admin/list');
    }
    //信息删除
    public function delImage(){
        //接收参数
        $id=input('id');
        //操作数据库
        $res=imageData::del($id);
        //返回结果

        if($res){
            return $this->success('操作成功',url('Goods/index'));//成功返回
        }
        else{
            return $this->error('操作失败');//失败返回
        }



    }

}