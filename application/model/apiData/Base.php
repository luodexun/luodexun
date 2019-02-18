<?php

namespace app\model\apiData;
class Base {
//    分页
    public static function parsePageInfo() {
        $params=session('params');
        $page=isset($params['page'])?$params['page']:1;
        $pagesize =isset($params['pagesize'])?$params['pagesize']:30;
        if ($page < 1) {
            $page = 1;
        }
        if ($pagesize < 1) {
            $pagesize = 30;
        }
        $offset = ($page - 1) * $pagesize;
        return [$offset, $pagesize, $page];
    }

}