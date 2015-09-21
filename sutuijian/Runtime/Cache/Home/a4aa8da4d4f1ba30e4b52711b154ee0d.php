<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>正在推荐</title>
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
                    url: '/Home/Webchatrecommend/get_recommending_list',
                    data: 'page=' + page + '&number=' + number,
                    dataType: 'json',
                    success: function (data) {

                        if (data.count == 0) {
                            if ($.trim($("#thelist2").html()) == "") {
                                $('#thelist2').append('<div class="resultjobs clearfix" style="font-size:14px;text-align:center;line-height:50px;color:#b4b4b4;">还未有正在推荐的职位，请先去推荐!</div>');
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

                            var str = "";
                            str = '<div class="bd2">'
                                    + '<div class="lists" onclick="show($(this))">'
                                    + '<ul class="latest-position">'
                                    + '<li class="clearfix lis1">'
                                    + '<div class="fl-lef dis-inlin">'
                                    + '<span class="fl-lef dis-inlin dis-block mysp1">' + data[i]['username'] + '</span>'
                                    + '<em class="fl-lef dis-inlin dis-block">' + data[i]['title'] + '</em>'
                                    + '</div>'
                                    + '<div class="fl-rig dis-inlin">'
                                    + '<span class="fl-lef dis-inlin dis-block">推荐费：</span>'
                                    + '<b>' + data[i]['Tariff'] + '</b>'
                                    + '</div>'
                                    + '</li>'
                                    + '<li class="clearfix lis1">'
                                    + '<div class="fl-lef dis-inlin r">' + data[i]['cpname'] + '</div>'

                                    + '<div class="fl-rig dis-inlin r"><span class="fl-lef dis-inlin dis-block">招聘人数:<b>' + data[i]['recommendnum'] + '</b></span></div>'
                                    + '</li>'
                                    + '<li class="clearfix lis2">'
                                    + '<div class="fl-lef dis-inlin">'

                                    + '<span class="fl-lef dis-inlin dis-block mysp1">' + data[i]['treatmentdata'] + '</span>'
                                    + '<span class="fl-lef dis-inlin dis-block">进度:<b>' + data[i]['audstartdata'] + '</b></span>'

                                    + '</div>';
                            if (data[i]['audstart'] > 3 && data[i]['audstart'] < 8 && data[i]['is_evaluate'] == 1) {
                                var str1 = data[i]['recordid']+","+data[i]['j_id']+",'"+data[i]['cpname']+"'";
                                str +=
                                        '<div class="fl-rig dis-inlin">'
                                        + '<span id="pingjia" class="pinj-btn" onclick="recomment('+str1+');">评价</span>'
                                        + '</div>';
                            }

                            str += '</li>'
                                    + '</ul>'
                                    + '<span class="down"></span>'
                                    + '</div>'
                                    + '<div class="list-process">'
                                    + '<ul>';

                            if (data[i]['notice_log'].length > 0) {
                                for (var j = 0; j < data[i]['notice_log'].length; j++) {
                                    str +=
                                            '<li class="clearfix">'
                                            + '<span class="sp1 l">'
                                            + ' <em> ' + data[i]['notice_log'][j]['posttime'] + '</em>'
                                            + '<b></b>'
                                            + '</span>'
                                            + '<span class="sp3">'
                                            + '<em>' + data[i]['notice_log'][j]['content'] + '</em>';
                                    if (j == 0) {
                                        str += '<b class="m"></b>';
                                    } else {
                                        str += '<b class=""></b>';
                                    }


                                    str += '</span></li>';
                                }
                            }
                            str += '</ul></div></div>';
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
            <div id="thelist" class="job-list-content process">

                <div class="list-candidates" style="padding-bottom:45px;">
                    <div id="thelist2">
                        <?php  if(empty($result)){ echo "<div style='font-size: 14px;color: #b4b4b4;text-align:center;margin-top:10px;margin-bottom:20px;'>还未有正在推荐的职位，请先去推荐！</div>"; }else{ foreach($result as $k=>$v) {?>
                        <div class="bd2">
                            <div class="lists">
                                <ul class="latest-position">
                                    <li class="clearfix lis1">
                                        <div class="fl-lef dis-inlin">
                                            <span class="fl-lef dis-inlin dis-block mysp1"><?php echo $v['username']?></span>
                                            <em class="fl-lef dis-inlin dis-block"><?php echo $v['title']?></em>
                                        </div>
                                        <div class="fl-rig dis-inlin">
                                            <span class="fl-lef dis-inlin dis-block">推荐费：</span>
                                            <b><?php echo $v['Tariff']?></b>
                                        </div>
                                    </li>
                                    <li class="clearfix lis1">
                                        <div class="fl-lef dis-inlin r"><?php echo $v['cpname']?></div>

                                        <div class="fl-rig dis-inlin r"><span class="fl-lef dis-inlin dis-block">招聘人数:<b><?php echo $v['recommendnum']?></b></span></div>
                                    </li>
                                    <li class="clearfix lis2">
                                        <div class="fl-lef dis-inlin">

                                            <span class="fl-lef dis-inlin dis-block mysp1"><?php echo $v['treatmentdata']?></span>
                                            <span class="fl-lef dis-inlin dis-block">进度:<b><?php echo $v['audstartdata']?></b></span>

                                        </div>
                                        <?php if($v['audstart']>3 && $v['audstart']<8 && $v['is_evaluate']==1){?>
                                        <div class="fl-rig dis-inlin">
                                            <input type='hidden' value="{$v[recordid]}">
                                            <span id="pingjia" class="pinj-btn" onclick='recomment("<?php echo ($v[recordid]); ?>", "<?php echo ($v[j_id]); ?>", "<?php echo ($v[cpname]); ?>")'>评价</span>
                                        </div>
                                        <?php }?>
                                    </li>
                                </ul>
                                <span class="down"></span>
                            </div>
                            <div class="list-process">
                                <ul>
                                    <?php foreach ($v['notice_log'] as $ko=>$vo){ ?>
                                    <li class="clearfix">
                                        <span class="sp1 l">
                                            <em><?php echo $vo['posttime']?></em>
                                            <b></b>
                                        </span>
                                        <span class="sp3">
                                            <em><?php echo $vo['content']?></em>   
                                            <b class="<?php if($ko=='0') echo 'm';?>"></b>
                                        </span>
                                    </li>
                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                        <?php }}?>

                    </div>
                    <div id='over' style='border-bottom: 1px solid #ccc;'></div>
                    <?php if(!empty($result)){?>
                    <div id="pullUp" style="font-family: '微软雅黑';background: #fff;height: 40px;line-height: 40px;padding: 5px 10px;border-bottom: 1px solid #ccc;font-weight: bold;font-size: 14px;color: #888;">
                        <span class="pullUpIcon"></span><div style="margin:0 auto;display:block;width:96px;" class="pullUpLabel">上拉加载更多...</div>
                    </div>
                    <?php }?>
                </div>

            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        $(document).ready(function () {
            $(".lists").click(function () {
                if( $(this).hasClass("current")){
                    $(this).next().hide();
                    $(this).removeClass('m').find(".down").removeClass('m');
                    $(this).parent().addClass("bd2");
                    $(this).parent().prev().addClass("bd2");
                    $(this).removeClass("current");
                    myScroll.refresh(); 
                }else{
                    $(this).next().show();
                    $(this).parent().siblings().find(".list-process").hide();
                    $(this).parent().siblings().find(".lists").removeClass('m');
                    $(this).parent().siblings().addClass("bd2");
                    $(this).parent().prev().removeClass("bd2");
                    //$(this).parent().css({'border-bottom': '1px #afafaf solid'});
                    $(this).parent().siblings().find(".down").removeClass('m');
                    $(this).addClass('m').find(".down").addClass('m');
                    $(this).addClass("current");
                    myScroll.refresh(); 
                }
                
            })
        });
        function show(ob) {
            ob.next().show();
            ob.parent().siblings().find(".list-process").hide();
            ob.parent().siblings().find(".lists").removeClass('m');
            ob.parent().siblings().css({'border-bottom': '1px #afafaf solid'});
            ob.parent().prev().css({'border-bottom': 'none'});
            ob.parent().css({'border-bottom': '1px #afafaf solid'});
            ob.addClass('m').find(".down").addClass('m');
            ob.parent().siblings().find(".down").removeClass('m');
            ob.addClass('m').find(".down").addClass('m');
            myScroll.refresh();
        }
        function  recomment(recordid, j_id, pname) {
            location.href = "/Home/Webchatrecommend/text_evaluate/recordid/" + recordid + "/j_id/" + j_id + "/pname/" + pname;
        }
    </script>
    <span style="display:none;">
    <script type="text/javascript">
        var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
        document.write(unescape("%3Cspan id='cnzz_stat_icon_1254515209'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1254515209%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));
    </script>
</span>

</body>
</html>