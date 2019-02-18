<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:60:"/serve/ldx/public/../application/index/view/login/login.html";i:1543245796;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登入</title>
    <link href="__STATIC__/index/style/header.css" type="text/css" rel="stylesheet"/>
    <link href="__STATIC__/index/style/footer.css" type="text/css" rel="stylesheet"/>
    <link href="__STATIC__/index/style/login.css" type="text/css" rel="stylesheet">
    <script src="__STATIC__/index/js/jquery-3.2.1.js"></script>
</head>
<body style="height: 200px">
<?php echo widget('Common/header'); ?>
<div class="login-container">
    <div class="login-left">
        <div class="login-title1">登录</div>
        <form action="<?php echo url('Login/doLogin'); ?>" method="post">
        <div class="login-title2">登录账号</div>
        <input name="username" class="username" type="text" placeholder="用户名/邮箱地址/手机号" style="width: 360px">
        <div class="login-title2">密码</div>
            <input name="password" class="password" type="password" placeholder="填写密码" style="width: 360px">
            <div class="login-remember">
            <input type="checkbox">
            <div class="login-title2">记住账号</div>
        </div>
            <div style="width: 360px;height: 44px">
                <input name="code" class="username" type="text"  style="width: 250px;float: left" id="code">
                <a class="code" style="float: right;height: 100%;background-color: #00a0e9;color: white;border: none;font-size: 12px;width:95px;text-align: center;line-height: 44px;text-decoration: none">点击获取验证码</a>
            </div>
        <input type="submit" class="submit-btn" value="登录" style="width: 360px"  >
        <div class="login-title2">
            <a>忘记密码？</a>
        </div>
        </form>
    </div>

    <div class="login-right">
        <img src="__STATIC__/index/image/ymsj_login.png">
        <span>我不是会员， <a>要加入。</a></span>
    </div>
</div>
<?php echo widget('Common/footer'); ?>
<script>
    $(function () {
        $('.code').click(function () {

            var username=$('.username').val();
        $.ajax({
            type: 'post',
            url: "<?php echo url('Login/msg'); ?>",
            dataType: 'json',
            data:{name:username},
            async:true,
            success:function (d) {
           $('#code').attr('placeholder',d.mobile)
            }
        });
        });
    });
</script>
</body>
</html>