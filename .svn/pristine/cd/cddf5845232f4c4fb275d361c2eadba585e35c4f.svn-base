<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎</title>
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/focuspic.js"></script>
        <script type="text/javascript" src="/Public/js/menu_v.js"></script>
        <script type="text/javascript" src="/Public/js/script.js"></script>
        <script type="text/javascript" src="/Public/js/index.js"></script>
        <script type="text/javascript" src="/Public/js/jquery.form.js"></script> 
        <script type="text/javascript" src="/Public/js/company.js"></script> 
        <script type="text/javascript" src="/Public/js/jqueryupload.js"></script> 
        <link rel="icon" href="/Public/img/favicon.ico" type="image/ico">
        <link rel="stylesheet" type="text/css" href="/Public/css/resizer.css">
        <link rel="stylesheet" href="/Public/css/focuspic.css" />
        <link rel="stylesheet" href="/Public/css/menu_v.css" />
        <link rel="stylesheet" type="text/css" href="/Public/css/style.css">
        <script type="text/javascript" src="/Public/js/jquery.ui.js"></script>
        <script type="text/javascript" src="/Public/js/index.js"></script>
        <link rel="stylesheet" href="/Public/css/smoothness/jquery.ui.css" type="text/css" />
        <link rel="stylesheet" type="text/css" href="/Public/css/uploadify.css">
        <script type="text/javascript" charset="utf-8" src="/Public/js/jquery.uploadify-3.1.js"></script>
    </head>
    <body>
        <!-- 遮罩层 -->
        <div class="mask" id="mask"></div>
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
            <div class="cn cn1 Infor EnterInfor Ent1" <?php  if($sIsNewCompay == "2"){ echo 'style="display:none;"';}?>>
                 <form action="<?php echo U('Company/saveCompanyBaseInfo');?>" id="submitBaseInfo"  name= "submitBaseInfo" method = 'post'   onsubmit = "return checkCompanyBaseInfo();" enctype="multipart/form-data">
                    <div class="cn_tp">
                        <h3>基本信息</h3>
                        <dl class="clearfix">
                            <dt>
                            <ul>
                                <li><em>公司名称 : </em><span><input type="text" id="cpname" name="cpname" ></span></li>
                                <?php if(is_array($arConfigInfo)): $i = 0; $__LIST__ = $arConfigInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$arConfig): $mod = ($i % 2 );++$i;?><li><em><?php echo ($arConfig['groupname']); ?> : </em>
                                        <select id="<?php echo ($arConfig['groupsign']); ?>" name="<?php echo ($arConfig['groupsign']); ?>">
                                            <option value="请选择">请选择</option>
                                            <?php if(is_array($arConfig['config_list'])): $i = 0; $__LIST__ = $arConfig['config_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$arConfigList): $mod = ($i % 2 );++$i;?><option value="<?php echo ($arConfigList['datavalue']); ?>" ><?php echo ($arConfigList['dataname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>    
                                        </select>
                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                <li><em>成立日期 : </em><input type="text" name="date" readonly="readonly" class="text" id="date" /></li>
                                <li><em>公司网址 : </em><span><input type="text" id="webname" name="webname" ></span></li>
                                <li class="lasty zhizhao">上传营业执照</li><a href='/Public/人人猎招聘方-合同.docx'><b id="fanben" style="position: relative;left: 214px; font-weight: normal;top: 8px;color: #2380b8;cursor: pointer;">(下载合同范本)</b></a>
                                <input type='hidden' value='1' id='lupdateNUm'>
                                <input type='hidden'  id='lUrl' name="licence" value='<?php echo ($arCompanyInfo[licence]); ?>'>
                                <script type="text/javascript">
                                    var img_id_upload = new Array();//初始化数组，存储已经上传的图片名
                                    var i = 0;//初始化数组下标
                                    var uploadLimit = 1;
                                    var buttonName1 = "<?php if($resumeInfo[updateFile]){ echo '重新上传简历';}else{echo '上传营业执照';}?>";
                                    $(function() {
                                        $('#file_upload').uploadify({
                                            'auto': true, //关闭自动上传
                                            'removeTimeout': 600, //文件队列上传完成1秒后删除
                                            'swf': '/Public/css/uploadify.swf',
                                            'uploader': '/Home/Index/uploadifyLicence.html',
                                            'method': 'post', //方法，服务端可以用$_POST数组获取数据
                                            'buttonText': buttonName1, //设置按钮文本
                                            'multi': true, //允许同时上传多张图片
                                            'uploadLimit': uploadLimit, //一次最多只允许上传10张图片
                                            'fileTypeDesc': '请选择 JPG,PNF,PDF文件', //只允许上传图像
                                            'fileTypeExts': '*.PNG;*.png;*.JPG; *.jpg; *.pdf;*.PDF;*.JPEG;*.jpeg', //限制允许上传的图片后缀
                                            'fileSizeLimit': '10MB', //限制上传的图片大小
                                            'onUploadSuccess': function(file, data, response) { //每次成功上传后执行的回调函数，从服务端返回数据到前端

                                                if (data == "no") {
                                                    $("#lupdateNUm").val(parseInt($("#lupdateNUm").val()) + 1);
                                                    var uploadLimit = $("#lupdateNUm").val();
                                                    //在这此处处理...
                                                    //通过uploadify的settings方式重置上传限制数量
                                                    $('#file_upload').uploadify('settings', 'uploadLimit', uploadLimit);
                                                } else {
                                                    $("#lUrl").val(data);
                                                    $(".Close4").hide();
                                                    $("#secord").hide();
                                                    $("#secord2 ").show();
                                                }

                                            }
                                        });
                                    });
                                </script>


                                <div id='ldiv' >
                                    <li style="margin-top:-15px;"><em>公司合同 : </em></li>
                                    <input type='hidden'  id='contract' name="contract" value='<?php echo ($arCompanyInfo[contract]); ?>'>
                                    <script type="text/javascript">
                                        var img_id_upload = new Array();//初始化数组，存储已经上传的图片名
                                        var i = 0;//初始化数组下标
                                        var uploadLimit = 1;
                                        var buttonName = "<?php if($resumeInfo[updateFile]){ echo '上传公司合同';}else{echo '上传公司合同';}?>";
                                        $(function() {
                                            $('#file_upload2').uploadify({
                                                'auto': true, //关闭自动上传
                                                'removeTimeout': 600, //文件队列上传完成1秒后删除
                                                'swf': '/Public/css/uploadify.swf',
                                                'uploader': '/Home/Index/uploadifyLicence.html',
                                                'method': 'post', //方法，服务端可以用$_POST数组获取数据
                                                'buttonText': buttonName, //设置按钮文本
                                                'multi': true, //允许同时上传多张图片
                                                'uploadLimit': uploadLimit, //一次最多只允许上传10张图片
                                                'fileTypeDesc': '请选择 zip文件', //只允许上传图像
                                                'fileTypeExts': '*.zip', //限制允许上传的图片后缀
                                                'fileSizeLimit': '10MB', //限制上传的图片大小
                                                'onUploadSuccess': function(file, data, response) { //每次成功上传后执行的回调函数，从服务端返回数据到前端
                                                    if (data == "no") {
                                                        $("#lupdateNUm").val(parseInt($("#lupdateNUm").val()) + 1);
                                                        var uploadLimit = $("#lupdateNUm").val();
                                                        //在这此处处理...
                                                        //通过uploadify的settings方式重置上传限制数量
                                                        $('#file_upload').uploadify('settings', 'uploadLimit', uploadLimit);
                                                    } else {
                                                        $("#contract").val(data);
                                                        $(".Close4").hide();
                                                        $("#thrih").hide();
                                                        $("#thrih2 ").show();
                                                    }
                                                }
                                            });
                                        });
                                    </script>
                                    <p style="margin-left: 82px;">(签订合同以后，才可以发布职位，招不到人不收费。)</p>
                                </div>
                                <li class="lasty hetong" style="position: relative;top: -48px;left: 0px;">上传合同</li>

                                <li class="clearfix" style="height:120px;display: none" id='ldiv2'>
                                    <em style="width:77px;float:left;display:block;height:10px">营业执照 : </em>
                                    <span style="width:118px;height:94px;display:block;border:1px #cccccc solid;float:left;border-radius:5px" ><img id='lisrc' style='width:100%;height:100%' src='<?php echo ($arCompanyInfo[licence]); ?>'></span>
                                    <b style="padding-top: 71px;display: block;float:left;font-weight: normal;">(营业执照审核通过后不可更改。)</b>
                                </li>

                                <li class="clearfix" style="height:120px;display: none" id='ldiv3'>
                                    <em style="width:77px;float:left;display:block;height:10px">网站合同 : </em>
                                    <span style="display:block;float:left;border-radius:5px"><a id="cisrc" href="<?php echo ($arCompanyInfo[contract]); ?>">我的合同</a> <b style="display: block; font-weight: normal;" id="hetongworing">(合同审核通过后不可更改。)</b></span>
                                   
                                </li>
                                <li><p class="error2" style="margin-left:10px;display: none" >sdf </p></li>

                            </ul>
                            </dt>
                            <dd>

                                <!--  <input class="EntLogo" type="file" id="comlogo" name="comlogo">> -->
                                <span>支持:JPG,PNG,GIF,大小不超过1M</span>
                                <div id="preview" style="height:100%;width: 100%;padding: 0px;display: none">   
                                    <img id="imghead"  width=100% height=100% border=0 src='<?php echo ($arCompanyInfo[comlogo]); ?>'>   
                                </div>   
                                <input type="file" class="EntLogo"  name="comlogo" onchange="previewImage(this)" />     
                            </dd>
                        </dl>
                    </div>
                    <div class="cn_btm">
                        <input class="Enterbc cur_point" type="submit" value="保存">
                    </div>
                    <input type="hidden" id="isnew" value="yes" name="isnew">
                </form>
            </div>
            <div class="cn cn1 Infor EnterInfor Ent2" <?php  if($sIsNewCompay == "1"){ echo 'style="display:none;"';}?> >
                 <div class="cn_tp">
                    <h3>基本信息</h3>
                    <dl class="clearfix">
                        <dt>
                        <ul>
                            <li><em>公司名称: </em><span id="cpnamed"><?php echo ($arCompanyInfo['cpname']); ?></span></li>
                            <li><em>公司性质: </em><span id="naturedata"><?php echo ($arCompanyInfo['naturedata']); ?></span></li>
                            <li><em>公司规模: </em><span id="scaledata"><?php echo ($arCompanyInfo['scaledata']); ?></span></li>
                            <li><em>公司阶段: </em><span id="stagedata"><?php echo ($arCompanyInfo['stagedata']); ?></span></li>
                            <li><em>成立日期: </em><span id="brightregdata"><?php echo ($arCompanyInfo['brightregdata']); ?></span></li>
                            <li><em>公司网址: </em><span id="webnamedata"><?php echo ($arCompanyInfo['webname']); ?></span></li>

                            
                            <li class="clearfix" style="height:120px;line-height:21px;<?php if(!$arCompanyInfo['licence'])echo 'display:none';?>" id="l1">
                                <em style="width:77px;float:left;display:block;height:10px">营业执照:</em>
                                <span style="width:118px;height:94px;display:block;border:1px #cccccc solid;float:left;border-radius:5px">
                                    <img src='<?php echo $arCompanyInfo[licence];?>' style="width:118px;height:94px;"/>
                                </span>
                                <b style="padding-top: 71px;display: block;float:left;font-weight: normal;"></b>
                                <b><span style="font-weight:bold;">注：</span><br/>点击修改按钮可重新上传营业执照；营业执照审核通过后不可再改。</b>
                            </li>
                            <li class="clearfix" <?php if($arCompanyInfo['licence'])echo "style='display:none'";?>  id="l2">
                                <em style="width:77px;float:left;display:block;height:10px">营业执照:</em>
                                未上传
                            </li>


                          
                            <li class="clearfix" style="height:120px;line-height:21px;<?php if(!$arCompanyInfo['contract'])echo 'display:none';?>" id="l3">
                                <em style="width:77px;float:left;display:inline-block;height:20px">网站合同:</em>
                                <span style="display:inline-block;float:left;border-radius:5px;width:330px;">
                                    <a style="display:inline-block;float:left;" href='<?php echo $arCompanyInfo[contract];?>'  id="yhetong"/> 我的合同</a>
                                <b style="display:inline-block;float:left;width:220px;font-size:12px;margin-left:10px;"><span style="font-weight:bold;">注：</span><br/>点击修改按钮可重新上传合同；合同审核通过后不可再改。</b>
                                </span>
                               
                                  </li>
                              
                            <li class="clearfix" <?php if($arCompanyInfo['contract'])echo "style='display:none'";?>  id="l4">
                                <em style="width:77px;float:left;display:block;height:10px">网站合同:</em>
                                未上传
                                  </li>
                          

                          

                        </ul>
                        </dt>
                        <dd>
                            <span>支持:JPG,PNG,GIF,大小不超过1M</span>
                            <img src="<?php echo ($arCompanyInfo['comlogo']); ?>" alt="公司logo" id="loginfoss">
                        </dd>
                    </dl>
                </div>
                <div class="cn_btm">
                    <input class="Enterxg cur_point" type="button" value="修改">
                </div>
            </div>
        </div>
        <input type="hidden" id="username" value="<?php echo ($arCompanyInfo[username]); ?>">

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
    <div class="scjl_tc scjl_tc2">
        <h3>上传营业执照</h3>
        <a class="Close4"></a>
        <div style="display:block" id='secord'>
            <div class="button_sc">
                <span>选择上传营业执照</span>
                <input type="file" name="file_upload" id="file_upload" class="sc_jl"/>
            </div>
            <div class="wjgs" style="margin-top:67px;">

                支持JPG、PNG、JPEG、PDF格式文件<br>文件大小需小于10M
            </div>
        </div>
        <div class="jlsc_cg" style="display:none" id='secord2'>
            <h4>营业执照上传成功</h4>
            <p></p>
            <button>确定</button>
        </div>
    </div>

    <div class="scjl_tc scjl_tc3">
        <h3>上传合同</h3>
        <a class="Close4"></a>
        <div style="display:block" id="thrih">
            <div class="button_sc">
                <span>选择上传合同</span>
                <input type="file" name="file_upload2" id="file_upload2" class="sc_jl"/>
            </div>
            <div class="wjgs" style="margin-top:67px;">
                请把扫描文件压缩至zip后上传<br>文件大小需小于10M
            </div>
        </div>
        <div class="jlsc_cg" style="display:none" id="thrih2">
            <h4>合同上传成功</h4>
            <p></p>
            <button>确定</button>
        </div>
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
    <script type="text/javascript">

        $(function() {
            $("#secord2 button").click(function() {
                // $("#fanben").hide()
                $(".scjl_tc2").slideUp();
                $(".zhizhao").hide();
                $(".mask").hide();
                //  $("#ldiv").hide()
                $("#lisrc").attr("src", $("#lUrl").val());
                $("#ldiv2").show();
            });
            $("#thrih2 button").click(function() {
                $(".hetong").hide();
                $("#fanben").hide()
                $(".scjl_tc3").slideUp();
               // $(".zhizhao").hide();
                $(".mask").hide();
                $("#ldiv").hide()
                $("#cisrc").attr("href", $("#contract").val());
                $("#hetongworing").hide();
                $("#ldiv3").show();
            });
        })

        $('.EntLogo').on('mouseenter',function(){
            $('.PersData .cn1 .cn_tp dl dd span').show();
        });

        $('.EntLogo').on('mouseleave',function(){
            $('.PersData .cn1 .cn_tp dl dd span').hide();
        });
        $('.PersData .cn1 .cn_tp dl dd').on('mouseenter',function(){
            $('.PersData .cn1 .cn_tp dl dd span').show();
        })
        $('.PersData .cn1 .cn_tp dl dd').on('mouseleave',function(){
            $('.PersData .cn1 .cn_tp dl dd span').hide();
        })
        $('.zhizhao').on('click', function() {
            $('.scjl_tc2').slideDown();
            $('.mask').show();
        })
        $('.hetong').on('click', function() {
            $('.scjl_tc3').slideDown();
            $('.mask').show();
        })
        //图片上传预览    IE是用了滤镜。   
        function previewImage(file)
        {
            var MAXWIDTH = "100%";
            var MAXHEIGHT = "100%";
            var div = document.getElementById('preview');
            if (file.files && file.files[0])
            {
                div.innerHTML = '<img id=imghead>';
                var img = document.getElementById('imghead');
                img.onload = function() {
                    var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
                    img.width = rect.width;
                    img.height = rect.height;
                    //                 img.style.marginLeft = rect.left+'px';   
                    img.style.marginTop = rect.top + 'px';
                }
                var reader = new FileReader();
                reader.onload = function(evt) {
                    img.src = evt.target.result;
                }
                reader.readAsDataURL(file.files[0]);
            }
            else //兼容IE   
            {
                var sFilter = 'filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
                file.select();
                var src = document.selection.createRange().text;
                div.innerHTML = '<img id=imghead>';
                var img = document.getElementById('imghead');
                img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
                var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
                status = ('rect:' + rect.top + ',' + rect.left + ',' + rect.width + ',' + rect.height);
                div.innerHTML = "<div id=divhead style='width:" + rect.width + "px;height:" + rect.height + "px;margin-top:" + rect.top + "px;" + sFilter + src + "\"'></div>";
            }
            $("#preview").show();
        }
        function clacImgZoomParam(maxWidth, maxHeight, width, height) {
            var param = {top: 0, left: 0, width: width, height: height};
            if (width > maxWidth || height > maxHeight)
            {
                rateWidth = width / maxWidth;
                rateHeight = height / maxHeight;

                if (rateWidth > rateHeight)
                {
                    param.width = maxWidth;
                    param.height = Math.round(height / rateWidth);
                } else
                {
                    param.width = Math.round(width / rateHeight);
                    param.height = maxHeight;
                }
            }

            param.left = Math.round((maxWidth - param.width) / 2);
            param.top = Math.round((maxHeight - param.height) / 2);
            return param;
        }
    </script>
</body>

</html>