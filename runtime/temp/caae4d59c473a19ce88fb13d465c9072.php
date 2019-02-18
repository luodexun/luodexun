<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:85:"/Users/ldx/WebstormProjects/luodexun/public/../application/admin/view/Admin/list.html";i:1545788887;s:88:"/Users/ldx/WebstormProjects/luodexun/public/../application/admin/view/common/header.html";i:1545732534;s:86:"/Users/ldx/WebstormProjects/luodexun/public/../application/admin/view/common/left.html";i:1545732534;s:88:"/Users/ldx/WebstormProjects/luodexun/public/../application/admin/view/common/upload.html";i:1545790825;}*/ ?>
<link rel="stylesheet" href="__STATIC__/admin/style/style.css" />
<div class="page-content" style="min-height: auto">
    <!-- Page Breadcrumb -->
    <div class="page-breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo url('Index/index'); ?>">系统</a>
            </li>
            <li class="active"><?php echo $ossTitle['title']; ?></li>
        </ul>
    </div>
    <!-- /Page Breadcrumb -->

    <!-- Page Body -->
    <div id="content" class="content clearfix" style="padding: 0 40px">
        <div id="main">
            <table>
                <tr>
                    <td>
                        <div class="panel panel-primary">
                            <div class="panel-heading">Upload file</div>
                            <div class="panel-body">
                                <form action="" class="form-horizontal">
                                    <div class="form-group">
                                        <label>Select file</label>
                                        <input type="file" id="file" />
                                    </div>
                                    <div class="form-group">
                                        <label>Store as</label>
                                        <input type="text" class="form-control" id="object-key-file" value="object" />
                                    </div>
                                    <div class="form-group">
                                        <input type="button" class="btn btn-primary" id="file-button" value="Upload" />
                                    </div>
                                </form>
                                <br />
                                <div class="progress">
                                    <div id="progress-bar"
                                         class="progress-bar"
                                         role="progressbar"
                                         aria-valuenow="0"
                                         aria-valuemin="0"
                                         aria-valuemax="100" style="min-width: 2em;">
                                        0%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="panel panel-success">
                            <div class="panel-heading">Upload content</div>
                            <div class="panel-body">
                                <form action="" class="form-horizontal">
                                    <div class="form-group">
                                        <label>Content</label>
                                        <textarea class="form-control" id="file-content" rows="3">Hello, OSS!</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Store as</label>
                                        <input type="text" class="form-control" id="object-key-content" value="object" />
                                    </div>
                                    <div class="form-group">
                                        <input type="button" class="btn btn-primary" id="content-button" value="Save" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="panel panel-info">
                            <div class="panel-heading">List files</div>
                            <div class="panel-body">
                                <table class="table table-striped" id="list-files-table">
                                    <tr>
                                        <th>Key</th>
                                        <th>Size</th>
                                        <th>LastModified</th>
                                    </tr>
                                </table>
                                <input type="button" class="btn btn-primary" id="list-files-button" value="Refresh" />
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="panel panel-warning">
                            <div class="panel-heading">Download file</div>
                            <div class="panel-body">
                                <form action="" class="form-horizontal">
                                    <div class="form-group">
                                        <label>Object key</label>
                                        <input type="text" class="form-control" id="dl-object-key" value="object" />
                                    </div>
                                    <div class="form-group">
                                        <label>Save as</label>
                                        <input type="text" class="form-control" id="dl-file-name" value="filename" />
                                    </div>
                                    <div class="form-group">
                                        <input type="button" class="btn btn-primary" id="dl-button" value="Download" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        Powered by
                        <a href="https://www.aliyun.com/product/oss">OSS</a> &
                        <a href="https://github.com/ali-sdk/ali-oss">ali-oss</a></td>
                </tr>
            </table>
        </div>
    </div>
    <!-- /Page Body -->
</div>
<script src="https://www.promisejs.org/polyfills/promise-6.1.0.js"></script>
<script type="text/javascript" src="https://gosspublic.alicdn.com/aliyun-oss-sdk.min.js"></script>
<script type="text/javascript" src="__STATIC__/admin/style/app.js?1000"></script>