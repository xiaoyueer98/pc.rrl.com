<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>我的账户</title>
        <link rel="stylesheet"  href="/Public/css/webchatnew/reset.css">
        <link rel="stylesheet"  href="/Public/css/webchatnew/wep.css">
        <script type="text/javascript" src="/Public/js/webchatnew/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/webchatnew/iscroll-refresh.js"></script>
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
                    url: '/Home/Webchatnew/get_account_list',
                    data: 'page=' + page + '&number=' + number,
                    dataType: 'json',
                    success: function (data) {

                        if (data.count == 0) {
                            if ($.trim($("#thelist2").html()) == "") {
                                $('#thelist2').append('<div class="resultjobs clearfix" style="font-size:14px;text-align:center;line-height:50px;color:#b4b4b4;">还未有账户信息！</div>');
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

                            var incr = data[i].incr > 0 ? "<span style='color:red;width:100%;margin:0'>+" + data[i].incr + "</span>" : data[i].incr;
                            var str = "";
                            str =
                                    '<div class="list clearfix">'
                                    + '<dl>'
                                    + '<dt>'
                                    + '<p class="pt"><span>' + data[i].username + '</span></p>'
                                    + '<p class="pb" style="color:#b4b4b4;font-size:12px;line-height:30px;"><span>' + data[i].comment + '</span><span>' + data[i].created_at + '</span></p>'
                                    + '</dt>'
                                    + '<dd class="rec">'
                                    + '<span class="self">' + incr + '</span>'
                                    + '</dd>'
                                    + '</dl>'
                                    + '</div>';

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
                    ajx(1, 10);
                    myScroll.refresh();
                }, 1000);
            }



            /**
             * 初始化iScroll控件
             */
            function loaded() {
                pullDownEl = document.getElementById('pullDown');
                pullDownOffset = pullDownEl.offsetHeight;
                pullUpEl = document.getElementById('pullUp');
                pullUpOffset = pullUpEl.offsetHeight;

                myScroll = new iScroll('re_wrapper', {
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
                            //pullDownAction();	// Execute custom function (ajax call?)
                        } else if (pullUpEl.className.match('flip')) {
                            pullUpEl.className = 'loading';
                            pullUpEl.querySelector('.pullUpLabel').innerHTML = '<img src="/Public/images/webchatnew/loading.gif" style="width:25px;height:25px;padding-top:7px;margin:0 auto;display:block">';
                            pullUpAction();	// Execute custom function (ajax call?)

                        }
                    }
                });

                setTimeout(function () {
                    document.getElementById('re_wrapper').style.left = '0';
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

        <div id="re_wrapper" style='top:0;'>
            <div id="scroller">
                <div id="pullDown" style="display:none">
                    <span class="pullDownIcon"></span><span class="pullDownLabel">下拉刷新...</span>
                </div>
                <div id="thelist">
                    <div id="thelist2">
                        
                        <?php  if(empty($result)){ echo "<div style='font-size: 14px;color: #b4b4b4;text-align:center;margin-top:10px;margin-bottom:20px;'>暂无账户信息！</div>"; }else{foreach($result as $ko => $vo){?>
                            <div class="list clearfix">
                                <dl>
                                    <dt>
                                    <p class="pt"><span><?php echo $vo['username']?></span></p>
                                    <p class="pb" style="color:#b4b4b4;font-size:12px;line-height:30px;"><span><?php echo $vo['comment']?></span><span><?php echo $vo['created_at']?></span></p>
                                    </dt>
                                    <dd class="rec">
                                    <?php if($vo['incr']>0){?>
                                    <span class="self"><?php echo $vo['incr']?></span>
                                    <?php }else{?>
                                    <span class="self">-<?php echo $vo['incr']?></span>
                                    <?php }?>
                                    </dd>
                                </dl>
                            </div>
                        <?php }}?>
                    </div>

                </div>
                <div id="over"></div>
                 <?php if(!empty($result)){?>
                <div id="pullUp" style='text-align:center;'>
                    <span class="pullUpIcon"></span><span class="pullUpLabel">上拉加载更多...</span>
                </div>
                <?php }?>
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