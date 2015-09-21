<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>推荐列表-人人猎</title>
         <meta name="keywords" content="人人猎,人人猎网，人人猎头,renrenlie.com,www.renrenlie.com,人人猎首页,人人猎官网，人人都是猎头" />
        <meta name="description" content="人人猎（www.renrenlie.com)是企业低成本极速直招平台，让企业一周内搞定招聘需求，为推荐人提供“人力资源”变现通道。" />
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/focuspic.js"></script>
        <script type="text/javascript" src="/Public/js/menu_v.js"></script>
        <script type="text/javascript" src="/Public/js/script.js"></script>
        <link rel="stylesheet" type="text/css" href="/Public/css/resizer.css">
        <link rel="stylesheet" href="/Public/css/focuspic.css" />
        <link rel="stylesheet" href="/Public/css/menu_v.css" />
        <link rel="stylesheet" type="text/css" href="/Public/css/style.css">
        <style>
            .Pop-up {position: fixed;top: 50%;left: 50%;display: none;margin-left: -177px;width: 354px;height: 174px;z-index:100;height: -87px; margin-top:-88px;background: url(/Public/img/dle_altBg.png) no-repeat;}
            .Pop-up div  textarea{ display: block;width: 200px;height: 40px;}
            .Pop-up  div{display: block;width: 200px;height: 40px;margin-left: 80px;margin-bottom: 10px;}
            .Pop-up h3 {margin-top: 45px;color: #2380b8;text-align: center;font-size: 14px;margin-bottom: 10px;}
            .Pop-up .btnR {margin-left: 66px;width: 80px;height: 30px;border: 0;border-radius: 5px;background: #1a628e;color: #fff;}
            .Pop-up h3 {margin-top: 45px;color: #2380B8; text-align: center; font-size: 14px;}
            .PersData .recom2 h3 { margin-bottom: 38px;padding: 0px;border: 0px none; font-size: 18px;}
            .Pop-up .btnL,.Pop-up .btnR { margin-left: 66px; width: 80px; height: 30px; border: 0px none;border-radius: 5px;background: none repeat scroll 0% 0% #1A628E;color: #FFF;}
        </style>
    </head>
    <body>
        <!-- 遮罩层 -->
        <div class="mask" id="mask"></div>
        <div class="dx_page" style="display:block">
            <div class="con">
                <p>亲爱的<input type="text" style="width:50px" value="XXXX" id="bt_name">同学，我们诚挚邀请你于<input type="text" style="width:50px" value="XXXX" id="msdate">和我们<input type="text" value="<?php echo ($jobInfo['comname']); ?>" id="gs">面试，公司地点：<input type="text" value="<?php echo ($jobInfo['jobplace']); ?>" id="address">乘车路线<input type="text" value="XXXX" id="lx">，联系人<input type="text" value="<?php echo ($jobInfo['cnname']); ?>" id="lxr">，联系电话<input type="text" value="<?php echo ($jobInfo['telephone']); ?>" id="hm">。请勿迟到。 </p>
                <input type="hidden" id="mobile">
                <input class="fs" type="button" value="发送">
                <span class="qx">取消</span>
            </div>
        </div>
    <div class="pc-zhuce" style="display: none" id='conZhuce'>
    <!--<a href="javascript:;" class="close"></a>-->
    <h3></h3>
    <dl>
        <dt>
        <ul class="pc-nav">
            <li class="nav1 mover3" id='tjrzc'>推荐人<input type="hidden" name="usertype" value="0"/></li>
            <li class="nav2" id='qyzc'>招聘企业</li>
        </ul>
        <ul class="list">
            <li><input type="text" name="username" value="请输入用户名" default="请输入用户名"></li>
            <li><input type="text" name="mobile" value="请输入手机号" default="请输入手机号"></li>
            <li><input type="text" class="vfition" name="vfition" value="请输入验证码" default="请输入验证码"><label class="vfit_btn1" style="display: block" id="get_reg_code">获取验证码</label><label class="vfit_btn2"  style="display: none"><i>60</i>秒后重新获取</label></li>
            <li><input type="text" class="possword"  name="possword" value="请输入密码" default="请输入密码" ></li>
            <p id="zhuceerror" style="display: none">您输入的密码不合格</p>
        </ul>
        <div class="yanzheng">
            <input class="radio1" type="radio" name="xieyi" id="xieyaya">
            <span>已阅读并接受人人猎网<a href="javascript:;" id="xieyisss">《用户协议和隐私条款》</a></span>
        </div>
        <button id="register">确认</button>
        </dt>
        <dd>
            <div class="yd">
                <span>已有账号</span>
                <em id="denglu3">点此登录</em>
            </div>
            <p>使用联合账号登录</p>
            <ul class="Sign" >
                <li><a href="/Home/Index/login?type=qq"><img src="/Public/img/qq_icon.png"></a></li>
                <li><a href="/Home/Index/login?type=sina"><img src="/Public/img/weibo.png"></a></li>
                <li><a href="/Home/Index/login?type=weixin"><img src="/Public/img/weixin.png"></a></li>
                <li><a href="/Home/Index/login?type=renren"><img src="/Public/img/renren.png"></a></li>
            </ul>
            <ul class="Grey" style="display:none">
                <li><img src="/Public/img/qq2.png"></li>
                <li><img src="/Public/img/Sina2.png"></li>
                <li><img src="/Public/img/weixin2.png"></li>
                <li><img src="/Public/img/renren2.png"></li>
            </ul>
        </dd>
    </dl>
</div>
<script>
    $(function() {
        $(".pc-zhuce .close").click(function(){
            $(".mask").hide();
            $(".pc-zhuce").hide();
        });
        $(".possword").focus(function(){
            if($(this).attr("default") == $(this).val()){
                $(this).attr("type","password");
            }
        });
        $(".possword").blur(function(){
            if(!$(this).val()){
                 $(this).attr("type","text");
            }
           
        });
        $("#register").attr("disabled", false);
        $(".nav2").click(function() {
            $(".Grey").show();
            $(".Sign").hide();
            $(".nav1").removeClass("mover3");
            $(this).addClass("mover3");
            $("input[name='usertype']").val(1);
        });
        $(".nav1").click(function() {
            $(".Grey").hide();
            $(".Sign").show();
            $(".nav2").removeClass("mover3");
            $(this).addClass("mover3");
            $("input[name='usertype']").val(0);
        });
        $(".pc-zhuce .list input").focus(function() {
            $(this).css("color", "black");
            if ($(this).val() == $(this).attr("default")) {
                $(this).val("");
            }
        });
        $(".pc-zhuce .list input").blur(function() {
            if (!$(this).val()) {
                $(this).css("color", "");
                $(this).val($(this).attr("default"));
            }
        });
        $("input[name='username']").blur(function() {
            if (/^[\@A-Za-z\!\#\$\%\^\&\*\.\~]{2,}[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{2,16}$/.test($(this).val())) {
                $("#zhuceerror").hide();
            } else {
                $(this).focus();
                $("#zhuceerror").html("请输入4-16位的英文字母，数字，下划线");
                $("#zhuceerror").show();
            }
            if (!$(this).val()) {
                $(this).css("color", "");
                $(this).val($(this).attr("default"));
                //  $(this).next().show();
                //  $(this).next().text("请输入用户名"); 
            }
        });
        //手机获取验证码
        $("#get_reg_code").click(function() {
            var usertype = $("input[name='usertype']").val();
            var mobile = $("input[name='mobile']").val();
            var reg = /^1[3|4|5|8][0-9]\d{4,8}$/;
            if (mobile == "请输入手机号") {
                $("input[name='mobile']").focus();
                $("#zhuceerror").html("请输入手机号码");
                $("#zhuceerror").show();
                return false;
            }
            if (!reg.test(mobile))
            {
                $("input[name='mobile']").focus();
                $("#zhuceerror").html("请正确输入手机号码");
                $("#zhuceerror").show();
                return false;
            }
            $(".vfit_btn1").attr("disabled", "disabled");
            $.post("/Home/Index/getRegCode", {
                'mobile': mobile,
                'usertype': usertype
            }, function(data) {
                if (data.code != 200) {
                    $(".vfit_btn1").attr("disabled", "");
                    $("#zhuceerror").html(data.msg);
                    $("#zhuceerror").show();
                    return false;
                } else {
                    time($(".vfit_btn1"));
                    $("#zhuceerror").hide();
                    $(".vfit_btn1").hide();
                    $(".vfit_btn2").show();
                }
            }, "json")
        });
        $("#zhuce").click(function() {
            $(".Grey").hide();
            $(".Sign").show();
            $(".nav2").removeClass("mover3");
            $(".nav1").addClass("mover3");
            $("input[name='usertype']").val(0);
            $(".mask").show();
            $(".pc-zhuce").show();
        });
        $("#register").click(function() {
            var username = $("input[name='username']").val();
            var mobile = $("input[name='mobile']").val();
            var vfition = $("input[name='vfition']").val();
            var password = $("input[name='possword']").val();
            var dd = document.getElementById("xieyaya").checked;
            var usertype = $("input[name='usertype']").val();

            if (!username || username === "请输入用户名") {
                $("input[name='username']").focus();
                $("#zhuceerror").html("请输入用户名称！");
                $("#zhuceerror").show();
                return false;
            }
            if (/^[\@A-Za-z\!\#\$\%\^\&\*\.\~]{2,}[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{2,16}$/.test(username)) {
                $("#zhuceerror").hide();
            } else {
                $("input[name='username']").focus();
                $("#zhuceerror").html("请输入4-16位的英文字母，数字，下划线");
                $("#zhuceerror").show();
                return false;
            }
            var reg = /^1[3|4|5|8][0-9]\d{4,8}$/;
            if (mobile == "请输入手机号") {
                $("input[name='mobile']").focus();
                $("#zhuceerror").html("请输入手机号码");
                $("#zhuceerror").show();
                return false;
            }
            if (!reg.test($.trim(mobile)))
            {
                $("input[name='mobile']").focus();
                $("#zhuceerror").html("请正确输入手机号码");
                $("#zhuceerror").show();
                return false;
            }

            if (!vfition || vfition == "请输入验证码") {
                $("input[name='vfition']").focus();
                $("#zhuceerror").html("请输入验证码");
                $("#zhuceerror").show();
                return false;
            }
            if (!password || password == "请输入密码") {
                $("input[name='possword']").focus();
                $("#zhuceerror").html("密码不能为空");
                $("#zhuceerror").show();
                return false;
            }

            if (password.length == 0)
            {
                $("input[name='possword']").focus();
                $("#zhuceerror").html("密码不能为空");
                $("#zhuceerror").show();
                //focus_input("regpassword");
                return false;
            }
            else if (password.length < 6 || password.length > 16)
            {

                $("input[name='possword']").focus();
                $("#zhuceerror").html("密码应为6-16个字符之间");
                $("#zhuceerror").show();
                return false;
            }
            else
            {
                var preg = /[`,，。;；'"‘’“” \u4e00-\u9fa5　]+/;
                if (preg.test(password))
                {

                    $("input[name='possword']").focus();
                    $("#zhuceerror").html("密码不能含有特殊字符");
                    $("#zhuceerror").show();

                    return false;
                }
                else
                {
                    //验证密码复杂度
                    var preg1 = /^[0-9]{6,}$/;
                    var preg2 = /^[a-zA-Z]{6,}$/;
                    if (preg1.test(password) || preg2.test(password))
                    {
                        $("input[name='possword']").focus();
                        $("#zhuceerror").html("密码不能是纯字母或纯数字");
                        $("#zhuceerror").show();

                        //focus_input("regpassword");
                        return false;
                    }
                    else
                    {
                        $("#zhuceerror").hide();
                    }
                }

            }
            if (dd == false) {
                $("#zhuceerror").html("请接受人人猎《用户协议和隐私条款》！");
                $("#zhuceerror").show();
                return false;
            }
            $("#register").attr("disabled", "disabled");
            $.post("/Home/Index/addUser", {
                'username': username,
                'mobile': mobile,
                'code': vfition,
                'password': password,
                'usertype': usertype
            }, function(data) {

                if (data.code != "200") {
                    $("#register").attr("disabled", false);
                    $("#zhuceerror").html(data.msg);
                    $("#zhuceerror").show();
                } else {
                    location.href = data.msg;
                }
            }, "json")
        });
    })
    var wait = 60;
    function time(o) {
        if (wait == 0) {

            o.attr("disabled", "disabled");
            $(".vfit_btn1").show();
            $(".vfit_btn2").hide();
            wait = 60;
        } else {
            o.attr("disabled", "");
            $(".vfit_btn2 i").html(wait);
            wait--;
            setTimeout(function() {
                time(o)
            },
                    1000)
        }
       
    }
</script>
    <div  class="denglu dengluBtn2">
    <a class="Close"></a>
    <h3></h3>
    <dl>
        <dt>
        <ul class="InputUl">
            <li><input class="DLUser" type="text" name="usernamees" value='<?php echo $_COOKIE[username];?>'/><span><?php if(!($_COOKIE[username] && $_COOKIE[password])){ echo "请输入用户名/手机号";}?></span></li>
            <li><input class="DLpassword" type="password" name="passwordes" value='<?php echo $_COOKIE[password];?>'/><span><?php if(!($_COOKIE[username] && $_COOKIE[password])){ echo "请输入密码";}?></span></li>
            <p class="error2"></p>
        </ul>
        <div class="yanzheng">
            <input type="checkbox" id="remembeme" <?php if($_COOKIE[username] && $_COOKIE[password]){ echo "checked";}?>>
                   <span>记住我<a href="/index.php?s=/Home/Company/findpwd.html">忘记密码？</a></span>
        </div>
        <input type="submit" class="zhucequeren" value="确认" id="denglubutton">
        <div class="weixin_img">
            <img src="/Public/img/erweima_img.jpg" alt="">
        </div>
        </dt>
        <dd>
            <div class="yd">
                <span>还没账号</span>
                <em id="dengluBtn2">点此注册</em>
            </div>
            <p><a href="">使用联合账号登录</a></p>
            <ul>
                <li><a href="/Home/Index/login?type=qq"><img src="/Public/img/qq_icon.png"></a></li>
                <!-- <li><a href="<?php echo U('login?type=qq');?>"><img src="/Public/img/qq2.png"></a></li> -->
                <li><a href="/Home/Index/login?type=sina"><img src="/Public/img/weibo.png"></a></li>
                <li><a href="/Home/Index/login?type=weixin"><img src="/Public/img/weixin.png"></a></li>
                <!-- <li class="dl_weixin"><img src="/Public/img/weixin.png"></li> -->
                <li><a href="/Home/Index/login?type=renren"><img src="/Public/img/renren.png"></a></li>
            </ul>
        </dd>
    </dl>
</div>
<div class="cfid">
    <a class="Close2" id="colosewindowd"></a>
    <h3><img src="/Public/img/denglu_hed.png" alt=""></h3>
    <ul>
        <li><b id="helloname">Robin您好！</b></li>
        <li>系统检测到你有另外一个相同的用于<span>推荐人</span>登录的用户ID<br>请你下次使用以下ID登录<span>推荐人页面</span></li>
        <li><div id="updatename">hrRobin</div></li>
        <li>
            <input type="hidden" id="hrefUrl">
            <input class="btn" type="button" value="我知道了" id="colosewindowds"></li>
    </ul>
</div>

<script>
    $(function () {
        $("#denglubutton").attr("disabled", false);
        $("#colosewindowd").click(function () {
            $(".mask1").hide();
            $(".mask").hide();
            $(".cfid").hide();
            $(".denglu").hide();
            location.href = $("#hrefUrl").val();
        })
        $("#colosewindowds").click(function () {
            $(".mask").hide();
            $(".mask1").hide();
            $(".cfid").hide();
            $(".denglu").hide();
            location.href = $("#hrefUrl").val();
        })
    })
    $("#denglubutton").click(function () {
        var username = $("input[name='usernamees']").val();
        var password = $("input[name='passwordes']").val();
        var remembeme = document.getElementById("remembeme").checked;

        if (!username) {
            $('.error2').html('用户名不能为空')
            $('.error2').show();
            return false;
        } else if (!password) {
            $('.error2').html('密码不能为空')
            $('.error2').show();
            return false;
        }
        var currentAction = $("#currentAction").val();

        if (currentAction) {

            var enterIndexComId = $("#enterIndexComId").val();
            var enterIndexJobId = $("#enterIndexJobId").val();
        } else {
            currentAction = "";
            enterIndexComId = 0;
            enterIndexJobId = 0;
        }

        var url = "/Home/Index/userlogin"; //定义一个登陆地址，分别为用户名登陆地址和手机号登陆地址
        if (/^((13[0-9])|147|(15[0-35-9])|180|182|(18[5-9]))[0-9]{8}$/.test(username)) {
            url = "/Home/Index/mobilelogin";
        }
        $.post(url, {
            'username': username,
            'password': password,
            'currentAction': currentAction,
            'enterIndexComId': enterIndexComId,
            'enterIndexJobId': enterIndexJobId,
            'remembeme': remembeme
        }, function (data) {

            if (data.code == 200) {
                location.href = data.msg;
                return false;
            } else if (data.code == 201) {
                $("#helloname").html(username + "您好！");
                $("#updatename").html("hr" + username);
                $("#hrefUrl").val(data.msg);
                $(".mask1").show();
                $(".cfid").show();
            } else {

                $('.error2').html(data.msg)
                $('.error2').show();
                return false;
            }
        }, "json")
    });
</script>
    <div id="J_Cat" class="cat">
    <div class="cat-hd">
        <a href="<?php echo U('Index/index');?>">
            <img src="/Public/img/logo.png" alt="" id="compic">
        </a>
    </div>
    <ul class="pd" style="background:#ffffff;">
        <h3>企业用户中心</h3>
        <li class="pd_list">
            <span><i><img src="/Public/img/pd_icon1.png" alt=""></i><b>企业资料</b></span>
            <ul  <?php  if($first_class == "1"){ echo 'style="display:block;"';}?>>
                <li><a href="<?php echo U('Company/EnterpriseInformation');?>"><em <?php  if($second_class == "1"){ echo 'class="hre"';}?>>基本信息</em></a></li>
                <li><a href="<?php echo U('Company/introductCompany');?>"><em <?php  if($second_class == "2"){ echo 'class="hre"';}?>>公司简介</em></a></li>
                <li><a href="<?php echo U('Company/ContInformation');?>"><em <?php  if($second_class == "3"){ echo 'class="hre"';}?>>联系方式</em></a></li>
                <li><a href="<?php echo U('Company/companyBright');?>"><em <?php  if($second_class == "4"){ echo 'class="hre"';}?>>公司亮点</em></a></li>
            </ul>
        </li>
        <li class="pd_list mytj" >
            <span><i><img src="/Public/img/pd_icon2.png" alt=""></i><b>招聘管理</b></span>

            <ul <?php  if($first_class == "2"){ echo 'style="display:block;"';}?>>
                <li><a href="javascript:;" class="sendJob"><em <?php  if($second_class == "11"){ echo 'class="hre"';}?>>发布招聘 </em></a></li>
                <li><a href="<?php echo U('Company/companyJobList');?>"><em <?php  if($second_class == "5"){ echo 'class="hre"';}?>>正在招聘 </em></a></li>
                <li><a href="<?php echo U('Company/beforeCompanyJobList');?>"><em <?php  if($second_class == "6"){ echo 'class="hre"';}?>>往期招聘 </em></a></li>
            </ul>
        </li>
        <li class="pd_list">
            <span><i><img src="/Public/img/pd_icon3.png" alt=""></i><b>我的账户</b></span>
            <ul <?php  if($first_class == "3"){ echo 'style="display:block;"';}?>>
                <li><a href="<?php echo U('Company/toBePaid');?>"><em <?php  if($second_class == "7"){ echo 'class="hre"';}?>>待付账单</em></a></li>
                <li><a href="<?php echo U('Company/paymentRecords');?>"><em <?php  if($second_class == "8"){ echo 'class="hre"';}?>>付款记录</em></a></li>
                <li><a href="<?php echo U('Company/nyMessage');?>"><em <?php  if($second_class == "9"){ echo 'class="hre"';}?>>我的消息</em></a></li>
            </ul>
        </li>
        <li class="btn"><span><i><img src="/Public/img/pd_icon5.png" alt=""></i><b><a href="javascript:;" class="sendJob"><em >发布职位</em></a></b></li>
    </ul>
   <div class="footer">
        <h3>服务热线</h3>
        <p>4006-685-596</p>
        <p>010-57188076</p>
        <p>010-57230694</p>
    </div>
</div>
<script>
    $(function() {
        $(".sendJob").click(function() {
            $.post("/index.php?s=/Home/Company/getuserinfos", {
            }, function(data) {

                if (data.code == 200) {
                    location.href = "/Home/Company/companySendJob.html";
                    return false;
                } else {
                    var url = "/Home/Company/";
                    sys_window(data.msg,url+data.url+".html");
                }
            }, "json")
        });
    })
</script>
    <div class="popup_ft reward" id="sys_window">
    <h3>温馨提示</h3>
    <a class="close cur_point"></a>
    <dl>
        <dt id="sys_content">恭喜您！</dt>
        <dd><input type="hidden" id="locationHref"><button id="comWind" class="cur_point">确认</button></dd>
    </dl>
</div>

<div class="RightFixed">
    <ul class="Right"  style="background:#283645">
        <li class="dt"><img src="/Public/img/rightTop.png" alt=""></li>
     <!--   <li><a href="http://www.hudong.com" target="_Blank"><img src="/Public/img/icon1.1.png" alt="百科"></a></li>
        <li><a href="http://www.gfxiong.com/" target="_Blank"><img src="/Public/img/gfx_logo1.png" alt="51社保"></a></li> -->
     <li><a href="http://www.meililai.com" target="_Blank"><img src="/Public/img/mll.png" alt="美丽来" title="美丽来"></a></li>
     <li><a href="http://www.kaomanfen.com" target="_Blank"><img src="/Public/img/kmf.png" alt="盈禾优仕" title="盈禾优仕"></a></li>
     <li><a href="http://www.easywed.cn" target="_Blank"><img src="/Public/img/yijie.png" alt="易结网" title="易结网"></a></li>
     <li><a href="http://www.loveoeye.com" target="_Blank"><img src="/Public/img/ysy.png" alt="云视野" title="云视野"></a></li>


      
  <!--      <li><a href="http://www.51shebao.com/" target="_Blank"><img src="/Public/img/51_2.png" alt="51社保"></a></li>
        <li><a href="http://www.idachu.cn/" target="_Blank"><img src="/Public/img/adc.png" alt="爱大厨"></a></li> -->
    </ul>
    <ul class="btm">
        <li style="margin-bottom:20px;">
            <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=1158321049&amp;site=qq&amp;menu=yes" target="_blank" title="欢迎登录人人猎网--人人都是猎头"><img src="/Public/img/icon1.2.png" alt=""></a>
        </li>
        <li class="hddb"><img src="/Public/img/icon1.1.3.png" alt="">
            <span class="myspan"></span>
        </li>
    </ul>
</div>

    <div class="center">
        <head>
    <link rel="icon" href="/Public/img/favicon.ico" type="image/ico">
</head>

<div class="centerCon1">
    <ul class="left" id="navTop">
        <li <?php if($cur == index): ?>class="cenTop"<?php endif; ?>><a href="<?php echo U('Index/index');?>">首页</a></li>
        <li <?php if($cur == search): ?>class="cenTop"<?php endif; ?>><a href="<?php echo U('Index/search');?>">职位</a></li>
        <li <?php if($cur == anli): ?>class="cenTop"<?php endif; ?>><a href="<?php echo U('Index/anli');?>">成功案例</a></li>
    </ul>

    <ul class="right">
        <?php if(empty($_SESSION['username']) && empty($_SESSION['cusername'])){ ?>
        <li class="firstLi2"><a class="dengluBtn">登录</a></li>
        <li><a id="zhuce" class="zhuce1">注册</a></li>
        <?php }else { $username = ($_SESSION['username']?$_SESSION['username']:$_SESSION['cusername']); if(strlen($username)=="31" && substr($username,0,3) == "wx_"){ $username = "微信用户"; } if(substr($username,0,3) == "qq_"){ $username = $_COOKIE[$username]; } ?>
        <ul class="xiala clearfix" >
            <li class="select first_l"><span><img src="/Public/img/icon_tx.png"></span><em><?php echo ($username); ?></em></li>
            <ul class="vio  clearfix" style="display:none">
                <div class="clearfix">
                    <li class="i_1"><a href="<?php echo ($data['url']); ?>">用户中心</a></li>
                    <li class="i_3"><a href="<?php echo ($data['savepass']); ?>">修改密码</a></li>
                    <li class="i_2"><a href="<?php echo ($data['logout']); ?>">退出账户</a></li>
                </div>

            </ul>
        </ul>
        <?php } ?>
    </ul>
</div>

        <div class="PersData">
            <div class="recom1 data recom2">
                <div class="recom1_tp">
                    <h3>推荐记录</h3>
                    <p class="ts"><em>招聘职位：</em><?php echo ($jobInfo['title']); ?>　　招聘资费：<?php echo ($jobInfo['Tariff']); ?> 元</p>
                    <div class="tab tck">
                        <table  border="1" class="tdclick">
                            <tr class="zzzp">
                                <th>序号</th>
                                <th>被推荐人</th>
                                <th>推荐人</th>
                                <th>在职状态</th>
                                <th>可面试时间</th>
                                <th>面试状态</th>
                                <th>付款信息</th>
                                <th>操作</th>
                            </tr>
                            <?php if(is_array($arRecordList['list'])): $i = 0; $__LIST__ = $arRecordList['list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$arRecordInfo): $mod = ($i % 2 );++$i;?><tr class="bg">
                                    <td><?php echo ($arRecordInfo['sort_id']); ?></td>
                                    <?php if($isViewReuse == 1): ?><td><a href="/index.php?s=/Home/Company/viewResume/id/<?php echo ($arRecordInfo['id']); ?>/jid/<?php echo ($arRecordInfo['j_id']); ?>/btid/<?php echo ($arRecordInfo['bt_id']); ?>.html"><?php echo ($arRecordInfo['btName']); ?></a></td><?php endif; ?>
                                    <?php if($isViewReuse == 0): ?><td><?php echo ($arRecordInfo['btName']); ?></td><?php endif; ?>
                                    <td><?php echo ($arRecordInfo['tName']); ?></td>
                                    <td><?php echo ($arRecordInfo['stage']); ?></td>
                                    <td><?php echo ($arRecordInfo['audstartdate']); ?></td>
                                    <td>

                                        <select style='width:85px' <?php if($arRecordInfo['audstart_status'] == 6): ?>disabled<?php endif; ?> onchange="changeAudreasonList('<?php echo ($arRecordInfo[audstart]); ?>',$(this).val(), <?php echo ($arRecordInfo['id']); ?>,<?php echo ($arRecordInfo['audstart_status']); ?>)">
                                            <?php if(is_array($arAudreasonList)): $i = 0; $__LIST__ = $arAudreasonList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$arAudreasonInfo): $mod = ($i % 2 );++$i;?><option value='<?php echo ($arAudreasonInfo[datavalue]); ?>' <?php if($arAudreasonInfo[dataname] == $arRecordInfo['audstart']): ?>selected="selected"<?php endif; ?>><?php echo ($arAudreasonInfo[dataname]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>

                                    </td>
                                    <td><?php echo ($arRecordInfo['sink']); ?></td>
                                    <td class="fsdx" btname="<?php echo ($arRecordInfo['btName']); ?>" mobile="<?php echo ($arRecordInfo['mobile']); ?>" jl_id=""><span class="sp2"><img src="/Public/img/xf.png" alt="" title="面试通知"></span></td>
                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </table>


                    </div>
                    <?php echo ($arRecordList["page"]); ?>

                </div>


            </div>
        </div>
        <div class="footer clearfix">
	<ul class="clearfix" style="width:610px;">
		<li><a href="<?php echo U('Index/sutuijian');?>">关于我们</a></li>
		<li><a href="<?php echo U('Index/tjrxy');?>">用户协议</a></li>
		<li><a href="<?php echo U('Index/yhys');?>">用户隐私</a></li>
		<li><a href="<?php echo U('Index/lxwm');?>">联系我们</a></li>
		<li class="last"><a href="<?php echo U('Index/joinus');?>">加入我们</a></li>
		<p style="float:left;width:210px;">人人猎 京ICP备14040265号-1 &nbsp;&nbsp;&nbsp;&nbsp;<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1254515209'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1254515209%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>
</p>
	</ul>
        <?php if(empty($linkArr)){ ?>
            <ul class="clearfix links">
                    <li style="color:#707e8c">友情链接：</li>
                    <li><a href="http://www.e3job.com/" target="_Blank">E商人才网</a>&nbsp&nbsp&nbsp|</li>
                    <li><a href="http://www.0579job.com/" target="_Blank">千里马人才网</a>&nbsp&nbsp&nbsp|</li>
                    <li><a href="http://www.1epoch.com/" target="_Blank">青岛logo设计</a>&nbsp&nbsp&nbsp|</li>
                    <li><a href="http://www.qidong.zp300.cn/" target="_Blank">启东人才网</a>&nbsp&nbsp&nbsp|</li>
                    <li><a href="http://bj.yi.xbaixing.com" target="_Blank">北京一站通</a>&nbsp&nbsp&nbsp|</li>
                    <li><a href="http://zhengyun.cc/" target="_Blank">郑云工作室</a></li>
            </ul>
            <ul class="clearfix links">
                    <li style="color:#707e8c">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</li>
                    <li><a href="http://www.5niubi.com/" target="_Blank">一折网</a>&nbsp&nbsp&nbsp&nbsp&nbsp|</li>
                    <li><a href="http://www.jdaaa.com/" target="_Blank">京东精选</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp|</li>
                    <li><a href="http://www.bcty365.com " target="_Blank">B5教程网</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp|</li>
                    <li><a href="http://www.shsixun.com " target="_Blank">思讯通</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp|</li>
            </ul>
        <?php }else{ ?>
            <ul class="clearfix links">
                     <li style="color:#707e8c;float:left;background:none;text-align:right;padding:5px 0">友情链接：</li>
                     <ul style="float:left;width:620px;padding-top:0">
                    <?php foreach($linkArr as $k=>$v) :$k=$k+1;?>
                    <li <?php if($k>0 && $k%6 == 0):?>class="endline"<?php endif;?>><a href="<?php echo ($v['linkurl']); ?>" target="_blank"><?php echo ($v['webname']); ?></a></li>
                    <?php endforeach;?>
                    </ul>
        <?php } ?>
</div>
    </div>
    <div class="Pop-up" id="sendStatus">
        <input type="hidden" id="del">
        <h3>确定修改此面试人的面试状态吗？</h3>
        <div style="display:none" id="reason"><textarea placeholder="请输入拒绝理由" id="rea"></textarea></div>
        <input type="hidden" id="reasonid">
        <input type="hidden" id="statused">
        <input type="button" class="btnL delconfirm" value="确认" >
        <input type="button" class="btnR qxconfirm" value="取消">
    </div>
    <div class="aa">
    <div class="fiexdCenter">
        <ul class="left" id="navTop">
            <li <?php if($cur == index): ?>class="cenTop"<?php endif; ?>><a  href="<?php echo U('Index/index');?>">首页</a></li>
            <li <?php if($cur == search): ?>class="cenTop"<?php endif; ?>><a   href="<?php echo U('Index/search');?>">职位</a></li>
            <li <?php if($cur == anli): ?>class="cenTop"<?php endif; ?>><a    href="<?php echo U('Index/anli');?>">成功案例</a></li>
        </ul>

        <ul class="right">		
            <?php if(empty($_SESSION['username']) && empty($_SESSION['cusername'])){ $username = $_SESSION['username']; ?>
            <li class="firstLi2"><a class="dengluBtn">登录</a></li>
            <li class="firstLi2"><a id="zhuce" class="zhuce1">注册</a></li>
            <?php }else { $username = ($_SESSION['username']?$_SESSION['username']:$_SESSION['cusername']); if(strlen($username)=="31" && substr($username,0,3) == "wx_") { $username = "微信用户"; } if(substr($username,0,3) == "qq_") { $username = $_COOKIE[$username]; } ?>
            <ul class="xiala2 clearfix" >
                <i></i>
                <li class="select2 first_l"><span><img src="/Public/img/icon_tx.png"></span><em><?php echo ($username); ?></em></li>
                <ul class="vio2  clearfix" style="display:none">
                    <div class="clearfix">
                        <li class="i_1"><a href="<?php echo ($data['url']); ?>">用户中心</a></li>
                        <li class="i_3"><a href="<?php echo ($data['savepass']); ?>">修改密码</a></li>
                        <li class="i_2"><a href="<?php echo ($data['logout']); ?>">退出账户</a></li>
                    </div>
                </ul>

            </ul>
            <?php } ?>
        </ul>

    </div>
</div>
</body>
<script type="text/javascript">

    function changeAudreasonList(tex, audreason, rid, audstart) {

        // 1 未审核 2 不面试 3 面试预约 4 面试不通过 5面试通过 6 已入职 7 已离职 8审核不通过
        if (audstart == 3 && (audreason == 1 || audreason == 2)) {
            sys_window("此人已经面试预约，不能为" + tex + "状态");
            return false;
        }
        if (audstart == 5 && (audreason == 1 || audreason == 2 || audreason == 3 || audreason == 4)) {
            sys_window("此人已经面试通过，不能为" + tex + "状态");
            return false;
        }
        if (audreason == 2 || audreason == 4 || audreason == 7) {

            $("#reason").show();
        } else {
            $("#reason").hide();
        }

        $("#reasonid").val(rid);
        $("#statused").val(audreason);
        $(".mask").show();
        $("#sendStatus").show();
    }
    $(".delconfirm").click(function() {
        var reasonid = $("#reasonid").val();
        var statused = $("#statused").val();
        var content = $("#rea").val();
        if (statused == 2 || statused == 4 || statused == 7) {
            if (!content) {
                sys_window("请选择拒绝理由！");
                return false;
            }
        }
        $.post("/Home/Company/updateUserStatus.html", {
            'reasonid': reasonid,
            'statused': statused,
            'content': content
        }, function(data) {
            window.location.reload();
        }, "json")
    });

    $(".qxconfirm").click(function() {
        $(".mask").hide();
        $("#sendStatus").hide();
    });

    $(document).ready(function() {
        $('.fsdx').on('click', function() {
            $("#bt_name").val($(this).attr("btname"));
            $("#mobile").val($(this).attr("mobile"));
            $('.mask').show();
            $('.dx_page').slideDown();
        });
        $(".fs").click(function() {
            var bt_name = $("#bt_name").val();
            var mobile = $("#mobile").val();
            var msdate = $("#msdate").val();
            var gs = $("#gs").val();
            var address = $("#address").val();
            var lx = $("#lx").val();
            var lxr = $("#lxr").val();
            var hm = $("#hm").val();
            if (!mobile) {
                sys_window("面试人没有留手机号码,您可以查看是否有邮箱填写或者联系我们的工作人员！");
                return false;
            }
            if (!bt_name || bt_name == "XXXX") {
                sys_window("面试人不能为空");
                return false;
            }

            if (!msdate || msdate == "XXXX") {
                sys_window("面试时间不能为空！");
                return false;
            }
            if (!address) {
                sys_window("公司地点不能为空！");
                return false;
            }
            var msgContent = "亲爱的" + bt_name + "同学，我们诚挚邀请你" + msdate + "和我们面试，公司地点" + address;
            if (lx != "XXXX" && !lx) {
                msgContent += "乘车路线" + lx;
            }
            if (lxr != "XXXX" && !lxr) {
                msgContent += "，联系人" + lxr;
            }

            if (hm != "XXXX" || !hm) {
                msgContent += "，联系号码" + hm;
            }
            msgContent += "。请勿迟到。";
            $.post("/Home/Company/sendMessage.html", {
                'msgcontent': msgContent,
                'mobile': mobile
            }, function(data) {
                if (data.code == "200") {
                    sys_window("发送成功!");
                    $('.mask').hide();
                    $('.dx_page').hide();
                } else {

                    sys_window(data.msg);
                }
            }, "json")
        });
        $('.qx').on('click', function() {
            $('.mask').hide();
            $('.dx_page').slideUp();
        });

        /*$('.fsdx').on('click',function(){
         $('.mask').show();
         $('.dx_page').show();
         })*/

        $('.fsdx').on('mouseenter', function() {
            $(this).css({'cursor': 'pointer'});
        })
    })


</script>
</html>