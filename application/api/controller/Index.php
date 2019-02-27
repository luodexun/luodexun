<?php
namespace app\api\controller;
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, sign");
header('Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS');
class Index extends Base {
    public function index()
    {
        return response('链接成功',200,['Authorization'=>'Basic bGxsMjc5OTA2OTA4OmxkeDU3NDQyNTQ1MA=='],'json');
    }
    public function update()
    {
        return response('链接成功',200,['Authorization'=>'Basic bGxsMjc5OTA2OTA4OmxkeDU3NDQyNTQ1MA=='],'json');
    }
}
