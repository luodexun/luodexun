<?php

namespace app\api\controller;
//ajax 跨域访问
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT');
use app\model\sms\SmsDemo;
use  app\index\model\Sms;
include(ROOT_PATH."extend/sts.php");
class Aliyun extends Base {
    public function getSts(){
        $data=sts();
        return $this->setCode(1000)->setMsg('数据请求成功')->setData($data)->renderOutput();
    }

    public function senMsg($params){
        $code='';
        $outId='';
        $admin=session('admin');
        for($i=0;$i<6;$i++){
            $code.=rand(1,9);
        }
        for($i=0;$i<8;$i++){
            $outId.=rand(1,9);
        }
        $req=SmsDemo::sendSms($params['mobile'],$code,$outId);
        $array=json_decode(json_encode($req,JSON_UNESCAPED_UNICODE),TRUE);
        $data=[
            'member_id'=>$admin['member_id'],
            'out_id'=>$code,
            'request_id'=>$array['RequestId']
        ];
        $kk=Sms::addSmsIfo($data);
        return $this->setCode(1000)->setMsg('数据请求成功')->renderOutput();
    }
}