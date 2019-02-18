<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/22
 * Time: 10:35
 */
namespace app\admin\model;
use think\Model;

class imageData extends Model{
    static public function allGoods($id){
        $data=db('image')
            ->alias('d')//别名
            ->field('a.goods_id,a.goods_name,d.image_id,d.is_face,d.image_url')
            ->join('goods a','d.goods_id=a.goods_id','left')
            ->order('a.goods_id')
            ->where(['a.goods_id'=>$id])
            ->paginate(3);
        return  $data;

    }
    //操作封面
    static public function upd($i_id,$g_id){


        if(!$i_id){
            return false;
        }
        if(!$g_id){
            return false;
        }


        //修改商品ID对应的图片is_face为0
        $goods=db('image')->where(['goods_id'=>$g_id])->update(['is_face'=>0]);
        //未执行则返回

        if($goods===false){
            return false;
        }

        //修改图片ID对应的图片is_face为1
        $data=db('image')->update([
            'is_face'=>1,
            'image_id'=>$i_id
            ]);

        return $data!==false?true:false;


    }

    //根据商品名字查出商品的id
    static public function getGoods($id){
        if (empty($id)){
            return false;
        }

        $data=db('goods')->field('goods_id,goods_name')->find($id);
        return $data;
    }

    //添加图片
    static public function add($data){
        if (empty($data)){
            return false;
        }

        //保存数据到数据库   insert
        $res=db('image')->insert($data);
        return $res!==false?true:false;
    }

    //删除图片
    static public function del($id){

        //查出图片路径--只查pic这个字段
        $picData=\db('image')->field('image_url')->find($id);
        $pic=$picData['image_url'];

        $goods_id=db('image')->find($id);

        //unlink删除文件
        //把绝对路径转为相对路径
        @unlink('.'.$pic);


        $res=db('image')->delete($id);


        return [
            'res'=>$res,
            'id'=>$goods_id['goods_id']
        ];
    }



}