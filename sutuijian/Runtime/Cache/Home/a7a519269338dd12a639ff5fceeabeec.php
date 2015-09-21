<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="/Public/img/favicon.ico" type="image/ico">
        <title>维护候选人简历-人人猎</title>
        <meta name="keywords" content="人人猎,人人猎网，人人猎头,renrenlie.com,www.renrenlie.com,人人猎首页,人人猎官网，人人都是猎头" />
        <meta name="description" content="人人猎（www.renrenlie.com)是企业低成本极速直招平台，让企业一周内搞定招聘需求，为推荐人提供“人力资源”变现通道。" />
        <link rel="stylesheet" type="text/css" href="/Public/css/boss.css">
        <script type="text/javascript" src="/Public/js/jquery-1.8.3.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/Public/css/uploadify.css">
        <script type="text/javascript" charset="utf-8" src="/Public/js/jquery.uploadify-3.1.js"></script>

    </head>
    <body>

        <div class="scjl_tc" style="display: block">

            <input type="file" name="file_upload" id="file_upload" class="sc_jl"/>


        </div>

        <script type="text/javascript">
            var img_id_upload = new Array(); //初始化数组，存储已经上传的图片名
            var i = 0; //初始化数组下标
            var uploadLimit = 1;
            var buttonName = "<?php if($resumeInfo[updateFile]){ echo '重新上传简历';}else{echo '上传简历';}?>";
            $(function () {
                $('#file_upload').uploadify({
                    'auto': true, //关闭自动上传
                    'removeTimeout': 600, //文件队列上传完成1秒后删除
                    'swf': '/Public/css/uploadify.swf',
                    'uploader': '/Home/Index/uploadify.html',
                    'method': 'post', //方法，服务端可以用$_POST数组获取数据
                    'buttonText': buttonName, //设置按钮文本
                    'multi': true, //允许同时上传多张图片
                    'uploadLimit': uploadLimit, //一次最多只允许上传10张图片
                    'fileTypeDesc': '请选择 Word,PDF文件', //只允许上传图像
                    'fileTypeExts': '*.doc; *.docx; *.pdf', //限制允许上传的图片后缀
                    'fileSizeLimit': '10000000000MB', //限制上传的图片大小
                    'onUploadSuccess': function (file, data, response) { //每次成功上传后执行的回调函数，从服务端返回数据到前端
                        $(".Close4").hide();
                        $(".secord").hide();
                        $(".jlsc_cg ").show();
                        var filedata = data.split("&&");
                        $("#updateFile").val(filedata[1]);
                        $("#updatePath").val(filedata[0]);
                        var cancel = $("#" + file.id + " .cancel a");
                        if (cancel) {
                            $("#updateNUm").val(parseInt($("#updateNUm").val()) + 1);
                            var uploadLimit = $("#updateNUm").val();
                            cancel.on('click', function () {
                                //在这此处处理...
                                //通过uploadify的settings方式重置上传限制数量
                                $('#file_upload').uploadify('settings', 'uploadLimit', uploadLimit);
                                //防止手快多点几次x，把x隐藏掉
                                $(this).hide();
                            });
                        }
                    }
                });
            });
        </script>



    </body>

</html>