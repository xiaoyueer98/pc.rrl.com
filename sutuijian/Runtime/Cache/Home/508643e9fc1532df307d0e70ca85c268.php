<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="/Public/img/favicon.ico" type="image/ico">
        <title>查看收益-人人猎</title>
        <meta name="keywords" content="人人猎,人人猎网，人人猎头,renrenlie.com,www.renrenlie.com,人人猎首页,人人猎官网，人人都是猎头" />
        <meta name="description" content="人人猎（www.renrenlie.com)是企业低成本极速直招平台，让企业一周内搞定招聘需求，为推荐人提供“人力资源”变现通道。" />
        <link rel="stylesheet" type="text/css" href="/Public/css/new-resizer.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/new-recommends.css">
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/al-index.js"></script>
        <script type="text/javascript" src="/Public/js/record-common.js"></script>
    </head>
    <body>
        <div class="mask" id="mask"></div>
    <div class="al-header">
    <div class="wrap">
        <div class="al-logo dis-inlin"><a href="/"><img src="/Public/img/new-index/al-logo.png" alt=""></a></div>
        <div class="al-nav dis-inlin fl-lef">
            <ul>
                <li class="dis-inlin fl-lef indx-li"><a <?php if($cur == index): ?>class="m"<?php endif; ?> href="/">首页</a></li>
                <li class="dis-inlin fl-lef"><a <?php if($cur == search): ?>class="m"<?php endif; ?> href="/Home/Index/search.html">职位</a></li>
                <li class="dis-inlin fl-lef"><a <?php if($cur == anli): ?>class="m"<?php endif; ?> href="/Home/Index/anli.html">案例</a></li>
                <li class="dis-inlin fl-lef last-li"><a <?php if($cur == qa): ?>class="m"<?php endif; ?> href="/Home/public/qa.html">Q&A<img src="/Public/img/new-index/new.png" alt=""></a></li>
                <li class="dis-inlin fl-lef"><a <?php if($cur == active): ?>class="m"<?php endif; ?> href="/Home/Active/salon_show.html">活动</a></li>
            </ul>
        </div>
        <?php if(!empty($_SESSION['username']) || !empty($_SESSION['cusername'])){ $username = ($_SESSION['username']?$_SESSION['username']:$_SESSION['cusername']); $arUserinfo = M("userinfo")->where("username='$username'")->find(); $flag = $arUserinfo['flag']; if($flag==1){ $arHaedUserinfo = M("company")->where("username='$username'")->find(); if($arHaedUserinfo['comlogo']){ $logoTmp = substr($arHaedUserinfo['comlogo'],0,1); if($logoTmp != "/"){ $arHaedUserinfo['comlogo'] = "/".$arHaedUserinfo['comlogo']; } } }elseif($flag==0){ $arHaedUserinfo = M("member")->where("username='$username'")->find(); } if(strlen($username)=="31" && substr($username,0,3) == "wx_"){ $username = "微信用户"; } if(substr($username,0,3) == "qq_" && $_COOKIE[$username]){ $username = $_COOKIE[$username]; }elseif(substr($username,0,3) == "qq_"){ $username = "qq用户"; } ?>
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
            <a href="/Home/Login/index.html">
            <div class="m1-l fl-lef">
                <img src="/Public/img/rcmd-img/reco-icon.png" alt="">
                <span>推荐人用户中心</span>
                <img src="/Public/img/rcmd-img/reco-icon.png" alt="">
            </div>
            </a>
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
    <a href='/Home/Login/userinfo.html'>
        <div class="odiv hover-hand <?php if($first_class == 1): echo 'm'; endif;?>">
            <span>1</span>
            <h6 class="tit1<?php if($first_class == 1):?> m<?php endif;?>">完善资料
                <?php if($leftNavCompleted['userinfo_completed'] === true):?>
                <em class="m"></em>
                <?php endif;?>
            </h6>
            <p class="tx<?php if($first_class == 1):?> m<?php endif;?>">完成之后可以推荐候选人</p>
        </div>
    </a>
    <a href='/Home/Login/Recommended.html'>
        <i class="dis-block"><img src="/Public/img/rcmd-img/btmjd.png" alt=""></i>
        <div class="odiv odiv2 hover-hand <?php if($first_class == 2): echo 'm'; endif;?>">
            <span>2</span>
            <h6 class="tit2<?php if($first_class == 2):?> m<?php endif;?>">维护候选人
            <?php if($leftNavCompleted['resume_completed'] === true):?>
            <em class="m"></em>
            <?php endif;?>
            </h6>
            <p class="jlk<?php if($first_class == 2):?> m<?php endif;?>">(简历库)</p>
            <p class="tx<?php if($first_class == 2):?> m<?php endif;?>">上传优质简历，坐等收钱</p>
            <a href="/Home/Login/Recommended/act/addResume.html" class="j"></a>
        </div>

    </a>
    <a href='/Home/Login/JobSearch.html'>
        <i class="dis-block"><img src="/Public/img/rcmd-img/btmjd.png" alt=""></i>
        <div class="odiv hover-hand <?php if($first_class == 3): echo 'm'; endif;?>">
            <span>3</span>
            <h6 class="tit3<?php if($first_class == 3):?> m<?php endif;?>">推荐职位
            <?php if($leftNavCompleted['record_completed'] === true):?>
            <em class="m"></em>
            <?php endif;?>
           </h6>
            <p class="tx<?php if($first_class == 3):?> m<?php endif;?>">查看职位，再推荐候选人</p>
        </div>
    </a>
    <a href='/Home/Login/Recording.html'>
        <i class="dis-block"><img src="/Public/img/rcmd-img/btmjd.png" alt=""></i>
        <div class="odiv hover-hand <?php if($first_class == 4): echo 'm'; endif;?>">
            <span>4</span>
            <h6 class="tit4<?php if($first_class == 4):?> m<?php endif;?>">跟踪状态
            <?php if($leftNavCompleted['record_completed'] === true):?>
            <em class="m"></em>
            <?php endif;?>
            </h6>
            <p class="tx<?php if($first_class == 4):?> m<?php endif;?>">时时关注候选人面试状态</p>
        </div>
    </a>

    <a href='/Home/Login/DetailsFunds.html'>
        <i class="dis-block"><img src="/Public/img/rcmd-img/btmjd.png" alt=""></i>
        <div class="odiv hover-hand <?php if($first_class == 5): echo 'm'; endif;?>">
            <span>5</span>
            <h6 class="tit5<?php if($first_class == 5):?> m<?php endif;?>">查看收益
            <?php if($leftNavCompleted['money_completed'] === true):?>
            <em class="m"></em>
            <?php endif;?>
            </h6>
            <p class="tx<?php if($first_class == 5):?> m<?php endif;?>">候选人入职后便得收益</p>
        </div>
    </a>

</div>
<script type="text/javascript">
    $(document).ready(function(e){
        $(".m2-l .odiv2").on("mouseenter",function(){
           $(this).find(".j").show();
        });
        $(".m2-l .odiv2").on("mouseleave",function(){
            $(this).find(".j").hide();
        });
    })
</script>
            <div class="m2-r fl-rig">
                <ul class="nav nav2">
                    <li class="dis-block dis-inlin first fl-lef<?php if($act != 'add'):?> m<?php endif;?>"><a href="javascript:;" class="back-none<?php if($act != 'add'):?> m<?php endif;?>">资金明细</a></li>
                    <li class="dis-block dis-inlin fl-lef<?php if($act == 'add'):?> m<?php endif;?>"><a href="/Home/Login/DetailsFunds/act/add.html"  <?php if($act == 'add'):?>class="m"<?php endif;?>>申请提现</a></li>
                </ul>
                <div class="fund-details track-state" <?php if($act == 'add'):?> style="display:none"<?php endif;?> >
                     <?php if(!empty($userAccount)):?>
                     <h3 class="money-info">
                        <span class="dis-block dis-inlin fl-lef">余额：<?php echo $userAccount['account'];?>元</span>
                    </h3>
                    <div class="content">
                        <table class="data_list">
                            <tbody>
                                <tr class="t">
                                    <th>序号</th>
                                    <th>事项</th>
                                    <th>发生金额（元）</th>
                                    <th>余额（元）</th>
                                    <th>日期</th>
                                </tr>
                                <tr  style='border:none;height:10px!important;'><td  style='border:none;height:10px!important;'></td></tr>
                                <?php foreach($arAccountList as $accountInfo):?>
                                <tr>
                                    <td class="wk wh47"  style="border-left: 1px solid #b3b3b3;"><?php echo $accountInfo['sort_id'];?></td>
                                    <td class="wk wh260"><?php echo $accountInfo['comment'];?></td>
                                    <td class="wk wh122"><?php echo $accountInfo['incr'];?></td>
                                    <?php if($accountInfo['from'] == 'enchashmentask'):?>
                                    <td class="wk wh122">--</td>
                                    <?php else:?>
                                    <td class="wk wh122"><?php echo $accountInfo['account'];?></td>
                                    <?php endif;?>
                                    <td class="wk wh152"><?php echo $accountInfo['updated_at'];?></td>
                                </tr>
                                <tr  style='border:none;height:5px!important;'><td  style='border:none;height:5px!important;'></td></tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                        <?php echo $page;?> 
                    </div>
                    <?php else:?>
                    <h3 class="money-info">
                        <span class="dis-block dis-inlin fl-lef">暂无收益</span>
                    </h3>
                    <?php endif?>
                </div>
                <div class="apply-for"  <?php if($act != 'add'):?> style="display:none"<?php endif;?>>
                     <?php if(!empty($userAccount)):?>
                     <h3 class="money-info" style="padding-left:26px;padding-top:25px;">
                        <span class="dis-block dis-inlin fl-lef">余额：<?php echo $userAccount['account'];?>元</span>
                    </h3>


                    <div class="con">
                        <div class="clearfix">
                            <em class="dis-inlin em1 dis-block fl-lef">申请提现：</em>
                            <input class="dis-inlin dis-block fl-lef" id="moneyInput" type="text" onkeyup="value = value.replace(/[^\d]/g, '')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" maxlength="4">
                            <b class="dis-inlin dis-block fl-lef">(元)</b>
                            <div class="clearfix ero undis" id="moneyError" style='margin: 0px;'>
                                <b class="fl-lef dis-block dis-inlin" style="margin-left:22px;">温馨提示:</b>
                                <span class="fl-lef dis-block dis-inlin clearfix">
                                    <i class="fl-lef dis-block dis-inlin"></i>
                                    <span class="fl-lef dis-block dis-inlin" id="moneyErrorText">你输入的金额有问题</span>
                                </span>
                            </div>
                            <input type='hidden' value="<?php echo $userAccount['account'];?>" id='amount'>
                        </div>
                        <div class="clearfix">
                            <em  class="dis-inlin em1 dis-block fl-lef">提示：</em>
                            <p  class="dis-inlin p1 dis-block fl-lef">取出金额在两个工作日内到帐，每次手续费5元。</p>
                        </div>




                        <div class="clearfix btn">
                            <button class="m" id="confirmEnchashmentDetailBon">确定</button>
                            <a href='/Home/Login/DetailsFunds.html'><button>取消</button></a>
                        </div>
                    </div>
                    <?php else:?>
                    <h3 class="money-info">
                        <span class="dis-block dis-inlin fl-lef">暂无收益</span>
                    </h3>
                    <?php endif?>
                </div>
            </div>
        </div>
    </div>
    <div class="popup_ft reward" id="remind_member_window" <?php if($userAccountInfo['remind_member'] !=1 && $isFinishBank==1):?>style="display: block"<?php else:?>style="display: none"<?php endif;?>>
         <h3>温馨提示</h3>
        <a class="close cur_point" id="remind_member_close"></a>
        <div style="margin-top:8px;">
            <p style="font-size:18px;margin-left:50px">请确认下列收款账号信息</p>
            <p style="font-size:16px;margin-left:50px;margin-top:18px;">收款银行：<?php echo ($userAccountInfo['bankname']); ?></p>
            <p style="font-size:16px;margin-left:50px;margin-top:18px;">收款账号：<?php echo ($userAccountInfo['banknumber']); ?></p>
            <dl>
                <dd style="margin-top: 22px"><input type="hidden" id="remind_member"><button id="com_remind_member" class="cur_point">确认</button></dd>
            </dl>
        </div>
    </div>

    <input type="hidden" name="act" value="<?php echo $act?>" id="act">
    <input type="hidden" name="isFinsh" value="<?php echo $isFinishBank?>" id="isFinsh">
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
        $(".m2-l>div").click(function() {
            $(this).addClass("m");
            $(this).find("h6").addClass("m");
            $(this).find("p").addClass("m");
            $(this).siblings().removeClass("m")
            $(this).siblings().find("h6").removeClass("m");
            $(this).siblings().find("p").removeClass("m");
        });
        var index;
        var list = $(".m2-r .nav li").eq(0);
        var divs = $(".m2-r>div");
        list.on("click", function() {
            that = $(this);
            index = that.index();
            that.addClass("m").siblings().removeClass("m");
            $(this).find("a").addClass("m").parent("li").siblings().find("a").removeClass("m");
            divs.eq(index).show().siblings("div").hide();
        });
        $(".apply-for .con .btn button").click(function() {
            $(this).addClass("m").siblings().removeClass("m");
        })
        $(function() {

            var act = $("#act").val();
            if (act != "add") {
                //判断是否已经填充了卡号，如果没有填充则去填充
                var isFinsh = $("#isFinsh").val();
                if (isFinsh != 1) {
                    $("#remind_member_window").hide();
                    sys_window("请完善收款账号！", "/Home/Login/userinfo.html")
                    return false;
                }
                //判断是否已经确认过收款账号信息
                if ($("#remind_member_window").css("display") == "block") {
                    $(".mask").show();
                }
                $("#remind_member_close").click(function() {
                    $(".mask").hide();
                    $("#remind_member_window").hide();
                });
                $("#com_remind_member").click(function() {
                    $.post("/Home/Login/RemindMember.html", {}, function(data) {
                        // location.href = location.href;
                        $(".mask").hide();
                        $("#remind_member_window").hide();
                    }, "json")
                });
            }
            $("#confirmEnchashmentDetailBon").attr("disabled", false);
            $("#enchashmentDetail").click(function() {
                $("#enchashmentDetailDiv").show();
            });
            $("#conEnchashmentDetailBon").click(function() {
                $("#moneyInput").val("");
                $("#enchashmentDetailDiv").hide();
            });
            /*JQuery 限制文本框只能输入数字和小数点*/
            $("#moneyInput").keyup(function() {
                $(this).val($(this).val().replace(/[^0-9.]/g, ''));
            }).bind("paste", function() {  //CTR+V事件处理    
                $(this).val($(this).val().replace(/[^0-9.]/g, ''));
            }).css("ime-mode", "disabled"); //CSS设置输入法不可用    
            $("#confirmEnchashmentDetailBon").click(function() {
                var moneyInput = $("#moneyInput").val();
                var amount = $("#amount").html();
                if (parseInt(moneyInput) > parseInt(amount)) {
                    $("#moneyInput").focus();
                    $("#moneyErrorText").html("当前资金账户余额不足，或已有提款记录！");
                    $("#moneyError").show();
                    return false;
                }
                if (moneyInput < 6) {
                    $("#moneyErrorText").html("每次提取限额不能少于5元！");
                    $("#moneyError").show();

                    return false;
                }
                var tmpMoney = moneyInput - 5;
                if (confirm("您提取的金额为" + moneyInput + "元,需要扣除手续费5元，届时您的到款金额为" + tmpMoney + "元。")) {
                    $("#confirmEnchashmentDetailBon").attr("disabled", "disabled");
                    var url = "<?php echo ($share['url']); ?>";
                    $.post("/Home/Login/EnchashmentDetail.html", {
                        'moneyInput': moneyInput
                    }, function(data) {
                        $("#confirmEnchashmentDetailBon").attr("disabled", false);
                        if (data.code != "200") {

                            sys_window(data.msg);
                        } else {
                            sys_window("提现申请成功！", "/Home/Login/DetailsFunds.html");
                            //$("#moneyInput").val("");
                            //$("#enchashmentDetailDiv").hide();
                        }
                    }, "json")
                }
            });

        })
    </script>
</body>
</html>