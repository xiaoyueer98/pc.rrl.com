<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>登录</title>
        <script type="text/javascript" src="/Public/js/webchat/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/webchat/iscroll.js"></script>
        <script type="text/javascript" src="/Public/js/webchat/wechat.js"></script>
        <link rel="stylesheet"  href="/Public/css/webchat/reset.css">
        <link rel="stylesheet"  href="/Public/css/webchat/wechat.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <script>
            window.onload = function () {
                var lend = new IScroll('.lend', {mouseWheel: true, click: true});
            }
        </script>
    </head>
    <body>
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
    <section id="wamp" class="lend">
        <div class="lend_scroll">
            <div class="logo"><img src="/Public/images/webchat/we_logo.png" alt=""></div>
            <div class="ms">
                <ul>
                    <li><input class="username lebd_tx" type="text" placeholder="请输入用户名/手机号"  name="username"/> </li>
                    <li><input class="password lebd_tx" type="password" placeholder="请输入密码" name="password"/></li>
                    <input type='hidden' value='<?php echo ($gourl); ?>' name='gourl'>
                    <li style="margin-bottom:10px;"><span id="span2" style='color:#fff;'>忘记密码</span><span  id="span1" style='color:#fff;'>免费注册</span></li>
                    <li><b class="lebd_tx2" id="loginbtn">登&nbsp录</b><li>
                    <li><b class="lebd_tx2" id="loginbtn1" style="display:none;">登&nbsp录</b><li>
                </ul>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="/Public/js/jquery.js"></script>
    <script type="text/javascript">

            $("#span1").click(function () {
                location.href = '/Home/Webchatreg/reg';
            })
            $("#span2").click(function () {
                location.href = '/Home/Webchatreg/forget_password';
            })
            var error = "";
            function  checkIsEmpty(name, tip) {

                var val = $("[name='" + name + "']").val();
                if (val == "") {
                    error += tip + "不能为空\n";
                    return false;
                } else {
                    return true;
                }

            }
            function  checkIsLawful(name, tip) {

                var val = $("[name='" + name + "']").val();
                if (val == "") {
                    error += tip + "不能为空\n";
                    return false;
                } else {
                    return true;
                }

            }
            $("#loginbtn").click(function () {
                $("#loginbtn1").css("display", "block");
                $("#loginbtn").css("display", "none");

                var re1 = checkIsEmpty('username', "用户名");
                var re2 = checkIsEmpty('password', "密码");
                var username = $("[name='username']").val();
                
                var type = 1;  //定义一个登陆类型1用户名2手机号
                if (/^((13[0-9])|147|(15[0-35-9])|180|182|(18[5-9]))[0-9]{8}$/.test(username)) {
                    type = 2;
                }

                var password = $("[name='password']").val();
                if (re1 && re2) {
                    var url = $("[name='gourl']").val();
                    $.ajax({
                        type: "post",
                        data: {"username": username, "password": password,"type":type},
                        url: "/Home/Webchatlogin/judge_login",
                        dataType: "json",
                        success: function (data)
                        {       //alert(data.code);
                            if (data.code == "200")
                            {
                                location.href = url;
                            }
                            else if (data.code == "500")
                            {
                                $("#loginbtn1").css("display", "none");
                                $("#loginbtn").css("display", "block");
                                like_alert(data.msg);
                                error = "";
                                return;
                            } else {
                                $("#loginbtn1").css("display", "none");
                                $("#loginbtn").css("display", "block");
                                like_alert("登陆异常");
                                error = "";
                                return;
                            }
                        }

                    })
                } else {

                    $("#loginbtn1").css("display", "none");
                    $("#loginbtn").css("display", "block");
                    like_alert(error);
                    error = "";
                    return;
                }
            })
    </script>
    <include file="Webchat:statistics">
</body>
</html>