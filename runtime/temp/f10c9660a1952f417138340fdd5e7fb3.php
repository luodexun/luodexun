<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:56:"/serve/ldx/public/../application/index/view/lis/lis.html";i:1543245796;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品分类_一米市集</title>
    <link rel="icon" href="__STATIC__/index/img/favicon.ico">
    <link rel="stylesheet" href="__STATIC__/index/css/bootstrap.css">
    <link rel="stylesheet" href="__STATIC__/index/css/yimi-home.css">
    <link rel="stylesheet" href="__STATIC__/index/css/goods.css">
    <link href="__STATIC__/index/style/header.css" type="text/css" rel="stylesheet"/>
    <link href="__STATIC__/index/style/footer.css" type="text/css" rel="stylesheet"/>
    <script src="__STATIC__/index/js/jquery-3.2.1.js"></script>
</head>
<body>
 <?php echo widget('Common/header'); ?>
<div class="inner_wrap" style="height: 1500px;">
    <div class="bread_wrap">
        <div class="cate_products_them">
            <img src="__STATIC__/index/img/4eb0ce5224a45a12f02df2461fcb2c67.jpg" alt="">
        </div>
        <div class="cate_photo_goods">
            <div class="cate_img_wrap">
                <div class="cate_img">
                    <a href="" style="background-image: url('__STATIC__/index/img/cate_img1.jpg')"></a>
                    <p class="cate_promo_goods_text">
                        <span class="p_name">有机紫水晶火龙果 250-350g/个</span>
                        <span class="p_info">￥46.00</span>
                </div>
                <div class="cate_img">
                    <a href="" style="background-image: url('__STATIC__/index/img/cate_img2.jpg')"></a>
                    <p class="cate_promo_goods_text">
                        <span class="p_name">上海烧卖「一只宝」 香菇肉丁</span>
                        <span class="p_info">￥36.00</span>
                </div>
                <div class="cate_img">
                    <a href="" style="background-image: url('__STATIC__/index/img/cate_img3.jpg')"></a>
                    <p class="cate_promo_goods_text">
                        <span class="p_name">生态慢养膳博士黑猪肋排</span>
                        <span class="p_info">￥46.00</span>
                </div>
                <div class="cate_img">
                    <a href="" style="background-image: url('__STATIC__/index/img/cate_img4.jpg')"></a>
                    <p class="cate_promo_goods_text">
                        <span class="p_name">有机醉金香葡萄</span>
                        <span class="p_info">￥43.00</span>
                </div>
                <div class="cate_img">
                    <a href="" style="background-image: url('__STATIC__/index/img/cate_img5.jpg')"></a>
                    <p class="cate_promo_goods_text">
                        <span class="p_name">有机巨玫瑰葡萄</span>
                        <span class="p_info">￥38.00</span>
                </div>
            </div>
            <div class="pre_btn"></div>
            <div class="next_btn"></div>
            <div class="cate_page_dot">
                <ul>
                    <li class="cate_dot" style="background-color:#15374A"></li>
                    <li class="cate_dot"></li>
                    <li class="cate_dot"></li>
                    <li class="cate_dot"></li>
                    <li class="cate_dot"></li>
                </ul>
            </div>
        </div>
        <div class="cate_products_pic">
            <div class="cate_artPic">
                <a href="" style="background-image: url('__STATIC__/index/img/926692f3584d610e0c7b098b38f0aa8b.jpg')"></a>
            </div>
            <div class="cate_artPic">
                <a href="" style="background-image: url('__STATIC__/index/img/49830e9e2d0753b719c95e1fafd63a01.jpg')"></a>
            </div>
        </div>
    </div>
    <div class="row">
        <!--左边-->

        <div class="search_bar col-md-2" style="height: 1200px;">
            <?php if(!empty($data[0])): ?>
            <div class="cats">
                <div class="taggle_open"></div>
                <div class="ctl_header">分类</div>
                <div class="cats_con">
                    <ul class="cat_one">
                        <?php foreach($data[0] as $v): ?>
                        <li>
                            <a class="goods" name="">
                                <?php echo $v['name']; ?>
                                <span></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                        <li>
                            <a id="emptyGoods_one">
                                清空
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <?php endif; ?>
            <div class="cats">
                <div class="taggle_open"></div>
                <div class="ctl_header">分类</div>
                <div class="cats_con">
                    <ul class="cat_two">
                        <?php foreach($data[1] as $k): ?>
                        <li>
                            <a class="goods" name="">
                                <?php echo $k; ?>
                                <span></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                        <li>
                            <a id="emptyGoods_two">
                                清空
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="cats">
                <div class="taggle_open"></div>
                <div class="ctl_header">分类</div>
                <div class="cats_con">
                    <ul class="cat_three">
                        <?php foreach($data[2][1] as $d=>$n): ?>
                        <li>
                            <?php if($data[2][0][$d]==1): ?>
                            <a class="goods" name="">
                                <?php echo $n; ?>
                                <span></span>
                            </a>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>
                        <li>
                            <a id="emptyGoods_three">
                                清空
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--右边-->
        <div class="search_results col-md-10"style="height:800px;">

            <div id="dataContent" style="width: 915px;">
                <div class="head">
                    <div class="pro_count">
                        共 <span></span> 件
                    </div>
                    <div class="btn">价格</div>
                    <div class="btn">购买</div>
                    <div class="btn">评价</div>
                    <div class="btn strongTag">综合</div>
                </div>
                <div class="model" style="display:none">
                    <div class="goods_wrap" style="width:180px;height:327px;float: left">
                        <div class="rank"></div>
                        <div class="goods_pic">
                            <img src="__STATIC__/index/img/hot.png" class="goods_pic_odds">
                            <a href="" target="_blank">
                                <div style="height: 180px;" class="goods_pic_content"></div>
                            </a>
                            <div class="btn_add_reduce" style="display: none">
                                <span class="num_show">0</span>
                            </div>
                            <div class="goods_redu" style="display: none"></div>
                            <div class="goods_add" style="display: none"></div>
                            <span class="hover_bg" style="display: none"></span>
                            <input type="hidden" name="" class="goods_id">
                            <input type="hidden" name="" class="store">
                        </div>
                        <h3 class="goods_name" style="overflow: hidden;height: 36px"><a href="" target="_blank"></a></h3>
                        <div>
                            <a href="" class="des">一米市集严选</a>
                            <span class="product_unit">100g/份</span>
                        </div>
                        <div class="goods_price">
                            <div class="selling_price">
                                <span class="discount_price"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="goods_wrap_unit" style="">

                </div>
                <div class="PagingBlock">
                    <div id="pre_page" class="disabled"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>上一页</div>
                    <div id="pages_list">
                        <span class="page current" page="0"> 1 </span>
                    </div>
                    <div id="next_page">下一页<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></div>
                </div>
            </div>
        </div>
    </div>
</div>
 <input type="hidden" name="cate1" class="cate1" value=<?php echo $data1; ?>>
 <input type="hidden" name="cate2" class="cate2" value=<?php echo $data2; ?>>
 <?php echo widget('Common/footer'); ?>
<script src="__STATIC__/index/js/goods.js"></script>
<script src="__STATIC__/index/js/list.js"></script>
<script src="__STATIC__/index/js/ym-heard.js"></script>
</body>
</html>