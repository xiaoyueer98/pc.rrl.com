<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎</title>
        <script type="text/javascript" src="Public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="Public/js/focuspic.js"></script>
        <script type="text/javascript" src="Public/js/menu_v.js"></script>
        <script type="text/javascript" src="Public/js/script.js"></script>
        <script type="text/javascript" charset="utf-8" src="Public/ueditor/ueditor.config.js"></script>
        <script type="text/javascript" charset="utf-8" src="Public/ueditor/ueditor.all.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="Public/ueditor/lang/zh-cn/zh-cn.js"></script>
        <link rel="stylesheet" type="text/css" href="Public/css/resizer.css">
        <link rel="stylesheet" href="Public/css/focuspic.css" />
        <link rel="stylesheet" href="Public/css/menu_v.css" />
        <link rel="stylesheet" type="text/css" href="Public/css/style.css">
        <style>
            .center .peoplerenm ul li p {
                float: left;
                display: inline-block;
                width: auto;
                height: auto;
                line-height: 34px;
            }
            .center .peoplerenm ul li.jlfj span {
                position: relative;
                top: -108px!importent;
                opacity: 0;
                display: block;
                width: 131px;
                height: 131px;
                left: -10px;
               
            }
        </style>
    </head>
    <body>
        <!-- 遮罩层 -->
        <div class="mask" id="mask"></div>
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
    $(function (){
         $("#zhucebutton").attr("disabled", false);
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
            $('.error').html('用户名不能为空')
            $('.error').show();
            return false;
        } else if (!email) {
            $('.error').html('邮箱不能为空')
            $('.error').show();
            return false;
        } else if (!password) {
            $('.error').html('密码不能为空')
            $('.error').show();
            return false;
        } else if (password != repassword) {
            $('.error').html('两次输入的密码不一致')
            $('.error').show();
            return false;
        }
         if(dd == false){
            $('.error').html('未同意接受消息')
            $('.error').show();
            return false;
        }
        $("#zhucebutton").attr("disabled", "disabled");
        $.post("/index.php?s=/Home/Login/add", {
            'username': username,
            'email': email,
            'password': password,
            'usertype': usertype
        }, function(data) {
            if (data.code == 200) {
                location.href = "/index.php?s=/Home/Login/register&email="+email;
                return false;
            } else {
                $("#zhucebutton").attr("disabled", false);
                $('.error').html(data.msg)
                $('.error').show();
                return false;
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
                <li><a href="<?php echo U('login?type=qq');?>"><img src="/Public/img/qq_icon.png"></a></li>
                <li><a href="<?php echo ($code_url); ?>"><img src="/Public/img/weibo.png"></a></li>
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
				<a href="http://wpa.qq.com/msgrd?v=3&amp;uin=1158321049&amp;site=qq&amp;menu=yes" target="_blank" title="欢迎登陆人人猎网--人人都是猎头"><img src="/Public/img/icon1.2.png" alt=""></a>
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
        <div class="PersData peoplerenm">

            <form action="/index.php?s=/Home/Login/btjadd" method="post" enctype="multipart/form-data" onsubmit = "return savaResumeType(1);"  name="submitForm">
                <h3 class="til">增加被推荐人</h3>
                <p class="clearfix mybtnp"><input type="button" class="sc1 <?php if($type==1) {echo "mo";}?>" value="上传简历模式" ><input class="sc2 <?php if($type==2) {echo "mo";}?>" type="button"  value="在线简历模式"></p>


                                                                                                                                                          <div class="cn cn2 Self Self1" <?php if($type==2) {echo "style='display:none'";}?>>
                                                                                                                                                               <div class="cn_tp">
                                                                                                                                                                  <ul>
                                                                                                                                                                      <h4>基本信息</h4>
                                                                                                                                                                      <li>
                                                                                                                                                                          <p class="firstP">
                                                                                                                                                                              <em>姓名：</em>
                                                                                                                                                                              <input type="text" name="username" id="username1" value="<?php echo ($resumeInfo['username']); ?>">
                                                                                                                                                                          </p>

                                                                                                                                                                          <p>
                                                                                                                                                                              <i>性别：</i>
                                                                                                                                                                              <?php if($resumeInfo){?>
                                                                                                                                                                              <label for="n">男</label>
                                                                                                                                                                              <input  name="sex" type="radio" value="0" <?php if($resumeInfo['sex']==0) echo "checked";?>>
                                                                                                                                                                                      <label for="v">女</label>
                                                                                                                                                                              <input  name="sex" type="radio" value="1" <?php if($resumeInfo['sex']==1) echo "checked";?>>

                                                                                                                                                                                      <?php }else{?>
                                                                                                                                                                                      <label for="n">男</label>
                                                                                                                                                                              <input  name="sex" type="radio" value="0" checked>
                                                                                                                                                                              <label for="v">女</label>
                                                                                                                                                                              <input  name="sex" type="radio" value="1">
                                                                                                                                                                              <?php }?>
                                                                                                                                                                              <i>年龄：</i>
                                                                                                                                                                              <input class="age" type="text" name="age" id="age1" value="<?php echo ($resumeInfo['age']); ?>">
                                                                                                                                                                          </p>
                                                                                                                                                                      </li>
                                                                                                                                                                      <li>
                                                                                                                                                                          <p class="firstP">
                                                                                                                                                                              <em>在职状态：</em>
                                                                                                                                                                              <select name="state" id="state1"> 
                                                                                                                                                                                  <option value="请选择">请选择</option>
                                                                                                                                                                                  <?php if(is_array($zzstatus)): $i = 0; $__LIST__ = $zzstatus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zzstatuslist): $mod = ($i % 2 );++$i;?><option value="<?php echo ($zzstatuslist['datavalue']); ?>" <?php if($zzstatuslist['datavalue'] == $resumeInfo['state']): ?>selected<?php endif; ?>><?php echo ($zzstatuslist['dataname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>  
                                                                                                                                                                              </select> 
                                                                                                                                                                          </p>

                                                                                                                                                                          <p>
                                                                                                                                                                              <em>联系电话：</em>
                                                                                                                                                                              <input class="mp" name="mobile" type="text" id="mobile1" value="<?php echo ($resumeInfo['mobile']); ?>">
                                                                                                                                                                          </p>
                                                                                                                                                                      </li>
                                                                                                                                                                      <li>
                                                                                                                                                                          <p class="firstP">
                                                                                                                                                                              <em>邮箱：</em>
                                                                                                                                                                              <input type="text" name="email" id="emailed1"  value="<?php echo ($resumeInfo['email']); ?>">
                                                                                                                                                                          </p>

                                                                                                                                                                          <p>
                                                                                                                                                                              <em>QQ：</em>
                                                                                                                                                                              <input class="mp" type="text" name="qqnum" id="qqnum1"   value="<?php echo ($resumeInfo['qqnum']); ?>">
                                                                                                                                                                          </p>
                                                                                                                                                                      </li>
                                                                                                                                                                  </ul>

                                                                                                                                                                  <ul class="clearfix" style="height:185px;">
                                                                                                                                                                      <h4>附件简历</h4>
                                                                                                                                                                      <li class="h clearfix">
                                                                                                                                                                          <dl>
                                                                                                                                                                              <dt>
                                                                                                                                                                              <img src="/Public/img/scimg.png" alt="">
                                                                                                                                                                              <input type="file" id="imgfile" name="fi" size="40">
                                                                                                                                                                              </dt>
                                                                                                                                                                              <dd>
                                                                                                                                                                                  <p>上传附件</p>
                                                                                                                                                                                  <p>支持word、pdf、ppt、txt、wps格式文件</p>
                                                                                                                                                                                  <p>文件大小需小于10M</p>
                                                                                                                                                                                  <p>注：若从其它网站下载的word简历，请将文件另存为.docx格式后上传</p>
                                                                                                                                                                                  <?php if($resumeInfo['upload']){?>
                                                                                                                                                                                  <a href="<?php echo $resumeInfo['upload'];?>">简历-<?php echo $resumeInfo['wordname'];?></a>
                                                                                                                                                                                  <?php }?>
                                                                                                                                                                              </dd>
                                                                                                                                                                          </dl>
                                                                                                                                                                      </li>
                                                                                                                                                                  </ul>
                                                                                                                                                                  <ul class="clearfix" style="border:none;">
                                                                                                                                                                      <h4>推荐理由</h4>
                                                                                                                                                                      <div>
                                                                                                                                                                          <script id="editor" name="because" type="text/plain" style="width:776px;height:300px;margin-top:10px;"><?php echo ($resumeInfo[because]); ?></script>
                                                                                                                                                                      </div>
                                                                                                                                                                  </ul>
                                                                                                                                                              </div>
                                                                                                                                                              <div class="cn_btm">
                                                                                                                                                                  <input type="hidden" value="<?php echo ($resumeInfo['id']); ?>" name="resume_id">
                                                                                                                                                                  <input class="btn bianji" type="submit" value="保存">
                                                                                                                                                              </div>
                                                                                                                                                          </div>
                                                                                     </form> 
                                                                                     <form action="/index.php?s=/Home/Login/btjadd" method="post" enctype="multipart/form-data" onsubmit = "return savaResumeType(2);" name="submitForm">
                                                                                         <div class="cn cn2 Self Self2" <?php if($type==1) {echo "style='display:none'";}?>>
                                                                                              <div class="cn_tp" style="margin-top:0px;">
                                                                                                 <ul>
                                                                                                     <h4>基本信息</h4>
                                                                                                     <li>
                                                                                                         <p class="firstP">
                                                                                                             <em>姓名：</em>
                                                                                                             <input type="text" name="username" id="username2" value="<?php echo ($resumeInfo['username']); ?>">
                                                                                                         </p>

                                                                                                         <p>
                                                                                                             <i>性别：</i>
                                                                                                             <?php if($resumeInfo){?>
                                                                                                             <label for="n">男</label>
                                                                                                             <input  name="sex" type="radio" value="0" <?php if($resumeInfo['sex']==0) echo "checked";?>>
                                                                                                                     <label for="v">女</label>
                                                                                                             <input  name="sex" type="radio" value="1" <?php if($resumeInfo['sex']==1) echo "checked";?>>

                                                                                                                     <?php }else{?>
                                                                                                                     <label for="n">男</label>
                                                                                                             <input  name="sex" type="radio" value="0" checked>
                                                                                                             <label for="v">女</label>
                                                                                                             <input  name="sex" type="radio" value="1">
                                                                                                             <?php }?>
                                                                                                             <i>年龄：</i>
                                                                                                             <input class="age" type="text" name="age" id="age2" value="<?php echo ($resumeInfo['age']); ?>">
                                                                                                         </p>
                                                                                                     </li>
                                                                                                     <li>
                                                                                                         <p class="firstP">
                                                                                                             <em>在职状态：</em>
                                                                                                             <select name="state" id="state2"> 
                                                                                                                 <option value="请选择">请选择</option>
                                                                                                                 <?php if(is_array($zzstatus)): $i = 0; $__LIST__ = $zzstatus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$zzstatuslist): $mod = ($i % 2 );++$i;?><option value="<?php echo ($zzstatuslist['datavalue']); ?>" <?php if($zzstatuslist['datavalue'] == $resumeInfo['state']): ?>selected<?php endif; ?>><?php echo ($zzstatuslist['dataname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>  
                                                                                                             </select> 
                                                                                                         </p>

                                                                                                         <p>
                                                                                                             <em>联系电话：</em>
                                                                                                             <input class="mp" name="mobile" type="text" id="mobile2" value="<?php echo ($resumeInfo['mobile']); ?>">
                                                                                                         </p>
                                                                                                     </li>
                                                                                                     <li>
                                                                                                         <p class="firstP">
                                                                                                             <em>邮箱：</em>
                                                                                                             <input type="text" name="email" id="emailed2"  value="<?php echo ($resumeInfo['email']); ?>">
                                                                                                         </p>

                                                                                                         <p>
                                                                                                             <em>QQ：</em>
                                                                                                             <input class="mp" type="text" name="qqnum" id="qqnum2"   value="<?php echo ($resumeInfo['qqnum']); ?>">
                                                                                                         </p>
                                                                                                     </li>
                                                                                                 </ul>
                                                                                                 <ul class="clearfix" style="border:none;">
                                                                                                     <h4>自我评价</h4>
                                                                                                     <div>
                                                                                                         <script id="editor2" type="text/plain" style="width:776px;height:300px;margin-top:10px;" name="personal"><?php echo ($resumeInfo[personal]); ?></script>
                                                                                                     </div>
                                                                                                 </ul>

                                                                                                 <ul class="clearfix" style="border:none;">
                                                                                                     <h4>教育经历</h4>
                                                                                                     <div>
                                                                                                         <script id="editor3" type="text/plain" style="width:776px;height:300px;margin-top:10px;" name="education"><?php echo ($resumeInfo[education]); ?></script>
                                                                                                     </div>
                                                                                                 </ul>

                                                                                                 <ul class="clearfix" style="border:none;">
                                                                                                     <h4>工作经历</h4>
                                                                                                     <div>
                                                                                                         <script id="editor4" type="text/plain" style="width:776px;height:300px;margin-top:10px;"  name="workexper"><?php echo ($resumeInfo[workexper]); ?></script>
                                                                                                     </div>
                                                                                                 </ul>

                                                                                                 <ul class="clearfix" style="border:none;">
                                                                                                     <h4>自理证书</h4>
                                                                                                     <div>
                                                                                                         <script id="editor5" type="text/plain" style="width:776px;height:300px;margin-top:10px;"   name="cercate"><?php echo ($resumeInfo[cercate]); ?></script>
                                                                                                     </div>
                                                                                                 </ul>

                                                                                                 <ul class="clearfix" style="border:none;">
                                                                                                     <h4>推荐理由</h4>
                                                                                                     <div>
                                                                                                         <script id="editor6" type="text/plain" style="width:776px;height:300px;margin-top:10px;"  name="because"><?php echo ($resumeInfo[because]); ?></script>
                                                                                                     </div>
                                                                                                 </ul>
                                                                                                 <p style="margin-left:14px;" class="error4">请填写姓名</p>
                                                                                             </div>
                                                                                             <div class="cn_btm">
                                                                                                 <input type="hidden" value="<?php echo ($resumeInfo['id']); ?>" name="resume_id">
                                                                                                 <input class="btn bianji" type="submit" value="保存">
                                                                                             </div>
                                                                                         </div>
                                                                                     </form>

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
            <script type="text/javascript">
                function savaResumeType(type) {
                    var username = $("#username" + type).val();
                    var age = $("#age" + type).val();
                    var state = $("#state" + type).val();
                    var mobile = $("#mobile" + type).val();
                    var email = $("#emailed" + type).val();
                    var qqnum = $("#qqnum" + type).val();
                    if (!username) {
                        $('.PersData .cn2 .cn_tp p.error4').html('请填写姓名');
                        $('.PersData .cn2 .cn_tp p.error4').show();
                        return false;
                    }
                    if (!age) {
                        $('.PersData .cn2 .cn_tp p.error4').html('请填写年龄');
                        $('.PersData .cn2 .cn_tp p.error4').show();
                        return false;
                    }
                    if (!state) {
                        $('.PersData .cn2 .cn_tp p.error4').html('请选择在职状态');
                        $('.PersData .cn2 .cn_tp p.error4').show();
                        return false;
                    }
                    if (!mobile) {
                        $('.PersData .cn2 .cn_tp p.error4').html('请填写手机');
                        $('.PersData .cn2 .cn_tp p.error4').show();
                        return false;
                    }
                    if (!email) {
                        $('.PersData .cn2 .cn_tp p.error4').html('请填写邮箱');
                        $('.PersData .cn2 .cn_tp p.error4').show();
                        return false;
                    }
                    /*
                    if (!qqnum) {
                        $('.PersData .cn2 .cn_tp p.error4').html('请填写qq');
                        $('.PersData .cn2 .cn_tp p.error4').show();
                        return false;
                    }
                    */
                    return true;
                }
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

                    $('#tj').on('click', function() {
                        $("#tj>input").val(0);

                    })

                    $('#com').on('click', function() {
                        $("#tj>input").val(1);
                    })
                })
                function checkuser()
                {
                    var username = $(".zhuceUser").val();
                    if (username != "")
                    {
                        if (/^[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{6,24}$/.test(username)) {

                            $.ajax({
                                type: "get",
                                data: {"username": username},
                                url: "/index.php?s=/Home/Login/check",
                                success: function(data)
                                {
                                    if (data == "0")
                                    {
                                        $(".error").html("用户名已注册");
                                        $('.error').show();
                                        return true;
                                    }
                                    else if (data == "1")
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
            <script type="text/javascript">

                //实例化编辑器
                //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
                var ue1 = UE.getEditor('editor');

                var ue2 = UE.getEditor('editor2');

                var ue3 = UE.getEditor('editor3');
                var ue4 = UE.getEditor('editor4');
                var ue5 = UE.getEditor('editor5');
                var ue6 = UE.getEditor('editor6');


                function getContentTxt() {
                    var arr = [];
                    arr.push("使用editor.getContentTxt()方法可以获得编辑器的纯文本内容");
                    arr.push("编辑器的纯文本内容为：");
                    arr.push(UE.getEditor('editor').getContentTxt());
                    // 
                    if (
                            ue1.getContentTxt() == "" ||
                            ue1.getContentTxt() == "" ||
                            ue2.getContentTxt() == "" ||
                            ue3.getContentTxt() == "" ||
                            ue4.getContentTxt() == "" ||
                            ue5.getContentTxt() == "" ||
                            ue6.getContentTxt() == "")
                    {
                        //  alert("您有没有填写的内容")
                    }
                    else {
                        // alert(UE.getEditor('editor').getContentTxt());
                    }
                    ;
                }
                function setContent(isAppendTo) {
                    alert(222);
                    var arr = [];
                    arr.push("使用editor.setContent('欢迎使用ueditor')方法可以设置编辑器的内容");
                    UE.getEditor('editor').setContent('欢迎使用ueditor', isAppendTo);
                    alert(arr.join("\n"));
                }
                $('.bianji').on('click', function() {
                    getContentTxt();
                });
                /*
                 $(function(){
                 var gsjanjie = '<?php echo ($resumeInfo[because]); ?>';
                 ue1.setContent(gsjanjie);
                 })
                 */


            </script>
        </body>

    </html>