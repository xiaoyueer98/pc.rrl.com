<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>候选人列表</title>
        <link rel="stylesheet"  href="/Public/css/webchatnew/reset.css">
        <link rel="stylesheet"  href="/Public/css/webchatnew/new-recommende.css">
        <script type="text/javascript" src="/Public/js/webchatnew/iscroll-refresh.js"></script>
        <script type="text/javascript" src="/Public/js/webchatnew/jquery-1.11.0.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <meta content="yes" name="apple-mobile-web-app-capable" />
        <meta content="black" name="apple-mobile-web-app-status-bar-style" />
        <meta content="telephone=no" name="format-detection" />
        <script type="text/javascript">
            var num = 2;
            var myScroll,
                    pullDownEl, pullDownOffset,
                    pullUpEl, pullUpOffset,
                    generatedCount = 0;
            function ajx(page, number) {
                $.ajax({
                    type: 'POST',
                    url: '/Home/Webchatnew/get_resume_list',
                    data: 'page=' + page + '&number=' + number + "&jobid=<?php echo ($jobid); ?>",
                    dataType: 'json',
                    success: function (data) {

                        if (data.count == 0) {
                            if ($.trim($("#thelist2").html()) == "") {
                                $('#thelist2').append('<div class="resultjobs clearfix" style="font-size:14px;text-align:center;line-height:50px;color:#b4b4b4;">您还没有候选人简历，请先添加候选人简历!</div>');
                            }
                            $('#pullUp').hide();
                            return;
                        }
                        if (data.count <= (num - 2) * 10) {
                            $("#over").html('<div class="resultjobs clearfix" style="font-size:14px;text-align:center;line-height:50px;color:#b4b4b4;">加载已完成!</div>');
                            $('#pullUp').hide();
                            return;
                        }

                        var data = eval(data['result']);
                        for (var i = 0; i < data.length; i++) {

                            if (data[i].deadline == 1) {
                                var str =
                                        '<div class = "bd" style="background:#f5f6f5;">'
                                        + '<dl class = "clearfix dis_box">'
                                        + '<dt class="dis-lef" ><span class=""></span>'
                                        + '</dt>'
                                        + '<dd class = "dis-rig flex" >'
                                        + '<div><span>' + data[i].username + '</span><em>' + data[i].sex + '</em><em>' + data[i].mobile + '</em></div>'
                                        + '<div><em>在职状态：</em><em>' + data[i].statedata + '</em></div>'
                                        + '</dd>'
                                        + '</dl>'
                                        + '</div>'
                            } else {
//                                var n = (page - 1) * number + i;
                                var str =
                                        '<div class = "bd" >'
                                        + '<dl class = "clearfix dis_box">'
                                        + '<dt class="dis-lef check" >'
                                        + '<span class="" id="mo' + data[i].id + '" onclick="change(\'mo' + data[i].id + '\',\'' + data[i].isRecord + '\')"><input type="hidden" value="' + data[i].id + '" id="resumeid"></span>'
                                        + '</dt>'
                                        + '<dd class = "dis-rig flex" >'
                                        + '<div><span>' + data[i].username + '</span><em>' + data[i].sex + '</em><em>' + data[i].mobile + '</em></div>'
                                        + '<div><em>在职状态：</em><em>' + data[i].statedata + '</em></div>'
                                        + '</dd>'
                                        + '</dl>'
                                        + '</div>'

                            }

                            $('#thelist2').append(str);
                        }
                    }
                });
                ++num;
            }
            function pullUpAction() {
                ajx(num, 10);
                setTimeout(function () {

                    var el, li, i;
                    el = document.getElementById('thelist');
                    myScroll.refresh();
                }, 1000);
            }
            function pullUpAction2() {
                setTimeout(function () {
                    ajx(1, 10)
                    myScroll.refresh();
                }, 1000);
            }

            //pullUpAction2();
            /**
             * 初始化iScroll控件
             */
            function loaded() {
                pullDownEl = document.getElementById('pullDown');
                pullDownOffset = pullDownEl.offsetHeight;
                pullUpEl = document.getElementById('pullUp');
                pullUpOffset = pullUpEl.offsetHeight;
                myScroll = new iScroll('thelist', {
                    scrollbarClass: 'myScrollbar', /* 重要样式 */
                    useTransition: false, /* 此属性不知用意，本人从true改为false */
                    topOffset: pullDownOffset,
                    onRefresh: function () {
                        if (pullDownEl.className.match('loading')) {
                            pullDownEl.className = '';
                            pullDownEl.querySelector('.pullDownLabel').innerHTML = '下拉刷新...';
                        } else if (pullUpEl.className.match('loading')) {
                            pullUpEl.className = '';
                            pullUpEl.querySelector('.pullUpLabel').innerHTML = '上拉加载更多...';
                        }
                    },
                    onScrollMove: function () {
                        if (this.y > 5 && !pullDownEl.className.match('flip')) {
                            pullDownEl.className = 'flip';
                            pullDownEl.querySelector('.pullDownLabel').innerHTML = '松手开始更新...';
                            this.minScrollY = 0;
                        } else if (this.y < 5 && pullDownEl.className.match('flip')) {
                            pullDownEl.className = '';
                            pullDownEl.querySelector('.pullDownLabel').innerHTML = '下拉刷新...';
                            this.minScrollY = -pullDownOffset;
                        } else if (this.y < (this.maxScrollY - 5) && !pullUpEl.className.match('flip')) {
                            pullUpEl.className = 'flip';
                            pullUpEl.querySelector('.pullUpLabel').innerHTML = '松手开始更新...';
                            this.maxScrollY = this.maxScrollY;
                        } else if (this.y > (this.maxScrollY + 5) && pullUpEl.className.match('flip')) {
                            pullUpEl.className = '';
                            pullUpEl.querySelector('.pullUpLabel').innerHTML = '上拉加载更多...';
                            this.maxScrollY = pullUpOffset;
                        }
                    },
                    onScrollEnd: function () {
                        if (pullDownEl.className.match('flip')) {
                        } else if (pullUpEl.className.match('flip')) {
                            pullUpEl.className = 'loading';
                            pullUpEl.querySelector('.pullUpLabel').innerHTML = '<img src="/Public/images/webchatnew/loading.gif" style="width:25px;height:25px;padding-top:7px;margin:0 auto;display:block">';
                            pullUpAction(); // Execute custom function (ajax call?)

                        }
                    }
                });
            }




            //初始化绑定iScroll控件 
            document.addEventListener('touchmove', function (e) {
                e.preventDefault();
            }, false);
            document.addEventListener('DOMContentLoaded', loaded, false);</script>
    </head>
    <body>
    
    <div id="wrap" class="job-wrap">
        <div class="content">
            <div id="pullDown" style="display:none">
                <span class="pullDownIcon"></span><span class="pullDownLabel">下拉刷新...</span>
            </div>
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




            
            <div id="thelist" class="job-list-content">
                <div  class="list-candidates" style="padding-bottom:45px;">
                    <div id="thelist2" >
                    <?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["deadline"] == 1): ?><div class="bd" style="background:#f5f6f5;">
                                <dl class="clearfix dis_box">
                                    <dt class="dis-lef"><span class=""></span></dt>
                                    <dd class="dis-rig flex">
                                        <div><span><?php echo ($vo["username"]); ?></span><em><?php echo ($vo["sex"]); ?></em><em><?php echo ($vo["mobile"]); ?></em></div>
                                        <div><span>在职状态</span><span><?php echo ($vo["statedata"]); ?></span></div>
                                    </dd>
                                </dl>
                            </div>
                            <?php else: ?>
                            <div class="bd">
                                <dl class="clearfix dis_box">
                                    <dt class="dis-lef check"><span class=""  id="mo<?php echo ($vo["id"]); ?>" onclick="change(this.id,'<?php echo ($vo["isRecord"]); ?>')"><input type="hidden" value="<?php echo ($vo["id"]); ?>" id="resumeid"></span></dt>
                                    <dd class="dis-rig flex">
                                        <div><span><?php echo ($vo["username"]); ?></span><em><?php echo ($vo["sex"]); ?></em><em><?php echo ($vo["mobile"]); ?></em></div>
                                        <div><span>在职状态</span><span><?php echo ($vo["statedata"]); ?></span></div>
                                    </dd>
                                </dl>
                            </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <div id="pullUp" style="font-family: '微软雅黑';background: #fff;height: 40px;line-height: 40px;padding: 5px 10px;border-bottom: 1px solid #ccc;font-weight: bold;font-size: 14px;color: #888;">
                <span class="pullUpIcon"></span><div style="margin:0 auto;display:block;width:96px;" class="pullUpLabel">上拉加载更多...</div>
            </div><div id="over"></div>

                </div>
            </div>
            

        </div>
    </div>
    <span class="myrcmd-btn" id='btn'>
        我要推荐
    </span>
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

        $.post("/Home/Webchatnew/checkSelectUser", {
            'jid': "<?php echo ($jobid); ?>",
        }, function (data) {

            if (data < 10) {
                $("#btn")[0].style.backgroundColor = "#0983c6";
                $("#btn")[0].disabled = false;
            } else {
                like_alert("该职位您的推荐已超过推荐人数限制。");
                $("#btn").css("background", "#ccc");
                $("#btn")[0].className="myrcmd-btn no";
                
                return;
            }
        }, "text");
        function  change(k,status) {
          
            $(".check").each(function (i) {
              
                $(this).find("span")[0].className = "";
            })
            if(status == "disabled"){
                like_alert("该候选人已经推荐过给该职位");
                return;
            }else if(status == "isthiscompany"){
                like_alert("该候选人已经推荐过给该公司的其他职位");
                return;
            }else if(status == "isthreecompany"){
                like_alert("该候选人最多只能推荐按给3家企业");
                return;
            }
            $("#" + k)[0].className = "m";
            


        }
        $("#btn").click(function () {
            if ($(this)[0].className == "myrcmd-btn no") {
                return;
            }
            var jid = $(".m").find("#resumeid").val();
            if (typeof (jid) == "undefined") {
                like_alert("请选择被推荐人");
                return;
            }
            location.href = "/Home/Webchatnew/resume_time/jobid/<?php echo ($jobid); ?>/jid/" + jid;
        })
    </script>
    
</body>
</html>