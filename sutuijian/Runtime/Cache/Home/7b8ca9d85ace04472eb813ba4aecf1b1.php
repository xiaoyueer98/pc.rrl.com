<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>收藏职位</title>
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
            })
            var myScroll,
                    pullDownEl, pullDownOffset,
                    pullUpEl, pullUpOffset,
                    generatedCount = 0;

            var num = 2;
            function ajx(page, number) {
                $.ajax({
                    type: 'POST',
                    url: '/Home/Webchatnew/get_favjob_list',
                    data: 'page=' + page + '&number=' + number,
                    dataType: 'json',
                    success: function (data) {


                        if (data.count == 0) {
                            if ($.trim($("#thelist2").html()) == "") {
                                $('#thelist2').append('<div class="resultjobs clearfix" style="font-size:14px;text-align:center;line-height:50px;color:#b4b4b4;">还未有收藏的职位!</div>');
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
                            if (data[i].cascname == "") {
                                var cascname = "北京";
                            }

                            // alert(data[i]);
                            var str = "";
                            if (data[i].deadline == 1) {
                            str = '<ul class="latest-position" style="background:#f5f6f5;">'
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
                                    + '<div class="fl-rig dis-inlin r"><span class="fl-lef dis-inlin dis-block"></span></div>'
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
                                    + '<span class="fl-rig dis-inlin">[' + cascname + ']</span>'
                                    + '</li>'
                                    + '</ul>';
                        }else{
                            str = '<a href="/Home/Webchatnew/job_detail/jobid/' + data[i].id + '">'
                                    + '<ul class="latest-position">'
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
                                    + '<div class="fl-rig dis-inlin r"><span class="fl-lef dis-inlin dis-block"></span></div>'
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
                                    + '<span class="fl-rig dis-inlin">[' + cascname + ']</span>'
                                    + '</li>'
                                    + '</ul>'
                                    + '</a>';
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
            document.addEventListener('DOMContentLoaded', loaded, false);

        </script>
    </head>
    <body>
    
    <div id="wrap" class="job-wrap">
        <div class="content">
            <div id="pullDown" style="display:none">
                <span class="pullDownIcon"></span><span class="pullDownLabel">下拉刷新...</span>
            </div>

            <div id="thelist" class="job-list-content">
                <div>
                    <div id="thelist2">
                        <?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($vo["deadline"] == 1): ?><ul class="latest-position" style="background:#f5f6f5;">
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

                                        <div class="fl-rig dis-inlin r"><span class="fl-lef dis-inlin dis-block"></span></div>
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
                                    <?php if($vo["cascname"] == '' ): ?><span class="fl-rig dis-inlin">[北京]</span>
                                        <?php else: ?>
                                        <span class="fl-rig dis-inlin">[<?php echo ($vo["cascname"]); ?>]</span><?php endif; ?>
                                    </li>
                                </ul>
                            <?php else: ?>
                            <a href="/Home/Webchatnew/job_detail/jobid/<?php echo ($vo["id"]); ?>">
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

                                        <div class="fl-rig dis-inlin r"><span class="fl-lef dis-inlin dis-block"></span></div>
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
                                    <?php if($vo["cascname"] == '' ): ?><span class="fl-rig dis-inlin">[北京]</span>
                                        <?php else: ?>
                                        <span class="fl-rig dis-inlin">[<?php echo ($vo["cascname"]); ?>]</span><?php endif; ?>
                                    </li>
                                </ul>
                            </a><?php endif; endforeach; endif; else: echo "$empty" ;endif; ?> 
                    </div>
                    <div id="pullUp" style="font-family: '微软雅黑';background: #fff;height: 40px;line-height: 40px;padding: 5px 10px;border-bottom: 1px solid #ccc;font-weight: bold;font-size: 14px;color: #888;">
                        <span class="pullUpIcon"></span><div style="margin:0 auto;display:block;width:96px;" class="pullUpLabel">上拉加载更多...</div>
                    </div>
                    <div id="over"></div>
                </div>

            </div>


        </div>
    </div>
    <span style="display:none;">
    <script type="text/javascript">
        var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
        document.write(unescape("%3Cspan id='cnzz_stat_icon_1254515209'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1254515209%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));
    </script>
</span>

</body>
</html>