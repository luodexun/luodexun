<?php
namespace app\api\controller;

/**
 * 生成token
 */
class Token extends Base
{
	/**
	 * 请求时间差
	 */
	public static $timeDif = 10000;

	public static $accessTokenPrefix = 'accessToken_';
	public static $expires = 7200;
	/**
	 * 测试appid，正式请数据库进行相关验证
	 */
	public static $appid = 'tp5restfultest';
	/**
	 * appsercet
	 */
	public static $appsercet = '123456';

	/**
	 * 生成token
	 */
	public function token($params)
	{
		//参数验证
		$validate = new \app\api\validate\Token;
		if(!$validate->check($params)){
			return response($validate->getError(),401);
		}

		self::checkParams($params);  //参数校验
		//数据库已经有一个用户,这里需要根据input('mobile')去数据库查找有没有这个用户
		$userInfo = [
			'uid'   => 1,
			'mobile'=> $params['mobile']
		]; //虚拟一个uid返回给调用方
		try {
			$accessToken = self::setAccessToken(array_merge($userInfo,$params));  //传入参数应该是根据手机号查询改用户的数据
			return $this->setData($accessToken)->setMsg('获取成功')->setCode(1000)->renderOutput();
		} catch (Exception $e) {
			return response($e,500);
		}
	}

	/**
	 * 刷新token
	 */
	public function refresh($refresh_token='',$appid = '')
	{
		$cache_refresh_token = Cache(self::$refreshAccessTokenPrefix.$appid);  //查看刷新token是否存在
		if(!$cache_refresh_token){
			return response('refresh_token is null',401);
		}else{
			if($cache_refresh_token !== $refresh_token){
				return response('refresh_token is error',401);
			}else{    //重新给用户生成调用token
				$data['appid'] = $appid;
				$accessToken = self::setAccessToken($data);
                return $this->setData($accessToken)->setCode(1000)->renderOutput();
			}
		}
	}

	/**
	 * 参数检测
	 */
	public static function checkParams($params = [])
	{	
		//时间戳校验
//		if(abs($params['timestamp'] - time()) > self::$timeDif){
//
//			return response('请求时间戳与服务器时间戳异常',401);
//		}

		//appid检测，这里是在本地进行测试，正式的应该是查找数据库或者redis进行验证
		if($params['appid'] !== self::$appid){
			return response('appid 错误',401);
		}

		//签名检测
		$sign = Oauth::makeSign($params,self::$appsercet);
		if($sign !== $params['sign']){
			return response('sign错误','sign：'.$sign,401);
		}
	}

	/**
     * 设置AccessToken
     * @param $clientInfo
     * @return int
     */
    protected function setAccessToken($clientInfo)
    {
        //生成令牌
        $accessToken = self::buildAccessToken();

        $accessTokenInfo = [
            'access_token'  => $accessToken,//访问令牌
            'expires_time'  => time() + self::$expires,      //过期时间时间戳
            'client'        => $clientInfo,//用户信息
        ];
        self::saveAccessToken($accessToken, $accessTokenInfo);  //保存本次token
        unset($accessTokenInfo['client']);
        return $accessTokenInfo ;
    }


    /**
     * 生成AccessToken
     * @return string
     */
    protected static function buildAccessToken($lenght = 32)
    {
        //生成AccessToken
        $str_pol = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789abcdefghijklmnopqrstuvwxyz";
		return substr(str_shuffle($str_pol), 0, $lenght);

    }

    /**
     * 存储token
     * @param $accessToken
     * @param $accessTokenInfo
     */
    protected static function saveAccessToken($accessToken, $accessTokenInfo)
    {
        //存储accessToken
        cache(self::$accessTokenPrefix . $accessToken, $accessTokenInfo, self::$expires);
    }
}