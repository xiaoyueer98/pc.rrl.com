<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>重置密码</title>
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
                                        <li style='line-height:30px;margin-bottom:10px'><span>用户名:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($username); ?></span></li>
					<li><span>输入新密码</span></li>
					<li><input class="txt" type="password" id="password"></li>
					<li><span>确认密码</span></li>
					<li><input class="txt" type="password" id="repassword"></li>
					<li><button class="btn_zh" id="spwd_btn">确认修改</button></li>
				</ul>
			</div>
		</div>
	</section>
	<footer></footer>
</div>
<include file="Webchat:statistics">
    <script type="text/javascript">
    $("#spwd_btn").click(function () {
            $("#spwd_btn")[0].disabled = true;
            var mobile = $("#mobile").val();
            var password = $("#password").val();
            var repassword = $("#repassword").val();

            if (!/^[\@A-Za-z0-9\_]{6,15}$/.test(password) || password == '') {
                $("#spwd_btn")[0].disabled = false;
                like_alert("请输入6-15位字母,数字,下划线!");
                return;
            } else if (password != repassword) {
                $("#spwd_btn")[0].disabled = false;
                like_alert("两次密码不相同!");
                return;
            } else {
                
                $.post("/Home/Webchatreg/password_save", {
                    'mobile': mobile,
                    'password': password
                }, function (data) {

                    if (data.code != "200") {
                        $("#spwd_btn")[0].disabled = false;
                        like_alert(data.msg);
                        return;
                    }else{
                        //alert(data.msg);
                        lo_like_alert("修改密码成功","/Home/Webchatlogin/login");
                        //location.href="/Home/Webchatlogin/login";
                    }
                }, "json");

            }
    })
    </script>
</body>
</html>