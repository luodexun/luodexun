<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/21
 * Time: 9:32
 */
namespace app\admin\model;
use think\Controller;
class Catedata extends Controller{
    static public function getaddClass($level){
          $data=db('cate')
              ->field('name,id,path')
              ->where('level',$level)
              ->select();
          $le=db('cate')
            ->field('level')
            ->select();
        $rul=[];
         for($i=0;$i<count($le);$i++){
             array_push($rul,$le[$i]['level']);
         }
         $num=max($rul);
//        dump($level);exit();
           return $data=[$data,$num,];
    }
    static public function addClass($id){
        $data=db('cate')
            ->field('path,level')
            ->where('id',$id)
            ->select();
        return $data;
    }
    static public function getData($name,$id){
        if (empty($id)&&$id!='0'){
            $data=db($name)
                ->select();
        }else{
            $data=db($name)
                ->where('pid',$id)
                ->select();
        }
        if(!isset($data)){
            return false;
        }
        return $data;
    }
    static public function addData($name,$data){
        $id=db($name)->insertGetId($data);
        if(empty($id)||!isset($id)){
            return false;
        }
        $da=[
            'id'=>$id,
            'path'=>$data['path'].','.$id
        ];
//        dump($da);exit();
        $rul=db($name)->update($da);
        if ($rul!==false) {
            return $kk=[
                'state'=>'succeed',
                'msg'=>'添加成功',
            ];
        } else {
            return $kk=[
                'state'=>'error',
                'msg'=>'添加失败',
            ];
        }
    }
    static public function editData($name,$data){
        $rul=db($name)->update($data);
        if ($rul!==false) {
            return [
                'state'=>'succeed',
                'msg'=>'修改成功',
            ];
        } else {
            return [
                'state'=>'error',
                'msg'=>'修改失败',
            ];
        }
    }
    static public function delData($name,$id){
        $data=db($name)->find($id);
        $path=$data['path'];
        $map['path']  = ['like',$path.'%'];
        $rul=db($name)
            ->where($map)
            ->delete();
        if ($rul!==false) {
            return $kk=[
                'state'=>'succeed',
                'msg'=>'删除成功',
            ];
        } else {
            return $kk=[
                'state'=>'error',
                'msg'=>'删除失败',
            ];
        }
    }
}