<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎-上传简历坐等收钱</title>
        <link rel="stylesheet"  href="/Public/css/webchatnew/reset.css">     
        <script type="text/javascript" src="/Public/js/jquery-1.8.3.min.js"></script>
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1, maximum-scale=1, user-scalable=no" />
        <meta name="format-detection" content="telephone=no,email=no"/>
        <meta name="full-screen" content="yes">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <style>
            .com-list input{
                background: #dff1ff;
            }
        </style>
    </head>
    <body>
        <div class="mask" style="display:none"></div>


        <p class="error"></p>
        <div class="wrap">

            <section class="content m-content1" style="padding-bottom:20px;display:block;margin-top:1px;">
                <div class="srdz-banner"><a href="http://m.renrenlie.com"><img src="/Public/images/webchatnew/srdz-banner2.png" alt=""></a></div>
                <div class="srdz-text">
                    <div class="clearfix">
                        <p class="clearfix"><a href="/Home/Webchatnew/qa"><span class="btn" style="margin-top:10px;width:100px;float:right">了解人人猎</span></a></p>
                        <div class="clearfix">
                            <p class="clearfix" style="width:auto;padding:0 10px;">
                                <label class="fl-lef"><b>HR：</b></label><em class="fl-lef" style="width:74%">如果你是HR，你所在的公司若招聘1人，往往会面试4-5人，面试过后但未录用的人，其实可以<b>大额变现</b>。</em>
                            </p>
                            <p class="clearfix" style="width:auto;padding:0 10px;">
                                <label class="fl-lef"><b>猎头：</b></label><em class="fl-lef" style="width:70%">如果你是猎头，每月会详细了解50名候选人，但是一般只有1-2名候选人拿到offer，你可以将剩余的50人<b>大额变现</b>。</em>
                            </p>
                        </div>
                        <span class="dis-block bt"><b>1</b>上传简历</span>
                        <div class="clearfix"><em class="fl-lef">你只需每天下班后，将候选人简历上传至人人猎，要求上传的候选人简历满足：<br>1 . 年薪<b>10万</b>以上的互联网中高端人才；<br>2 . 候选人<b>正在看</b>工作机会。</em></div>
                        <span class="dis-block bt"><b>2</b>系统匹配</span>
                        <div class="clearfix"><em class="fl-lef">人人猎会将你上传的候选人简历<b>匹配</b>到与其最合适的工作机会，并协调面试预约。</em></div>
                        <span class="dis-block bt"><b>3</b>随心掌控</span>
                        <div class="clearfix"><em class="fl-lef">当你上传候选人进入人人猎推荐流程后，可随时在用户中心查看候选人<b>面试状态</b>。</em></div>
                        <span class="dis-block bt"><b>4</b>入职拿钱</span>
                        <div class="clearfix"><em class="fl-lef">候选人入职后，就可得到相应的推荐<b>奖金</b>。</em></div>
                        <span class="ms">还等什么，<b>快去电脑上传简历</b>吧</span>

                    </div>

                </div>

                <div>
                        <a href="/Home/Webchatnew/add_resume.html"><span class="btn" id="btn">马上参与</span></a>
                </div>

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
           
            //获取分享的参数
            var title = "人人猎-上传简历坐等收钱";
            var desc = "HR和猎头的赚钱神器";
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