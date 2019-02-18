<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/21
 * Time: 11:13
 */
namespace app\admin\model;

use think\Db;
use think\Model;

class Goodsdata extends Model {

    static public function allGoods(){
        $data=db('goods')
            ->alias('a')//别名
            ->field('a.goods_id,a.goods_name,a.sell_price,a.market_price,
            a.maketable,a.store,a.freez,a.recycle,a.last_modify,a.last_modify_id,
            c.name,d.is_face,d.image_url')
            ->join('cate c','a.cate_id =c.id','left')
            ->join('image d','d.goods_id=a.goods_id','left')
            ->where(['d.is_face'=>1])
            ->paginate(6);
        return $data;

    }
    static public function allcate(){
        $data=db('cate')
            ->field('id,pid')
            ->select();
        $id=[];$pid=[];
        for ($i=0;$i<count($data);$i++){
            array_push($id,$data[$i]['id']);
            array_push($pid,$data[$i]['pid']);
        }
         $pid=array_unique($pid);
         unset($pid[0]);
         $rul= array_diff($id,$pid);
        $data=db('cate')
            ->field('id,name')
            ->where('id','in',$rul)
            ->select();
           return $data;
//        dump($data);exit();
    }
    static public function add($data,$image,$select){
        if(empty($data)){
            return false;
        }
        if(empty($image)){
            return false;
        }

        if(empty($select)){
            return false;
        }
//        存商品数据
        $goods_id=db('goods')->insertGetId($data);
//          储存图片信息
        $image['goods_id']=$goods_id;
        $image['is_face']=1;
        db('image')->insert($image);
//        储存选择数据
        $select['goods_id']=$goods_id;
        $res=db('select')->insert($select);
        return $res!==false?true:false;

    }
    //编辑商品信息
    static public function edit($data,$select){
        if(empty($data)){
            return false;
        }
        if(empty($select)){
            return false;
        }
        //修改数据
        $res=db('goods')->update($data);
        $res=db('select')->update($select);
        return $res!==false?true:false;

    }

    //根据ID获取全部数据
    static public function getGoodsById($id){
        if(!$id){
            return false;
        }
        $data=db('goods')->find($id);
        $cate=Goodsdata::allCate();
        $select=db('select')
            ->where('goods_id',$id)
            ->select();
        return [$data,$cate,$select[0]]??false;
    }
      //删除商品信息
    static public function del($id){
        if(empty($id)){
            return false;
        }

        $data=db('goods')->find($id);

        if ($data['recycle']==1){
            $data['recycle']=0;


        }else if($data['recycle']==0){
            $data['recycle']=1;
        }

        $res=db('goods')->update($data);

        return $res!==false?true:false;


    }
   //处理图片上传的方法
    static public function upload($filename){
        //获取表单上传的文件 判断是不是POST提交
        $file = request()->file($filename);

        //如果上传了文件
        if ($file) {
            //将上传文件存到指定路径   tp5\public\uploads
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');

            //上传成功后 获取上传信息
            if ($info) {

                //拼接图片完整路径
                $url = '/uploads/' . $info->getSaveName();
                //把路径中的反斜线替换成正斜线
                $url = str_replace('\\', '/', $url);


                return [
                    'status' => 'success',
                    'url' => $url,
                ];
            } else {
                //上传失败错误信息
                return [
                    'status' => 'error',
                    'msg' => $file->getError(),
                ];
            }
        }
    }
    static public function img(){
        $image=[
        ];
        //判断图片有没有上传
        if ($_FILES['pic']['tmp_name']!=''){

            //上传图片
            $arr= self::upload('pic');
            if ($arr['status']=='success') {
                //把图片路径放入数据库
                $image['image_url'] = $arr['url'];
//                dump($image['image_url']);exit();
                $pic =\think\Image::open('.' . $image['image_url']);
                $dirName = dirname($image['image_url']);//路径名
                $baseName = basename($image['image_url']);//文件名


                $pic->thumb(650, 650)->save('.' . $dirName . '/650_' . $baseName);

                $image['image_b_url'] = $dirName . '/650_' . $baseName;

                $pic->thumb(250, 250)->save('.' . $dirName . '/250_' . $baseName);
                $image['image_m_url'] = $dirName . '/250_' . $baseName;
                $pic->thumb(100, 100)->save('.' . $dirName . '/100_' . $baseName);
                $image['image_s_url'] = $dirName . '/100_' . $baseName;

            }

            return $image;
        }
    }

}