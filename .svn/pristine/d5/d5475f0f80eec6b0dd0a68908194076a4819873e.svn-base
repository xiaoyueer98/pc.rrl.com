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
        <!-- 注册弹出框 -->
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
                <li><a href="<?php echo U('Login/SucceRecom');?>"><em <?php  if($second_class == "6"){ echo 'class="hre"';}?>>成功推荐 </em></a></li>
                <li><a href="<?php echo U('Login/HistOfRecom');?>"><em <?php  if($second_class == "7"){ echo 'class="hre"';}?>>历史推荐 </em></a></li>
            </ul>
        </li>
        <li class="pd_list">
            <span><i><img src="/Public/img/pd_icon3.png" alt=""></i><b>职位搜藏</b></span>
            <ul <?php  if($first_class == "3"){ echo 'style="display:block;"';}?>>
                <li><a href="<?php echo U('Login/JobSearch');?>"><em  <?php  if($second_class == "8"){ echo 'class="hre"';}?>>职位高级搜索</em></a></li>
                <li><a href="<?php echo U('Login/MyJobSearch');?>"><em  <?php  if($second_class == "9"){ echo 'class="hre"';}?>>我的搜索器</em></a></li>
                <li><a href="<?php echo U('Login/MyPosition');?>"><em <?php  if($second_class == "10"){ echo 'class="hre"';}?>>收藏的职位</em></a></li>
            </ul>
        </li>
        <li class="pd_list">
            <span><i><img src="/Public/img/pd_icon4.png" alt=""></i><b>我的账户</b></span>
            <ul <?php  if($first_class == "4"){ echo 'style="display:block;"';}?>>
                <li><a href="<?php echo U('Login/ReceivAccount');?>"><em <?php  if($second_class == "11"){ echo 'class="hre"';}?>>收款账号</em></a></li>
                <li><a href="<?php echo U('Login/DetailsFunds');?>"><em <?php  if($second_class == "12"){ echo 'class="hre"';}?>>资金明细</em></a></li>
                <li><a href="<?php echo U('Login/MyMessage1');?>"><em <?php  if($second_class == "13"){ echo 'class="hre"';}?>>我的消息</em></a></li>
                <li><a href=""><em <?php  if($second_class == "14"){ echo 'class="hre"';}?>>我的密码</em></a></li>
                <li><a href=""><em <?php  if($second_class == "15"){ echo 'class="hre"';}?>>退出账户</em></a></li>
            </ul>
        </li>

        <li class="btn"><a href="<?php echo U('Login/ModifyRencom');?>"><span><i><img src="/Public/img/pd_icon5.png" alt=""></i><b>增加推荐人</b></span></a></li>
    </ul>
    <div class="footer">
        <h3>服务热线</h3>
        <p>4006-685-596</p>
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
        <div class="gaojisosu">
            <div class="sk">
                <h3>职位高级搜索</h3>
                <div class="cn">
                    <ul>
                        <form action="" method="">
                            <li style="padding:0"><em>行业类别:</em>
                                <select  id="strycate1" onchange="changeHy($(this).val(),'strycate')"  style="width:140px">
                                    <option value="请选择">请选择</option>
                                    <?php if(is_array($hyData)): $i = 0; $__LIST__ = $hyData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$HY): $mod = ($i % 2 );++$i;?><option value="<?php echo ($HY['id']); ?>"><?php echo ($HY['cascname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                                </select>
                                <select name="strycate" id="strycate"  style="width:140px">
                                    <option>不限</option>
                                </select>

                                <em class="myem">职位类别:</em>
                                <select  id="Jobcate1" onchange="changeHy($(this).val(),'Jobcate')"  style="width:140px">
                                            <option value="请选择">请选择</option>
                                            <?php if(is_array($zwData)): $i = 0; $__LIST__ = $zwData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ZW): $mod = ($i % 2 );++$i;?><option value="<?php echo ($ZW['id']); ?>"><?php echo ($ZW['cascname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                        <select name="Jobcate" id="Jobcate"  style="width:140px">
                                            <option>不限</option>
                                        </select></li>
                            <li>
                                <em>工作地点:</em>
                               <select id="dq" onchange="changeHy($(this).val(),'jobplace')"  style="width:140px">
                                            <option value="请选择">请选择</option>
                                            <?php if(is_array($dqData)): $i = 0; $__LIST__ = $dqData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$DQ): $mod = ($i % 2 );++$i;?><option value="<?php echo ($DQ['id']); ?>"><?php echo ($DQ['cascname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select>
                                        <select name="jobplace" id="jobplace"  style="width:140px">
                                            <option>不限</option>
                                        </select>
                                <em> 工资待遇:</em>
                                <select name='treatment' id="treatment"  style="width:200px">
                                    <option value=''>不限</option>
                                    <?php if(is_array($money)): $i = 0; $__LIST__ = $money;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?><option value='<?php echo ($m["datavalue"]); ?>'><?php echo ($m["dataname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                                
                                <!--
                                <em>赏金：</em>
                                <select name='Tariff' id="Tariff">
                                    <option value=''>请选择</option>
                                    <?php if(is_array($smoney)): $i = 0; $__LIST__ = $smoney;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sm): $mod = ($i % 2 );++$i;?><option value='<?php echo ($sm["datavalue"]); ?>'><?php echo ($sm["dataname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                                -->
                            </li>
                          
                            <li>
                                <em>发布时间：</em>
                                <select name='puttime' id="puttime">
                                    <option value=''>请选择</option>
                                    <?php if(is_array($positime)): $i = 0; $__LIST__ = $positime;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pt): $mod = ($i % 2 );++$i;?><option value='<?php echo ($pt["datavalue"]); ?>'><?php echo ($pt["dataname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </li>
                            
                            <li class="sosuoLi" >
                                <span style="display: none">请输入行业类别</span>
                                <input type="button" class="btn" value="搜索" onclick="search()">
                            </li>
                        </form>
                        <li class="gr"><em>保存为个人搜索器：</em><input class="tex" type="text" value="给我起个名字吧"><input value="保存" class="btn" type="button"></li>
                    </ul>
                </div>
                <div class="SearchTag">
                    <ul class="LableUl">
                        <li><span  id="newdesc" onclick="search(this)">最新</span></li>
                        <li><span  id="newdesc" onclick="search(this)">薪资</span></li>
                        <li><span  id="newdesc" onclick="search(this)">赏金</span></li>
                        <li class="laseLabl">我的搜索标签</li>
                    </ul>
                    <ul class="listUl">



                        <?php if(is_array($comp)): $i = 0; $__LIST__ = $comp;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cp): $mod = ($i % 2 );++$i;?><li class="clearfix">
                                <em><img src="/Public/img/qiye_logo.png" alt=""></em>
                                <div> 
                                    <dt class="clearfix">
                                    <span class="Position"><a href="/index.php?s=/Home/Login/EnterIndex2&comid=<?php echo ($cp["id"]); ?>&jobid=<?php echo ($cp["jobid"]); ?>"><?php echo ($cp["cascname"]); ?></a><i></i></span>
                                    <span class="EntprisName"><a href="/index.php?s=/Home/Login/EnterIndex2&comid=<?php echo ($cp["id"]); ?>"><?php echo ($cp["cpname"]); ?></a></span>
                                    <span class="Salary"><i>￥</i><?php echo ($cp["dataname"]); ?></span>
                                    </dt>
                                    <dd class="clearfix">
                                        <span class="WorkAge"><a href="/index.php?s=/Home/Login/EnterIndex2&comid=<?php echo ($cp["id"]); ?>"><?php echo ($cp["ccas"]); ?></a></span>
                                        <span class="Education"><a href="/index.php?s=/Home/Login/EnterIndex2&comid=<?php echo ($cp["id"]); ?>"><?php echo ($cp["ccasc"]); ?></a></span>
                                        <span class="Education"><a href="/index.php?s=/Home/Login/EnterIndex&comid=<?php echo ($cp["id"]); ?>">更新于：<?php echo ($cp["starttime"]); ?></a></span>
                                        <span class="Place"><a href="Artand">￥<?php echo ($cp["Tariff"]); ?></a></span>
                                    </dd>
                                </div>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        <?php echo ($str); ?>
                        <input type="hidden" id="hid" value="1"/>
                    </ul>
                </div>
            </div>
        </div>
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
    function search(obj)
    {
        var newdesc=$("#this").val();
        var position = $("#position").val();
        var nowpage = $("#hid").val();
        var industry = $("#industry").val();
        var area = $("#area").val();
        var treatment = $("#treatment").val();
        var Tariff = $("#Tariff").val();
        var puttime = $("#puttime").val();
        var newdesc=$(obj).text();
        $.ajax({
			
            url:"/index.php?s=/Home/Login/searchs",
            type:"post",
            data:{"position":position,"industry":industry,"area":area,"treatment":treatment,"Tariff":Tariff,"puttime":puttime,"nowpage":nowpage,"newdesc":newdesc},
            url:"/index.php?s=/Home/Login/searchs",
            success:function(msg)
            {
                $(".listUl").html(msg);
            }
	
        });
    }
    function page(i){
        var position = $("#position").val();
        var industry = $("#industry").val();
        var area = $("#area").val();
        var treatment = $("#treatment").val();
        var Tariff = $("#Tariff").val();
        var puttime = $("#puttime").val();
        $.ajax({
            url:"/index.php?s=/Home/Login/page",
            type:"post",
            data:{'i':i,"position":position,"industry":industry,"area":area,"treatment":treatment,"Tariff":Tariff,"puttime":puttime},
            success:(function(mgsp){
                $(".listUl").html(mgsp);
            })
        });
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
<script type="text/javascript">

   
    function changeHy(b,h){
        if(b !== "请选择"){
            $.ajax({
                type: "post",
                data:{"id":b},
                dataType:"json",
                url: "/index.php?s=/Home/Login/getData",
                success: function(datas){
                    
                   
                    if(h == "strycate"){
                        var html = "<option>不限</option>";
                    }else if(h == "Jobcate"){
                        var html = "<option>不限</option>";
                    }else if(h == "jobplace"){
                        var html = "<option>不限</option>";
                    }
                    for(var i=0;i<datas.length;i++){
                        html+="<option value='"+datas[i].id+"'>"+datas[i].cascname+"</option>";
                    }
                    $("#"+h).html(html);
                }

            });
        }
    }
    function Jobsearch()
    {
        var industry = $("#industry").val();
        var position = $("#position").val();
        var area = $("#area").val();
        var treatment = $("#treatment").val();
        var Tariff = $("#Tariff").val();
        var puttime=$("#puttime").val();
        $.ajax({
			
            url:"/index.php?s=/Home/Login/JobSearch",
            data:{"industry":industry,"position":position,"area":area,"treatment":treatment,"Tariff":Tariff,"puttime":puttime},
            type:"get",
            success:function(msg)
            {
				
            }
		
        })

    }
</script>
</html>