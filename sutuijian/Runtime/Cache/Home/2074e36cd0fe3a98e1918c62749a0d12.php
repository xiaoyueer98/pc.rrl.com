<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="/Public/img/favicon.ico" type="image/ico">
        <title>入职管理-人人猎</title>
        <meta name="keywords" content="人人猎,人人猎网，人人猎头,renrenlie.com,www.renrenlie.com,人人猎首页,人人猎官网，人人都是猎头" />
        <meta name="description" content="人人猎（www.renrenlie.com)是企业低成本极速直招平台，让企业一周内搞定招聘需求，为推荐人提供“人力资源”变现通道。" />

        <link rel="stylesheet" type="text/css" href="/Public/css/new-resizer.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/new-company.css">
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/new-company-common.js"></script>
        <script type="text/javascript" src="/Public/js/al-index.js"></script>			
    </head>
    <body>
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

    <div class="wrap" style="top:0;">
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
                    <li class="first dis-block dis-inlin fl-lef<?php if(!$act):?> m<?php endif;?>"><a class="<?php if(!$act):?>m <?php endif;?>back-none" href="/Home/Company/toBePaid.html">进程跟踪</a></li>
                    <li class="first dis-block dis-inlin fl-lef<?php if($act == "newPaid"):?> m<?php endif;?>"><a class="<?php if($act == "newPaid"):?>m <?php endif;?>back-none" href="/Home/Company/toBePaid/act/newPaid.html">待付账单</a></li>
                    <li class="first dis-block dis-inlin fl-lef<?php if($act == "oldPaid"):?> m<?php endif;?>"><a class="<?php if($act == "oldPaid"):?>m <?php endif;?>back-none" href="/Home/Company/toBePaid/act/oldPaid.html">付款记录</a></li>
                </ul>
                <div class="add-resume track-state<?php if($act):?> undis<?php endif;?>">
                    <div class="con"> 
                        <div class="titl">进程跟踪</div>
                        <table style="width:689px;"> 
                            <tbody> 
                                <tr class="t"> 
                                    <th>序号</th> 
                                    <th>面试职位</th> 
                                    <th>推荐进度</th> 
                                    <th>招聘费（元）</th> 
                                    <th>总招聘人数</th> 
                                </tr> 
                                <tr style="border:none;height:10px!important;">
                                    <td style="border:none;height:10px!important;"></td>
                                </tr>
                            </tbody>
                            <?php if($jobList):?>
                            <?php foreach($jobList as $key=>$job):?>
                            <tr> 
                                <td class="wh47 wk" style="border-left: 1px solid #b3b3b3;"><?php echo $key+1;?></td> 
                                <td class="wh77 wk table-text-left"><?php echo $job['title']?></td> 
                                <td class="wh54 wk table-text-left shenhed cur_point" tid="<?php echo $job['j_id']?>"><img src="/Public/img/company-img/icon4.png" alt=""></td> 
                                <td class="wh102 wk table-text-left"><?php echo $job['Tariff']?></td> 
                                <td class="wh102 wk"><?php echo $job['employ']?></td> 
                            </tr> 

                            <tbody class="state undis" id="state_<?php echo $job['j_id']?>"> 
                                <?php foreach($job['logList'] as $keys=>$logList):?>
                                <tr> 
                                    <td colspan="1"></td> 
                                    <td class="wh77 wk" colspan="1"><?php echo date("Y-m-d H:i",$logList['created_at'])?></td> 
                                    <td class="prompt"> <b></b><i <?php if($keys==0):?>class="m"<?php endif;?>></i> </td> 
                                    <td class="wh220 wk" colspan="3"><?php echo $logList['content'];?></td> 
                                </tr> 
                                <?php endforeach;?> 
                            </tbody> 

                            <?php endforeach;?>
                        </table> 
                        <?php else:?>
                        <tr> 
                            <td  class="wk" colspan="5"  style="border-left: 1px solid #b3b3b3;"><b>暂无记录</b></td>
                        </tr>
                        </table> 
                        <?php endif;?>
                    </div>  
                </div>

                <div class="add-resume track-state<?php if($act !="newPaid"):?> undis<?php endif;?>">
                     <div class="con"> 
                        <div class="titl">待付账单</div>
                        <table style="width:689px;" class="data_list"> 
                            <tbody> 
                                <tr class="t"> 
                                    <th>序号</th> 
                                    <th>被推荐人</th> 
                                    <th>推荐人</th> 
                                    <th>面试职位</th> 
                                    <th>招聘费（元）</th> 
                                    <th>入职日期</th> 
                                </tr> 

                                <tr style="border:none;height:10px!important;">
                                    <td style="border:none;height:10px!important;"></td>
                                </tr>
                                <?php if($newPaid['payList']):?>
                                <?php foreach($newPaid['payList'] as $payIno):?>
                                <tr> 
                                    <td class="wh47 wk" style="border-left: 1px solid #b3b3b3;"><?php echo $payIno['sort_id'];?></td> 
                                    <td class="wh113 wk table-text-left"><?php echo $payIno['btname'];?></td> 
                                    <td class="wh113 wk table-text-left"><?php echo $payIno['tname'];?></td> 
                                    <td class="wh190 wk table-text-left"><?php echo $payIno['Jobcate'];?></td> 
                                    <td class="wh102 wk hover-hand"> <?php echo $payIno['Tariff'];?></td> 
                                    <td class="wh102 wk table-text-left"><?php echo $payIno['posttime'];?></td> 
                                </tr> 
                                <?php endforeach;?>
                                <?php else:?>
                                <tr> 
                                    <td  class="wk" colspan="6"  style="border-left: 1px solid #b3b3b3;"><b>暂无记录</b></td>
                                </tr>

                                <?php endif;?>
                            </tbody> 
                        </table> 
                        <?php echo $newPaid['page'];?>
                    </div>  
                </div>

                <div class="add-resume track-state<?php if($act !="oldPaid"):?> undis<?php endif;?>">
                     <div class="con"> 
                        <div class="titl">付款记录</div>
                        <table style="width:689px;" class="data_list"> 
                            <tbody> 
                                <tr class="t"> 
                                    <th>序号</th> 
                                    <th>被推荐人</th> 
                                    <th>推荐人</th> 
                                    <th>在职状态</th> 
                                    <th>面试职位</th> 
                                    <th>面试状态</th> 
                                    <th>招聘费（元）</th> 
                                    <th>付款记录</th> 
                                </tr> 
                                <tr style="border:none;height:10px!important;">
                                    <td style="border:none;height:10px!important;"></td>
                                </tr>
                                <?php if($oldPaid['payList']):?>
                                <?php foreach($oldPaid['payList'] as $payIno):?>
                                <tr> 
                                    <td class="wh47 wk" style="border-left: 1px solid #b3b3b3;"><?php echo $payIno['sort_id'];?></td> 
                                    <td class="wh113 wk table-text-left"><?php echo $payIno['btname'];?></td> 
                                    <td class="wh113 wk table-text-left"><?php echo $payIno['tname'];?></td> 
                                    <td class="wh190 wk table-text-left"><?php echo $payIno['zzstatus'];?></td> 
                                    <td class="wh190 wk table-text-left"><?php echo $payIno['title'];?></td> 	
                                    <td class="wh102 wk hover-hand"> <?php echo $payIno['msstatus'];?></td> 
                                    <td class="wh102 wk table-text-left"><?php echo $payIno['Tariff'];?></td> 
                                    <td class="wh102 wk table-text-left"><?php echo $payIno['tatus'];?></td> 
                                </tr> 
                                <?php endforeach;?>
                                <?php else:?>
                                <tr> 
                                    <td  class="wk" colspan="8"  style="border-left: 1px solid #b3b3b3;"><b>暂无记录</b></td>
                                </tr>

                                <?php endif;?>

                            </tbody> 
                        </table> 
                        <?php echo $oldPaid['page'];?>
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

    </script>
</body>

</html>