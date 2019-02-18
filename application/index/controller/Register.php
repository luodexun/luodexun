<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/21
 * Time: 15:26
 */
namespace app\index\controller;


class Register extends Base
{
    public function index()
    {
        return $this->fetch('register');
    }
public function register(){
        if(request()->isPost()) {
            $response = [
                'status'=>'error',
                'msg'=>''
            ];
            //获取数据
            $data = [
                'username'         => input('username'),
                'password'         => input('password'),
                'checkPassword'    => input('checkPassword'),
                'checkCode'        => input('checkCode'),
                'verificationCode' => input('verificationCode')
            ];
            //验证

            //验证验证码是否正确
            if(!captcha_check($data['checkCode'])){
                //return $this->error('验证码错误','Register/register');
                $response['msg'] = '验证码错误';
                return json($response);
            }

            $validate = validate('Member');
            if (!$validate->scene('register')->check($data)) {
                //return $this->error($validate->getError());
                $response['msg'] = $validate->getError();
                return json($response);
            }
            //保存数据
            $arr = [
                'username'=>$data['username'],
                'password'=>$data['password']
            ];
            $arr['password'] = md5($arr['password']);
            //返回这条记录的主键值
            $res = db('member')->insertGetId($arr);
            if ($res) {
                //return $this->success('注册成功', url('Login/index'));
                $response['status'] = 'success';
                $response['msg'] = '注册成功';
                //根据主键值查出用户信息
                $info = db('member')->find($res);
                //将用户信息保存在session 即注册成功后默认为已登录状态
                session('member',$info);

                return json($response);
            } else {
                $response['msg'] = '注册失败';
                return json($response);
                //return $this->error('注册失败');
            }
        }
    return $this->fetch('register');
}
}