<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/23
 * Time: 11:31
 */
namespace app\index\model;
use think\Controller;
class Sms extends Controller
{
    static public function addSmsIfo($data)
    {
        $data = db('sms')
            ->insert($data);
        return $data;
    }
}