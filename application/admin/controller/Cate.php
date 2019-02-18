<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/20
 * Time: 22:39
 */
namespace app\admin\controller;
use app\admin\model\Catedata;
class Cate extends Base {
//    添加分类
    public function addClass(){
        if (request()->isPost()){
            $id=input('cate');
            if ($id!=0){
                $data=Catedata::addClass($id)[0];
                $data['level']=$data['level']+1;
                $data['pid']=$id;
                $data['name']=input('name');
            }else{
                $data=[
                    'name'=>input('name'),
                    'pid'=>$id,
                    'level'=>'0',
                    'path'=>'0',
                ];
            }

//            dump($data);exit();
            $rul=Catedata::addData('cate',$data);
//            dump($rul);exit();
            if ($rul['state']=='succeed') {
                return $this->success($rul['msg'], url('Cate/index',['id'=>$id]));
            } else {
                return $this->error($rul['msg']);
            }

        }
        $level=input('level');
        $data=Catedata::getaddClass($level);
        $data=$data[1];
//        dump($data);exit();
        $this->assign('addData', $data);
        return $this->fetch('Admin/list');
    }
    public function getClass(){
        $level=input('level');
//        dump($level);exit();
        if ($level!='top'){
            $data=Catedata::getaddClass($level);
            $data=$data[0];
        }else{
            $data=[
               ['name'=>'顶级分类']
            ];
        }
        return $data;
    }
//    加载数据
    public function index(){
        $id=input('id');
        if (!isset($id)){
            $id='0';
        }
        $data=Catedata::getData('cate',$id);
//        dump($data);exit();
        $this->assign('cateList', $data);
        return $this->fetch('Admin/list');
    }
//    添加数据
    public function add(){
        if (request()->isPost()){
            $id=input('id');
            $level=input('level')+1;
            $data=[
                'pid'=>$id,
                'level'=> $level,
                'name'=>input('name'),
                'path'=>input('path').',',
            ];
//            dump($data);exit();
            $rul=Catedata::addData('cate',$data);
//            dump($rul);exit();
            if ($rul['state']=='succeed') {
                return $this->success($rul['msg'], url('Cate/index',['id'=>$id]));
            } else {
                return $this->error($rul['msg']);
            }

        }
        $id=input('id');
        $level=input('level');
        $path=input('path');
        $data=[
            'way'=>1,
            'id'=>$id,
            'name'=>'',
            'level'=>$level,
            'path'=>$path,
        ];
//        dump($data);exit();
        $this->assign('cateAe', $data);
        return $this->fetch('Admin/list');
    }
//    修改数据
    public function edit(){
        //        判断是否为post模式接收数据
        if (request()->isPost()){
            $id=input('id');
            $data=[
                'id'=>$id,
                'name'=>input('name'),
            ];
//            $validate = validate('Userdata');
//            if(!$validate->scene('edit')->check($data)){
//                return $this->error($validate->getError());
//            }
            $rul=Catedata::editData('cate',$data);
//            判断状态
            if ($rul['state']=='succeed') {
                return $this->success($rul['msg'], url('Cate/index',['id'=>$id]));
            } else {
                return $this->error($rul['msg']);
            }
//            dump($data);exit();
        }
//        将要修改的用户数据取出送到模版
        $data=[
            'way'=>2,
            'id'=>input('id'),
            'name'=>input('name')
        ];
//        dump($data);exit();
//        dump($data);exit();
        $this->assign('cateAe', $data);
        return $this->fetch('admin/list');
    }
//    删除数据
    public function del(){
        $id=input('id');
        $rul=Catedata::delData('cate',$id);
        if ($rul['state']=='succeed') {
            return $this->success($rul['msg'], url('Cate/index',['id'=>$id]));
        } else {
            return $this->error($rul['msg']);
        }
    }

}