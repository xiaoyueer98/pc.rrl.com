<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="cn">
    <head>
        <title>最新职位</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1, maximum-scale=1, user-scalable=no" />
        <meta name="format-detection" content="telephone=no,email=no"/>
        <meta name="full-screen" content="yes">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <script type="text/javascript" src="/Public/js/iscroll.js"></script>
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <link rel="stylesheet" href="/Public/css/webchat/jin_2.css"/>
        <script type="text/javascript">
            var myScroll,
                    pullDownEl, pullDownOffset,
                    pullUpEl, pullUpOffset,
                    generatedCount = 0;

            var num = 2;
            /**
             * 初始化iScroll控件
             */
            function ajx(page, number) {
                $.ajax({
                    type: 'POST',
                    url: '/Home/Webchat/get_newjob_list',
                    data: 'page=' + page + '&number=' + number,
                    dataType: 'json',
                    success: function (data) {
                        
                        if (data.count <= (num-2) * 10) {
                            $('#over').html('<div class="resultjobs clearfix" style="font-size:14px;text-align:center;line-height:50px;color:#b4b4b4;">数据加载完成！</div>');
                            $('#pullUp').hide();
                            return;
                        }

                        var data = eval(data['result']);
                        for (var i = 0; i < data.length; i++) {

                            var posttimedata = "";
                            if (data[i].posttimedata.indexOf("-") === -1) {
                                posttimedata = data[i].posttimedata;

                            } else {
                                posttimedata = data[i].posttimedata.substr(5);
                                if (posttimedata.substr(0, 1) == "0") {
                                    posttimedata = posttimedata.substr(1);
                                }
                            }
//                            var treament = data[i].treatmentdata.replace("元", "");
//                            var pos = treament.indexOf("-");
//                            var treatmentB = treament.substr(0, pos);
//                            var treatmentE = treament.substr(pos + 1);
//                            var treamentNew = (treatmentB / 1000) + "K-" + (treatmentE / 1000) + "K";

                            var str = "";
                            str = '<a href="/Home/Webchat/job_detail/id/' + data[i].id + '">'
                                    + '<div class="con clearfix">'
                                    + '<div class="cen xzw">'
                                    + '<p class="p1">'
                                    + '<span class="p1_sp">' + data[i].title + '</span>'
                                    + '</p>'
                                    + '<p class="p1">'
                                    + '<em>' + data[i].cpname + '</em>'
                                    + '</p>'
                                    + '<p class="p2">'
                                    + '<span class="spa1 date">' + posttimedata + '</span>'
                                    + '<span class="spa1">' + data[i].cascname + '</span>'
                                    + '<span class="spa1">' + data[i].experiencedata.replace("工作经验", "") + '</span>'
                                    + '<span class="spa1">已推荐<span style="color:red;">' + data[i].recommendednum + '</span>人</span>'
                                    + '</p>'
                                    + '</div>'
                                    + '<div class="right">'
                                    + '<a href=""><p class="p1 p_t">' + data[i].treatmentdata + '</p></a>'
                                    + '<a href=""><p class="p1"></p></a>'
                                    + '<a href=""><p class="p2 p_b">' + data[i].Tariff + '</p></a>'
                                    + '</div>'
                                    + '</div>'
                                    + '</a>';


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
                }, 1300);
            }
            function pullUpAction2() {
                setTimeout(function () {
                    ajx(1, 10)
                    myScroll.refresh();
                }, 200);
            }
            //pullUpAction2()

            function loaded() {
                pullDownEl = document.getElementById('pullDown');
                pullDownOffset = pullDownEl.offsetHeight;
                pullUpEl = document.getElementById('pullUp');
                pullUpOffset = pullUpEl.offsetHeight;

                myScroll = new iScroll('wrapper', {
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
//                            pullDownEl.className = 'loading';
//                            pullDownEl.querySelector('.pullDownLabel').innerHTML = '加载中...';
//                            pullDownAction(); // Execute custom function (ajax call?)
                            $('#pullDown').hide();
                        } else if (pullUpEl.className.match('flip')) {
                            pullUpEl.className = 'loading';
                            pullUpEl.querySelector('.pullUpLabel').innerHTML = '加载中...';
                            pullUpAction(); // Execute custom function (ajax call?)

                        }
                    }
                });



                setTimeout(function () {
                    document.getElementById('wrapper').style.left = '0';
                }, 800);
            }
            //初始化绑定iScroll控件
            document.addEventListener('touchmove', function (e) {
                e.preventDefault();
            }, false);
            document.addEventListener('DOMContentLoaded', loaded, false);
        </script>
    </head>
    <body>
        <!--<div id="header">
            <span href="../db.html#page2">被推荐人</span>
            <a href="">返回</a>
        </div>-->
        <div id="wrapper">
            <div id="scroller">
                <div id="pullDown" style="display:none">
                    <span class="pullDownIcon"></span><span class="pullDownLabel">下拉刷新...</span>
                </div>
                <div id="thelist">
                    <div id="thelist2">
                        <?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="con clearfix">
                                <a href="/Home/Webchat/job_detail/id/<?php echo ($vo["id"]); ?>">
                                <div class="cen xzw">
                                    <p class="p1">
                                        <span class="p1_sp"><?php echo ($vo["title"]); ?></span>
                                    </p>
                                    <p class="p1">
                                        <em><?php echo ($vo["cpname"]); ?></em>
                                    </p>
                                    <p class="p2">
                                        <span class="spa1 date"><?php echo ($vo["posttimedata"]); ?></span>
                                        <span class="spa1"><?php echo ($vo["cascname"]); ?></span>
                                        <span class="spa1"><?php echo ($vo["experiencedata"]); ?></span>
                                        <span class="spa1">已推荐<?php echo ($vo["recommendednum"]); ?>人</span>
                                    </p>
                                </div>
                                <div class="right">
                                    <a href=""><p class="p1 p_t"><?php echo ($vo["treatmentdata"]); ?></p></a>
                                    <a href=""><p class="p1"></p></a>
                                    <a href=""><p class="p2 p_b"><?php echo ($vo["Tariff"]); ?></p></a>
                                </div>
                            </div>
                            </a><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <div id='over'></div>
                </div>
                
                <div id="pullUp">
                    <span class="pullUpIcon"></span><span class="pullUpLabel">上拉加载更多...</span>
                </div>
                
            </div>
        </div>

    <footer style="position: fixed; left: 0px; bottom: 0px; z-index: 110; margin-bottom: 0px;width:100%">
        <div class="footer">
           <h2 align="center"class="ftitle">人人猎<a style="margin-left:10px;display:none"><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1254515209'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1254515209%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script></a></h2>
           <p align="center" class="ftel">TEL：4006-685-596 京ICP备140140256号</p>
        </div>
</footer>
<span style="display:none;">
    <script type="text/javascript">
        var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
        document.write(unescape("%3Cspan id='cnzz_stat_icon_1254515209'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1254515209%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));
    </script>
</span>
       

</body>
</html>