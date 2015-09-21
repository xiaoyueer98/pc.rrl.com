<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>速推荐</title>
    <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="/Public/js/focuspic.js"></script>
    <script type="text/javascript" src="/Public/js/menu_v.js"></script>
    <script type="text/javascript" src="/Public/js/script.js"></script>
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
		<div class="footer">
	    	<h3>服务热线</h3>
	    	<p>4006-685-596</p>
	    </div>
	    <div id="J_CatBd" class="cat-bd">
	        <div id="J_CatMenu" class="cat-menu">
	            <ul class="cat-menu-bd">
	                <li class="J_Cat cat-1" data-id="1">技术</li>
	                <li class="J_Cat cat-2" data-id="2">产品</li>
	                <li class="J_Cat cat-3" data-id="3">设计</li>
	                <li class="J_Cat cat-4" data-id="4">运营/编辑</li>
	                <li class="J_Cat cat-5" data-id="5">市场/销售</li>
	                <li class="J_Cat cat-6" data-id="6">职能</li>
	            </ul>
	        </div>
	        <div id="J_CatCont" class="cat-cont" style="display: none; top: 202px; width: 425px; overflow: hidden;">
	            <ul id="J_CatContBd" class="cat-cont-bd">
	                <li class="J_Mod mod" style="display: none;">
						<h3>后端开发</h3>
						<ul class="clearfix">
							<li><a href="http://www.baidu.com">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
						</ul>
						<h3>前段开发</h3>
						<ul class="clearfix">
							<li><a href="http://www.baidu.com">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
						</ul>

						<ul class="clearfix">
							<li><a href="http://www.baidu.com">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
						</ul>
	                </li>
	                <li class="J_Mod mod" style="display: none;">
						<h3>后端开发</h3>
						<ul class="clearfix">
							<li><a href="http://www.baidu.com">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
						</ul>
						<h3>前段开发</h3>
						<ul class="clearfix">
							<li><a href="http://www.baidu.com">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
						</ul>

						<ul class="clearfix">
							<li><a href="http://www.baidu.com">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
						</ul>
	                </li>
	                <li class="J_Mod mod" style="display: none;">
	                	<h3>后端开发</h3>
						<ul class="clearfix">
							<li><a href="http://www.baidu.com">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
						</ul>
						<h3>前段开发</h3>
						<ul class="clearfix">
							<li><a href="http://www.baidu.com">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
						</ul>

						<ul class="clearfix">
							<li><a href="http://www.baidu.com">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
						</ul>
	                </li>
	                <li class="J_Mod mod" style="display: none;">
						<h3>后端开发</h3>
						<ul class="clearfix">
							<li><a href="http://www.baidu.com">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
						</ul>
						<h3>前段开发</h3>
						<ul class="clearfix">
							<li><a href="http://www.baidu.com">PHP</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
						</ul>

						<ul class="clearfix">
							<li><a href="http://www.baidu.com">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
						</ul>
	                </li>
	                <li class="J_Mod mod" style="display: none;">
						<h3>后端开发</h3>
						<ul class="clearfix">
							<li><a href="http://www.baidu.com">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
						</ul>

						<h3>后端开发</h3>
						<ul class="clearfix">
							<li><a href="http://www.baidu.com">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
						</ul>

						<h3>后端开发</h3>
						<ul class="clearfix">
							<li><a href="http://www.baidu.com">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
						</ul>

						<h3>后端开发</h3>
						<ul class="clearfix">
							<li><a href="http://www.baidu.com">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
						</ul>
						<h3>前段开发</h3>
						<ul class="clearfix">
							
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
						</ul>

						<ul class="clearfix">
							<li><a href="http://www.baidu.com">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
						</ul>
	                </li>
	                <li class="J_Mod mod" style="display: none;">
	                	<h3>后端开发</h3>
						<ul class="clearfix">
							<li><a href="http://www.baidu.com">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
						</ul>
						<h3>前段开发</h3>
						<ul class="clearfix">
							<li><a href="http://www.baidu.com">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
						</ul>

						<h3>前段开发</h3>
						<ul class="clearfix">
							<li><a href="http://www.baidu.com">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
						</ul>

						<h3>前段开发</h3>
						<ul class="clearfix">
							<li><a href="http://www.baidu.com">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
						</ul>

						<ul class="clearfix">
							<li><a href="http://www.baidu.com">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
							<li><a href="">Java</a></li>
							<li><a href="">Pyphon</a></li>
							<li><a href="">.Net</a></li>
							<li><a href="">PHP</a></li>
						</ul>
	                </li>
	            </ul>
	            </div>
	            </a>
	        </div>
	    </div>

	    <div class="cat-shadow">
	    </div>
	</div>
		<div class="RightFixed">
		<ul class="Right">
			<li class="dt"><a href=""><img src="/Public/img/rightTop.png" alt=""></a></li>
			<li><a href=""><img src="/Public/img/icon1.1.png" alt=""></a></li>
			<li><a href=""><img src="/Public/img/icon1.1.png" alt=""></a></li>
			<li><a href=""><img src="/Public/img/icon1.1.png" alt=""></a></li>
			<li><a href=""><img src="/Public/img/icon1.1.png" alt=""></a></li>
			<li><a href=""><img src="/Public/img/icon1.1.png" alt=""></a></li>
		</ul>
		<ul class="btm">
			<li>
				<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=1158321049&amp;site=qq&amp;menu=yes" target="_blank" title="欢迎登陆速推荐网--人人都是猎头"><img src="/Public/img/icon1.2.png" alt=""></a>
			</li>
			<li class="hddb"><img src="/Public/img/icon1.1.3.png" alt="">
				<span class="myspan"></span>
			</li>
		</ul>
	</div>
	
	<div class="center">
		<div class="centerCon1">
	<ul class="left" id="navTop">
		<li class="cenTop"><a href="<?php echo U('Index/index');?>">首页</a></li>
		<li><a href="<?php echo U('Index/search');?>">职位</a></li>
		<li><a href="">成功案例</a></li>
		<li><a href="">活动</a></li>
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
//-->
</script>
		<?php if(is_array($comp)): $i = 0; $__LIST__ = $comp;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cp): $mod = ($i % 2 );++$i;?><form action="/index.php?s=/Home/Login/RecommendTheCandidate&position=<?php echo ($cp["cascname"]); ?>&comid=<?php echo $_GET['comid']; ?>&jobid=<?php echo ($cp["jobid"]); ?>" method="post">
		<input type="hidden" id="jobid" value="<?php echo ($cp["jobid"]); ?>">
			<div class="positi">
				<h3>职位明细</h3>
				<ul class="first_Ul">
					<h4><em><?php echo ($cp["cascname"]); ?></em><span>发布：<?php echo ($cp["posttime"]); ?> 截止：<?php echo ($cp["endtime"]); ?></span></h4>
					<li>
						<p><em>招聘人数：</em><span><?php echo ($cp["employ"]); ?></span><em>工作地点：</em><span><?php echo ($cp["casc"]); ?></span></p>
						<p><em>工作经验：</em><span><?php echo ($cp["ccasc"]); ?></span><em>学历要求：</em><span><?php echo ($cp["ccas"]); ?></span><em>语言能力:</em><span></span></p>
						<dl class="clearfix">
							<dt><em>地址：</em><span><?php echo ($cp["address"]); ?></span></dt>
							<dd><em>职位月薪：</em><span style="color:#cb000d"><?php echo ($cp["dataname"]); ?></span></dd>
						</dl>
						<dl class="clearfix">
							<dt><em>主页：</em><a href=""><?php echo ($cp["webname"]); ?></a></span></dt>
							<dd><em style="color:#2380b8">推荐费：</em><span style="color:#cb000d"><?php echo ($cp["Tariff"]); ?></span></dd>
						</dl>
					</li>
				</ul>

				<h5>职位描述</h5>
				<ul class="nth_child">
					<li><?php echo ($cp["workdesc"]); ?></li>
					
				</ul>

				<h5>职位描述</h5>
				<ul class="nth_child">
					<li><span><?php echo ($cp["content"]); ?></span>
					</li>
					
				</ul><?php endforeach; endif; else: echo "" ;endif; ?>
				<input type="submit" class="ljtj" value="立即推荐">
				<div class="fiexd2">
										

					<dl>
						<dt><input type="file" class="file_r"></dt>
						
						<dd>
						<?php if(is_array($cinfo)): $i = 0; $__LIST__ = $cinfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><p><em>公司：</em><span><?php echo ($vo["cpname"]); ?></span></p>
							<p><em>融资阶段：</em><span><?php echo ($vo["jieduan"]); ?></span></p>
							<p><em>性质：</em><span><?php echo ($vo["xingzhi"]); ?></span></p>
							<p><em>规模：</em><span><?php echo ($vo["guimo"]); ?></span></p><?php endforeach; endif; else: echo "" ;endif; ?>
						</dd>
						<ul>
							<li class="li_1" onclick="userfavorite()">
							</li>
							<li class="li_2">
								<ul>
									<li class="clearfix"><span><img src="/Public/img/xl_icon.png" alt=""></span><em>分享至微博</em></li>
									<li class="clearfix"><span><img src="/Public/img/weixin_ic.png" alt=""></span><em>分享至微博</em></li>
									<li class="clearfix"><span><img src="/Public/img/qq_ic.png" alt=""></span><em>分享至微博</em></li>
								</ul>
							</li>
						</ul>
					</dl>

				</div>
			</div>
		</form>
		
		<div class="footer clearfix">
	<ul class="clearfix">
		<li><a href="<?php echo U('Index/AboutUs');?>">关于我们</a></li>
		<li><a href="<?php echo U('Index/AboutUs2');?>">注册协议</a></li>
		<li><a href="<?php echo U('Index/AboutUs4');?>">用户隐私</a></li>
		<li class="last"><a href="<?php echo U('Index/AboutUs3');?>">用户隐私协议</a></li>
	</ul>
	<p>速推荐网 京ICP备14040265号</p>
</div>
	</div>
	<div class="aa">
		<div class="fiexdCenter">
			<ul class="left" id="navTop">
				<li class="cenTop"><a href="<?php echo U('Index/index');?>">首页</a></li>
				<li><a href="<?php echo U('Index/search');?>">职位</a></li>
				<li>成功案例</li>
				<li>活动</li>
			</ul>

			<ul class="right">		
				<?php if(empty($_SESSION['username'])){ $username = $_SESSION['username']; ?>
					<li class="firstLi2"><a class="dengluBtn">登录</a></li>
					<li class="firstLi2"><a id="zhuce" class="zhuce1">注册</a></li>
					<?php }else { ?>
							<ul class="xiala2 clearfix" >
								<i></i>
								<li class="select2 first_l"><span><img src="/Public/img/icon_tx.png"></span><em><?php echo ($_SESSION['username']); ?></em></li>
								<ul class="vio2  clearfix" style="display:none">
									<div class="clearfix">
										<li class="i_1"><a href="www.baidu.com">用户中心</a></li>
										<li class="i_3"><a href="<?php echo ($savepass); ?>">修改密码</a></li>
										<li class="i_2"><a href="<?php echo ($logout); ?>">退出账户</a></li>
									</div>
								</ul>
								
							</ul>
						<?php } ?>
			</ul>
		</div>
	</div>
</body>
<script type="text/javascript">
function userfavorite()
{
	var jobid = $("#jobid").val();
	$.ajax({
		
		url:"/index.php?s=/Home/Login/aaa",
		data:{"jobid":jobid},
		type:"post",
		success:function(vic)
		{
			if(vic=="ok")
			{
				alert("关注成功");
			}
			else if(vic=="no")
			{
				alert("关注失败");
			}
			else if(vic=="ceng")
			{
				alert("已关注过");
			}
		}
	
	})
}
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