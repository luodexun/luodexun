<?php
namespace app\index\controller;
use app\index\model\Goods;
use dwn\Express;
class Index extends Base{
    public function test(){
        $client=new Express('8sGzEk3g','e3f327599d218ff2fcebb23d6f944965');
        $res=$client->setOption('ratio')->execute();
        dump($res);exit();
    }
    public function index()
    {
        $nu=[];
        $goods=[];
        $data=db('goods')
            ->alias('a')//别名
            ->field('a.goods_id,a.goods_name,a.keywords,a.sell_price,a.market_price,a.store,
            d.image_id,d.is_face,d.image_m_url,a.is_hot,a.is_new')
            ->join('image d','d.goods_id=a.goods_id','left')
            ->where(['d.is_face'=>1])
            ->where('a.keywords','一米市集严选')
            ->limit('8')
            ->select();
        $this->assign('data',$data);
        $rul=db('cate')
            ->alias('a')
            ->where('level','0')
            ->field('id')
            ->select();
        for ($i=0;$i<count( $rul);$i++){
            $cate=[];
            $data=db('cate')
                ->where('pid',$rul[$i]['id'])
                ->field('id')
                ->select();
//            dump($data);
            for ($j=0;$j<count( $data);$j++){
            array_push($cate,$data[$j]['id']);
            }
            array_push($nu,$cate);
        }
//        dump($nu);
        for ($k=0;$k<count($nu);$k++){
            $data=db('goods')
            ->alias('a')//别名
            ->where('a.cate_id','in',$nu[$k])
            ->field('a.goods_id,a.goods_name,a.keywords,a.sell_price,a.market_price,a.store,
            d.image_id,d.is_face,d.image_m_url,a.is_hot,a.is_new')
            ->join('image d','d.goods_id=a.goods_id','left')
            ->where(['d.is_face'=>1])
            ->limit(8)
            ->select();
            array_push($goods,$data);

    }
        $this->assign('goods',$goods);
        return $this->fetch('Index/index');

    }

}
