<?php
namespace app\api\controller;
use Think\Controller;
class Updata extends Base {
    public function index()
    {
       $info=input('post');
       db('hooks')->insert([
           'content'=>$info
       ]);
    }
}