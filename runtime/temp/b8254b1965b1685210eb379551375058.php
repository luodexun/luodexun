<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:88:"/Users/ldx/WebstormProjects/luodexun/public/../application/index/view/Common/header.html";i:1545732534;}*/ ?>
<link href="__STATIC__/index/style/footer.css" type="text/css" rel="stylesheet"/>
<script src="__STATIC__/index/js/jquery-3.2.1.js"></script>
<div class="bar"></div>
<header>
    <div class="logo" style="background-image: url(__STATIC__/index/img/logo_modified.png)">
        <!--<p>跟友善农夫，买一份诚食</p>-->
    </div>
    <div class='ym_hd_products'>
        <a class='ym_hd_buttonHead' href="/products.html">所有商品</a>
        <ul>
     <?php foreach($nav as $v): ?>
            <li style="background-image: url('https://img.yimishiji.com/v1/img/d816053f3e405749cfbaf338f9bb1e1e.jpg');">
                <a href="/products-22.html" style="display: inline-block;width:100%;height:56px; "></a>
                <a class='tier1_cate' href="<?php echo url('Lis/lis',['id'=>$v[0]]); ?>"><?php echo $v[0]; ?></a>
                <ul>
                    <?php foreach($v[1] as $k): ?>
                    <li>
                        <a class='tier2_cate' href="<?php echo url('Lis/lis',['id'=>$v[0].','.$k]); ?>"><?php echo $k; ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class='ym_hd_theme'>
        <a class='ym_hd_buttonHead'>好事发生</a>
        <ul>
            <li class='promo'>
                <a href='http://www.yimishiji.com/article-zhuantihuodong-197.html'>新到尖货</a>
            </li>
            <li class='promo'>
                <a href='article-zhuantihuodong-104.html'>优惠推选</a>
            </li>
            <li class='promo'>
                <a href='article-zhuantihuodong-97.html'>好物预购</a>
            </li>
            <li class='promo'>
                <a href='https://www.yimishiji.com/card.html'>充值卡</a>
            </li>
        </ul>
    </div>

    <div class='ym_hd_lifestyle'>
        <a class='ym_hd_buttonHead'>吃的主张</a>
        <ul>
            <li class='promo'>
                <a href='tags.html'>做个选择</a>
            </li>
            <li class='promo'>
                <a href='farmers.html'>农友伙伴</a>
            </li>
            <li class='promo'>
                <a href='article-womenneirong-60.html'>认识我们</a>
            </li>
            <li class='promo'>
                <a href='blog-index.html'>食物记事</a>
            </li>
            <li class='promo'>
                <a href='http://www.yimishiji.com/article-zhuantihuodong-269.html'>公益伙伴</a>
            </li>
        </ul>
    </div>


    <div class='ym_hd_search'>
        <form id='search_form' action="/products.html" method="post" async="false">
            <input class="x-input" type="text" name="search_keywords" placeholder="搜索你喜欢的" value="有机杂粮"
                   id="dom_el_56ad320"/>
            <button class='search_button' style="background-image: url(__STATIC__/index/img/icon_magnifier.png)"></button>
        </form>
    </div>

    <div class='ym_hd_account'>
        <a class='ym_hd_buttonHead' href="/member.html" style="background-image: url(__STATIC__/index/img/ym_icon_user.png)"></a>
        <div class='ym_hd_profilePanel'>
            <div class="small-signin login_2193">
                <ul>
                    <?php if(\think\Request::instance()->session('member.member_id') == ''): ?>
                    <li>
                        <a href="<?php echo url('Login/index'); ?>">登入</a>
                    </li>
                    <li>
                        <a href="<?php echo url('Register/index'); ?>">注册</a>
                    </li>
                   <?php else: ?>
                    <li>
                        <a href=""><?php echo \think\Request::instance()->session('member.username'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo url('Login/logout'); ?>">退出登录</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="ym_hd_cart">
        <div class="minicart has-minicart" id="minicart_2193" onClick="javascript:window.location.href = '<?php echo url('Car/index'); ?>'">
            <a id="car" href="<?php echo url('Car/index'); ?>" class="ics minicart-text" style="background-image: url(__STATIC__/index/img/ym_icon_cart.png)"><span style="display:none">购物篮</span></a>
            <b class="ics op-cart-number  minicart-info">0</b>
            <span class="ics arr"></span>
            <div class="minicart-cont" style="height: auto;">
                <div class="no-information">购物篮中空空的喔,慢慢逛，不要忘记带上「食欲」</div>
            </div>
        </div>
    </div>
</header>
<script>
    $(function () {
        $.ajax({
            type: 'post',
            url: "<?php echo url('Car/Inquire'); ?>",
            dataType: 'json',
            async:true,
            success:function (d) {
                var kk=d;
                var goods_num=0;
                for(var key in kk){
                    goods_num+=parseInt(kk[key]);
                }
                $('.op-cart-number').text(goods_num);
            }
        });
    })
</script>
