<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Loader;
use think\Validate;
use app\admin\model\Userdata;
class Member extends Base{
    //    加载用户列表
    public function index(){
        $id=null;
        $data=Userdata::getData('member',$id);
//      dump($data);exit();
        $this->assign('memberList',$data);
        return $this->fetch('Admin/list');
    }
    //   添加用户
    public function add(){
        //        判断是否为post模式接收数据
        if (request()->isPost()){
            $data=[
                'member_id'=>input('id'),
                'username'=>input('username'),
                'mobile'=>input('mobile'),
                'email'=>input('email'),
            ];
            if (!empty(input('password'))){
               $data['password']=md5(input('password'));
            }
//            判断用户是否冻结
            if(input('lock')=='on'){
                $data['lock']=1;
            }else{
                $data['lock']=0;
            };
            $data['reg_time']=time();
            if ($_FILES['pic']['tmp_name'] != '') {
                $arr = Userdata::upload('pic');
                if ($arr['status'] == 'success') {
                    $data['pic'] = $arr['url'];
                } else {
                    return $this->error($arr['msg']);
                }
            }
//            dump($data);exit();
            $validate= validate('Admin'); //获取表中的数据 Admin是类名 必须首字母大写
            if(!$validate->scene('add')->check($data)){//加了验证场景 并验证数据
                return $this->error($validate->getError());//自动验证提示错误
            }
            $data['ip']= $_SERVER["REMOTE_ADDR"];
            $rul=Userdata::addData('member',$data);
//            判断状态
            if ($rul['state']=='succeed') {
                return $this->success($rul['msg'], ('Member/index'));
            } else {
                return $this->error($rul['msg']);
            }
//            dump($data);exit();
        }
//      加载用户添加模版
        $data=[
            'way'=>1,
            'member_id'=>'',
            'username'=>'',
            'pic'=>'',
            'mobile'=>'',
            'email'=>'',
            'ip'=>'',
            'lock'=>''
        ];
//        dump($data);exit();
        $this->assign('memberAe',$data);
        return $this->fetch('admin/list');
    }
    //    编辑用户
    public function edit(){
        //        判断是否为post模式接收数据
        if (request()->isPost()){
            $data=[
                'member_id'=>input('member_id'),
                'username'=>input('username'),
                'mobile'=>input('username'),
                'email'=>input('email'),
            ];
            if (!empty(input('password'))){
                $data['password']=md5(input('password'));
            }
//            判断用户是否冻结
            if(input('lock')=='on'){
                $data['lock']=1;
            }else{
                $data['lock']=0;
            };
            if ($_FILES['pic']['tmp_name'] != '') {
                $arr =Userdata::upload('pic');
                if ($arr['status'] == 'success') {
                    $urlDate=db('member')->field('pic')->find($data['member_id']);
                    @unlink('.'.$urlDate['pic']);
                    $data['pic'] = $arr['url'];
                } else {
                    return $this->error($arr['msg']);
                }

            }
            $validate= validate('Userdata'); //获取表中的数据 Admin是类名 必须首字母大写
            if(!$validate->scene('edit')->check($data)){//加了验证场景 并验证数据
                return $this->error($validate->getError());//自动验证提示错误
            }
            $data['ip']= $_SERVER["REMOTE_ADDR"];
//            dump($data);exit();
            $rul=Userdata::editData('member',$data);
//            判断状态
            if ($rul['state']=='succeed') {
                return $this->success($rul['msg'], ('Member/index'));
            } else {
                return $this->error($rul['msg']);
            }
//            dump($data);exit();
        }
//        将要修改的用户数据取出送到模版
        $id=input('member_id');
//        dump($id);exit();
        $data=Userdata::getData('member',$id);
        $data['data'][0]['way']=2;
//        dump($data);exit();
//        dump($data);exit();
        $this->assign('memberAe', $data['data'][0]);
        return $this->fetch('admin/list');
    }
    //    删除用户
    public function del($member_id)
    {
        $rul=Userdata::delData('member',$member_id);
//            判断状态
        if ($rul['state']=='succeed') {
            return $this->success($rul['msg'], ('Member/index'));
        } else {
            return $this->error($rul['msg']);
        }
    }
}