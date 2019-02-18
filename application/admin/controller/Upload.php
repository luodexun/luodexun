<?php
namespace app\admin\controller;



class Upload extends Base
{
    public function index()
    {
        $this->assign("ossTitle",['title'=>"oss Upload"]);
        return $this->fetch('Admin/list');
    }
}
