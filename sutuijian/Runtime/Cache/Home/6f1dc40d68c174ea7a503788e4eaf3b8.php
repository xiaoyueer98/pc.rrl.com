<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="/Public/img/favicon.ico" type="image/ico">
        <title>候选人列表-人人猎</title>
        <meta name="keywords" content="人人猎,人人猎网，人人猎头,renrenlie.com,www.renrenlie.com,人人猎首页,人人猎官网，人人都是猎头" />
        <meta name="description" content="人人猎（www.renrenlie.com)是企业低成本极速直招平台，让企业一周内搞定招聘需求，为推荐人提供“人力资源”变现通道。" />
        <link rel="stylesheet" type="text/css" href="/Public/css/new-resizer.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/new-company.css">
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/new-company-common.js"></script>
        <script type="text/javascript" src="/Public/js/al-index.js"></script>	
       		
    </head>
    <body>

        <style>
            .Pop-up {position: fixed;top: 50%;left: 50%;display: none;margin-left: -177px;width: 354px;height: 174px;z-index:100;height: -87px; margin-top:-88px;background: url(/Public/img/dle_altBg.png) no-repeat;}
            .Pop-up div  textarea{ display: block;width: 200px;height: 40px;}
            .Pop-up  div{display: block;width: 200px;height: 40px;margin-left: 80px;margin-bottom: 10px;}
            .Pop-up h3 {margin-top: 45px;color: #2380b8;text-align: center;font-size: 14px;margin-bottom: 10px;}
            .Pop-up .btnR {margin-left: 66px;width: 80px;height: 30px;border: 0;border-radius: 5px;background: #1a628e;color: #fff;}
            .Pop-up h3 {margin-top: 45px;color: #2380B8; text-align: center; font-size: 14px;}
            .PersData .recom2 h3 { margin-bottom: 38px;padding: 0px;border: 0px none; font-size: 18px;}
            .Pop-up .btnL,.Pop-up .btnR { margin-left: 66px; width: 80px; height: 30px; border: 0px none;border-radius: 5px;background: none repeat scroll 0% 0% #1A628E;color: #FFF;}
            .track-state .titl ul.select ul li{padding:0 5px;text-align: left;background:#0983C6;}
            .track-state .titl ul.select ul li:hover{background:#11abff;}
            .track-state .titl ul.select ul li a{font-size:14px;color:#ffffff;}
            .track-state .titl ul.select ul li a:hover{color:#ffffff;}
            .track-state .titl ul>li{text-align:center;}
        </style>
        <div class="mask" style="display:none"></div>
    <div class="al-header">
    <div class="wrap">
        <div class="al-logo dis-inlin"><a href="/"><img src="/Public/img/new-index/al-logo.png" alt=""></a></div>
        <div class="al-nav dis-inlin fl-lef">
            <ul>
                <li class="dis-inlin fl-lef indx-li"><a <?php if($cur == index): ?>class="m"<?php endif; ?> href="/">首页</a></li>
                <li class="dis-inlin fl-lef"><a <?php if($cur == search): ?>class="m"<?php endif; ?> href="/Home/Index/search.html">职位</a></li>
                <li class="dis-inlin fl-lef"><a <?php if($cur == anli): ?>class="m"<?php endif; ?> href="/Home/Index/anli.html">案例</a></li>
                <li class="dis-inlin fl-lef"><a <?php if($cur == qa): ?>class="m"<?php endif; ?> href="/Home/public/qa.html">Q&A</a></li>
                <li class="dis-inlin fl-lef"><a <?php if($cur == active): ?>class="m"<?php endif; ?> href="/Home/Active/salon_show.html">活动</a></li>
                 <li class="dis-inlin fl-lef last-li"><a <?php if($cur == qa): ?>class="m"<?php endif; ?> href="http://bbs.renrenlie.com">论坛<img src="/Public/img/new-index/new.png" alt=""></a></li>
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
                    <a class="a1 m fl-lef dis-inlin" href="/Home/Company/EnterpriseInformation.html">完善资料</a>
                    <a class="a2 fl-lef dis-inlin" href="/Home/Company/SignContract.html">签订合同</a>
                    <a class="a3 fl-lef dis-inlin" href="/Home/Company/SendJob.html">发布职位</a>
                    <a class="a4 fl-lef dis-inlin" href="/Home/Company/ResumeList.html">查看候选人</a>
                    <a class="a5 fl-lef dis-inlin" href="/Home/Company/toBePaid.html">入职管理</a>
                    <a class="a6 fl-lef dis-inlin" href="/Home/Login/logout.html">退出登录</a>
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
            <a href="/Home/Company/index.html">
                <div class="m1-l fl-lef">
                    <img src="/Public/img/rcmd-img/reco-icon.png" alt="">
                    <span>企业用户中心</span>
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
    <a href='/Home/Company/EnterpriseInformation.html'>
        <div class="odiv hover-hand <?php if($first_class == 1): echo 'm'; endif;?>">
            <span>1</span>
            <h6 class="tit1 <?php if($first_class == 1): echo 'm'; endif;?>">完善资料<em <?php if($leftNavCompleted['userinfo_completed'] == true): echo 'class="m"'; endif;?>></em></h6>
            <p class="tx <?php if($first_class == 1): echo 'm'; endif;?>">方便推荐人了解公司及职位</p>
        </div>
    </a>
    <i class="dis-block"><img src="/Public/img/rcmd-img/btmjd.png" alt=""></i>
    <a href='/Home/Company/SignContract.html'>
        <div class="odiv hover-hand <?php if($first_class == 2): echo 'm'; endif;?>">
            <span>2</span>
            <h6 class="tit2 <?php if($first_class == 2): echo 'm'; endif;?>">签订合同<em <?php if($leftNavCompleted['contract_completed'] == true): echo 'class="m"'; endif;?>></em></h6>

            <p class="tx <?php if($first_class == 2): echo 'm'; endif;?>">签订合同后，就可以发布职位了</p>
        </div>
    </a>
    <i class="dis-block"><img src="/Public/img/rcmd-img/btmjd.png" alt=""></i>
       
        <div  id="sendJobDiv" class="odiv odiv3 hover-hand <?php if($first_class == 3): echo 'm'; endif;?>">
            <span>3</span>
            <h6 class="tit3 <?php if($first_class == 3): echo 'm'; endif;?>">发布职位<em <?php if($leftNavCompleted['job_completed'] == true): echo 'class="m"'; endif;?>></em></h6>
            <p class="tx <?php if($first_class == 3): echo 'm'; endif;?>">职位通过系统审核，就会有推荐</p>
            <a href="javascript:;" class="j"></a>
        </div>
    
    <i class="dis-block"><img src="/Public/img/rcmd-img/btmjd.png" alt=""></i>
    <a href='/Home/Company/ResumeList.html'>
        <div class="odiv hover-hand<?php if($first_class == 4): echo ' m'; endif;?>">
            <span>4</span>
            <h6 class="tit4<?php if($first_class == 4): echo ' m'; endif;?>">查看候选人<em <?php if($leftNavCompleted['record_completed'] == true): echo 'class="m"'; endif;?>></em></h6>
            <p class="jlk<?php if($first_class == 4): echo ' m'; endif;?>">(简历库)</p>
            <p class="tx<?php if($first_class == 4): echo ' m'; endif;?>">如符合要求，请安排面试</p>
        </div>
    </a>
    <i class="dis-block"><img src="/Public/img/rcmd-img/btmjd.png" alt=""></i>
    <a href='/Home/Company/toBePaid.html'>
        <div class="odiv hover-hand<?php if($first_class == 5): echo ' m'; endif;?>">
            <span>5</span>
            <h6 class="tit5<?php if($first_class == 5): echo ' m'; endif;?>">入职管理<em></em></h6>
            <p class="tx<?php if($first_class == 5): echo ' m'; endif;?>">候选人入职后，支付招聘费</p>
        </div>
    </a>
</div>
<script type="text/javascript">
    $(document).ready(function(e){
        $(".m2-l .odiv3").on("mouseenter",function(){
           $(this).find(".j").show();
        });
        $(".m2-l .odiv3").on("mouseleave",function(){
            $(this).find(".j").hide();
        });
    })
</script>
            <div class="m2-r fl-rig">
                <ul class="nav nav2">
                    <li class="first dis-block dis-inlin fl-lef m"><a class="m back-none " style="padding-left:0">推荐记录</a></li>
                </ul>
                <div class="add-resume track-state" style="display:block">
                    <div class="con"> 

                        <?php if($checked == "true"):?>
                        <div class="titl">
                            <span class="dis-block dis-inlin fl-lef">招聘职位：</span>
                            <ul class="dis-block dis-inlin fl-lef select hover-hand">
                                <li>
                                    <?php if($jobInfoTmp): echo $jobInfoTmp['title']; else:?>全部职位<?php endif;?>
                                </li>
                                <ul>
                                    <?php foreach($arJobList as $jobInfo):?>
                                    <li><a href="/Home/Company/ResumeList/id/<?php echo $jobInfo['id'];?>.html"><?php echo $jobInfo['title'];?></a></li>
                                    <?php endforeach;?>
                                </ul>
                            </ul>
                            <div class="fl-lef r-div">
                                <span class="dis-block dis-inlin fl-lef">招聘资费：</span>
                                <span class="dis-block dis-inlin fl-lef"> <?php if($jobInfoTmp): echo $jobInfoTmp['Tariff']; else:?>--<?php endif;?></span>
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
                                <?php if($arRecordList):?>
                                <?php foreach($arRecordList as $resumeList):?>
                                <tr style="border:none;height:10px!important;">
                                    <td style="border:none;height:10px!important;"></td>
                                </tr>
                                <tr> 
                                    <td class="wh35 wk" style="border-left: 1px solid #b3b3b3;"><?php echo $resumeList['sort_id']?></td> 
                                    <td class="wh66 wk table-text-left td-position">
                                        <?php if($resumeList['news_status'] !=1):?>
                                        <img class="new" src="/Public/img/company-img/icon11.png" alt="">
                                        <?php endif;?>
                                        <a href="/Home/Company/viewResume/id/<?php echo ($resumeList['id']); ?>/jid/<?php echo ($resumeList['j_id']); ?>/btid/<?php echo ($resumeList['bt_id']); ?>.html"><?php echo $resumeList['bt_username'];?></a>

                                    </td> 
                                    <td class="wh95 wk table-text-left"><?php echo $resumeList['title'];?></td> 
                                    <td class="wh71 wk table-text-left">
                                        <?php
 if(strlen($resumeList['t_username'])>30 && strpos($resumeList['t_username'],"qq_") === 0){ echo "qq用户"; }elseif(strlen($resumeList['t_username'])>10 && strpos($resumeList['t_username'],"renren_") === 0){ echo "人人用户"; }elseif(strlen($resumeList['t_username'])>30 && strpos($resumeList['t_username'],"wx_") === 0){ echo "微信用户"; }elseif(strlen($resumeList['t_username'])>10 && strpos($resumeList['t_username'],"sina_") === 0){ echo "新浪用户"; }else{ echo $resumeList['t_username']; } ?>
                                    </td> 
                                    <td class="wh69 wk hover-hand"><?php echo date("Y-m-d",$resumeList['posttime']);?></td> 
                                    <td class="wh91 wk table-text-left"><?php echo $resumeList['state'];?></td> 
                                    <td class="wh69 wk hover-hand"><?php echo $resumeList['audstartdate'];?></td> 
                                    <td class="wh84 wk table-text-left"><?php echo $resumeList['mobile'];?></td> 
                                    <td class="wh92 wk table-text-left"><?php echo $resumeList['sink'];?></td> 
                                </tr>
                                <tr  class="tr-content">
                                    <td colspan="9">
                                        <div class="td-content">
                                            <div class="odiv1">
                                                <span class="dis-block">企业HR操作</span>
                                            </div>
                                            <div class="odiv2">
                                                <span class="dis-block dis-inlin fl-lef">当前状态</span>
                                                <select class="dis-block dis-inlin fl-lef" name="" <?php if($resumeList['audstart_status']==6):?>disabled<?php endif;?> onchange="changeAudreasonList('<?php echo ($resumeList[audstart]); ?>',$(this).val(), <?php echo ($resumeList['id']); ?>,<?php echo ($resumeList['audstart_status']); ?>)"> 
                                                        <?php if(is_array($arAudreasonList)): $i = 0; $__LIST__ = $arAudreasonList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$arAudreasonInfo): $mod = ($i % 2 );++$i;?><option value='<?php echo ($arAudreasonInfo[datavalue]); ?>' <?php if($arAudreasonInfo[dataname] == $resumeList['audstart']): ?>selected="selected"<?php endif; ?>><?php echo ($arAudreasonInfo[dataname]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                </select> 
                                            </div>
                                            <div class="odiv3">
                                                <a href="/Home/Company/viewResume/id/<?php echo ($resumeList['id']); ?>/jid/<?php echo ($resumeList['j_id']); ?>/btid/<?php echo ($resumeList['bt_id']); ?>.html"  class="dis-block">
                                                    查看简历</a>
                                            </div>
                                            <div class="odiv4">
                                                <a href="javascript:void(0)" class="dis-block send-sms fsdx" btname="<?php echo ($resumeList['bt_username']); ?>" mobile="<?php echo ($resumeList['mobile']); ?>" real_audstart_time="<?php echo ($resumeList['real_audstart_time']); ?>" recordid="<?php echo ($resumeList['id']); ?>">发送面试短信</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                                <?php else:?>
                                <tr> 
                                    <td  class="wk" colspan="9"  style="border-left: 1px solid #b3b3b3;"><b>暂无记录</b></td>
                                </tr>
                                <?php endif;?>

                            </tbody> 
                        </table> 
                        <?php echo $page;?>
                        <?php else:?>
                        <div style="background: #ffcccc none repeat scroll 0 0;border: 1px dashed #ccc;color: #000;font-size: 14px;height: 25px;line-height: 25px; margin-top: 30px;padding: 0 10px;text-align: left;width: 665px;">您的企业未通过人人猎系统审核，请您与我们的客服联系：010-57188076</div>
                        <?php endif;?>
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

    <div class="dx_page">
        <div class="con">
            <p>亲爱的<input type="text" style="width:50px" value="XXXX" id="bt_name">同学，我们诚挚邀请你于<input type="text" style="width:50px" value="XXXX" id="msdate">和我们<input type="text" value="<?php echo ($company['cpname']); ?>" id="gs">面试，公司地点：<input type="text" value="<?php echo ($company['address']); ?>" id="address">乘车路线<input type="text" value="XXXX" id="lx">，联系人<input type="text" value="<?php echo ($company['cnname']); ?>" id="lxr">，联系电话<input type="text" value="<?php echo ($company['telephone']); ?>" id="hm">。请勿迟到。 </p>
            <input type="hidden" id="mobile">
            <input type="hidden" id="recordid">
            <div style="color: red; margin-left: 80px; position: absolute;margin-top:-30px;" id="ms_error"></div>
            <input class="fs" type="button" value="发送">
            <span class="qx">取消</span>
        </div>
    </div>
    
    
    
   
    <div class="Pop-up" id="sendStatus">
        <input type="hidden" id="del">
        <h3>确定修改此面试人的面试状态吗？</h3>
        <div style="display:none" id="reason"><textarea placeholder="请输入拒绝理由" id="rea"></textarea></div>
        <input type="hidden" id="reasonid">
        <input type="hidden" id="statused">
        <input type="button" class="btnL delconfirm cur_point" value="确认" >
        <input type="button" class="btnR qxconfirm cur_point" value="取消">
    </div>
    <!--面试预约时，填写面试时间页面-->
    <div class="modify-data" style="display:none;height:auto;padding-bottom:20px;left:43%;">
        <span class="dis-block" style="margin-top:20px">确定修改此面试人的面试时间吗？</span>
        <div class="clearfix ero" style="display:block;margin-bottom:10px;width:400px">
            <b class="fl-lef dis-block dis-inlin" style="margin-left:3px;">温馨提示:</b>
            <span class="fl-lef dis-block dis-inlin clearfix" style="height:auto;margin:0;width: 340px">
                <i class="fl-lef dis-block dis-inlin"></i>
                <span class="fl-lef dis-block dis-inlin" style="width:290px;height:auto!important;line-height:20px;margin:0">设定面试时间以后,请再设定面试短信内容。这样,候选人会马上收到面试短信通知。另外，人人猎系统会提前半天再次向候选人自动发出相同内容的面试短信提醒。</span>
            </span>
        </div>
        <div  class=" date control-group" style="width:240px;margin-top:0">
            <div class="controls" style="width:240px;">
                <input readonly name="candidate_time" id="candidate_time" style="color:#999999;width:240px;height:20px;" type="text" onclick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss',min:laydate.now(), max:'2099-06-16 23:59:59'})" placeholder="YYYY-MM-DD hh:mm:ss">
            </div>
            <input type="hidden" value="" id="time_recid">
        </div>
        <div class="clearfix"><span class="min-btn l hover-hand" id="time_ok">确定</span><span class="min-btn m hover-hand" id="time_cancel">取消</span></div>
    </div>
    <script type="text/javascript"  src="/Public/js/laydate.dev.js"></script>
    <script>
        $(function () {
            $(".titl .select").click(function () {
                $(".titl .select ul").show();
            });
            $(".titl .select").mouseleave(function () {
                $(".titl .select ul").hide();
            })
        })

        function changeAudreasonList(tex, audreason, rid, audstart) {
           
            if(audreason == 1){
                tex = "未审核";
            }else if(audreason==2){
                tex = "不面试";
            }else if(audreason==3){
                tex = "面试预约";
            }else if(audreason==4){
                tex = "面试不通过";
            }else if(audreason==5){
                tex = "面试通过";
            }else if(audreason==6){
                tex = "已入职";
            }else if(audreason==7){
                tex = "已离职";
            }else if(audreason==8){
                tex = "审核不通过";
            }

            // 1 未审核 2 不面试 3 面试预约 4 面试不通过 5面试通过 6 已入职 7 已离职 8审核不通过
            if (audstart == 3 && (audreason == 1 || audreason == 2)) {
                sys_window("此人已经面试预约，不能为" + tex + "状态");
                return false;
            }
            if (audstart == 5 && (audreason == 1 || audreason == 2 || audreason == 3 || audreason == 4)) {
                sys_window("此人已经面试通过，不能为" + tex + "状态");
                return false;
            }
            if (audstart>audreason) {
                sys_window("面试状态不能向前更改");
                return false;
            }
            if (audreason == 2 || audreason == 4 || audreason == 7) {
                $("#reason").show();
            } else if (audreason == 3 && audstart != 3) {

                $("#time_recid").val(rid);
                $(".mask").show();
                $(".modify-data").show();
                return false;
            } else {
                $("#reason").hide();
            }

            $("#reasonid").val(rid);
            $("#statused").val(audreason);
            $(".mask").show();
            $("#sendStatus").show();
        }
        //填写面试时间取消按钮
        $("#time_cancel").click(function () {
            $("#candidate_time").val("");
            $("#time_recid").val("");
            $(".mask").hide();
            $(".modify-data").hide();
//            location.reload();
        })
        //填写面试时间确定按钮
        $("#time_ok").click(function () {
            $(".mask").hide();
            $(".modify-data").hide();
            var candidate_time = $("#candidate_time").val();
            var time_recid = $("#time_recid").val();
            if($.trim(candidate_time) == ""){
                sys_window("面试时间不能为空！");
                return false;
            }
            $("#candidate_time").val("");
            $("#time_recid").val("");

            $.post("/Home/Company/updateUserStatus.html", {
                'statused': 3,
                'reasonid': time_recid,
                'candidate_time': candidate_time,
            }, function (data) {
                location.reload();
            }, "json")
        })
        $(".delconfirm").click(function () {
            var reasonid = $("#reasonid").val();
            var statused = $("#statused").val();
            var content = $("#rea").val();
            if (statused == 2 || statused == 4 || statused == 7) {
                if (!content) {
                    sys_window("请选择拒绝理由！");
                    $("#sendStatus").hide();
                    return false;
                }
            }
            $.post("/Home/Company/updateUserStatus.html", {
                'reasonid': reasonid,
                'statused': statused,
                'content': content
            }, function (data) {
                window.location.reload();
            }, "json")
        });

        $(".qxconfirm").click(function () {
            $(".mask").hide();
            $("#sendStatus").hide();
//            location.reload();
        });

        $(document).ready(function () {

            $('.fsdx').click(function () {
                $("#bt_name").val($(this).attr("btname"));
                $("#mobile").val($(this).attr("mobile"));
                $("#recordid").val($(this).attr("recordid"));

                if ($(this).attr("real_audstart_time")) {
                    $("#msdate").val($(this).attr("real_audstart_time"));
                }
                $('.mask').show();
                $('.dx_page').slideDown();
            });
            $(".fs").click(function () {
                var bt_name = $("#bt_name").val();
                var mobile = $("#mobile").val();
                var msdate = $("#msdate").val();
                var gs = $("#gs").val();
                var address = $("#address").val();
                var lx = $("#lx").val();
                var lxr = $("#lxr").val();
                var hm = $("#hm").val();
                var recordid = $("#recordid").val();
                
                if (!mobile) {
                    sys_window("面试人没有留手机号码,您可以查看是否有邮箱填写或者联系我们的工作人员！");
                    return false;
                }
                if (!bt_name || bt_name == "XXXX") {
                    $("#ms_error").html("面试人不能为空");
                    $("#ms_error").show();
                    return false;
                }

                if (!msdate || msdate == "XXXX") {
                    $("#ms_error").html("面试时间不能为空");
                    $("#ms_error").show();

                    return false;
                }
                if (!address) {
                    $("#ms_error").html("公司地点不能为空");
                    $("#ms_error").show();
                    return false;
                }
                var msgContent = "亲爱的" + bt_name + "同学，我们诚挚邀请你" + msdate + "和我们面试，公司地点" + address;
                if (lx != "XXXX" && lx) {
                    msgContent += "乘车路线" + lx;
                }

                if (lxr != "XXXX" && lxr) {
                    msgContent += "，联系人" + lxr;
                }

                if (hm != "XXXX" || hm) {
                    msgContent += "，联系号码" + hm;
                }
                msgContent += "。请勿迟到。";
                var hash = "<?php $_SESSION['cookie']=time();echo md5('rrl_'.$_SESSION['cookie']);?>";
                $.post("/Home/Company/sendMessage.html", {
                    'msgcontent': msgContent,
                    'mobile': mobile,
                    'recordid':recordid,
                    'hash':hash
                }, function (data) {
                    if (data.code == "200") {
                        sys_window("发送成功!");
                        $('.mask').show();
                        $('.dx_page').hide();
                    } else {
                        sys_window(data.msg);
                        $('.dx_page').hide();
                        $('.mask').show();
                    }
                }, "json")
            });
            $('.qx').click(function () {
                $('.mask').hide();
                $('.dx_page').slideUp();
            });

            /*$('.fsdx').on('click',function(){
             $('.mask').show();
             $('.dx_page').show();
             })*/

            $('.fsdx').mouseenter(function () {
                $(this).css({'cursor': 'pointer'});
            })
        })
      
       
        $("#comWind").click(function () {
            
            $("#sys_window").hide();
            $(".mask").hide();
            location.reload();
        });

    </script>
    
    
</body>

</html>