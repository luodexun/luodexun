<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/26
 * Time: 14:52
 */
namespace app\index\controller;


class Pay extends Base{

    public function index(){
        session('next_url',null);
        $data=db('jm_area')->select();
        $goodsData = $this->goods();
        $id=session('member')['member_id'];
        $addr=db('address')->where(['member_id'=>$id,'def_addr'=>1])->find();


        $this->assign('addr',$addr);
        $this->assign('data',$data);
        $this->assign('goodsData',$goodsData['goods']);
        $this->assign('total',$goodsData['total']);
        $this->assign('goods_ids',$goodsData['goods_ids']);


        return $this->fetch('pay');
    }



    public function city($area_id){
        $city=db('jm_area')->where(['parent_id'=>$area_id])->select();
        return json(
            $city
        );
    }

    public function town($area_id){
        $town=db('jm_area')->where(['parent_id'=>$area_id])->select();
        return json(
            $town
        );
    }

    public function goods(){
        //获取登录用户的id
        $id=session('member')['member_id'];
        //查询购物车表、商品表和图片管理表
        $data=db('car')
            ->alias('c')//别名
            ->join('goods g','g.goods_id=c.goods_id','left')
            ->join('image i','i.goods_id=c.goods_id','left')
            ->field('c.goods_num,c.goods_id,g.sell_price,i.image_s_url')
            ->where(['c.member_id'=>$id,'i.is_face'=>1])
            ->select();

        //计算总价
        $total = '';
        $goods_ids = count($data);
        foreach ($data as $k=>$v){
            $total += $v['sell_price']*$v['goods_num'];
        }

            return [
                'goods'=>$data,
                  'total'=>  $total,
                'goods_ids'=>$goods_ids
            ];
    }


    public function order() {
        //获取登录用户的id
        $id = session('member')['member_id'];
        //查询购物车表、商品表
        $data = db('car')
            ->alias('c')//别名
            ->join('goods g', 'g.goods_id=c.goods_id', 'left')
            ->field('c.goods_num,g.sell_price')
            ->where(['c.member_id' => $id])
            ->select();
        //计算总价
        $total = '';
        foreach ($data as $k => $v) {
            $total += $v['sell_price'] * $v['goods_num'];
        }
        //获取下单时间
        $create_time = time();

        //dump($create_time);exit();
        //生成订单号 order_id
        $order_id = date('ymdHis', time()) . rand(10000, 99999);
        //echo $order_id;exit;
        //把需要存到order表的数据放到arr数组
        $arr = [
            'order_id'     => $order_id,
            'member_id'    => $id,
            'total_amount' => $total,
            'create_time'  => $create_time,
            'status'       => 1,
            'pay_status'   => 0,
            'memo'   => input('memo'),
        ];

        if (empty(input('pay_method'))){
            return json([
                'status'   => 'error',
            ]);
        }
        else{
            $arr['pay_method']=input('pay_method');
        }

        db('order')->insert($arr);

        return json([
            'status'   => 'success',
            'order_id' => $order_id
        ]);
            }

    //点击保存地址
    public function save(){
        //获取登录用户的id
        $id=session('member')['member_id'];
        $provinceId=input('province');
        $province= db("jm_area")->find($provinceId);
        $cityId=input('city');
        $city= db("jm_area")->find($cityId);
        $townId=input('town');
        $town= db("jm_area")->find($townId);
        $area=$province['area_name'].'省'.$city['area_name'].'市'. $town['area_name'];
        $addr=input('addr');


        $data=[
            'member_id'=>$id,
            'area'=>$area,
            'address'=>$addr,
        ];
        $data['create_time']=time();

        $data['def_addr']=1;


        $res=db('address')->insert($data);

        if($res!==false){
            return $this->success('保存成功',url('Pay/index'));//成功返回
        }
        else{
            return $this->error('保存失败');//失败返回
        }



    }
}