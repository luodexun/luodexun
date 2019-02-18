<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/21
 * Time: 14:46
 */
namespace app\admin\model;
use think\Controller;
use think\Db;

class Userdata extends Controller{
//    加载数据
    static public function getData($name,$id){
        if (empty($id)&&$id!='0'){
            $data=db($name)
                ->paginate(6);
        }else{
            $data=db($name)
                ->where('id',$id)
                ->paginate(6);
        }
        if(!isset($data)){
            return false;
        }
        $page=$data->render();
        $data=$data->all();
        return [
            'data'=>$data,
            'page'=>$page
        ];
    }
//    用户添加
    static public function addData($name,$data){
       $rul=db($name)->insert($data);
        if ($rul!==false) {
            return [
                'state'=>'succeed',
                'msg'=>'添加成功',
            ];
        } else {
            return [
                'state'=>'error',
                'msg'=>'添加失败',
            ];
        }
    }
//    用户修改
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
//    用户删除
    static public function delData($name,$id){
        $rul=db($name)->delete($id);
        if ($rul!==false) {
            return [
                'state'=>'succeed',
                'msg'=>'删除成功',
            ];
        } else {
            return [
                'state'=>'error',
                'msg'=>'删除失败',
            ];
        }
    }
//      图片上传
    static function upload($filename)
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file($filename);

        // 移动到框架应用根目录/public/uploads/ 目录下
        if ($file) {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if ($info) {
                // 成功上传后 获取上传信息
                // 输出 jpg
//                echo $info->getExtension();
                // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
                $url = '/uploads/' . $info->getSaveName();
                $url = str_replace('\\', '/', $url);
                return [
                    'status' => 'success',
                    'url' => $url
                ];
//                echo $info->getSaveName();
                // 输出 42a79759f284b767dfcb2a0197904287.jpg
//                echo $info->getFilename();
            } else {
                // 上传失败获取错误信息
//                echo $file->getError();
                return [
                    'status' => 'error',
                    'msg' => $file->getError()
                ];
            }
        }
    }
}