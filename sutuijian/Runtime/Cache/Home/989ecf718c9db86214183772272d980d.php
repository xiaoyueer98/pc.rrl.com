<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册</title>
	<script type="text/javascript" src="/Public/js/webchat/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="/Public/js/webchat/iscroll.js"></script>
	<link rel="stylesheet"  href="/Public/css/webchat/reset.css">
	<link rel="stylesheet"  href="/Public/css/webchat/wechat.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <script type="text/javascript">
            document.addEventListener("touchmove", function (e) {
                e.preventDefault();
            }, false);
            $(document).ready(function (e) {
                var myScroll = new IScroll('#wamp', {mouseWheel: true, click: false});
            })
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
<div id="container">
        <!--<header><div class="leftarw">返回</div>忘记密码</header>-->
	<section id="wamp">
		<div class="scroll">
			<div class="center">
				<ul>
                                        <input type="hidden" value="<?php echo ($mobile); ?>" id="mobile">
					<li><span>用户名<label style='font-size:14px;color:#626262;'>(数字、字母、下划线3-16位)</label></span></li>
					<li><input class="txt" type="text" id="username"></li>
					<li><span>密码</span></li>
					<li><input class="txt" type="password" id="password"></li>
                                        <li><span>邀请码<label style='font-size:14px;color:#626262;'>(可选)</label></span></li>
					<li><input class="txt" type="text" id="invitecode"></li>
					<li><button class="btn_zh" id="reg_btn">完成注册</button></li>
				</ul>
			</div>
		</div>
	</section>
	<footer></footer>
</div>
<include file="Webchat:statistics">
    <script type="text/javascript">
    $("#reg_btn").click(function () {

            $("#reg_btn")[0].disabled = true;
            var mobile = $("#mobile").val();
            var password = $("#password").val();
            var username = $("#username").val();
            var invitecode = $("#invitecode").val();
            
            if (!username ||  !/^[a-zA-Z0-9]{1}[a-zA-Z0-9_]{3,16}$/.test(username) || username.indexOf("qq_") === 0 || username.indexOf("sina_") === 0 || username.indexOf("wx_") === 0 || username.indexOf("renren_") === 0) {
                $("#reg_btn")[0].disabled = false;
                like_alert("用户名由3-16位字母、下划线、数字组成!");
                return;
            } else if (!password || !/^[\@A-Za-z0-9\_]{6,15}$/.test(password)) {
                $("#reg_btn")[0].disabled = false;
                like_alert("请输入6-15位字母,数字,下划线!");
                return;
            } else {
                
                $.post("/Home/Webchatreg/reg_save", {
                    'mobile': mobile,
                    'username': username,
                    'password': password,
                    'invitecode': invitecode
                }, function (data) {

                    if (data.code != "200") {
                        $("#reg_btn")[0].disabled = false;
                        like_alert(data.msg);
                        return;
                    }else{
                        lo_like_alert("注册成功","/Home/Webchat/new_job");
                        //location.href="/Home/Redpackagewx/get_code"; //微信端注册领红包活动
                    }
                }, "json");

            }
    })
    </script>
</body>
</html>