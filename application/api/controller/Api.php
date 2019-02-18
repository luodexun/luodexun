<?php
namespace app\api\controller;

use think\Controller;
use think\Request;
use app\api\controller\Send;
use app\api\controller\Oauth;

/**
 * api 入口文件基类，需要控制权限的控制器都应该继承该类
 */
class Api
{
	/**
     * @var \think\Request Request实例
     */
    protected $clientInfo;

	/**
	 * 构造方法
	 * @param Request $request Request对象
	 */
	public function __construct()
	{
		$this->init();
		$this->uid = $this->clientInfo['uid'];

	}

	/**
	 * 初始化
	 * 检查请求类型，数据格式等
	 */
	public function init()
	{	
		//所有ajax请求的options预请求都会直接返回200，如果需要单独针对某个类中的方法，可以在路由规则中进行配置
		if(request()->isOptions()){

			return response("成功",200,null,'Text');
		}
		//配置不要鉴权的方法白名单
		if(!in_array(request()->controller().'/'.request()->action().'/'.strtolower(request()->method()),config('allow_method'))){
			//授权处理
			$oauth = model('app\api\controller\Oauth');   //tp5.1容器，直接绑定类到容器进行实例化
    		return $this->clientInfo = $oauth->authenticate();
		}

	}
}