<?php
namespace app\admin\controller;



class Index extends Base
{
    public function index()
    {
        $this->assign("defaultArgs", json_encode(array(
            "Action" => "",
            "params" => array(
                "" => ""
            )
        ), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        return $this->fetch('Admin/list');
    }
    public  function  php(){
        phpinfo();
    }
    public function web(){
        return $this->fetch('Admin/list');
    }
    public function  socket(){
        return $this->fetch();
    }
}
