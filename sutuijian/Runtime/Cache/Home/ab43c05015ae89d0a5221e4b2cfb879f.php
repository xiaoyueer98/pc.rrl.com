<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎-使用帮助</title>
        <link rel="stylesheet" type="text/css" href="/Public/css/webchatnew/reset.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/webchatnew/new-recommende.css">
        <script type="text/javascript" src="/Public/new-js/iscroll.js"></script>
        <script type="text/javascript" src="/Public/js/zepto.min.js"></script>
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1, maximum-scale=1, user-scalable=no" />
        <meta name="format-detection" content="telephone=no,email=no"/>
        <meta name="full-screen" content="yes">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <style>
            .wrap{
                width: 100%;
                padding-top:44px;
            }
            .content{
                margin-top: 10px;
            }
            .content div{
                width: 100%;
            }
            .unborder{
                border: none;
            }
            .bd{
                border-bottom:1px #eeeeee solid;
            }
            .h3{
                width: 90%;
                margin:0 auto;
                padding-left: 10px;
                font-size: 16px;
                color: #323232;
                text-align: left;
                border-left: 4px #2380b8 solid;
            }
            .eeturn-index{
                width: 36px;
                height: 38px;
                background: url(/Public/img/10.png) no-repeat center;
                background-size:32px 34px;
                position:fixed;
                top:60%;
                right:10px;
                overflow: hidden;
                border-radius: 5px;
            }
            .eeturn-index div{
                width: 100%;
                height: 100%;
                position: relative;
            }
            .eeturn-index span{
                background: #2380b8;
                position: absolute;
                display: block;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
                z-index: 1;
            }
            .eeturn-index em{
                width: 100%;
                height: 38px;
                text-align: center;
                position: absolute;
                padding-top: 4px;
                z-index: 2;
                padding-left: 1px;
                display: block;
                font-size: 12px;
                color: #fff;
                width: 34px;
                margin: 0 auto;
            }
        </style>

    </head>
    <body>
        <div class="eeturn-index">
            <a href="http://www.renrenlie.com">
                <div>
                    <span></span>
                    <em>返回首页</em> 
                </div></a>
        </div>
        <div class="wrap" style="padding-top:0">
            <div class="clearfix" style="margin-top:1px;border-bottom:1px solid #ccc;">
                <span class="qa-btn rcmd-btn dis-block m">我是推荐人</span>
                <span class="qa-btn hr-btn dis-block">我是企业HR</span>
            </div>
            <section class="content m-content1 qa-content rcmd" style="padding-bottom:20px;display:block">

                <?php foreach($arQAlist1 as $qaInfo):?>
                <div class="bd">
                    <div class="div-list">
                        <div class="qa q clearfix">
                            <span class="fl-lef dis-block"></span>
                            <em class="fl-lef dis-block"><?php echo $qaInfo['question'];?></em>
                        </div>
                        <div class="qa a clearfix">
                            <span class="fl-lef dis-block"></span>
                            <em class="fl-lef dis-block"><?php echo $qaInfo['answer'];?></em>
                        </div>
                        <!--                    <div class="qa qa-img">
                                                <img src="/Public/new-images/new-company/qa-404.jpg" alt="">
                                            </div>-->
                    </div>
                </div>
                <?php endforeach;?>
            </section>
            <section class="content m-content1 qa-content comp" style="padding:20px 0;display:none">
                <?php foreach($arQAlist2 as $qaInfo):?>
                <div class="bd">
                    <div class="div-list">
                        <div class="qa q clearfix">
                            <span class="fl-lef dis-block"></span>
                            <em class="fl-lef dis-block"><?php echo $qaInfo['question'];?></em>
                        </div>
                        <div class="qa a clearfix">
                            <span class="fl-lef dis-block"></span>
                            <em class="fl-lef dis-block"><?php echo $qaInfo['answer'];?></em>
                        </div>
                        <!--                    <div class="qa qa-img">
                                                <img src="/Public/new-images/new-company/qa-404.jpg" alt="">
                                            </div>-->
                    </div>
                </div>
                <?php endforeach;?>


            </section>


        </div>
        <!--为微信分享提供参数开始-->
        <input type='hidden' value='<?php echo ($appId); ?>' id='appId'>
        <input type='hidden' value='<?php echo ($timestamp); ?>' id='timestamp'>
        <input type='hidden' value='<?php echo ($nonceStr); ?>' id='nonceStr'>
        <input type='hidden' value='<?php echo ($signature); ?>' id='signature'>

        <script type="text/javascript">

            $(document).ready(function () {
                $("input").click(function () {
                    if (document.activeElement.tagName == 'INPUT') {
                        $(".fixed").css({'position': 'absolute', 'top': '0'});
                    } else if (document.activeElement.tagName !== 'INPUT') {
                        $(".fixed").css('position', 'fixed');
                    }
                })
            })

            $(".rcmd-btn").click(function () {
                $(".rcmd").show();
                $(".comp").hide();
                $(this).addClass("m").siblings().removeClass("m");
                //alert(23)
            })

            $(".hr-btn").click(function () {
                $(".rcmd").hide();
                $(".comp").show();
                $(this).addClass("m").siblings().removeClass("m");
            })

            //获取分享的参数
            var title = "人人猎-使用帮助";
            var desc = "职场牛人都在人人猎";
            var linkurl = window.location.href;
            var linkimg = "http://www.renrenlie.com/Public/images/webchatnew/logo.png";
        </script>
        <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <script type="text/javascript" src="/Public/js/webchat/shares_all.js"></script>
    <span style="display:none;">
    <script type="text/javascript">
        var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
        document.write(unescape("%3Cspan id='cnzz_stat_icon_1254515209'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1254515209%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));
    </script>
</span>

</body>
</html>