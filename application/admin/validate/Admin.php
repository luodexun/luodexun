<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/15
 * Time: 18:23
 */
namespace app\admin\validate;

use think\Validate;

class Admin extends Validate{

    //验证规则
    protected $rule=[
      'username'=>'require|max:25|unique:manager',
      'password'=>'require',
    ];

    //提示文字
    protected $message=[
        'username.require' => '用户名必填',
        'username.max'     => '用户名最多不能超过25个字符',
    ];

    //验证场景
    protected $scene=[
      'add'=>['username','password'],
      'edit'=>['username'],
    ];

}




