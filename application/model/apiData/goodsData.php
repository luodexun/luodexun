<?php
namespace app\model\apiData;
use think\Db;
class goodsData extends Base {
    public static function index($condition,$field){
        list($offset, $pagesize, $page) = self::parsePageInfo();
        $data=db('goods')
            ->limit($offset, $pagesize)
            ->where($condition)
            ->field($field)
            ->select();
        return $data;
     }
}