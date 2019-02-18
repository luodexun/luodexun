<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/23
 * Time: 11:31
 */
namespace app\index\model;
use think\Controller;
class Goods extends Controller
{
    static public function load($cateName){
//        dump($cateName);
        if (isset($cateName[1])){
            $rul=db('cate')
                ->field('id')
                ->where('name',$cateName[1])
                ->select();
            $recur=[$rul[0]['id']];
        }else{
            $rul=db('cate')
                ->field('id')
                ->where('name',$cateName[0])
                ->select();
            $data=db('cate')
                ->where('pid',$rul[0]['id'])
                ->field('id')
                ->select();
            $recur=[];
            for ($i=0;$i<count($data);$i++){
                array_push($recur,$data[$i]['id']);
            }
            array_unique($recur);
        }
//        dump($recur);exit();




//     dump($recur);exit();
//        exit();
        return $recur;
    }

    static public function cate($cateName){
        $recur=Goods::load($cateName);
        $a= db('cate')
            ->where('id', 'in', $recur)
            ->field('name')
            ->select();
        $b= db('cate')
            ->alias('a')
            ->join('goods c', 'a.id=c.cate_id')
            ->where('a.id', 'in', $recur)
            ->field('keywords')
            ->select();
        $m=[];
        for ($i=0;$i<count($b);$i++){
            $array = array_values($b[$i]);
            for ($k=0;$k<count($array);$k++){
                array_push($m,$array[$k]);
                $m=array_unique($m);
            }
        }
//        dump($m);exit();
        $field=["sustainable","farmer","natural","local","visit","ancient","negative","agriculture","origin","gluten","material","gmo","produce"];
        $c= db('cate')
            ->alias('a')
            ->join('goods c', 'a.id=c.cate_id')
            ->where('a.id', 'in', $recur)
            ->join('select b', 'c.goods_id=b.goods_id')
            ->field($field)
            ->select();
        for ($i=0;$i<count($field);$i++){
            $rul[$i]=0;
        }
//        dump($c);
        for ($i=0;$i<count($c);$i++){
            $array=array_values($c[$i]);
            for ($k=0;$k<count($array);$k++){
                if($array[$k]==1){
                    $rul[$k]=1;
                }
            }
        }
//        dump($rul);exit();
        $k=[$rul,['可持续发展','小农栽种','天然无毒','本地食材','一米亲访','古法手作','无负面添加','自然农法','优质产地','无麸质','纯天然原料','非转基因','有机生产']];
        if(count($cateName)!=1){
            $a=[];
        }
        $data=[$a,$m, $k];
        return $data;
    }

    static public function vv($cateName){
        $data1=[];
        $data2=[];
        $data3=[];
        if(count($cateName[0])==1){
            $ci= db('cate')
                ->where('name',$cateName[0][0])
                ->field('id')
                ->select();
            $data=db('cate')
                ->alias('a')
                ->where('a.pid', $ci[0]['id'])
                ->join('goods c','a.id=c.cate_id')
                ->field('c.goods_id')
                ->select();
            $data1=Goods::Analysis($data);
        }else{
            for ($i=1;$i<count($cateName[0]);$i++){
                $rul=db('cate')
                    ->alias('a')
                    ->where('a.name',trim($cateName[0][$i]))
                    ->join('goods c','a.id=c.cate_id')
                    ->field('c.goods_id')
                    ->select();
                $data1=array_merge($data1,Goods::Analysis($rul));
            }
        }
        $k=['可持续发展','小农栽种','天然无毒','本地食材','一米亲访','古法手作','无负面添加','自然农法','优质产地','无麸质','纯天然原料','非转基因','有机生产'];
        $field=["sustainable","farmer","natural","local","visit","ancient","negative","agriculture","origin","gluten","material","gmo","produce"];
        if(count($cateName[2])!=1) {
            for ($i = 1; $i < count($cateName[2]); $i++) {
                for ($j = 0; $j < count($k); $j++) {
                    if ($cateName[2][$i] == $k[$j]) {
                        $rul = db('select')
                            ->where($field[$j], 1)
                            ->where('goods_id', 'in', $data1)
                            ->field('goods_id')
                            ->select();
                        $data2=array_unique(array_merge($data2,Goods::Analysis($rul)));
                    }
                }
            }
        }else{
            $data2=$data1;
        }
        if(count($cateName[1])!=1) {
            for ($i = 1; $i < count($cateName[1]); $i++) {
                $rul = db('goods')
                    ->where('goods_id', 'in', $data2)
                    ->where('keywords',trim($cateName[1][$i]))
                    ->field('goods_id')
                    ->select();
                $data3=array_unique(array_merge($data3,Goods::Analysis($rul)));
            }
        }else{
           $data3=$data2;
        }
        return $data3;
    }

    static public function search($cateName){
        $rul=Goods::vv($cateName);
//        dump($rul);exit();
        $data = db('goods')
            ->alias('a')
            ->where('a.goods_id','in', $rul)
            ->join('image k', 'a.goods_id=k.goods_id')
            ->where('k.is_face', '1')
            ->field('a.goods_id,a.sell_price,a.goods_name,a.store,a.keywords,k.image_url')
            ->select();
//        dump($data);
//        exit();
        return $data;

    }

    static public function Analysis($data){
        $rul=[];
        for ($i=0;$i<count($data);$i++){
            array_push($rul,$data[$i]['goods_id']);
        }
        return $rul;
    }

    static public function kk($cateName){
        $data=[];
        $data1=[];
        $data2=[];
        $data3=[];
        $filed=['sustainable','farmer','natural','local','visit','ancient','negative','agriculture','origin','gluten','material','gmo','produce'];
        $ci= db('cate')
            ->where('name',$cateName[0])
            ->field('level,id')
            ->select();
//        dump($ci);exit();
        if($ci[0]['level']==0&&count($cateName)==1){
            $data=db('cate')
                ->alias('a')
                ->where('a.pid', $ci[0]['id'])
                ->join('goods c','a.id=c.cate_id')
                ->field('c.goods_id')
                ->select();
             $data=Goods::Analysis($data);
        }else{
            $data=db('cate')
                ->alias('a')
                ->where('a.pid', $ci[0]['id'])
                ->join('goods c','a.id=c.cate_id')
                ->field('c.goods_id')
                ->select();
            $data=Goods::Analysis($data);
//            dump(count($cateName));exit();
            for ($i=1;$i<count($cateName);$i++){
                $rul=db('cate')
                    ->alias('a')
                    ->where('a.name',trim($cateName[$i]))
                    ->join('goods c','a.id=c.cate_id')
                    ->field('c.goods_id')
                    ->select();
                if(isset($rul[0])){
                    $data1=array_merge($data1,Goods::Analysis($rul));
//                    $kk=Goodsdata::insert($data,$data1);
//                    $kk=Goodsdata::insert($kk,$data1);
                }else{
                    $rul=db('goods')
                        ->where('keywords',trim($cateName[$i]))
                        ->where('goods_id', 'in', $data)
                        ->field('goods_id')
                        ->select();
                    if(isset($rul[0])){
                        $data2=array_merge($data2,Goods::Analysis($rul));
//                        $kk=Goodsdata::insert($kk,$data2);
//                        $kk=Goodsdata::insert($kk,$data2);
                    }else{
                        for($k=0;$k<count($filed);$k++){
                            $rul=db('select')
                                ->where($filed[$k],trim($cateName[$i]))
                                ->where('goods_id', 'in', $data)
                                ->field('goods_id')
                                ->select();
                            if(isset($rul[0])){
                                $data3=array_unique(array_merge($data3,Goods::Analysis($rul)));
//                                $kk=Goodsdata::insert($kk,$data3);
                            }
                        }
                    }
                }
//                else{
//                    if(isset($data[0])){
//                        echo '1';
//                        $rul=db('goods')
//                        ->where('keywords',trim($cateName[$i]))
//                        ->where('goods_id', 'in', $data)
//                        ->field('goods_id')
//                        ->select();
//                        $data1=array_merge($data1,Goodsdata::Analysis($rul));
//                    }else{
//                        echo '2';
//                        $rul=db('goods')
//                        ->where('keywords',trim($cateName[$i]))
//                        ->field('goods_id')
//                        ->select();
//                    }
//
//                }
//                elseif(isset($rul[0])){
//                    $rul=db('goods')
//                        ->where('keywords',trim($cateName[$i]))
//                        ->where('goods_id', 'in', $data)
//                        ->field('goods_id')
//                        ->select();
//                    if(isset($rul[0])){
//                        $data=array_merge($da,Goodsdata::Analysis($rul));
//                    }
//                }else{
//                    $rul=db('goods')
//                        ->where('keywords',trim($cateName[$i]))
//                        ->field('goods_id')
//                        ->select();
//                }
            }

//            $data=Goodsdata::Analysis($data);
        }
        $kk=[];
        array_push($kk,$data,$data1,$data2,$data3);
       for($f=1;$f<count($kk);$f++){
            if (!empty($kk[$f])){
                $data=array_intersect($data,$kk[$f]);
            }
        }
        return $data;
        }

    static public function goods($cateName)
    {
        $recur=Goods::load($cateName);
        $data = db('cate')
            ->alias('a')
            ->join('goods c', 'a.id=c.cate_id')
            ->where('a.id', 'in', $recur)
            ->join('image k', 'c.goods_id=k.goods_id')
            ->where('k.is_face', '1')
            ->select();
        return $data;
    }

    static public function nav(){
        $hh=[];
        $cc=[];
        $data=db('cate')
            ->where('level',0)
            ->field('id,name')
            ->select();
        for ($i=0;$i<count($data);$i++){
          $rul=db('cate')
              ->where('pid',$data[$i]['id'])
              ->field('name')
              ->select();
            for ($k=0;$k<count($rul);$k++){
               $yy=array_values($rul[$k]);
                array_push($cc,$yy[0]);
            }
            $kk=[$data[$i]['name'],$cc];
            $cc=[];
            array_push($hh,$kk);
        }
//        dump($hh);
        return $hh;

    }

}