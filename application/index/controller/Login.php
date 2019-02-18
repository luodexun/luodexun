<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/21
 * Time: 15:15
 */
namespace app\index\controller;
use app\model\sms\SmsDemo;
use  app\index\model\Sms;
class Login extends Base
{
    public function index()
    {
       return $this->fetch('login');
    }
    public function doLogin(){
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
        if(!$data['code']){
            return $this->error('验证码不能为空');
        }
        //链接数据库
        $info=db('member')->where(array('username'=>$data['username']))->find();
        //验证用户名
//        dump( $info);exit();
        if ($data['username']!=$info['username']){
            return $this->error("用户名或密码错误",'Login/index');
        }
        //验证密码
        //if (md5($data['password'])!=$info['password']){
            if (md5($data['password'])!=$info['password']){
            return $this->error("用户名或密码错误",'Login/index');
        }
        //登录成功后  将用户信息存到session
        session('member',$info);
        $car=unserialize(cookie('car'));
        for($i=0;$i<count($car);$i++){
            $kk=new Car();
            $kk->car($car[$i]['goods_id'],$car[$i]['goods_num']);
        }
        //成功返回
        return $this->success('登录成功 正在跳转...','Index/index',session('next_url'));

    }

    //退出登录
    public function logout(){
        session('member',null);
        return $this->redirect('Index/index');

    }
    public function msg($name){
        $code='';
        $info=db('member')
            ->field('mobile,member_id')
            ->where('username',$name)
            ->find();
        for($i=0;$i<6;$i++){
            $code.=rand(1,9);
        }
        for($i=0;$i<8;$i++){
            $this->outId.=rand(1,9);
        }
        $req=SmsDemo::sendSms($info['mobile'],$code,$this->outId);
        $array=json_decode(json_encode($req,JSON_UNESCAPED_UNICODE),TRUE);
        $data=[
            'member_id'=>$info['member_id'],
            'out_id'=>$code,
            'request_id'=>$array['RequestId']
        ];
        $kk=Sms::addSmsIfo($data);
        return $info['mobile'];

    }

    }