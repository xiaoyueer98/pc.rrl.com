<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>忘记密码</title>
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
                        <li><span>手机号</span></li>
                        <li><input class="txt" type="text" id="mobile"></li>
                        <li style="position:relative;height:35px;"><button class="btn_yz" id="getcode">获取验证码</button></li>
                        <li><span>输入验证码</span></li>
                        <li><input class="txt" type="text" id="verify"></li>
                        <li><button class="btn_zh" id="fpwd_btn">下一步</button></li>
                    </ul>
                </div>
            </div>
        </section>

        <footer></footer>
    </div>
    <include file="Webchat:statistics">
    <script type="text/javascript">
        
        var wait = 60;
        $("#getcode").disabled = false;
        function time(o) {
            
            if (wait == 0) {
                o.innerHTML ="获取验证码";
                o.removeAttribute("disabled",false);
                $('#getcode').css("background","#206daf");
                wait = 60;
            } else {
                o.setAttribute("disabled",true);
                o.innerHTML = "(" + wait + ")重新发送";
                wait--;
                setTimeout(function () {
                    time(o)
                },
                        1000)
            }
        }
        $('#getcode').click(function () {
            this.disabled = true;
            $('#getcode').css("background","#b4b4b4");
            var o = this;
            //alert(this.innerHTML)
            //alert(this[0].setAttribute("disabled",true));
            if (!/^[0-9]{11}$/.test($('#mobile').val()) || $('#mobile').val() == '') {
                this.disabled = false;
                $('#getcode').css("background","#206daf");
                like_alert("手机号不符合规则");
                return;
            } else {

                
                var mobile = $("#mobile").val();
                var hash = "<?php $_SESSION['cookie']=time();echo md5('rrl_'.$_SESSION['cookie']);?>";
                $.post("/Home/Webchatreg/forget_mobile", {
                    'mobile': mobile,
                    'type':'1',
                    'hash':hash
                }, function (data) {
                    if (data.code != "200") {
                        $('#getcode')[0].disabled = false;
                        $('#getcode').css("background","#206daf");
                        like_alert(data.msg);
                        return;
                    }else{ 
                        time(o);
                    }
                }, "json");
            }

        })

        $("#fpwd_btn").click(function () {
            
            $("#fpwd_btn")[0].disabled = true;
            var mobile = $("#mobile").val();
            var verify = $("#verify").val();

            if (!/^[0-9]{11}$/.test($('#mobile').val()) || $('#mobile').val() == '') {
                $("#fpwd_btn")[0].disabled = false;
                like_alert("手机号不符合规则");
            } else if (!verify) {
                $("#fpwd_btn")[0].disabled = false;
                like_alert("请输入验证码!");
                return;
            } else {
                
                $.post("/Home/Webchatreg/checkVerify", {
                    'verify': verify,
                    'mobile': mobile,
                    'type': '1'
                }, function (data) {

                    if (data.code != "200") {
                        $("#fpwd_btn")[0].disabled = false;
                        like_alert(data.msg);
                        return;
                    }else{
                        location.href="/Home/Webchatreg/forget_pwd_redirect";
                    }
                }, "json");

            }
        })
    </script>
</body>
</html>