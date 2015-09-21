<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>候选人面试时间</title>
        <link rel="stylesheet"  href="/Public/css/webchatnew/reset.css">
        <link rel="stylesheet"  href="/Public/css/webchatnew/new-recommende.css">
        <script type="text/javascript" src="/Public/js/webchatnew/iscroll.js"></script>
        <script type="text/javascript" src="/Public/js/webchatnew/jquery-1.11.0.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <meta content="yes" name="apple-mobile-web-app-capable" />
        <meta content="black" name="apple-mobile-web-app-status-bar-style" />
        <meta content="telephone=no" name="format-detection" />
        <script type="text/javascript">
            $(document).ready(function () {
                $(".gsjj-btn").click(function () {
                    $('.comp-text').slideDown();
                    $('.myh3-2').addClass("m");
                    $(".myh3").removeClass('m');
                    setTimeout(function () {
                        myScroll.refresh();
                    }, 500)
                })

                myScroll = new IScroll('#m', {
                    click: true,
                    scrollbars: true,
                    mouseWheel: true,
                    interactiveScrollbars: true,
                    shrinkScrollbars: 'scale',
                    fadeScrollbars: true
                });


                $('.jl ul li em').on('click', function () {
                    $(this).hide();
                    $(this).nextAll().show();
                })
            })
            document.addEventListener('touchmove', function (e) {
                e.preventDefault();
            }, false);
        </script>
        
    </head>
    <body>

    <div class="wrap job-wrap" id="wamp">
        <div class="content">
            <?php
if(!empty($_GET['jobid'])){ $arJob = M("job")->where("id=".$_GET['jobid'])->find(); if(empty($arJob)){ header("location:/Home/Webchatnew/job_list"); die; } if(empty($arJob['title'])){ $arJob['title'] = getCascList($arJob['Jobcate'], "信息不明"); } $jobname = $arJob['title']; } if(!empty($_GET['jid'])){ $arResume = M("resume")->where("id=".$_GET['jid'])->find(); if(empty($arResume)){ header("location:/Home/Webchatnew/job_list"); die; } $resumename = $arResume['username']; } ?>

<ul class="rcmd-steps">
    <li class="fl-lef m1">
        <b class="m">第一步</b>
        <span class="m">选择要推荐的职位</span>
        <em style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;width: 8em;padding-left:3px;"><?php if(!empty($jobname)){echo $jobname;}?></em>
    </li>
    <li class="fl-lef">
        <b>第二步</b>
        <span>选择推荐候选人</span>
        <em><?php if(!empty($resumename)){echo $resumename;}?></em>
    </li>
    <li class="fl-lef last">
        <b>第三步</b>
        <span>确认推荐</span>
    </li>
</ul>
<span style="display:none;">
    <script type="text/javascript">
        var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
        document.write(unescape("%3Cspan id='cnzz_stat_icon_1254515209'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1254515209%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));
    </script>
</span>

<script>
   
    if(location.href.indexOf("job_list")!="-1" || location.href.indexOf("job_detail")!="-1"){
//        $(".rcmd-steps li")[0].className="fl-lef m";
//        $(".rcmd-steps li")[1].className="fl-lef";
//        $(".rcmd-steps li")[2].className="fl-lef last";
    }else if(location.href.indexOf("push_resume")!="-1"){
        $(".rcmd-steps li")[1].className="fl-lef m";
        $(".rcmd-steps li b")[1].className="m";
        $(".rcmd-steps li span")[1].className="m";
    }else{
        $(".rcmd-steps li")[1].className="fl-lef m";
        $(".rcmd-steps li b")[1].className="m";
        $(".rcmd-steps li span")[1].className="m";
        
        $(".rcmd-steps li")[2].className="fl-lef last m";
        $(".rcmd-steps li b")[2].className="m";
        $(".rcmd-steps li span")[2].className="m";
    }
</script>




            <div id="m" class="m detail flex">
                <div class="scroll">
                    <ul class="set-time">    
                        <li  class="first_li">
                            <textarea placeholder="请输入候选人面试时间如:3月5日全天或3月6日下午或3月5日-7日下午5点以后" id="audstartdate" ></textarea>
                            <input type="hidden" value="<?php echo ($jobid); ?>" id="j_id">
                            <input type="hidden" value="<?php echo ($jid); ?>" id="bt_id">
                        </li>
                        <li class="myli_2">
                            <span>重要提示：</span>
                            <p>向企业推荐候选人之前，必须同候选人进行沟通。一旦发现“盲目提交”（未经候选人同意即提交职位候选人）遭到客户投诉，人人猎有权终止您的猎头注册用户资格。</p>
                        </li>
                        <li class="last_li"><button class="btn_qr" id="btn">确认推荐</button><button class="btn_qx">再沟通一下</button></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--推荐成功弹框开始-->
        <div style="display:none" id="alert_like">
            <div class="mask"></div>
            <div class="tjcg">
                <dl>
                    <dt><img src="/Public/images/webchatnew/tj_cg.png" alt="" style='width:30%;height:30%;margin-top:-50px;'></dt>
                    <dd>成功推荐了1个人才！</dd>
                    <a href="/Home/Webchatnew/job_list"><dd class=""><button style='margin-top:0px;'>返回职业列表</button></dd></a>
                </dl>
            </div>
        </div>
        <!--推荐成功弹框结束-->
    <style>
.mask{
	position: fixed;
	z-index: 3;
	display: block;
	width: 100%;
	height: 100%;
	background: #000;
	opacity: .7;
	filter: alpha(opacity=70);
}    
.tanchu{
	width: 300px;
	height: 120px;
	padding:10px 0;
	background: #ffffff;
	box-shadow: 1px 1px 10px #2c2b2b;
	position: fixed;
	left: 50%;
	top: 50%;
	margin-left:-150px;
	margin-top: -90px;
	z-index: 4;
	border-radius: 15px;
}
.tanchu dl{
	margin:0 auto;
	width: 260px;
	margin-top: 10px;
}

.tanchu dl dd{
	text-align: center;
	color: #2380b8;
	line-height: 30px;
	font-size: 16px;
	font-weight: bold;
}
.tanchu dl dd button{
	width: 110px;
	height: 30px;
	background: #2380b8;
	border-radius: 5px;
	border:none;
	color: #ffffff;
	margin-top:10px;
}    
</style>
<div style="display:none;" id="like_alert_kuang">
<div class="mask"></div>
<div class="tanchu">
    <dl>
        <dd id="alert_title"></dd>
        <dd id="alert_ok"><button>确定</button></dd>
    </dl>
</div>
</div>

<script type="text/javascript">
    
    //调用这个方法的前提是，引入了jquery
    function  like_alert(title){
        
        $("#alert_title").html(title);
        $("#like_alert_kuang").css("display","block");
        $("#alert_ok").click(function(){
            $("#like_alert_kuang").css("display","none");
        })
    }
    
    function  re_like_alert(title){
        
        $("#alert_title").html(title);
        $("#like_alert_kuang").css("display","block");
        $("#alert_ok").click(function(){
            $("#like_alert_kuang").css("display","none");
            location.reload();
        })
       
    }
    
    function  lo_like_alert(title,url){
        
        $("#alert_title").html(title);
        $("#like_alert_kuang").css("display","block");
        $("#alert_ok").click(function(){
            $("#like_alert_kuang").css("display","none");
            location.href=url;
        })
       
    }
    
    
</script>    
    <script type="text/javascript">
        
        $("#btn").click(function () {
            $(this)[0].disabled = true;
            var audstartdate = $("#audstartdate").val();
            if ($.trim(audstartdate) == "") {
                $(this)[0].disabled = false;
                like_alert("面试时间不能为空");
                return;
            } else {

                var j_id = $("#j_id").val();
                var bt_id = $("#bt_id").val();
                if(j_id == "" || isNaN(j_id) || bt_id == "" || isNaN(bt_id) ){
                    
                    lo_like_alert("参数异常","/Home/Webchatnew/job_list");
                    return;
                }
                $.post("/Home/Webchatnew/record_save", {
                    'j_id': j_id,
                    'audstartdate': audstartdate,
                    'bt_id': bt_id
                }, function (data) {
                    if (data.code == "400") {
                        location.href = "/Home/Webchatlogin/login";
                        return;
                    }else if(data.code != "200") {
                        like_alert(data.msg);
                        $(this)[0].disabled = false;
                        return;
                    }else {
                        
                        $("#alert_like").css("display", "block");
                        $("#alert_like").attr("z-index", "100");
                        $(".tjcg").css("display", "block");
                        return;
                    }
                }, "json");
            }
        })
        $(".btn_qx").click(function () {

            location.href = "/Home/Webchatnew/job_list";
            return;
        })
    </script>
    <span style="display:none;">
    <script type="text/javascript">
        var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
        document.write(unescape("%3Cspan id='cnzz_stat_icon_1254515209'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1254515209%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));
    </script>
</span>

</body>
</html>