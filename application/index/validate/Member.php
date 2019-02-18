<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/25
 * Time: 16:19
 */
namespace app\index\validate;
use think\Validate;
class Member extends Validate{
    //验证规则
    ///^1[34578]\d{9}$/
    protected $rule=[
        'username'=>'require|regex:1[34578]\d{9}|unique:member',
        'password'=>'require|min:6|max:20',
        'checkPassword'=>'require|confirm:password',
        'checkCode'=>'require',
        'verificationCode'=>'require'
    ];
    //验证文字
    protected $message=[
        'username.require' => '手机号必须填写',
        'username.regex' => '请填写正确手机号',
        'username.unique'  => '该手机号码已注册过啦',
        'password.require' => '密码必填',
        'password.min' => '密码不得少于6个字符',
        'password.max' => '密码不得多于20个字符',
        'checkPassword.require' => '确认密码必填',
        'checkPassword.confirm' => '两次密码输入不一致',
        'checkCode.require' => '校验码必填',
        'verificationCode.require' => '验证码必填',
    ];
    //验证场景
    protected $scene=[

        'register'=>['username','password','checkPassword','checkCode', 'verificationCode'],

    ];

}