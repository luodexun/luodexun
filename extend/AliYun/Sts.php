<?php
/**
 * Created by PhpStorm.
 * User: ldx
 * Date: 2019/11/13
 * Time: 3:00 PM
 */

namespace Aliyun;
include_once EXTEND_PATH.'/aliyun-php-sdk-core/Config.php';
use Sts\Request\V20150401 as StsApi;
use ClientException;
use ServerException;
use DefaultAcsClient;
use DefaultProfile;
class Sts {
    public function getSts(){
        DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", "Sts", "sts.cn-hangzhou.aliyuncs.com");
        $iClientProfile = DefaultProfile::getProfile("cn-hangzhou", 'LTAINkiaOSo4KJ28', 'qVYm5MQcuLrdk0Dqkp8KoKL9DUBWKx');
        $client = new DefaultAcsClient($iClientProfile);
        $roleArn = "acs:ram::1809406158160863:role/ramtesttappreadonly";
        $policy = json_encode([
            "Statement" => [
                [
                    "Action"   => "oss:*",
                    "Effect"   => "Allow",
                    "Resource" => "*"
                ]
            ],
            "Version"   => "1"
        ]);
        $request = new StsApi\AssumeRoleRequest();
        $request->setRoleSessionName("client_name");
        $request->setRoleArn($roleArn);
        $request->setPolicy($policy);
        $request->setDurationSeconds(3600);
        try {
            $response = $client->getAcsResponse($request);
            return [
                'status'=>'success',
                'data'=>[
                    "AccessKeySecret"=>$response->Credentials->AccessKeySecret,
                    "AccessKeyId"=>$response->Credentials->AccessKeyId,
                    "Expiration"=>$response->Credentials->Expiration,
                    "SecurityToken"=>$response->Credentials->SecurityToken
                ]
            ];
        } catch(ServerException $e) {
            return ['status'=>'error','msg'=>$e->getMessage()];
        } catch(ClientException $e) {
            return ['status'=>'error','msg'=>$e->getMessage()];
        }
    }
}