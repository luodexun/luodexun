<?php
namespace app\api\controller;
use think\Exception;

/**
 * API鉴权验证
 */
class Oauth
{
    /**
     * accessToken存储前缀
     *
     * @var string
     */
    public static $accessTokenPrefix = 'accessToken_';

    /**
     * 过期时间秒数
     *
     * @var int
     */
    public static $expires = 7200;

    /**
     * 认证授权 通过用户信息和路由
     * @param Request $request
     * @return \Exception|UnauthorizedException|mixed|Exception
     * @throws UnauthorizedException
     */
    final function authenticate()
    {
        return self::certification(self::getClient());
    }

    /**
     * 获取用户信息
     * @param Request $request
     * @return $this
     * @throws UnauthorizedException
     */
    public static function getClient()
    {   
        //获取头部信息
        try {
            $authorization = request()->header('Authorization');   //tp5.1Facade调用 获取头部字段
            return trim(str_replace('Bearer','',$authorization));
        } catch (Exception $e) {
            return response('Invalid authorization credentials',401);
        }
    }

    /**
     * 获取用户信息后 验证权限
     * @return mixed
     */
    public static function certification($authorization){
        $getCacheAccessToken = Cache(self::$accessTokenPrefix.$authorization);  //获取缓存access_token
        if(!$getCacheAccessToken){
            return response("access_token不存在或为空",401);
        }
        return $getCacheAccessToken['client'];
    }

    /**
     * 生成签名
     * _字符开头的变量不参与签名
     */
    public static function makeSign ($data = [],$app_secret = '')
    {   
        unset($data['version']);
        unset($data['sign']);
        return self::_getOrderMd5($data,$app_secret);
    }

    /**
     * 计算ORDER的MD5签名
     */
    private static function _getOrderMd5($params = [] , $app_secret = '') {
        ksort($params);
        $params['key'] = $app_secret;
        return strtolower(md5(urldecode(http_build_query($params))));

    }

}