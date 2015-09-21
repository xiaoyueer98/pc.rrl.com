<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>速推荐</title>
    <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="/Public/js/focuspic.js"></script>
    <script type="text/javascript" src="/Public/js/menu_v.js"></script>
    <script type="text/javascript" src="/Public/js/script.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
    <link rel="stylesheet" type="text/css" href="/Public/css/resizer.css">
    <link rel="stylesheet" href="/Public/css/focuspic.css" />
    <link rel="stylesheet" href="/Public/css/menu_v.css" />
    <link rel="stylesheet" type="text/css" href="/Public/css/style.css">
</head>
<body>
	<!-- 遮罩层 -->
	<div class="mask" id="mask"></div>
	<div id="conZhuce" class="zhuce">
	<a class="Close"></a>
	<h3></h3>
	<dl>
		<dt>
			
			<form action ="/index.php?s=/Home/Login/add" method ="post" id="form">
			<ul class="nav clearfix">
				<li class="navfirstLi" id="tj"><input type="hidden" name="usertype" value="1"/>推荐人</li>
				<li class="navlastLi mover3" id="com">招聘企业</li>
			</ul>
				<ul class="InputUl">
					<li><input class="zhuceUser" onblur="checkuser()" type="text" name="username" placeholder="请输入用户名"/></li>
					<li><input type="text" class="email" id="email" name="email" placeholder="请输入邮箱信息"/></li>
					<li><input class="password1" type="password" name="password" placeholder="请输入密码" maxlength="16"/></li>
					<li><input class="password2" style="margin-bottom:0px;" type="password" placeholder="确认密码"/></li>
					<p class="error"></p>
				</ul>
				<div class="yanzheng">
					<input class="radio1" type="radio" name="xieyi">
					<span>已阅读并接受速推荐网<a href="">《用户协议和隐私政策》</a></span>
				</div>
				<input type="submit" class="zhucequeren"  value="确认">
			</form>
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
				<li><a href=""><img src="/Public/img/weixin.png"></a></li>
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
	<div id="" class="denglu">
	<a class="Close"></a>
	<h3></h3>
	<dl>
		<dt>
			<form action ="/index.php?s=/Home/Login/userlogin" id="dlform" method ="post">
				<ul class="InputUl">
					<li><input class="DLUser" type="text" name="username" placeholder="请输入用户名"/></li>
					<li><input class="DLpassword" type="password" name="password" placeholder="请输入用户名"/></li>
					<p class="error2"></p>
				</ul>
				<div class="yanzheng">
					<b></b>
					<span>记住我<a href="/index.php?s=/Home/Login/huopass">忘记密码？</a></span>
				</div>
				<input type="submit" class="zhucequeren" value="确认">
			</form>
		</dt>
		<dd>
			<div class="yd">
				<span>还没账号</span>
				<em id="dengluBtn2">点此注册</em>
			</div>
			<p><a href="">使用联合账号登录</a></p>
			<ul>
				<li><a href="<?php echo U('login?type=qq');?>"><img src="/Public/img/qq_icon.png"></a></li>
				<li><a href="<?php echo ($code_url); ?>"><img src="/Public/img/weibo.png"></a></li>
				<li><a href=""><img src="/Public/img/weixin.png"></a></li>
				<li><a href="<?php echo U('login?type=renren');?>"><img src="/Public/img/renren.png"></a></li>
			</ul>
		</dd>
	</dl>
</div>

	<div id="J_Cat" class="cat">
	    <div class="cat-hd">
	        <a href="//list.taobao.com/browse/cat-0.htm">
	           <img src="/Public/img/logo.png" alt="">
	        </a>
	    </div>
	    <div class="sousuo">
		    <form action="">
		    	<ul class="myUl">
					<li>
						<span class="mysp"></span>
						<input class="sousuoIpt" type="text"/>	
						<input type="button" class="ssBtn" value="搜索">
					</li>
				</ul>
		    </form>
		</div>
		<ul class="pd">
			<h3>推荐人用户中心</h3>
			<li class="pd_list">
				<span><i><img src="/Public/img/pd_icon1.png" alt=""></i><b>我的资料</b></span>
				<ul style="display:block">
					<li><a href="<?php echo U('Login/TheBasicInformation');?>"><em class="hre">基本信息</em></a></li>
					<li><a href="<?php echo U('Login/ziwojieshao');?>"><em >自我介绍</em></a></li>
				</ul>
			</li>
			<li class="pd_list mytj">
				<span><i><img src="/Public/img/pd_icon2.png" alt=""></i><b>我的推荐</b></span>
				<ul>
					<li><a href="<?php echo U('Login/RecoSettings');?>"><em>推荐设置 </em></a></li>
					<li><a href="<?php echo U('Login/Recommended');?>"><em>被推荐人 </em></a></li>
					<li><a href="<?php echo U('Login/IsRecommended');?>"><em>正在推荐 </em></a></li>
					<li><a href="<?php echo U('Login/SucceRecom');?>"><em>成功推荐 </em></a></li>
					<li><a href="<?php echo U('Login/HistOfRecom');?>"><em>历史推荐 </em></a></li>
				</ul>
			</li>
			<li class="pd_list">
				<span><i><img src="/Public/img/pd_icon3.png" alt=""></i><b>职位搜藏</b></span>
				<ul>
					<li><a href="<?php echo U('Login/JobSearch');?>"><em>职位高级搜索</em></a></li>
					<li><a href="<?php echo U('Login/MyJobSearch');?>"><em>我的搜索器</em></a></li>
					<li><a href="<?php echo U('Login/MyPosition');?>"><em>收藏的职位</em></a></li>
				</ul>
			</li>
			<li class="pd_list">
				<span><i><img src="/Public/img/pd_icon4.png" alt=""></i><b>我的账户</b></span>
				<ul>
					<li><a href="<?php echo U('Login/ReceivAccount');?>"><em>收款账号</em></a></li>
					<li><a href="<?php echo U('Login/DetailsFunds');?>"><em>资金明细</em></a></li>
					<li><a href="<?php echo U('Login/MyMessage');?>"><em>我的消息</em></a></li>
					<li><a href=""><em>我的密码</em></a></li>
					<li><a href=""><em>退出账户</em></a></li>
				</ul>
			</li>
			
			<li class="btn"><span><i><img src="/Public/img/pd_icon5.png" alt=""></i><b>增加推荐人</b></li>
		</ul>
		<div class="footer">
	    	<h3>服务热线</h3>
	    	<p>4006-685-596</p>
	    </div>
	</div>
	<div class="RightFixed">
		<ul class="Right">
			<dt><a href=""><img src="/Public/img/rightTop.png" alt=""></a></dt>
			<li><a href=""><img src="/Public/img/icon1.1.png" alt=""></a></li>
			<li><a href=""><img src="/Public/img/icon1.1.png" alt=""></a></li>
			<li><a href=""><img src="/Public/img/icon1.1.png" alt=""></a></li>
			<li><a href=""><img src="/Public/img/icon1.1.png" alt=""></a></li>
			<li><a href=""><img src="/Public/img/icon1.1.png" alt=""></a></li>
		</ul>
		<ul class="btm">
			<li><img src="/Public/img/icon1.2.png" alt=""></li>
			<li class="hddb"><img src="/Public/img/icon1.1.3.png" alt=""><span class="myspan"></span></li>
		</ul>
	</div>
	<div class="center">
		<div class="centerCon1">
			<ul class="left" id="navTop">
				<li class="cenTop">首页</li>
				<li>职位</li>
				<li>成功案例</li>
				<li>活动</li>
			</ul>

			<ul class="right">
				<li class="firstLi">
					<select name="" id="" style="border:none;">
						<option>北京</option>
						<option>太原</option>
						<option>广州</option>
						<option>深圳</option>
						<option>上海</option>
						<option>永和</option>
					</select>
				</li>
				<li class="firstLi2"><a class="dengluBtn">登陆</a></li>
				<li><a id="zhuce" class="zhuce1">注册</a></li>
			</ul>
		</div>
		<div class="PersData">
			<div class="cn cn1 Infor">
				<div class="cn_tp">
					<h3>基本信息</h3>
					<dl class="clearfix">
						<dt>
							<ul>
								<li><em>用户名 :</em><span>Robin</span></li>
								<li><em>真实姓名 :</em><span>Robin</span></li>
								<li><em>邮箱 :</em><span>Robin</span></li>
								<li><em>手机 :</em><span>Robin</span></li>
								<li><p><em>性别 :</em><span>男</span></p><p><em>年龄 :</em><span>27</span></p></li>
								<li><p><em>QQ :</em><span>2415000656</span></p><p><em>微信 :</em><span>Robin man</span></p></li>
							</ul>
						</dt>
						<dd>
							<input class="EntLogo" type="file">
							<img src="/Public/img/HeadPort.png" alt="">
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
					<dl class="clearfix">
						<dt>
							<ul>
								<li><em>用户名 :</em><span>Robin</span></li>
								<li><em>真实姓名 :</em><input style="width:183px" class="ip1 hanzi" type="text" value="杨帆"></li>
								<li><em>邮箱 :</em><input class="ip1 email2" type="text" id="email" value="Robin@163.com"></li>
								<li><em>手机 :</em><input class="ip1 shoujihao" type="text" value="2415000656"></li>
								<li>
									<p class="clearfix">
										<em class="xb">性别 :</em>
										<input class="ip2" id="nan" name="gender" type="radio">
										<label for="nan">男</label>
										<input class="ip2" id="nv" name="gender" type="radio">
										<label for="nv">女</label>
									</p>
									<p>
										<em class="xb">年龄 :</em>
										<input type="text" class="ip3" value="27">
									</p>
								</li>
								<li><p><em>QQ :</em><input type="text" class="qq" value="2415000656"></p><p><em>微信 :</em><input type="text" class="weixin" value="Robin"></p></li>
								<li><i class="error2"></i></li>
							</ul>
						</dt>
						<dd>
							<input class="EntLogo" type="file">
							<img src="/Public/img/HeadPort.png" alt="">
						</dd>
					</dl>
				</div>
				<div class="cn_btm">
					<input class="btn1" type="button" value="保存">
					<input class="btn2" type="button" value="取消">
				</div>
			</div>
		</div>
		<div class="footer clearfix">
			<ul class="clearfix">
				<li><a href="">关于我们</a></li>
				<li><a href="">注册协议</a></li>
				<li><a href="">用户隐私</a></li>
				<li class="last"><a href="">联系我们</a></li>
			</ul>
			<p>速推荐网 京ICP备14040265号</p>
		</div>
	</div>
	<div class="aa">
		<div class="fiexdCenter">
			<ul class="left" id="navTop">
				<li class="cenTop">首页</li>
				<li>职位</li>
				<li>成功案例</li>
				<li>活动</li>
			</ul>

			<ul class="right">
				<li class="firstLi">
					<select name="" id=""  onchange='location.href=this.options[this.selectedIndex].value;' style="border:none;">
						<option style="">北京</option>
						<option>太原</option>
						<option>广州</option>
						<option>深圳</option>
						<option>上海</option>
						<option>永和</option>

						<option style="">北京</option>
						<option>太原</option>
						<option>广州</option>
						<option>深圳</option>
						<option>上海</option>
						<option>永和</option>

						<option style="">北京</option>
						<option>太原</option>
						<option>广州</option>
						<option>深圳</option>
						<option>上海</option>
						<option>永和</option>

						<option style="">北京</option>
						<option>太原</option>
						<option>广州</option>
						<option>深圳</option>
						<option>上海</option>
						<option>永和</option>

						<option style="">北京</option>
						<option>太原</option>
						<option>广州</option>
						<option>深圳</option>
						<option>上海</option>
						<option>永和</option>

						<option style="">北京</option>
						<option>太原</option>
						<option>广州</option>
						<option>深圳</option>
						<option>上海</option>
						<option>永和</option>

						<option style="">北京</option>
						<option>太原</option>
						<option>广州</option>
						<option>深圳</option>
						<option>上海</option>
						<option>永和</option>
					</select>
				</li>
				<li class="firstLi2"><a class="dengluBtn">登陆</a></li>
				<li><a id="zhuce" class="zhuce1">注册</a></li>
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
</script>
</html>