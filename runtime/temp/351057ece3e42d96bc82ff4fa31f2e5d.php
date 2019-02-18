<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:85:"/Users/ldx/WebstormProjects/luodexun/public/../application/admin/view/Admin/list.html";i:1545788887;s:88:"/Users/ldx/WebstormProjects/luodexun/public/../application/admin/view/common/header.html";i:1545732534;s:86:"/Users/ldx/WebstormProjects/luodexun/public/../application/admin/view/common/left.html";i:1545732534;s:90:"/Users/ldx/WebstormProjects/luodexun/public/../application/admin/view/common/cateList.html";i:1545732534;}*/ ?>
<div class="page-content">
    <!-- Page Breadcrumb -->

    <div class="page-breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <a href="#">系统</a>
            </li>
            <li class="active">链接管理</li>
        </ul>
    </div>

    <!-- /Page Breadcrumb -->

    <!-- Page Body -->
    <div class="page-body">

        <button type="button" tooltip="添加用户" class="btn btn-sm btn-azure btn-addon" onClick="javascript:window.location.href = '<?php echo url('Cate/addClass'); ?>'"> <i class="fa fa-plus"></i> Add
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
                                    <th class="text-center">name</th>
                                    <th class="text-center">pid</th>
                                    <th class="text-center">path</th>
                                    <th class="text-center">level</th>
                                    <th class="text-center"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($cateList as $arr): ?>
                                <tr onClick="javascript:window.location.href = '<?php echo url("Cate/index",['id'=>$arr['id']]); ?>'">
                                <td align="center"><?php echo $arr['id']; ?></td>
                                <td align="center"><?php echo $arr['name']; ?></td>
                                <td align="center"><?php echo $arr['pid']; ?></td>
                                <td align="center"><?php echo $arr['path']; ?></td>
                                <td align="center"><?php echo $arr['level']; ?></td>
                                <td align="center">
                                    <a href="<?php echo url('Cate/add',['id'=>$arr['id'],'level'=>$arr['level'],'path'=>$arr['path']]); ?>" class="btn btn-primary btn-sm shiny">
                                        <i class=""></i> 添加子分类
                                    </a>
                                    <a href="<?php echo url('Cate/edit',['id'=>$arr['id'],'name'=>$arr['name']]); ?>" class="btn btn-primary btn-sm shiny">
                                        <i class="fa fa-edit"></i> 编辑
                                    </a>
                                    <a href="<?php echo url('Cate/del',['id'=>$arr['id']]); ?>" onClick="warning('确实要删除吗', '')" class="btn btn-danger btn-sm shiny">
                                        <i class="fa fa-trash-o"></i> 删除
                                    </a>
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
    </div>
    <!-- /Page Body -->
</div>