<?php
namespace app\admin\controller;

use think\Controller;

class Login extends Controller
{
    public function login()
    {
        return $this->fetch();
    }

    public  function  doLogin(){
        //获取参数
        $data=[
            'username'=>input('username'),
            'password'=>input('password'),
            'code'=>input('code'),
        ];
        //验证是否为空
        if(!$data['username']){
            return $this->error('用户名不能为空');
        }
        if(!$data['password']){
            return $this->error('密码不能为空');
        }
//        if(!$data['code']){
//            return $this->error('验证码不能为空');
//        }

        //验证验证码是否正确
//        if(!captcha_check($data['code'])){
//            return $this->error('验证码错误','Login/login');
//        }




        //获取数据库中的数据
        $info=db('admin')->where(array('username'=>$data['username']))->find();
//        echo db()->getLastSql();
//        dump($info);
//        exit;

        //验证用户名
        //!isset($info)||empty($info)
        if ($data['username']!=$info['username']){
            return $this->error("无效用户",'Login/login');
        }

        //验证密码
        if (md5($data['password'])!=$info['password']){
            return $this->error("密码错误",'Login/login');
        }

        //登录成功后  将用户信息存到session
        $info['lastlogin']=time();
        $rul=db('admin')->update($info);
        session('admin',$info);


         //成功返回
        return $this->success('登录成功 正在跳转...','Index/index');





    }

    public function outlogin(){
        session('admin',null);
        return $this->error("退出成功",'Login/login');
    }
}