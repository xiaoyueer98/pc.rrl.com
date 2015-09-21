<?php if (!defined('THINK_PATH')) exit();?><html>
    <script type="text/javascript" src="/Public/js/jquery-1.8.3.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/Public/css/uploadify.css">
    <script type="text/javascript" charset="utf-8" src="/Public/js/jquery.uploadify-3.1.js"></script>
    <h3 id='file_upload' style='height:10px;background:white;'>附件简历</h3>
    <div class="resume-annex">
        
        <dl style="padding:32px 0 0 72px;width:435px;<?php if(!$resumeInfo[upload] || $resumeInfo[upload] =='/Uploads/word/'){ echo "display:none";}?>"  id="upd12">
            <dt class="fl-lef" style="margin-top:5px;margin-left:0;width:42px;"><img src="/Public/img/cwjl.png"></dt>
                <dd style="font-size: 16px;width: 183px;margin-top: -5px; text-align: center; line-height: 35px;" class="jianliurl fl-lef"> <a class="wk dis-block" style="width:100%;height:100%;" href='<?php echo $resumeInfo[upload];?>'><?php echo $resumeInfo[updateName];?></a></dd>
                    <span style="color: #2380b8;position: absolute;bottom: 57px;right: 20px;cursor:pointer" onclick="$('#upd11').show();
                            $('#upd12').hide();
                            $('.jianliurl').html('重新上传简历')">删除</span>
                </dl>
                <input type='hidden' value='1' id='updateNUm'>
                <input type='hidden' id='updateFile' name='updateFile' value='<?php echo ($resumeInfo[updateFile]); ?>'>
                <input type='hidden'  id='updatePath' name='updatePath' value='<?php echo ($resumeInfo[updatePath]); ?>'>
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
            </div>


        </html>