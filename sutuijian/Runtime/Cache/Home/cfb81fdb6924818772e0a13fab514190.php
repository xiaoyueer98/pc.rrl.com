<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎</title>
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/focuspic.js"></script>
        <script type="text/javascript" src="/Public/js/menu_v.js"></script>
        <script type="text/javascript" src="/Public/js/script.js"></script>
        <script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.config.js"></script>
        <script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.all.min.js"> </script>
        <script type="text/javascript" charset="utf-8" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
        <script type="text/javascript" src="/Public/js/mourse.js"></script>
        <link rel="stylesheet" type="text/css" href="/Public/css/resizer.css">
        <link rel="stylesheet" href="/Public/css/focuspic.css" />
        <link rel="stylesheet" href="/Public/css/menu_v.css" />
        <script type="text/javascript" src="/Public/js/jquery.ui.js"></script>

        <link rel="stylesheet" type="text/css" href="/Public/css/style.css">
        <link rel="stylesheet" href="/Public/css/smoothness/jquery.ui.css" type="text/css" />
    </head>
    <body>
        <!-- 遮罩层 -->
        <div class="mask" id="mask"></div>
    <div id="conZhuce" class="zhuce">
    <a class="Close"></a>
    <h3></h3>
    <dl>
        <dt>

        <!--   <form action ="/index.php?s=/Home/Company/add" method ="post" id="form" onsubmit="return checkSendJob()">   -->
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
            <input class="radio1" type="radio" name="xieyi">
            <span>已阅读并接受人人猎网<a href="">《用户协议和隐私条款》</a></span>
        </div>
        <input type="button" class="zhucequeren"  value="确认" id="zhucebutton" >
        <!--   </form>  -->
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
        $("#zhucebutton").attr("disabled", "disabled");
        $.post("/index.php?s=/Home/Company/add", {
            'username': username,
            'email': email,
            'password': password,
            'usertype': usertype
        }, function(data) {
            if (data.code == 200) {
                location.href = "/index.php?s=/Home/Company/register&email="+email;
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
        <!--	<form action ="/index.php?s=/Home/Company/userlogin" id="dlform" method ="post">   -->
        <ul class="InputUl">
            <li><input class="DLUser" type="text" name="usernamees" /><span>请输入用户名</span></li>
            <li><input class="DLpassword" type="password" name="passwordes"/><span>请输入密码</span></li>
            <p class="error2"></p>
        </ul>
        <div class="yanzheng">
            <b></b>
            <span>记住我<a href="/index.php?s=/Home/Company/huopass">忘记密码？</a></span>
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
        <li>系统检测到你有另外一个相同的用于<span>企业</span>登录的用户ID<br>请你下次使用以下ID登录<span>推荐人页面</span></li>
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

        $.post("/index.php?s=/Home/Company/userlogin", {
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
            <img src="/Public/img/logo.png" alt="" id="compic">
        </a>
    </div>
   
    <ul class="pd">
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
                <li><a href="<?php echo U('Company/companySendJob');?>"><em <?php  if($second_class == "11"){ echo 'class="hre"';}?>>发布招聘 </em></a></li>
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
        <li class="btn"><span><i><img src="/Public/img/pd_icon5.png" alt=""></i><b><a href="<?php echo U('Company/companySendJob');?>"><em>发布职位</em></a></b></li>
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
             url: "/index.php?s=/Home/Company/ajaxReturn",
             success: function(e){
					$("#ajaxposi").html(e);
             }

         });
	});
//-->
</script>
        <div class="PersData peoplerenm">
            <form action="/index.php?s=/Home/Company/companySendJobAdd" method="post" enctype="multipart/form-data" onsubmit="return checkSendJob()">

                <h3 class="til">发布职位</h3>
                <form action="/index.php?s=/Home/Company/xinxi" method="post" >
                    <div class="cn cn2 Self Self2">
                        <div class="cn_tp" style="margin-top:0px;">
                            <ul>
                                <h4>基本信息</h4>
                                <li>
                                    <p class="firstP" style="width:auto;margin-right:40px;">
                                        <em>职位名称：</em>

                                        <input type="text" style="width:198px;" name = "title" id = "title">
                                    </p>
                                    <p class="firstP" style="width:auto;margin-right:40px;display:block">
                                        <em>行业类别：</em>
                                        <!-- <select id="strycate" name="strycate">
                                            <?php if(is_array($hyData)): $i = 0; $__LIST__ = $hyData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hy): $mod = ($i % 2 );++$i;?><option value="<?php echo ($hy['id']); ?>"><?php echo ($hy['cascname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select> -->

                                        <select  id="strycate1" onchange="changeHy($(this).val(),'strycate')">
                                            <option value="请选择">请选择</option>
                                            <?php if(is_array($hyData)): $i = 0; $__LIST__ = $hyData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$HY): $mod = ($i % 2 );++$i;?><option value="<?php echo ($HY['id']); ?>"><?php echo ($HY['cascname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                                        </select>
                                        <select name="strycate" id="strycate">
                                            <option>请选择行业</option>
                                        </select> 

                                    <p class="firstP" style="width:auto;margin-right:40px;">
                                        <em>职位类别：</em>
                                        <select  id="Jobcate1" onchange="changeHy($(this).val(),'Jobcate')">
                                            <option value="请选择">请选择</option>
                                            <?php if(is_array($zwData)): $i = 0; $__LIST__ = $zwData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ZW): $mod = ($i % 2 );++$i;?><option value="<?php echo ($ZW['id']); ?>"><?php echo ($ZW['cascname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                        <select name="Jobcate" id="Jobcate">
                                            <option>请选择职位</option>
                                        </select> 

                                    </p>
                                </li>
                                <li>
                                    <p class="firstP" style="width:auto;margin-right:10px">
                                        <em>语言能力：</em>
                                        <select id="joblang" name="joblang">
                                            <?php if(is_array($ynData)): $i = 0; $__LIST__ = $ynData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$yn): $mod = ($i % 2 );++$i;?><option value="<?php echo ($yn['datavalue']); ?>"><?php echo ($yn['dataname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                    </p>

                                    <p class="firstP" style="width:auto;margin-right:10px">
                                        <em>招聘人数：</em>
                                        <input type="number" style="width:108px;" name = "employ" id = "employ">
                                    </p>
                                    <p class="firstP" style="width:auto;margin-right:10px">
                                        <em>月薪待遇：</em>
                                        <select onchange="treatmentChange()" style="width:128px; padding-left:10px; height:26px; line-height:26px; border-radius:5px;" name = "treatment" id = "treatment">
                                            <option value="0">请选择</option>
                                            <?php if(is_array($jobInfo[1]['config_list'])): $i = 0; $__LIST__ = $jobInfo[1]['config_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$arConfigList): $mod = ($i % 2 );++$i;?><option value="<?php echo ($arConfigList['datavalue']); ?>" tar="<?php echo ($arConfigList['id']); ?>"><?php echo ($arConfigList['dataname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>										
                                        </select>
                                    </p>
                                </li>
                                <li>
                                    <p class="firstP"  style="width:auto;margin-right:10px">
                                        <em>工作地点：</em>

                                        <select id="dq" onchange="changeHy($(this).val(),'jobplace')">
                                            <option value="请选择">请选择</option>
                                            <?php if(is_array($dqData)): $i = 0; $__LIST__ = $dqData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$DQ): $mod = ($i % 2 );++$i;?><option value="<?php echo ($DQ['id']); ?>"><?php echo ($DQ['cascname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                        <select name="jobplace" id="jobplace">
                                            <option>请选择市</option>
                                        </select> 
                                    </p>

                                    <p class="firstP"  style="width:auto;margin-right:10px">
                                        <em>工作经验：</em>
                                        <select style="width:108px; padding-left:30px; height:26px; line-height:26px; border-radius:5px;" name = "experience" id = "experience">
                                            <option value="0">请选择</option>
                                            <?php if(is_array($jobInfo[2]['config_list'])): $i = 0; $__LIST__ = $jobInfo[2]['config_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$arConfigList): $mod = ($i % 2 );++$i;?><option value="<?php echo ($arConfigList['datavalue']); ?>"><?php echo ($arConfigList['dataname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                    </p>
                                    <p class="firstP"  style="width:auto;margin-right:10px">
                                        <em>学历要求：</em>
                                        <select style="width:108px; padding-left:30px; height:26px; line-height:26px; border-radius:5px;" name = "education" id = "education">
                                            <option value="0">请选择</option>
                                            <?php if(is_array($jobInfo[3]['config_list'])): $i = 0; $__LIST__ = $jobInfo[3]['config_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$arConfigList): $mod = ($i % 2 );++$i;?><option value="<?php echo ($arConfigList['datavalue']); ?>"><?php echo ($arConfigList['dataname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                    </p>
                                </li>
                                <li>
                                    <p class="firstP"  style="width:auto;margin-right:40px">
                                        <em>截止时间：</em>
                                        <input type="text" readonly="readonly" name = "endtime" id = "date" style="height:24px;margin-left:1px;width:87px;">
                                    </p>
                                </li>
                            </ul>
                            <ul class="clearfix">
                                <h4>工作职责</h4>
                                <textarea name = "editor" id = "editor" placeholder="对大家介绍一下公司吧" style="width:776px;height:300px;margin-top:10px;"></textarea>
                            </ul>

                            <ul class="clearfix">
                                <h4>岗位要求</h4>
                                <textarea name = "editor1" id = "editor1" placeholder="对大家介绍一下公司吧" style="width:776px;height:300px;margin-top:10px;"></textarea>
                            </ul>

                            <ul class="clearfix qita">
                                <h4>其他：</h4>
                                <li class="clearfix"><em>本职位管理者联系方式：</em><input type="radio" id = "meth" name = "meth" checked value="1" onclick="clickDefault('default')"><em>使用默认联系方式</em><input type="radio" name = "meth" value="2" id = "meth" onclick="clickDefault('write')"><em>使用其他联系方式</em>
                                </li>
                                <li class="clearfix" style="display:none;margin-left:294px;" id="defaults">
                                    <input type="text" placeholder="输入联系人姓名姓名" name = "email" id = "email" >
                                    <input type="text" placeholder="输入手机号"  name = "mobile" id = "mobile">
                                </li>
                                <li class="clearfix"><span>招聘资费：</span><input type="text" name = "Tariff" id = "tariff" siz="5"><em>00元&nbsp;&nbsp;</em><span id = "money"></span></li>
                                <li class="clearfix"><p class="error3" style="">您有未填写项目</p></li>
                            </ul>
                        </div>
                        <div class="cn_btm">
                            <input class="btn bianji" type="submit" value="发布职位">
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
</body>
<script type="text/javascript">
    
    function changeHy(b,h){
        if(b !== "请选择"){
            $.ajax({
                type: "post",
                data:{"id":b},
                dataType:"json",
                url: "/index.php?s=/Home/Company/getData",
                success: function(datas){
                    
                   
                    if(h == "strycate"){
                        var html = "<option>请选择行业</option>";
                    }else if(h == "Jobcate"){
                        var html = "<option>请选择职位</option>";
                    }else if(h == "jobplace"){
                        var html = "<option>请选择市</option>";
                    }
                    for(var i=0;i<datas.length;i++){
                        html+="<option value='"+datas[i].id+"'>"+datas[i].cascname+"</option>";
                    }
                    $("#"+h).html(html);
                }

            });
        }
    }

    var arrTariff = {"20197":"5000","20121":"5000","20122":"8000","20123":"12000","20132":"15000","20134":"25000","20135":"35000","20136":"50000",}
    $(document).ready(function(){
        var catList = $( ".J_Cat" );
		
        catList.on( "mouseenter", function(){
            var id = $(this).attr('data-id');
            $.ajax({
                type: "get",
                data:{"id":id},
                url: "/index.php?s=/Home/Company/ajaxReturn",
                success: function(e){
                    $("#ajaxposi").html(e);
                }

            });
        });



        /*-----------------------冯辉-----------------------*/

        $('.xuanze').on('click',function(){
            $('.tuanchu1').show();
        });

        $('#tj').on( 'click',function(){
            $("#tj>input").val(0);

        } )
		
        $('#com').on( 'click',function(){
            $("#tj>input").val(1);
        } )
    })
    function treatmentChange(){
        $("#money").text("(招聘资费不能低于"+arrTariff[$("#treatment  option:selected").attr("tar")]+")");
    }
    function checkSendJob(){
        var title = $("#title").val();
        var strycate = $("#strycate").val();
     
        var jobcate  = $("#jobcate").val();
        var joblang  = $("#joblang").val();
        var employ   = $("#employ").val();
		
        var treatment= $("#treatment   option:selected").attr("tar");
        var jobplace = $("#jobplace").val();
        var experience= $("#experience").val();
        var education= $("#education").val();

        var workdesc = ue.getContent();
        var content  = ue2.getContent();
 
        var tariff   = $("#tariff").val();
        var meth     = $("#meth").val();
        var email    = $("#email").val();
        var mobile   = $("#mobile").val();
        var reg      = /^1[3|4|5|8][0-9]\d{4,8}$/;
        var numreg   = /[0-9]*/;  
       
        if(!title){
            $('.center .peoplerenm ul li p.error3').html('职位名称不能为空');
            $('.center .peoplerenm ul li p.error3').show();
            return false;
        }
        if(title.length>50){
            $('.center .peoplerenm ul li p.error3').html('职位名称信息过长');
            $('.center .peoplerenm ul li p.error3').show();
            return false;
        }
        if(strycate == "请选择行业"){
            $('.center .peoplerenm ul li p.error3').html('请选择您招聘的详细行业');
            $('.center .peoplerenm ul li p.error3').show();
            return false;
        }else if(jobcate == "请选择职位"){
            $('.center .peoplerenm ul li p.error3').html('请选择您招聘的详细职位');
            $('.center .peoplerenm ul li p.error3').show();
            return false;
        }else if(!numreg.test(employ) || employ<1){
            $('.center .peoplerenm ul li p.error3').html('招聘人数格式不正确');
            $('.center .peoplerenm ul li p.error3').show();
            return false;
        }else if(treatment == 0){
            $('.center .peoplerenm ul li p.error3').html('请选择月薪待遇');
            $('.center .peoplerenm ul li p.error3').show();
            return false;
        }else if(jobplace == "请选择市"){
            $('.center .peoplerenm ul li p.error3').html('请选择工作地点');
            $('.center .peoplerenm ul li p.error3').show();
            return false;
        }else if(experience == 0){
            $('.center .peoplerenm ul li p.error3').html('请选择工作经验');
            $('.center .peoplerenm ul li p.error3').show();
            return false;
        }else if(education == 0){
            $('.center .peoplerenm ul li p.error3').html('请选择学历要求');
            $('.center .peoplerenm ul li p.error3').show();
            return false;
        }else if(!workdesc){
            $('.center .peoplerenm ul li p.error3').html('工作职责不能为空');
            $('.center .peoplerenm ul li p.error3').show();
            return false;
        }else if(!content){
            $('.center .peoplerenm ul li p.error3').html('岗位要求不能为空');
            $('.center .peoplerenm ul li p.error3').show();
            return false;
        }else if(mobile){
            if(!reg.test(mobile)){
                $('.center .peoplerenm ul li p.error3').html('手机号格式错误');
                $('.center .peoplerenm ul li p.error3').show();
                return false;
            }
        }else  if(!tariff){
            $('.center .peoplerenm ul li p.error3').html('招聘资费不能为空');
            $('.center .peoplerenm ul li p.error3').show();
            return false;
        }else if((tariff*100) < eval(arrTariff[treatment])){
            $('.center .peoplerenm ul li p.error3').html("招聘自费不能低于"+arrTariff[treatment]);
            $('.center .peoplerenm ul li p.error3').show();
            return false;
        }
        return true;
    }
	
    function clickDefault(obj){
        var defaults    = $("#defaults");
        if(obj == "default"){
            defaults.hide();
        }else{
            defaults.show();
        }
    }
	
    function checkuser()
    {
        var username = $(".zhuceUser").val();
        if(username!="")
        {
            if(/^[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{6,24}$/.test(username)){

                $.ajax({

                    type:"get",
                    data:{"username":username},
                    url:"/index.php?s=/Home/Company/check",
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
<script type="text/javascript">

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor');
    var ue2 = UE.getEditor('editor1');

    function isFocus(e){
        alert(UE.getEditor('editor').isFocus());
        UE.dom.domUtils.preventDefault(e)
    }
    function setblur(e){
        UE.getEditor('editor').blur();
        UE.dom.domUtils.preventDefault(e)
    }
    function insertHtml() {
        var value = prompt('插入html代码', '');
        UE.getEditor('editor').execCommand('insertHtml', value)
    }
    function createEditor() {
        enableBtn();
        UE.getEditor('editor');
    }
    function getAllHtml() {
       // alert(UE.getEditor('editor').getAllHtml())
    }
    function getContent() {
        var arr = [];
        //arr.push("使用editor.getContent()方法可以获得编辑器的内容");
        //arr.push("内容为：");
        //arr.push(UE.getEditor('editor').getContent());
        //var aa = $.parseJSON( ue.getContent() );
       // alert(ue.getContent());
    }
   

    function getPlainTxt() {
        var arr = [];
        arr.push("使用editor.getPlainTxt()方法可以获得编辑器的带格式的纯文本内容");
        arr.push("内容为：");
        arr.push(UE.getEditor('editor').getPlainTxt());
       // alert(arr.join('\n'))
    }
    function setContent(isAppendTo) {
        var arr = [];
        arr.push("使用editor.setContent('欢迎使用ueditor')方法可以设置编辑器的内容");
        UE.getEditor('editor').setContent('欢迎使用ueditor', isAppendTo);
       // alert(arr.join("\n"));
    }
    function setDisabled() {
        UE.getEditor('editor').setDisabled('fullscreen');
        disableBtn("enable");
    }

    function setEnabled() {
        UE.getEditor('editor').setEnabled();
        enableBtn();
    }

    function getText() {
        //当你点击按钮时编辑区域已经失去了焦点，如果直接用getText将不会得到内容，所以要在选回来，然后取得内容
        var range = UE.getEditor('editor').selection.getRange();
        range.select();
        var txt = UE.getEditor('editor').selection.getText();
        //alert(txt)
    }

    function getContentTxt() {
        var arr = [];
        /*arr.push("使用editor.getContentTxt()方法可以获得编辑器的纯文本内容");
        arr.push("编辑器的纯文本内容为：");
        arr.push(UE.getEditor('editor').getContentTxt());*/
       // alert(UE.getEditor('editor').getContentTxt());
    }
    $('.bianji').on('click',function(){
        getContentTxt();

    });
    function hasContent() {
        var arr = [];
        arr.push("使用editor.hasContents()方法判断编辑器里是否有内容");
        arr.push("判断结果为：");
        arr.push(UE.getEditor('editor').hasContents());
       // alert(arr.join("\n"));
    }
    function setFocus() {
        UE.getEditor('editor').focus();
    }
    function deleteEditor() {
        disableBtn();
        UE.getEditor('editor').destroy();
    }
    function disableBtn(str) {
        var div = document.getElementById('btns');
        var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            if (btn.id == str) {
                UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
            } else {
                btn.setAttribute("disabled", "true");
            }
        }
    }
    function enableBtn() {
        var div = document.getElementById('btns');
        var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
        }
    }

    function getLocalData () {
       // alert(UE.getEditor('editor').execCommand( "getlocaldata" ));
    }

    function clearLocalData () {
        UE.getEditor('editor').execCommand( "clearlocaldata" );
       // alert("已清空草稿箱")
    }
</script>
<script>
    $(function () {

        $('#search_button').button({
            icons : {
                primary : 'ui-icon-search',
            },
        });
    

        $('#reg').dialog({
            autoOpen : true,
            modal : true,
            resizable : false,
            width : 320,
            height : 340,
            buttons : {
                '提交' : function () {
                
                }
            }
        });
    
        $('#reg').buttonset();
    
        $('#date').datepicker({
            dateFormat : 'yy-mm-dd',
            //dayNames : ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],
            //dayNamesShort : ['星期日','星期一','星期二','星期三','星期四','星期五','星期六'],
            dayNamesMin : ['日','一','二','三','四','五','六'],
            monthNames : ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
            monthNamesShort : ['一月','二月','三月','四月','五月','六月','七月','八月','九月','十月','十一月','十二月'],
            altField : '#abc',
            altFormat : 'dd/mm/yy',
            //appendText : '日历',
            showWeek : true,
            weekHeader : '周',
            firstDay : 1,
            //disabled : true,
            //numberOfMonths : 3,
            //numberOfMonths : [3,2],
            //showOtherMonths : true,
            //selectOtherMonths : true,
            changeMonth : true,
            changeYear : true,
            //isRTL : true,
            //autoSize : true,
            //showOn : 'button',
            //buttonText : '日历',
            //buttonImage : 'img/calendar.gif',
            //buttonImageOnly : true,
            showButtonPanel : true,
            closeText : '关闭',
            currentText : '今天dd',
            //nextText : '下个月mm',
            //prevText : '上个月mm',
            //navigationAsDateFormat : true,
            //yearSuffix : '年',
            //showMonthAfterYear : true,
        
            //日期的限制优先级，min和max最高
        
            minDate : 0,                //但是年份有另外一个属性进行了限制
            //hideIfNoPrevNext : true,
        
            //而maxDate和minDate只是限制日期，而年份的限制的优先级没有另外一个高
            yearRange : '0:2220',
            maxDate : new Date(2215,1,1),
            //defaultDate : -1,
        
            //gotoCurrent : true,
        
            //showAnim : true,
            //duration : 1000,
            //showAnim : 'slide',
            //beforeShow : function () {
            //  alert('日历显示之前被调用！');
            //}
        
            //beforeShowDay : function (date) {
            //  if (date.getDate() == 1) {
            //      return [false, 'a', '不能选择1号'];
            //  } else {
            //      return [true];
            //  }
            //}
        
            //onChangeMonthYear : function (year, month, inst) {
            //alert('日历中年份或月份改变时激活！');
            //alert(year);
            //alert(month);
            //alert(inst.id);
            //}
        
            //onSelect : function (dateText, inst) {
            //  alert(dateText);
            //}
        
            //onClose : function (dateText, inst) {
            //  alert(dateText);
            //}
        });
    
        //alert($('#date').datepicker('getDate').getFullYear());
        $('#date').datepicker('setDate', '2013-2-1');
    
        $('#reg input[title]').tooltip({
            show : false,
            hide : false,
            position : {
                my : 'left center',
                at : 'right+5 center'
            },
        });
    
    
        $('#email').autocomplete({
            delay : 0,
            autoFocus : true,
            source : function (request, response) {
                //获取用户输入的内容
                //alert(request.term);
                //绑定数据源的
                //response(['aa', 'aaaa', 'aaaaaa', 'bb']);
            
                var hosts = ['qq.com', '163.com', '263.com', 'sina.com.cn','gmail.com', 'hotmail.com'],
                term = request.term,        //获取用户输入的内容
                name = term,                //邮箱的用户名
                host = '',                  //邮箱的域名
                ix = term.indexOf('@'),     //@的位置
                result = [];                //最终呈现的邮箱列表
                
                
                result.push(term);
            
                //当有@的时候，重新分别用户名和域名
                if (ix > -1) {
                    name = term.slice(0, ix);
                    host = term.slice(ix + 1);
                }
            
                if (name) {
                    //如果用户已经输入@和后面的域名，
                    //那么就找到相关的域名提示，比如bnbbs@1，就提示bnbbs@163.com
                    //如果用户还没有输入@或后面的域名，
                    //那么就把所有的域名都提示出来
                
                    var findedHosts = (host ? $.grep(hosts, function (value, index) {
                        return value.indexOf(host) > -1
                    }) : hosts),
                    findedResult = $.map(findedHosts, function (value, index) {
                        return name + '@' + value;
                    });
                
                    result = result.concat(findedResult);
                }
            
                response(result);
            },  
        });
    

    });
</script>
</html>