<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:85:"/Users/ldx/WebstormProjects/luodexun/public/../application/admin/view/Admin/list.html";i:1545788887;s:88:"/Users/ldx/WebstormProjects/luodexun/public/../application/admin/view/common/header.html";i:1545732534;s:86:"/Users/ldx/WebstormProjects/luodexun/public/../application/admin/view/common/left.html";i:1545732534;s:86:"/Users/ldx/WebstormProjects/luodexun/public/../application/admin/view/common/list.html";i:1545732534;}*/ ?>
<div class="page-content">
    <!-- Page Breadcrumb -->
    <div class="page-breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo url('Index/index'); ?>">系统</a>
            </li>
            <li class="active">用户管理</li>
        </ul>
    </div>
    <!-- /Page Breadcrumb -->

    <!-- Page Body -->
    <div class="page-body">

        <button type="button" tooltip="添加用户" class="btn btn-sm btn-azure btn-addon"
                onClick="javascript:window.location.href = '<?php echo url('Admin/add'); ?>'"><i class="fa fa-plus"></i>
            Add
        </button>
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <div class="widget">
                    <div class="widget-body">
                        <div class="flip-scroll">
                            <table class="table table-bordered table-hover">
                                <thead class="">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">用户名</th>
                                    <th class="text-center">头像</th>
                                    <th class="text-center">电话</th>
                                    <th class="text-center">邮箱</th>
                                    <th class="text-center">最后一次登录的时间</th>
                                    <th class="text-center">操作</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach($indexData['data'] as $v): ?>
                                <tr>
                                    <td align="center"><?php echo $v['id']; ?></td>
                                    <td align="center"><?php echo $v['username']; ?></td>
                                    <td align="center">
                                        <?php if($v['avatar'] != ''): ?>
                                        <img src=<?php echo $v['avatar']; ?> alt="" width="50px">
                                        <?php else: ?>
                                        暂无缩略图
                                        <?php endif; ?>
                                    </td>
                                    <td align="center"><?php echo $v['mobile']; ?></td>
                                    <td align="center"><?php echo $v['email']; ?></td>
                                    <td align="center"><?php echo date("Y-m-d H:i:s",$v['lastlogin']); ?></td>
                                    <td align="center">
                                        <a href="<?php echo url('Admin/edit',array('id'=>$v['id'])); ?>"
                                           class="btn btn-primary btn-sm shiny">
                                            <i class="fa fa-edit"></i> 编辑
                                        </a>
                                        <?php if($v['id'] != 1): ?>
                                        <!--判断id是否为1  不为1  显示-->
                                        <a href="#" onClick="warning('确实要删除吗',
                                                 '<?php echo url('Admin/del',array('id'=>$v['id'])); ?>')"
                                           class="btn btn-danger btn-sm shiny">
                                            <i class="fa fa-trash-o"></i> 删除
                                        </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $indexData['page']; ?>
    </div>
    <!-- /Page Body -->
</div>