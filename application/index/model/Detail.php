<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/23
 * Time: 11:31
 */
namespace app\index\model;
use think\Controller;
class Detail extends Controller
{
    static public function detail($recur)
    {
        $data = db('cate')
            ->alias('a')
            ->join('goods c', 'a.id=c.id')
            ->where('a.id', 'in', $recur)
            ->join('image k', 'c.goods_id=k.goods_id')
            ->where('k.is_face', '0')
            ->select();
        return $data;
    }
}