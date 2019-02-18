<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:86:"/Users/ldx/WebstormProjects/luodexun/public/../application/admin/view/common/test.html";i:1545790363;}*/ ?>
<div class="page-content" style="min-height: auto">
    <!-- Page Breadcrumb -->
    <div class="page-breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo url('Index/index'); ?>">系统</a>
            </li>
            <li class="active">api测试</li>
        </ul>
    </div>
    <!-- /Page Breadcrumb -->

    <!-- Page Body -->
    <div id="content" class="content clearfix" style="padding: 0 40px">
        <div class="contentBox">
            <div class="col">
                <h2 class="title">Tester</h2>
                <div class="form form_login">
                    <form action=""  name="mainform" id="mainForm">
                        <table width="100%" style="border:1px solid #EAEAEA">
                            <tr><td width="10%"><input type="button" name="execute" value="execute" id="execute"/></td></tr>
                            <tr><td>Args:</td><td><textarea name="service" id="service" cols=100 rows=9><?php echo $defaultArgs; ?></textarea></td></tr>
                            <tr>
                                <td>Result:</td>
                                <td  style="vertical-align:top;"><div id="result" style="border:1px solid #CCCCCC;background-color:#ffcccc;padding:10px;word-break: break-all;"></div></td>
                            </tr>
                        </table>

                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function(){
                $("#execute").click(function(){
                    var service = $("#service").val();
                    if(!service){
                        alert("request args can't be empty");
                        return false;
                    }
                    $("#result").html("loading....");
                    var req=$.parseJSON(service);
                    $.ajax({
                        type:'POST',
                        timeout: 10000, // 超时时间 10 秒
                        headers: {
                            'Content-Type':'application/x-www-form-urlencoded'
                        },
                        url: 'https://api.letmexiu.com',
                        data:req,
                        success: function(data) {
                            var html= JSON.stringify(data,null,2);
                            $("#result").html("<textarea name='result' rows=30 cols=120 style='font-size: 13px;color: black'>"+html+"</textarea>");
                        },
                        error: function(err) {
                        },
                        complete: function(XMLHttpRequest, status) { //请求完成后最终执行参数　
                        }
                    })
                    return false;
                });
            });
        </script>
    </div>
    <!-- /Page Body -->
</div>