<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"/Users/ldx/WebstormProjects/luodexun/public/../application/admin/view/Admin/list.html";i:1545788887;}*/ ?>
<?php echo widget('Common/header'); ?>
<script type="text/javascript" src="__STATIC__/admin/style/jquery-3.2.1.js"></script>
</head>
<!-- /头部 -->

<div class="main-container container-fluid">
    <div class="page-container">
        <!-- Page Sidebar -->
        <!--挂件菜单页-->
        <?php echo widget('Common/left'); ?>

        <!-- Page Content -->
        <!--判断数据的状态切换模版-->
        <?php if(isset($defaultArgs)): ?>
        <!--挂件增改页-->
        <?php echo widget('Common/test'); endif; if(isset($addData)): ?>
        <!--挂件增改页-->
        <?php echo widget('Common/add'); endif; ?>
        <!--用户加载模版-->
        <?php if(isset($indexData)): ?>
        <!--挂件列表页-->
        <?php echo widget('Common/lis'); endif; ?>
        <!--用户添加模版-->
        <?php if(isset($aeData)): ?>
        <!--挂件增改页-->
        <?php echo widget('Common/ae'); endif; ?>
        <!-- /Page Content -->
        <!--用户加载-->
        <?php if(isset($memberList)): ?>
        <!--挂件列表页-->
        <?php echo widget('Common/memberList'); endif; if(isset($memberAe)): ?>
        <!--挂件增改页-->
        <?php echo widget('Common/memberAe'); endif; if(isset($memberaE)): ?>
        <!--挂件增改页-->
        <?php echo widget('Common/memberAe'); endif; ?>
        <!--商品列表-->
        <?php if(isset($cateList)): ?>
        <?php echo widget('Common/cateList'); endif; ?>
        <!--商品添加-->
        <?php if(isset($cateAe)): ?>
        <?php echo widget('Common/cateAe'); endif; ?>
        <!--商品管理-->
        <!--商品列表-->
        <?php if(isset($goodsData)): ?>
        <?php echo widget('Common/goodsData'); endif; ?>
        <!--商品添加-->
        <?php if(isset($goodsAdd)): ?>
        <?php echo widget('Common/goodsAdd'); endif; ?>
        <!--商品编辑-->
        <?php if(isset($goodsEdit)): ?>
        <?php echo widget('Common/goodsEdit'); endif; ?>
        <!--图片管理-->
        <?php if(isset($imageData)): ?>
        <?php echo widget('Common/imageData'); endif; ?>
        <!--图片添加-->
        <?php if(isset($imageAdd)): ?>
        <?php echo widget('Common/imageAdd'); endif; ?>
        <!--上传-->
        <?php if(isset($ossTitle)): ?>
        <?php echo widget('Common/upload'); endif; ?>
<!--Basic Scripts-->
<script src="__STATIC__/admin/style/jquery_002.js"></script>
<script src="__STATIC__/admin/style/bootstrap.js"></script>
<script src="__STATIC__/admin/style/jquery.js"></script>
<!--Beyond Scripts-->
<script src="__STATIC__/admin/style/beyond.js"></script>

</body></html>