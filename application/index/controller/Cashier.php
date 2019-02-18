<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/28
 * Time: 10:07
 */
namespace app\index\controller;


class Cashier extends Base
{

    public function index()
    {
        $order_id = input('order_id');
        $orderData=db('order')->find($order_id);
        $this->assign('order_id',$order_id);
        $this->assign('total_amount',$orderData['total_amount']);
        return $this->fetch('cashier');
    }
}