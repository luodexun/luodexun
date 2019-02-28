<?php
namespace app\api\controller;

use think\Controller;
use think\Request;

trait Send
 {

	/**
	 * 返回成功
	 */
	public static function returnMsg($code = 200,$message = '')
	{	
		http_response_code($code);    //设置返回头部
        $return['code'] = (int)$code;
        $return['message'] = $message;
        $return['time']=time();
        header('Content-Type:application/json');
        exit(json_encode($return,JSON_UNESCAPED_UNICODE));
	}
}

