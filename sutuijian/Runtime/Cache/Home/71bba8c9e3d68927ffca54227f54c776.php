<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎</title>
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/focuspic.js"></script>
        <script type="text/javascript" src="/Public/js/menu_v.js"></script>
        <script type="text/javascript" src="/Public/js/script.js"></script>
        <script type="text/javascript" src="/Public/js/jquery.form.js"></script> 
        <link rel="stylesheet" type="text/css" href="/Public/css/resizer.css">
        <link rel="stylesheet" href="/Public/css/focuspic.css" />
        <link rel="stylesheet" href="/Public/css/menu_v.css" />
        <link rel="stylesheet" type="text/css" href="/Public/css/style.css">
    </head>
    <body>
        <!-- 遮罩层 -->
        <div class="mask" id="mask"></div>
    
    <div id="" class="denglu yzsj" id="" style="display:none">
	<a class="Close"></a>
	<h4>验证手机</h4>
	<ul class="jcid">
		<li><div id="telephoneCheck">您的手机号码是：</div></li>
		<li><div><input type="button" class="time" value="免费获取验证码" id="getCode"></div></li>
		<li><div><em>验证码：</em><input class="inpu1" type="text" id="code"><i class="error3" style="display:none;">不能为空</i></div></li>
		<li><div><input type="button" class="butonqr" value="确认"></div></li>
	</ul>
</div>
    <div id="conZhuce" class="zhuce">
    <a class="Close"></a>
    <h3></h3>
    <dl>
        <dt>
            <ul class="nav clearfix">
                <li class="navfirstLi" id="tj"><input type="hidden" name="usertype" value="1"/>推荐人</li>
                <li class="navlastLi mover3" id="com">招聘企业</li>
            </ul>
            <ul class="InputUl">
                <li><input class="zhuceUser" onblur="checkuser()" type="text" name="username" /><span>请输入用户名</span></li>
                <li><input type="text" class="email" id="email" name="email"/><span>请输入邮箱信息</span></li>
                <li><input class="password1" type="password" name="password"/><span>请输入密码</span></li>
                <li><input class="password2" style="margin-bottom:0px;" type="password"/><span>确认密码</span></li>
                <p class="error"></p>
            </ul>
            <div class="yanzheng">
                <input class="radio1" type="radio" name="xieyi" id="xieyaya">
                <span>已阅读并接受人人猎网<a href="">《用户协议和隐私条款》</a></span>
            </div>
            <input type="button" class="zhucequeren"  value="确认" id="zhucebutton" >
            <div class="erweima_dl"><img src="/Public/img/erweima_img.jpg" alt=""><a class="Close3"><img src="/Public/img/close_weixin.png" alt=""></a></div>
        </dt>
        <dd>
            <div class="yd">
                <span>已有账号</span>
                <em id="denglu3">点此登录</em>
            </div>
            <p>使用联合账号登录</p>
            <ul class="Sign" style="display:none">
                <li><a href="<?php echo U('login?type=qq');?>"><img src="/Public/img/qq_icon.png"></a></li>
                <li><a href="<?php echo ($code_url); ?>"><img src="/Public/img/weibo.png"></a></li>
                <li class="weixindl" style="cursor:hand;"><img src="/Public/img/weixin.png"></li>
                <li><a href="<?php echo U('login?type=renren');?>"><img src="/Public/img/renren.png"></a></li>
            </ul>
            <ul class="Grey">
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
        $("#zhucebutton").attr("disabled", false);
        $("#email").blur(function() {
            var email = $("#eamil").val();
            var usertype = $("input[name='usertype']").val();
            $.post("/index.php?s=/Home/Login/checkemail", {
                'eamil': email,
                'usertype': usertype
            }, function(data) {
                if (data.code != 200) {
                    $('.error').html(data.msg)
                    $('.error').show();
                    return false;
                }
            }, "json")
        });
    })
    $("#zhucebutton").click(function() {
        var username = $("input[name='username']").val();
        var email = $("input[name='email']").val();
        var password = $("input[name='password']").val();
        var repassword = $(".password2").val();
        var xieyi = $("input[name='xieyi']").val();
        var usertype = $("input[name='usertype']").val();
        var dd = document.getElementById("xieyaya").checked;

        if (!username) {
            $('.error').html('用户名不能为空！')
            $('.error').show();
            return false;
        } else if (!email) {
            $('.error').html('邮箱不能为空！')
            $('.error').show();
            return false;
        } else if (!password) {
            $('.error').html('密码不能为空！')
            $('.error').show();
            return false;
        } else if (password != repassword) {
            $('.error').html('两次输入的密码不一致！')
            $('.error').show();
            return false;
        }
        if (dd == false) {
            $('.error').html('请接受人人猎《用户协议和隐私条款》！')
            $('.error').show();
            return false;
        }
        $("#zhucebutton").attr("disabled", "disabled");
        $.post("/index.php?s=/Home/Login/checkemail", {
            'eamil': email,
            'usertype': usertype
        }, function(data) {
            if (data.code != 200) {
                 $("#zhucebutton").attr("disabled", false);
                $('.error').html(data.msg)
                $('.error').show();
                return false;
            } else {
                $.post("/index.php?s=/Home/Login/add", {
                    'username': username,
                    'email': email,
                    'password': password,
                    'usertype': usertype
                }, function(data) {
                    if (data.code == 200) {
                        location.href = "/index.php?s=/Home/Login/register&email=" + email;
                        return false;
                    } else {
                        $("#zhucebutton").attr("disabled", false);
                        $('.error').html(data.msg)
                        $('.error').show();
                        return false;
                    }
                }, "json")
            }
        }, "json")




    });
</script>
    <div id="" class="denglu">
    <a class="Close"></a>
    <h3></h3>
    <dl>
        <dt>
        <!--	<form action ="/index.php?s=/Home/Login/userlogin" id="dlform" method ="post">   -->
        <ul class="InputUl">
            <li><input class="DLUser" type="text" name="usernamees" /><span>请输入用户名</span></li>
            <li><input class="DLpassword" type="password" name="passwordes"/><span>请输入密码</span></li>
            <p class="error2"></p>
        </ul>
        <div class="yanzheng">
            <input type="checkbox">
            <span>记住我<a href="/index.php?s=/Home/Login/huopass">忘记密码？</a></span>
        </div>
        <input type="submit" class="zhucequeren" value="确认" id="denglubutton">
        <!--	</form>   -->
        </dt>
        <dd>
            <div class="yd">
                <span>还没账号</span>
                <em id="dengluBtn2">点此注册</em>
            </div>
            <p><a href="">使用联合账号登录</a></p>
            <ul>
                <li><a href=""><img src="/Public/img/qq_icon.png"></a></li>
                <li><a href="<?php echo U('login?type=sina');?>"><img src="/Public/img/weibo.png"></a></li>
                <li><a href=""><img src="/Public/img/weixin.png"></a></li>
                <li><a href="<?php echo U('login?type=renren');?>"><img src="/Public/img/renren.png"></a></li>
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
    $(function() {
        $("#denglubutton").attr("disabled", false);
        $("#colosewindowd").click(function() {
            $(".mask1").hide();
            $(".mask").hide();
            $(".cfid").hide();
            $(".denglu").hide();
            location.href = $("#hrefUrl").val();
        })
        $("#colosewindowds").click(function() {
            $(".mask").hide();
            $(".mask1").hide();
            $(".cfid").hide();
            $(".denglu").hide();
            location.href = $("#hrefUrl").val();
        })
    })
    $("#denglubutton").click(function() {
        var username = $("input[name='usernamees']").val();
        var password = $("input[name='passwordes']").val();

        if (!username) {
            $('.error2').html('用户名不能为空')
            $('.error2').show();
            return false;
        } else if (!password) {
            $('.error2').html('密码不能为空')
            $('.error2').show();
            return false;
        }

        $.post("/index.php?s=/Home/Login/userlogin", {
            'username': username,
            'password': password
        }, function(data) {

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
            <img src="/Public/img/logo.png" alt="">
        </a>
    </div>
    <div class="sousuo">
    <form action="/index.php?s=/Home/Login/JobSearch" method="post">
    	<ul class="myUl">
			<li>
				<span class="mysp"></span>
				<input class="sousuoIpt" type="text" id="position" name="position"/>	
				<input type="submit" class="ssBtn" value="搜索">
			</li>
		</ul>
    </form>
    </div>
    <ul class="pd">
        <h3>推荐人用户中心</h3>
        <li class="pd_list">
            <span><i><img src="/Public/img/pd_icon1.png" alt=""></i><b>我的资料</b></span>
            <ul <?php  if($first_class == "1"){ echo 'style="display:block;"';}?>>
                <li><a href="<?php echo U('Login/userinfo');?>"><em <?php  if($second_class == "1"){ echo 'class="hre"';}?>>基本信息</em></a></li>
                <li><a href="<?php echo U('Login/ziwojieshao');?>"><em <?php  if($second_class == "2"){ echo 'class="hre"';}?>>自我介绍</em></a></li>
            </ul>
        </li>
        <li class="pd_list mytj">
            <span><i><img src="/Public/img/pd_icon2.png" alt=""></i><b>我的推荐</b></span>
            <ul <?php  if($first_class == "2"){ echo 'style="display:block;"';}?>>
                <li><a href="<?php echo U('Login/RecoSettings');?>"><em <?php  if($second_class == "3"){ echo 'class="hre"';}?>>推荐设置 </em></a></li>
                <li><a href="<?php echo U('Login/Recommended');?>"><em <?php  if($second_class == "4"){ echo 'class="hre"';}?>>被推荐人 </em></a></li>
                <li><a href="<?php echo U('Login/IsRecommended');?>"><em <?php  if($second_class == "5"){ echo 'class="hre"';}?>>正在推荐 </em></a></li>
           <!--     <li><a href="<?php echo U('Login/SucceRecom');?>"><em <?php  if($second_class == "6"){ echo 'class="hre"';}?>>成功推荐 </em></a></li>
                <li><a href="<?php echo U('Login/HistOfRecom');?>"><em <?php  if($second_class == "7"){ echo 'class="hre"';}?>>历史推荐 </em></a></li>
           -->
            </ul>
        </li>
        <li class="pd_list">
            <span><i><img src="/Public/img/pd_icon3.png" alt=""></i><b>职位搜藏</b></span>
            <ul <?php  if($first_class == "3"){ echo 'style="display:block;"';}?>>
                <li><a href="<?php echo U('Login/JobSearch');?>"><em  <?php  if($second_class == "8"){ echo 'class="hre"';}?>>职位高级搜索</em></a></li>
            <!--      <li><a href="<?php echo U('Login/MyJobSearch');?>"><em  <?php  if($second_class == "9"){ echo 'class="hre"';}?>>我的搜索器</em></a></li>
                <li><a href="<?php echo U('Login/MyPosition');?>"><em <?php  if($second_class == "10"){ echo 'class="hre"';}?>>收藏的职位</em></a></li>
            -->
            </ul>
        </li>
        <li class="pd_list">
            <span><i><img src="/Public/img/pd_icon4.png" alt=""></i><b>我的账户</b></span>
            <ul <?php  if($first_class == "4"){ echo 'style="display:block;"';}?>>
                <li><a href="<?php echo U('Login/ReceivAccount');?>"><em <?php  if($second_class == "11"){ echo 'class="hre"';}?>>收款账号</em></a></li>
        <!--        <li><a href="<?php echo U('Login/DetailsFunds');?>"><em <?php  if($second_class == "12"){ echo 'class="hre"';}?>>资金明细</em></a></li>
                <li><a href="<?php echo U('Login/MyMessage1');?>"><em <?php  if($second_class == "13"){ echo 'class="hre"';}?>>我的消息</em></a></li>
      
               <li><a href=""><em <?php  if($second_class == "14"){ echo 'class="hre"';}?>>我的密码</em></a></li>
                <li><a href=""><em <?php  if($second_class == "15"){ echo 'class="hre"';}?>>退出账户</em></a></li>
          -->
            </ul>
        </li>

        <li class="btn"><a href="<?php echo U('Login/ModifyRencom');?>"><span><i><img src="/Public/img/pd_icon5.png" alt=""></i><b>增加候选人</b></span></a></li>
    </ul>
    <div class="footer">
        <h3>服务热线</h3>
        <p>4006-685-596</p>
    </div>
</div>
    	<div class="RightFixed">
		<ul class="Right" style="height:300px">
			<li class="dt"><img src="/Public/img/rightTop.png" alt=""></li>
			<li><a href="http://www.hudong.com" target="Blank"><img src="/Public/img/icon1.1.png" alt="百科"></a></li>
			<li><a href="http://www.gfxiong.com/" target="Blank"><img src="/Public/img/gfx_logo1.png" alt="51社保"></a></li>
			<li><a href="http://www.kaomanfen.com" target="Blank"><img src="/Public/img/kmf.png" alt="盈禾优仕"></a></li>
			<li><a href="http://www.easywed.cn" target="Blank"><img src="/Public/img/yijie.png" alt="易结网"></a></li>
			<li><a href="http://www.loveoeye.com" target="Blank"><img src="/Public/img/ysy.png" alt="云视野"></a></li>
		</ul>
		<ul class="btm">
			<li>
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
        <li class="cenTop"><a href="<?php echo U('Index/index');?>">首页</a></li>
        <li><a href="<?php echo U('Index/search');?>">职位</a></li>
        <li><a href="<?php echo U('Index/cgal');?>">成功案例</a></li>
    </ul>

    <ul class="right">
        <?php if(empty($_SESSION['username']) && empty($_SESSION['cusername'])){ ?>
        <li class="firstLi2"><a class="dengluBtn">登录</a></li>
        <li><a id="zhuce" class="zhuce1">注册</a></li>
        <?php }else { $username = ($_SESSION['username']?$_SESSION['username']:$_SESSION['cusername']); ?>
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
<script type="text/javascript">
<!--
    $(document).ready(function() {
        var catList = $(".J_Cat");

        catList.on("mouseenter", function() {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "get",
                data: {"id": id},
                url: "/index.php?s=/Home/Login/ajaxReturn",
                success: function(e) {
                    $("#ajaxposi").html(e);
                }

            });
        });
    })
//-->
</script>
        <div class="PersData">
            <div class="cn cn1 Infor">
                <div class="cn_tp">
                    <h3>基本信息</h3>
                    <dl class="clearfix">
                        <dt>
                        <ul>
                            <li><em>用户名 :</em><span ><?php echo ($userinfo['username']); ?></span></li>
                            <li><em>真实姓名 :</em><span id="t2"><?php echo ($userinfo['cnname']); ?></span></li>
                            <li><em>邮箱 :</em><span id="t3"><?php echo ($userinfo['email']); ?></span></li>
                            <li><em>手机 :</em><span id="t4" class="mobileed"><?php echo ($userinfo['mobile']); ?></span></li>
                            <li><p><em>性别 :</em>
                                    <span id="t5">
                                        <?php if($userinfo["sex"] == 1): ?>女
                                            <?php else: ?>
                                            男<?php endif; ?>
                                    </span>
                                </p><p><em>年龄 :</em><span id="t6"><?php echo ($userinfo['age']); ?></span></p></li>
                            <li><p><em>QQ :</em><span id="t7"><?php echo ($userinfo['qqnum']); ?></span></p><p><em>微信 :</em><span  id="t8"><?php echo ($userinfo['weixin']); ?></span></p></li>
                        </ul>
                        </dt>
                        <dd>

                            <img src="<?php echo ($userinfo['avatar']); ?>" alt=""  id="t9">
                        </dd>
                    </dl>
                </div>
                <div class="cn_btm">
                    <input class="btn" type="button" value="修改">
                </div>
            </div>
            <div class="cn cn1 Modify" style="display:none">
                <div class="cn_tp">
                    <h3>基本信息</h3>
                    <form enctype="multipart/form-data" action="/index.php?s=/Home/Login/useradd" method="post" id="submitBaseInfo">

                        <dl class="clearfix">
                            <dt>
                            <ul>
                                <li><em>用户名 :</em><span><?php echo ($userinfo['username']); ?></span></li>
                                <li class="zzxm"><em>真实姓名 :</em><b>*</b><input style="width:183px" id="cnname" class="ip1 hanzi" type="text" placeholder="请输入真实姓名" name="cnname" value="<?php echo ($userinfo['cnname']); ?>"></li>
                                <li class="zzxm"><em>邮箱 :</em><span><?php echo ($userinfo['email']); ?></span></li>
                                <li class="zzxm"><em>手机 :</em><b>*</b><input class="ip1 shoujihao" name="mobile" type="text" placeholder="请输入手机号" value="<?php echo ($userinfo['mobile']); ?>" id="mobile" ><input class="butondx"  style="display:none" type="button" value="验证手机号码"></li>
                                <li>
                                    <p class="clearfix">
                                        <em class="xb">性别 :</em>

                                        <input class="ip2" id="sex" name="sex" type="radio" value="0" <?php if($userinfo['sex'] == "0") echo 'checked=checked';?>>
                                               <label for="nan">男</label>
                                        <input class="ip2" id="sex" name="sex" type="radio" value="1" <?php if($userinfo['sex'] == "1") echo 'checked=checked';?>><label for="nv">女</label>
                                    </p>
                                    <p>
                                        <em class="xb">年龄 :</em>
                                        <input type="text" class="ip3" name="age" id="age" placeholder="年龄" value="<?php echo ($userinfo['age']); ?>">
                                    </p>
                                </li>
                                <li><p><em>QQ :</em><input type="text" name="qqnum" id="qqnum" class="qq" placeholder="请输入QQ" value="<?php echo ($userinfo['qqnum']); ?>"></p><p><em>微信 :</em><input type="text" id="weixin" class="weixin" placeholder="请输入微信号" name="weixin"  value="<?php echo ($userinfo['weixin']); ?>"></p></li>
                                <li><p class="error2" style="display:none;margin-left:75px;color:#de6a6a;">第三方第三方</p></li>
                            </ul>
                            </dt>
                            <dd>
                                <input class="EntLogo" type="file" name="avatar">
                                <img src="/Public/img/HeadPort.png" alt="">
                            </dd>
                        </dl>
                </div>
                <div class="cn_btm">
                    <input class="btn2" type="hidden" value="取消" id="check_coded" name="check_coded">
                    <input class="btn1" type="button" value="保存" name="baocun" onclick="ajaxadd()">
                    <input class="btn2" type="button" value="取消">
                </div>
                </form>
            </div>
        </div>
        <div class="footer clearfix">
	<ul class="clearfix">
		<li><a href="<?php echo U('Index/sutuijian');?>">关于我们</a></li>
		<li><a href="<?php echo U('Index/tjrxy');?>">注册协议</a></li>
		<li><a href="<?php echo U('Index/yhys');?>">用户隐私</a></li>
		<li class="last"><a href="<?php echo U('Index/lxwm');?>">联系我们</a></li>
	</ul>
	<p>人人猎 京ICP备14040265号&nbsp;&nbsp;&nbsp;&nbsp;<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1254515209'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1254515209%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>
</p>
</div>
    </div>
    <div class="aa">
		<div class="fiexdCenter">
			<ul class="left" id="navTop">
				<li class="cenTop"><a href="<?php echo U('Index/index');?>">首页</a></li>
				<li><a href="<?php echo U('Index/search');?>">职位</a></li>
				<li><a href="<?php echo U('Index/cgal');?>">成功案例</a></li>
			</ul>

			<ul class="right">		
				<?php if(empty($_SESSION['username']) && empty($_SESSION['cusername'])){ $username = $_SESSION['username']; ?>
					<li class="firstLi2"><a class="dengluBtn">登录</a></li>
					<li class="firstLi2"><a id="zhuce" class="zhuce1">注册</a></li>
					<?php }else { $username = ($_SESSION['username']?$_SESSION['username']:$_SESSION['cusername']); ?>
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

    $(document).ready(function(){
        var catList = $( ".J_Cat" );
		
        catList.on( "mouseenter", function(){
            var id = $(this).attr('data-id');
            $.ajax({
                type: "get",
                data:{"id":id},
                url: "/index.php?s=/Home/Login/ajaxReturn",
                success: function(e){
                    $("#ajaxposi").html(e);
                }

            });
        });
        $('#tj').on( 'click',function(){
            $("#tj>input").val(0);

        } )
		
        $('#com').on( 'click',function(){
            $("#tj>input").val(1);
        } )
    })	
    function checkuser()
    {
        var username = $(".zhuceUser").val();
        if(username!="")
        {
            if(/^[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{6,24}$/.test(username)){

                $.ajax({

                    type:"get",
                    data:{"username":username},
                    url:"/index.php?s=/Home/Login/check",
                    success:function(data)
                    {
                        if(data=="0")
                        {
                            $(".error").html("用户名已注册");
                            $('.error').show();
                            return true;
                        }
                        else if(data=="1")
                        {
                            $(".error").html("用户名可以使用");
                            $('.error').show();
                            return false;
                        }
                    }

                })
            }
            else
            {
                $('.error').html('用户名格式不正确')
                $('.error').show();
			
            }
        }
        else
        {
            $('.error').html('用户名非空')
            $('.error').show();
        }
    }
    $(function (){
       $("#check_coded").val("");
       $("#code").val(""); 
        $("#getCode").click(function(){
            var telephoneCheck = $("#mobile").val();
            $.ajax({
                type: "post",
                data:{"telephoneCheck":telephoneCheck},
                url: "/index.php?s=/Home/Login/getCode",
                dataType:"json",
                success: function(e){
                    if(e.code != "200"){
                        $(".error3").html(e.msg);
                        $(".error3").show();
                    }
                }
            });
        })
        $(".butonqr").click(function(){
            var code = $("#code").val();
            if(code){
                if (/^[0-9]{4}$/.test(code)) {
                    $('.error3').hide();
                } else {
                    $('.error3').html('验证码格式不正确')
                    $('.error3').show();
                }
            }else{
                $('.error3').html('验证码不能为空')
                $('.error3').show();
            }
            $.ajax({
                type: "post",
                dataType:"json",
                data:{"code":code},
                url: "/index.php?s=/Home/Login/checkCode",
                success: function(data){
                  
                    if(data.code != "200"){
                        $(".error3").html(data.msg);
                        $(".error3").show();
                    }else{
                        $("#check_coded").val(data.msg);
                        $('.yzsj').hide();
                        $('.mask').hide();
                        $(".error3").hide();
                    }
                }
            });
        });
    })
    
    
    function ajaxadd(){
        var code = $("#check_coded").val();
        var mobileed = $(".mobileed").html();
        var mobile = $("#mobile").val();
        if(mobileed == mobile){
           
            $("#submitBaseInfo").ajaxSubmit({  
                type: 'post',  
                dataType:"json",
                url: "/index.php?s=/Home/Login/useradd" ,  
                success: function(data){  
             
                    return false;
                },  
                error: function(XmlHttpRequest, textStatus, errorThrown){  
               
                    $.post("/index.php?s=/Home/Login/getUserInfo",{},function (data){
                        $("#t2").html(data.cnname);
                        $("#t3").html(data.email);
                        $("#t4").html(data.mobile);
                        if(data.sex>0){
                            $("#t5").html("女");
                        }else{
                            $("#t5").html("男");
                        }
                        $("#t6").html(data.age);
                        $("#t7").html(data.qqnum);
                        $("#t8").html(data.weixin);
                        $('#t9').attr("src",data.avatar);
                        $('.Modify').hide();
                        $('.Infor').show();
                        $('.Self').show();
                    },"json")
                }  
            }); 
        }else{
            $.post("/index.php?s=/Home/Login/checkCode",{code:code},function (data){
                if(data.code != "200"){
                    $('.error2').html('手机验证码不正确或未验证请重新获取');
                    $('.error2').show();
                    return false;
                }else{
                    $("#submitBaseInfo").ajaxSubmit({  
                        type: 'post',  
                        dataType:"json",
                        url: "/index.php?s=/Home/Login/useradd" ,  
                        success: function(data){  
             
                            return false;
                        },  
                        error: function(XmlHttpRequest, textStatus, errorThrown){  
               
                            $.post("/index.php?s=/Home/Login/getUserInfo",{},function (data){
                                $("#t2").html(data.cnname);
                                $("#t3").html(data.email);
                                $("#t4").html(data.mobile);
                                if(data.sex>0){
                                    $("#t5").html("女");
                                }else{
                                    $("#t5").html("男");
                                }
                                $("#t6").html(data.age);
                                $("#t7").html(data.qqnum);
                                $("#t8").html(data.weixin);
                                $('#t9').attr("src",data.avatar);
                                $('.Modify').hide();
                                $('.Infor').show();
                                $('.Self').show();
                            },"json")
                        }  
                    }); 
                }   
            },"json");
        }
        
        
        return false;
    }
</script>
</html>