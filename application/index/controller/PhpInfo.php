<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/28
 * Time: 10:07
 */
namespace app\index\controller;


class phpInfo extends Base
{

    public function index()
    {
        phpinfo();
    }
}