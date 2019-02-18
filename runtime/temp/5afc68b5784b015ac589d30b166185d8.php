<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:86:"/Users/ldx/WebstormProjects/luodexun/public/../application/admin/view/common/left.html";i:1545732534;}*/ ?>
<div class="page-sidebar" id="sidebar">



    <!-- Page Sidebar Header-->
    <div class="sidebar-header-wrapper">
        <input class="searchinput" type="text">
        <i class="searchicon fa fa-search"></i>
        <div class="searchhelper">Search Reports, Charts, Emails or Notifications</div>
    </div>
    <!-- /Page Sidebar Header -->
    <!-- Sidebar Menu -->
    <ul class="nav sidebar-menu">
        <!--Dashboard-->
        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-user"></i>
                <span class="menu-text">账户管理</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo url('Admin/index'); ?>">
                                    <span class="menu-text">
                                        管理员列表                                    </span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
                <li>
                    <a href="<?php echo url('Member/index'); ?>">
                                    <span class="menu-text">
                                        用户列表                                    </span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li>


        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-calendar"></i>
                <span class="menu-text">分类</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo url('Cate/index'); ?>">
                                    <span class="menu-text">
                                        分类列表                                    </span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
                <li>
                    <a href="<?php echo url('Cate/addClass'); ?>">
                                    <span class="menu-text">
                                        添加分类                                    </span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-file-text"></i>
                <span class="menu-text">商品</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo url('Goods/index'); ?>">
                                    <span class="menu-text">
                                        商品列表                                    </span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-anchor"></i>
                <span class="menu-text">上传文件</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo url('Upload/index'); ?>">
                                    <span class="menu-text">
                                        上传文件                                </span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-openid"></i>
                <span class="menu-text">订单</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="<?php echo url('Order/index'); ?>">
                                    <span class="menu-text">
                                        订单列表                                </span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-joomla"></i>
                <span class="menu-text">系统</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="/admin/document/index.html">
                                    <span class="menu-text">
                                        配置                                   </span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="http://www.chuanke.com/s2260700.html" class="menu-dropdown">
                <i class="menu-icon fa fa-gear"></i>
                <span class="menu-text">视频教程</span>
                <i class="menu-expand"></i>
            </a>
        </li>



    </ul>
    <!-- /Sidebar Menu -->
</div>