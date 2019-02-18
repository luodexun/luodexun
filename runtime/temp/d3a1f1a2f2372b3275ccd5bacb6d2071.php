<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:85:"/Users/ldx/WebstormProjects/luodexun/public/../application/admin/view/Admin/list.html";i:1545788887;s:88:"/Users/ldx/WebstormProjects/luodexun/public/../application/admin/view/common/header.html";i:1545732534;s:86:"/Users/ldx/WebstormProjects/luodexun/public/../application/admin/view/common/left.html";i:1545732534;s:91:"/Users/ldx/WebstormProjects/luodexun/public/../application/admin/view/common/goodsData.html";i:1545732534;}*/ ?>
<div class="page-content">
    <!-- Page Breadcrumb -->
    <div class="page-breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo url('Index/index'); ?>">系统</a>
            </li>
            <li class="active">商品管理</li>
        </ul>
    </div>
    <!-- /Page Breadcrumb -->

    <!-- Page Body -->
    <div class="page-body">


        <button type="button" tooltip="添加商品" class="btn btn-sm btn-azure btn-addon"
                onClick="javascript:window.location.href = '<?php echo url('Goods/add'); ?>'"><i class="fa fa-plus"></i>
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
                                    <th class="text-center">商品名称</th>
                                    <th class="text-center">商品分类</th>
                                    <th class="text-center">商品封面</th>
                                    <th class="text-center">商品售价</th>
                                    <th class="text-center">市场价</th>
                                    <th class="text-center">是否上架</th>
                                    <th class="text-center">库存</th>
                                    <th class="text-center">库存状态</th>
                                    <th class="text-center">商品状态</th>
                                    <th class="text-center">最近更新时间</th>
                                    <th class="text-center">更新管理员</th>
                                    <th class="text-center">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($goodsData as $v): ?>

                                <tr>
                                    <td align="center" >
                                        <?php echo $v['goods_id']; ?>
                                    </td>
                                    <td align="center" ><?php echo $v['goods_name']; ?></td>
                                    <td align="center" ><?php echo $v['name']; ?></td>
                                    <td align="center">
                                        <?php if($v['image_url'] != ''): if($v['is_face'] == 1): ?>
                                        <img src="<?php echo $v['image_url']; ?>" width="80px">
                                        <?php endif; else: ?>
                                        暂无封面
                                        <?php endif; ?>
                                    </td>
                                    <td align="center"><?php echo $v['sell_price']; ?></td>
                                    <td align="center" ><?php echo $v['market_price']; ?></td>
                                    <td align="center"><?php echo $v['maketable']==1?'已上架':'未上架'; ?></td>
                                    <td align="center" ><?php echo $v['store']; ?></td>
                                    <td align="center"><?php echo $v['freez']==1?'已冻结':'正常'; ?></td>
                                    <td align="center" ><?php echo $v['recycle']==1?'已删除':'正常'; ?></td>
                                    <td align="center" ><?php echo date("Y-m-d H:i:s",$v['last_modify']); ?></td>
                                    <td align="center" ><?php echo $v['last_modify_id']; ?></td>


                                    <td align="center">

                                        <a href="<?php echo url('Goods/imageIndex',['id'=>$v['goods_id']]); ?>"
                                           class="btn btn-primary btn-sm shiny">
                                            <i class="fa fa-picture-o"></i> 图片管理
                                        </a>

                                        <a href="<?php echo url('Goods/edit',['id'=>$v['goods_id']]); ?>"
                                           class="btn btn-primary btn-sm shiny">
                                            <i class="fa fa-edit"></i> 编辑
                                        </a>

                                        <a href="#" onClick="warning('确定要操作吗',
                                                 ' <?php echo url('Goods/del',['id'=>$v['goods_id']]); ?>'   )"
                                           class="btn btn-danger btn-sm shiny"
                                        >
                                            <i class="fa fa-trash-o"></i>
                                            <?php if($v['recycle'] == 1): ?>
                                            恢复
                                            <?php else: ?>
                                            删除
                                            <?php endif; ?>
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
        <?php echo $goodsData->render(); ?>
        <!--分页-->
    </div>
    <!-- /Page Body -->
</div>