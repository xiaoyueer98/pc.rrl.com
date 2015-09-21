<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>最新职位</title>
        <link rel="stylesheet"  href="/Public/css/webchatnew/reset.css">
        <link rel="stylesheet"  href="/Public/css/webchatnew/new-recommende.css">
        <script type="text/javascript" src="/Public/js/webchatnew/iscroll-refresh.js"></script>
        <script type="text/javascript" src="/Public/js/webchatnew/jquery-1.11.0.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <meta content="yes" name="apple-mobile-web-app-capable" />
        <meta content="black" name="apple-mobile-web-app-status-bar-style" />
        <meta content="telephone=no" name="format-detection" />
        <script type="text/javascript">
            $(function () {
                $('.nav').hide();
                //搜索处理
                $("#search").click(function () {

                    var search_input = $.trim($("#search_input").val());
                   
                    location.href="/Home/Webchatnew/job_list/title/"+search_input;
                })
            })
            var myScroll,
                    pullDownEl, pullDownOffset,
                    pullUpEl, pullUpOffset,
                    generatedCount = 0;

            var num = 2;
            function ajx(page, number,condition) {
                 if (typeof condition == "undefined") {
                    condition = "";
                }
                $.ajax({
                    type: 'POST',
                    url: '/Home/Webchatnew/get_job_list',
                    data: 'page=' + page + '&number=' + number+"&condition="+condition,
                    dataType: 'json',
                    success: function (data) {

                        
                        if (data.count == 0) {
                            if ($.trim($("#thelist2").html()) == "") {
                                $('#thelist2').append('<div class="resultjobs clearfix" style="font-size:14px;text-align:center;line-height:50px;color:#b4b4b4;">暂无职位!</div>');
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


                            // alert(data[i]);
                            var str = "";
                            str = '<a href="/Home/Webchatnew/job_detail/jobid/' + data[i].id + '">'
                                    +'<ul class="latest-position">'
                                    + '<li class="clearfix lis1">'
                                    + '<div class="fl-lef dis-inlin">'
                                    + '<em class="fl-lef dis-inlin dis-block">' + data[i].title + '</em>'
                                    + '</div>'
                                    + '<div class="fl-rig dis-inlin">'
                                    + '<em class="fl-lef dis-inlin dis-block">' + data[i].treatmentdata + '</em>'
                                    + '</div>'
                                    + '</li>'
                                    + '<li class="clearfix lis1">'
                                    + '<div class="fl-lef dis-inlin r">' + data[i].cpname + '</div>'
                                    + '<div class="fl-rig dis-inlin r"><span class="fl-lef dis-inlin dis-block">[' + data[i].cascname
                                    + ']</span></div>'
                                    + '</li>'
                                    + '<li class="clearfix lis2">'
                                    + '<div class="fl-lef dis-inlin">'
                                    + '<span class="fl-lef dis-inlin dis-block">招聘人数:<i>' + data[i].employ + '</i></span>'
                                    + '<span class="fl-lef dis-inlin dis-block">已推荐人数:<b>' + data[i].recommendednum + '</b></span>'
                                    + '</div>'
                                    + '<div class="fl-rig dis-inlin">'
                                    + '</div>'
                                    + '</li>'
                                    + '<li class="clearfix lis3">'
                                    + '<em class="fl-lef dis-inlin">候选人入职，你即得奖励￥' + data[i].Tariff + '</em>'
                                    + '<span class="fl-rig dis-inlin">' + data[i].starttime + '</span>'
                                    + '</li>'
                                    + '</ul>'
                                    + '</a>';

                            $('#thelist2').append(str);
                        }
                    }
                });
                ++num;
            }
            function pullUpAction() {
                var search_input = $.trim($("#search_input").val());
                
                ajx(num, 10,search_input);
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
            document.addEventListener('DOMContentLoaded', loaded, false);

        </script>
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




            <div class="search" style="display:block">
                <div class=" clearfix">
                    <input type="text" placeholder="请输入关键词" value="<?php echo $title?>" id="search_input">
                    <span class="btn" id="search" style='margin-top:0'>搜索</span>
                </div>
            </div>
            <div id="thelist" class="job-list-content">
                <div>
                    <div id="thelist2">
                       <?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="/Home/Webchatnew/job_detail/jobid/<?php echo ($vo["id"]); ?>">
                            <ul class="latest-position">
                                <li class="clearfix lis1">
                                    <div class="fl-lef dis-inlin">
                                        <em class="fl-lef dis-inlin dis-block"><?php echo ($vo["title"]); ?></em>
                                    </div>
                                    <div class="fl-rig dis-inlin">
                                        <em class="fl-lef dis-inlin dis-block"><?php echo ($vo["treatmentdata"]); ?></em>
                                    </div>
                                </li>
                                <li class="clearfix lis1">
                                    <div class="fl-lef dis-inlin r"><?php echo ($vo["cpname"]); ?></div>

                                    <div class="fl-rig dis-inlin r"><span class="fl-lef dis-inlin dis-block">[<?php echo ($vo["cascname"]); ?>]</span></div>
                                </li>
                                <li class="clearfix lis2">
                                    <div class="fl-lef dis-inlin">

                                        <span class="fl-lef dis-inlin dis-block">招聘人数:<i><?php echo ($vo["employ"]); ?></i></span>
                                        <span class="fl-lef dis-inlin dis-block">已推荐人数:<b><?php echo ($vo["recommendednum"]); ?></b></span>

                                    </div>
                                    <div class="fl-rig dis-inlin">
                                    </div>
                                </li>
                                <li class="clearfix lis3">
                                    <em class="fl-lef dis-inlin">候选人入职，你即得奖励￥<?php echo ($vo["Tariff"]); ?></em>
                                    <span class="fl-rig dis-inlin"><?php echo ($vo["starttime"]); ?></span>
                                </li>
                            </ul>
                            </a><?php endforeach; endif; else: echo "" ;endif; ?> 
                    </div>
                     <div id="pullUp" style="font-family: '微软雅黑';background: #fff;height: 40px;line-height: 40px;padding: 5px 10px;border-bottom: 1px solid #ccc;font-weight: bold;font-size: 14px;color: #888;">
                        <span class="pullUpIcon"></span><div style="margin:0 auto;display:block;width:96px;" class="pullUpLabel">上拉加载更多...</div>
                    </div><div id="over"></div>
                </div>
                
            </div>
            
            
        </div>
    </div>
</body>
</html>