<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
        <link rel="icon" href="/Public/img/favicon.ico" type="image/ico">
	<title>入职管理</title>
	<link rel="stylesheet" type="text/css" href="/Public/css/new-resizer.css">
	<link rel="stylesheet" type="text/css" href="/Public/css/new-company.css">
	<script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="/Public/js/al-index.js"></script>			
</head>
<body>
	<div class="qd-qx-alert">
		<p>确定删除此候选人记录吗？</p>
		<div>
			<span class="qd btn hover-hand m">确定</span>
			<span class="qx btn hover-hand">取消</span>
		</div>
	</div>
	<div class="dx_page">
		<div class="con">
		    <p>亲爱的<input type="text" style="width:50px" value="XXXX" id="bt_name">同学，我们诚挚邀请你于<input type="text" style="width:50px" value="XXXX" id="msdate">和我们<input type="text" value="<?php echo ($jobInfo['comname']); ?>" id="gs">面试，公司地点：<input type="text" value="<?php echo ($jobInfo['jobplace']); ?>" id="address">乘车路线<input type="text" value="XXXX" id="lx">，联系人<input type="text" value="<?php echo ($jobInfo['cnname']); ?>" id="lxr">，联系电话<input type="text" value="<?php echo ($jobInfo['telephone']); ?>" id="hm">。请勿迟到。 </p>
		    <input type="hidden" id="mobile">
		    <input class="fs" type="button" value="发送">
		    <span class="qx">取消</span>
		</div>
	</div>
	<div class="mask"></div>
	<div class="al-header">
    <div class="wrap">
        <div class="al-logo dis-inlin"><a href="/"><img src="/Public/img/new-index/al-logo.png" alt=""></a></div>
        <div class="al-nav dis-inlin fl-lef">
            <ul>
                <li class="dis-inlin fl-lef indx-li"><a <?php if($cur == index): ?>class="m"<?php endif; ?> href="/">首页</a></li>
                <li class="dis-inlin fl-lef"><a <?php if($cur == search): ?>class="m"<?php endif; ?> href="/Home/Index/search.html">职位</a></li>
                <li class="dis-inlin fl-lef"><a <?php if($cur == anli): ?>class="m"<?php endif; ?> href="/Home/Index/anli.html">案例</a></li>
                <li class="dis-inlin fl-lef"><a <?php if($cur == qa): ?>class="m"<?php endif; ?> href="/Home/public/qa.html">Q&A</a></li>
                <li class="dis-inlin fl-lef last-li"><a href="/Home/Active/salon_show.html">活动<img src="/Public/img/new-index/new.png" alt=""></a></li>
            </ul>
            
        </div>
        <?php if(!empty($_SESSION['username']) || !empty($_SESSION['cusername'])){ $username = ($_SESSION['username']?$_SESSION['username']:$_SESSION['cusername']); $arUserinfo = M("userinfo")->where("username='$username'")->find(); $flag = $arUserinfo['flag']; if($flag==1){ $arHaedUserinfo = M("company")->where("username='$username'")->find(); if($arHaedUserinfo['comlogo']){ $logoTmp = substr($arHaedUserinfo['comlogo'],0,1); if($logoTmp != "/"){ $arHaedUserinfo['comlogo'] = "/".$arHaedUserinfo['comlogo']; } } }elseif($flag==0){ $arHaedUserinfo = M("member")->where("username='$username'")->find(); } if(strlen($username)=="31" && substr($username,0,3) == "wx_"){ $username = "微信用户"; } if(substr($username,0,3) == "qq_"){ $username = $_COOKIE[$username]; } ?>
        <div class="al-right dis-inlin fl-rig" id="my-account">
            <div class="mydiv clearfix" id="my-account2"><span class="m-user dis-block dis-inlin fl-lef"><?php echo ($username); ?></span><span class="dis-block dis-inlin fl-rig account-jt"></span></div>

            <?php if($flag == "0"){ ?>
            <dl class="mydl">
                <dt class="fl-lef dis-inlin">
                <span class="head" style="display: block">
                    <?php if($flag==0 && isset($arHaedUserinfo['avatar']) && $arHaedUserinfo['avatar'] !='' && file_get_contents("http://".$_SERVER['SERVER_NAME']."/".$arHaedUserinfo['avatar'])):?>
                    <img src="<?php echo '/'.$arHaedUserinfo[avatar];?>" style="width: 124px;height: 124px">
                    <?php endif;?>
                </span>
                <!-- <span class="btn">更换头像<input type="file" class="sc"></span> -->
                </dt>
                <dd class="fl-lef dis-inlin" id="my-data">
                    <a class="a1 m fl-lef dis-inlin" href="/Home/Login/userinfo.html"><img src="/Public/img/new-index/a1.png" alt="">完善资料</a>
                    <a class="a2 fl-lef dis-inlin" href="/Home/Login/JobSearch.html"><img src="/Public/img/new-index/a2.png" alt="">推荐职位</a>
                    <a class="a3 fl-lef dis-inlin" href="/Home/Login/Recording.html"><img src="/Public/img/new-index/a3.png" alt="">跟踪状态</a>
                    <a class="a4 fl-lef dis-inlin" href="/Home/Login/DetailsFunds.html"><img src="/Public/img/new-index/a4.png" alt="">查看收益</a> 
                    <a class="a5 fl-lef dis-inlin" href="/Home/Login/Recommended.html"><img src="/Public/img/new-index/a5.png" alt="">简历库</a>
                    <a class="a6 fl-lef dis-inlin" href="/Home/Login/logout.html"><img src="/Public/img/new-index/a6.png" alt="">退出登录</a>
                </dd>
            </dl>
            <?php }elseif($flag == "1"){ ?>
            <dl class="mydl">
                <dt class="fl-lef dis-inlin">
                <span class="head">

                    <?php if($flag==1 && isset($arHaedUserinfo['comlogo']) && $arHaedUserinfo['comlogo'] !="" && file_get_contents("http://".$_SERVER['SERVER_NAME'].$arHaedUserinfo['comlogo'])):?>
                    <img src="<?php echo $arHaedUserinfo[comlogo];?>" style="width: 124px;height: 124px">
                    <?php endif;?>
                </span>
                <!-- <span class="btn">更换头像<input type="file" class="sc"></span> -->
                </dt>
                <dd class="fl-lef dis-inlin" id="my-data">
                    <a class="a1 m fl-lef dis-inlin" href="/Home/Company/EnterpriseInformation.html"><img src="/Public/img/company-img/al1.png" alt="">完善资料</a>
                    <a class="a2 fl-lef dis-inlin" href="/Home/Company/SignContract.html"><img src="/Public/img/company-img/al2.png" alt="">签订合同</a>
                    <a class="a3 fl-lef dis-inlin" href="/Home/Company/SendJob.html"><img src="/Public/img/company-img/al3.png" alt="">发布职位</a>
                    <a class="a4 fl-lef dis-inlin" href="/Home/Company/ResumeList.html"><img src="/Public/img/company-img/al4.png" alt="">查看候选人</a>
                    <a class="a5 fl-lef dis-inlin" href="/Home/Company/toBePaid.html"><img src="/Public/img/company-img/al5.png" alt="">入职管理</a>
                    <a class="a6 fl-lef dis-inlin" href="/Home/Login/logout.html"><img src="/Public/img/company-img/al6.png" alt="">退出登录</a>
                </dd>
            </dl>
            <?php } ?>
        </div>
        <?php }else{ ?>
        <div class="al-right dis-inlin fl-rig">
            <div class="mydiv2 clearfix" id="my-account2"><span class="dengluBtn hover-hand">登录</span><span class="zhuce1 hover-hand" id="zhuce">注册</span></div>
        </div>
        <?php } ?>

    </div>	
</div>

	<div class="wrap">
		<div class="ms1 clearfix">
			<div class="m1-l fl-lef">
				<img src="/Public/img/rcmd-img/reco-icon.png" alt="">
				<span>推荐人用户中心</span>
				<img src="/Public/img/rcmd-img/reco-icon.png" alt="">
			</div>
			<div class="m1-r fl-rig">
				<span class="gjz dis-block dis-inlin fl-lef">关键字</span>
				<div class="search dis-inlin fl-lef">
					<input id="searchbox" class="dis-block dis-inlin post fl-lef" value="" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; JAVA &nbsp; Android &nbsp; IOS " type="text">
					<span class="btn hover-hand dis-block dis-inlin post fl-lef btn-search">
						<img src="/Public/img/new-index/position-btn.png" alt="">
					</span>
				</div>
			</div>
		</div>
		<div class="ms2 clearfix">
			<div class="m2-l fl-lef">
    <div class="odiv hover-hand m">
        <span>1</span>
        <h6 class="tit1 m">完善资料<em class="m"></em></h6>
        <p class="tx m">方便推荐人了解公司及职位</p>
    </div>
    <i class="dis-block"><img src="/Public/img/rcmd-img/btmjd.png" alt=""></i>
    <div class="odiv hover-hand">
        <span>2</span>
        <h6 class="tit2">签订合同<em></em></h6>
        
        <p class="tx">签订合同后，就可以发布职位了</p>
    </div>
    <i class="dis-block"><img src="/Public/img/rcmd-img/btmjd.png" alt=""></i>
    <div class="odiv hover-hand">
        <span>3</span>
        <h6 class="tit3">发布职位<em></em></h6>
        <p class="tx">职位通过系统审核，就会有推荐</p>
    </div>
    <i class="dis-block"><img src="/Public/img/rcmd-img/btmjd.png" alt=""></i>
    <div class="odiv hover-hand">
        <span>4</span>
        <h6 class="tit4">查看候选人<em></em></h6>
        <p class="jlk">(简历库)</p>
        <p class="tx">如符合要求，请安排面试</p>
    </div>
    <i class="dis-block"><img src="/Public/img/rcmd-img/btmjd.png" alt=""></i>
    <div class="odiv hover-hand">
        <span>5</span>
        <h6 class="tit5">入职管理<em></em></h6>
        <p class="tx">候选人入职后，支付招聘费</p>
    </div>
</div>
			<div class="m2-r fl-rig">
				<ul class="nav nav2">
					<li class="first dis-block dis-inlin fl-lef m"><a class="m back-none " style="padding-left:0">推荐记录</a></li>
				</ul>
				<div class="add-resume track-state" style="display:block">
					<div class="con"> 
						<div class="titl">
							<span class="dis-block dis-inlin fl-lef">招聘职位：</span>
							<ul class="dis-block dis-inlin fl-lef select hover-hand">
								<li>全部职位</li>
								<ul>
									<li><a href="">php</a></li>
									<li><a href="">php</a></li>
									<li><a href="">php</a></li>
									<li><a href="">php</a></li>
									<li><a href="">php</a></li>
									<li><a href="">php</a></li>
									<li><a href="">php</a></li>
									<li><a href="">php</a></li>
									<li><a href="">php</a></li>
									<li><a href="">php</a></li>
									<li><a href="">php</a></li>
									<li><a href="">php</a></li>
								</ul>
							</ul>
							<div class="fl-lef r-div">
								<span class="dis-block dis-inlin fl-lef">招聘资费：</span>
								<span class="dis-block dis-inlin fl-lef">--</span>
							</div>
						</div>
					    <table style="width:689px;" class="data_list"> 
					    	<tbody> 
							    <tr class="t"> 
							    	<th>序号</th> 
							      	<th>候选人姓名</th> 
							      	<th>职位</th> 
							      	<th>推荐人</th> 
							      	<th>推荐时间</th> 
							      	<th>在职状态</th> 
							      	<th>可面试时间</th> 
							      	<th>联系方式</th> 
							      	<th>付款信息</th> 
							    </tr> 
							    <tr style="border:none;height:10px!important;">
							     	<td style="border:none;height:10px!important;"></td>
							    </tr>
							    <tr> 
							        <td class="wh35 wk" style="border-left: 1px solid #b3b3b3;">1</td> 
							     	<td class="wh66 wk table-text-left td-position"><img class="new" src="/Public/img/company-img/icon11.png" alt="">李三</td> 
							     	<td class="wh95 wk table-text-left">超级牛逼的高级设计师</td> 
							    	<td class="wh71 wk table-text-left">外三层</td> 
									<td class="wh69 wk hover-hand" tid="729"> 2015-06-11</td> 
									<td class="wh91 wk table-text-left">离职，随时可以入职</td> 
									<td class="wh69 wk hover-hand" tid="729"> 2015-06-11 15:30</td> 
									<td class="wh84 wk table-text-left">18500521769</td> 
									<td class="wh92 wk table-text-left">未打款</td> 
							     </tr>
							     <tr  class="tr-content">
							     	<td colspan="9">
							     		<div class="td-content">
							     			<div class="odiv1">
							     				<span class="dis-block">企业HR操作</span>
							     			</div>
							     			<div class="odiv2">
							     				<span class="dis-block dis-inlin fl-lef">当前状态</span>
							     				<select class="dis-block dis-inlin fl-lef" name=""> 
													<option value="0">DIVCSS5</option> 
													<option value="1">DIVCSS5</option> 
												</select> 
							     			</div>
							     			<div class="odiv3">
							     				<a href="" class="dis-block">查看简历</a>
							     			</div>
							     			<div class="odiv4">
							     				<a href="javascript:void(0)" class="dis-block send-sms">发送面试短信</a>
							     			</div>
							     			<div class="odiv5">
							     				<a href="javascript:void(0)" class="dis-block delete">删除该记录</a>
							     			</div>
							     		</div>
							     	</td>
							     </tr>
							     <tr style="height:5px;"></tr>
					    	</tbody> 
					    </table> 
					    <div class="inner clearfix">
					    <ul class="clearfix dis-inlin fl-rig dis-block"> 
					     <li class="itme active dis-block dis-inlin fl-lef"><a href="javascript:;" class="active">1</a></li>
					     <li class="itme dis-block dis-inlin fl-lef"><a class="num" href="/index.php?s=/Home/Login/Recording/p/2.html">2</a></li> 
					     <li class="next dis-block dis-inlin fl-lef"><a class="next" href="/index.php?s=/Home/Login/Recording/p/2.html">&gt;|</a></li> 
					     <div class="total dis-block dis-inlin fl-lef">
					       共2页
					     </div>
					    </ul>
					   </div> 
					  </div>  
				</div>
			</div>
		</div>
	</div>
	<div class="al-footer">
    <div class="wrap">
        <ul class="con clearfix">
            <li class="clearfix myli li1 fl-lef dis-inlin"><img src="/Public/img/new-index/foter-logo.png" alt=""></li>
            <li class="clearfix myli li2 fl-lef dis-inlin">
                <ul>
                    <li><a href="/Home/Public/aboutus.html">关于我们</a></li>
                    <li><a href="/Home/Public/yhxy.html">用户协议</a></li>
                    <li><a href="/Home/Public/yhys.html">用户隐私</a></li>
                    <li><a href="/Home/Public/contactus.html">联系我们</a></li>
                    <li><a href="/Home/Public/joinus.html">加入我们</a></li>
                    <li><a href="/Home/Public/feedback.html">意见反馈</a></li>
                </ul>
            </li>
            <li class="clearfix myli li3 fl-lef dis-inlin">
                <img src="/Public/img/new-index/pic3.png" alt="">
                <span>友情链接</span>
            </li>
            <li class="clearfix myli li4 fl-lef dis-inlin">
            <?php if(empty($linkArr)){ ?>
            <ul>
                <li class="fl-lef"><a href="">北京一站通</a></li>
                <li class="fl-lef"><a href="">郑云工作室</a></li>
                <li class="fl-lef"><a href="">启东人才网</a></li>
                <li class="fl-lef"><a href="">青岛logo设计</a></li>
                <li class="fl-lef"><a href="">千里马人才网</a></li>
                <li class="fl-lef"><a href="">E商人才网</a></li>
                <li class="fl-lef"><a href="">北京一站通</a></li>
                <li class="fl-lef"><a href="">来了</a></li>
                <li class="fl-lef"><a href="">一折网</a></li>
                <li class="fl-lef"><a href="">京东精选</a></li>
                <li class="fl-lef"><a href="">B5教程网</a></li>
                <li class="fl-lef"><a href="">郑云工作室</a></li>
                <li class="fl-lef"><a href="">郑云工作室</a></li>
                <li class="fl-lef"><a href="">郑云工作室</a></li>
                <li class="fl-lef"><a href="">郑云工作室</a></li>
            </ul>
            <?php }else{ ?>
            <ul>
                <?php  if(count($linkArr)>17) $len=17; else $len=count($linkArr); for($k=0;$k<$len;$k++) : ?>
                <li  class="fl-lef"><a href="<?php echo $linkArr[$k]['linkurl']?>" target="_blank"><?php echo $linkArr[$k]['webname']?></a></li>
                <?php endfor;?>
                <if >
                <?php if(count($linkArr)>17):?>
                 <li class="fl-lef back-none"><a href="/Home/Public/friendLink.html">更多>></a></li> 
                <?php endif;?>
            </ul>
            <?php } ?>
            </li>
            <li class="clearfix myli li5 fl-lef dis-inlin">
                <p>4006-685-596</p>
                <p>010-57188076</p>
                <p>010-57230694</p>
            </li>
        </ul>
        <div class="border"></div>
        <p style="margin-top: 35px;">人人猎 京ICP备14040265号-1<span style="margin-left:10px;" id='cnzz_stat_icon_1254515209'>&nbsp;&nbsp;&nbsp;&nbsp;<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
                            document.write(unescape("%3Cspan id='cnzz_stat_icon_1254515209'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1254515209%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script></span></p>
    </div>
</div>
<div class="popup_ft reward" id="sys_window">
    <h3>温馨提示</h3>
    <a class="close cur_point"></a>
    <dl>
        <dt id="sys_content">恭喜您！</dt>
        <dd><input type="hidden" id="locationHref"><button id="comWind" class="cur_point">确认</button></dd>
    </dl>
</div>

<script>
	$(".m2-l>div").click(function(){
		$(this).addClass("m");
		$(this).find("h6").addClass("m");
		$(this).find("p").addClass("m");
		$(this).siblings().removeClass("m")
		$(this).siblings().find("h6").removeClass("m");
		$(this).siblings().find("p").removeClass("m");
	});

	var index;
	var list = $(".m2-r .nav li");
	var divs = $(".m2-r>div");
	list.on("click",function(){
		that = $(this);
		index = that.index();
		that.addClass("m").siblings().removeClass("m");
		$(this).find("a").addClass("m").parent("li").siblings().find("a").removeClass("m");
		divs.eq(index).show().siblings("div").hide();
	});

	var myspans = $(".add-resume .biaoqian .odiv .m span i");
	myspans.click(function(){
		$(this).parent().remove();
		//alert(23)
	})
	var btn = $(".biaoqian .odiv .paset-btn");
	btn.click(function(){
		var myVal = $(this).prev().val();
		 if (myVal.trim().length !== 0){
		 	$(this).parent().prev().append("<span class='dis-block dis-inlin fl-lef hover-hand'>"+myVal+"<i></i></span>");
		 }
		var myspans = $(".add-resume .biaoqian .odiv .m span i");;
		myspans.click(function(){
			$(this).parent().remove();
		})
	})
	$(".label-parent span").click(function(){
		var text = $(this).text();
		$(".add-resume .biaoqian .odiv .m").append("<span class='dis-block dis-inlin fl-lef hover-hand'>"+text+"<i></i></span>");
		var myspans = $(".add-resume .biaoqian .odiv .m span i");;
		myspans.click(function(){
			$(this).parent().remove();
		})
	})

	$(".biaoqian .odiv .confirm-btn").click(function(){
		 var content = "";
		 if($(".odiv .content .m span").size()>0){
		 	$(".odiv .content .m span").each(function(){
		 		content +='<span class="dis-block dis-inlin fl-lef">'+$(this).text()+'</span>';
		 	});
		 	content +='<a href="javascript:void(0)">编辑</a>';
		 	$(".biaoqian p.mylabel").html(content);
		 };
		 $(".biaoqian .odiv").hide();
		 $(".add-resume .biaoqian .mylabel a").click(function(){
			$(".biaoqian .odiv").show();
		 })
	});
	$(".biaoqian .odiv .top b").click(function(){
		$(".biaoqian .odiv").hide();
	});
	$(".biaoqian .odiv .top b").click(function(){
		$(".biaoqian .odiv").hide();
	});

	$(".biaoqian .odiv .cancel").click(function(){
		$(".biaoqian .odiv").hide();
	})
	$(".add-resume .biaoqian .mylabel a").click(function(){
		$(".biaoqian .odiv").show();
	})

</script>
<script type="text/javascript">
	!function(){
		laydate.skin('yahui');//切换皮肤，请查看skins下面皮肤库
		laydate({elem: '#demo'});//绑定元素
	}();

	//日期范围限制
	var start = {
	    elem: '#start',
	    format: 'YYYY-MM-DD',
	    min: laydate.now(), //设定最小日期为当前日期
	    max: '3099-06-16', //最大日期
	    istime: true,
	    istoday: false,
	    choose: function(datas){
	         end.min = datas; //开始日选好后，重置结束日的最小日期
	         end.start = datas //将结束日的初始值设定为开始日
	    }
	};
	var end = {
	    elem: '#end',
	    format: 'YYYY-MM-DD',
	    min: laydate.now(),
	    max: '2099-06-16',
	    istime: true,
	    istoday: false,
	    choose: function(datas){
	        start.max = datas; //结束日选好后，充值开始日的最大日期
	    }
	};
	// laydate(start);
	// laydate(end);
	//自定义日期格式
	laydate({
	    elem: '#laydate1',
	    format: 'YYYY年MM月DD日',
	    festival: true, //显示节日
	    choose: function(datas){ //选择日期完毕的回调
	        alert('得到：'+datas);
	    }
	});
	//日期范围限定在昨天到明天
	laydate({
	    elem: '#hello3',
	    min: laydate.now(-1), //-1代表昨天，-2代表前天，以此类推
	    max: laydate.now(+1) //+1代表明天，+2代表后天，以此类推
	});
</script>
   <script>
        function showDisMsg(msg) {
            // sys_window(msg);
        }
        $(function() {
            $(".shenhed").click(function() {
                var id = $(this).attr("tid");
                $(".state").hide(100);
                $(".state2").hide(100);

                if ($("#state_" + id).css("display") == "none") {
                    $("#state_" + id).show(100);
                } else {
                    $("#state_" + id).hide(100);
                }
            });
        });
        function commentDiv(id) {
            $(".state").hide(100);
            $(".state2").hide(100);
            if ($("#comment_" + id).css("display") == "none") {
                $("#comment_" + id).show(100);
            } else {
                $("#comment_" + id).hide(100);
            }

        }
        function comment(id) {
            var content = $("#content_" + id).val();
            if (!content) {
                sys_window("请输入评论内容！");
            }
            if (content.length > 500) {
                sys_window("请输入的评论内容过长！");
            }
            $.post("/Home/Login/comment.html", {'id': id, 'content': content}, function(data) {
                sys_window(data.msg);
            }, "json")
        }
        $(".m2-l>div").click(function() {
            $(this).addClass("m");
            $(this).find("h6").addClass("m");
            $(this).find("p").addClass("m");
            $(this).siblings().removeClass("m")
            $(this).siblings().find("h6").removeClass("m");
            $(this).siblings().find("p").removeClass("m");
        });
        $(".titl .select").on("click",function(){
        	$(".titl .select ul").show();
        });
        $(".titl .select").on("mouseleave",function(){
        	$(".titl .select ul").hide();
        })

        $(".send-sms").on("click",function(){
        	$(".mask").show();
        	$(".dx_page").slideDown();
        });
        $(".qx").on("click",function(){
        	$(".dx_page").slideUp();
        	$(".mask").hide();
        });
        $(".delete").on("click",function(){
        	$(".mask").show();
        	$(".qd-qx-alert").show();
        })
        $(".qd-qx-alert .qx").on("click",function(){
        	$(".mask").hide();
        	$(".qd-qx-alert").hide();
        })

    </script>
</body>

</html>