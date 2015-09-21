<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="/Public/img/favicon.ico" type="image/ico">
        <title>查看简历-人人猎</title>
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
                <li class="dis-inlin fl-lef indx-li"><a <?php if($cur == index): ?>class="m"<?php endif; ?> href="/Home/Index/index.html">首页</a></li>
                <li class="dis-inlin fl-lef"><a <?php if($cur == search): ?>class="m"<?php endif; ?> href="/Home/Index/search.html">职位</a></li>
                <li class="dis-inlin fl-lef"><a <?php if($cur == anli): ?>class="m"<?php endif; ?> href="/Home/Index/anli.html">案例</a></li>
                <li class="dis-inlin fl-lef last-li"><a href="/Home/Active/salon_show.html">活动<img src="/Public/img/new-index/new.png" alt=""></a></li>
            </ul>
            
        </div>
        <?php if(!empty($_SESSION['username']) || !empty($_SESSION['cusername'])){ $username = ($_SESSION['username']?$_SESSION['username']:$_SESSION['cusername']); $arUserinfo = M("userinfo")->where("username='$username'")->find(); $flag = $arUserinfo['flag']; if($flag==1){ $arHaedUserinfo = M("company")->where("username='$username'")->find(); }elseif($flag==0){ $arHaedUserinfo = M("member")->where("username='$username'")->find(); } if(strlen($username)=="31" && substr($username,0,3) == "wx_"){ $username = "微信用户"; } if(substr($username,0,3) == "qq_"){ $username = $_COOKIE[$username]; } ?>
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
                    <a class="a1 m fl-lef dis-inlin" href="/Home/Login/userinfo.html"><img src="/Public/img/company-img/al1.png" alt="">完善资料</a>
                    <a class="a2 fl-lef dis-inlin" href="/Home/Login/JobSearch.html"><img src="/Public/img/company-img/al2.png" alt="">签订合同</a>
                    <a class="a3 fl-lef dis-inlin" href="/Home/Login/Recording.html"><img src="/Public/img/company-img/al3.png" alt="">发布职位</a>
                    <a class="a4 fl-lef dis-inlin" href="/Home/Login/DetailsFunds.html"><img src="/Public/img/company-img/al4.png" alt="">查看候选人</a> 
                    <a class="a5 fl-lef dis-inlin" href="/Home/Login/Recommended.html"><img src="/Public/img/company-img/al5.png" alt="">入职管理</a>
                    <a class="a6 fl-lef dis-inlin" href="/Home/Login/logout.html"><img src="/Public/img/company-img/al6.png" alt="">退出登录</a>
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
                    <a class="a1 m fl-lef dis-inlin" href="/Home/Company/EnterpriseInformation.html"><img src="/Public/img/new-index/a1.png" alt="">完善资料</a>
                    <a class="a2 fl-lef dis-inlin" href="/Home/Company/EnterpriseInformation.html"><img src="/Public/img/new-index/a2.png" alt="">管理合同</a>
                    <a class="a3 fl-lef dis-inlin" href="/Home/Company/companySendJob.html"><img src="/Public/img/new-index/a3.png" alt="">发布职位</a>
                    <a class="a4 fl-lef dis-inlin" href="/Home/Company/companyJobList.html"><img src="/Public/img/new-index/a4.png" alt="">查看候选人</a>
                    <a class="a5 fl-lef dis-inlin" href="/Home/Company/toBePaid.html"><img src="/Public/img/new-index/a5.png" alt="">入职管理</a>
                    <a class="a6 fl-lef dis-inlin" href="/Home/Login/logout.html"><img src="/Public/img/new-index/a6.png" alt="">退出登录</a>
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
                    <li class="m first dis-block dis-inlin fl-lef"><a class="m">候选人简历</a></li>
                </ul>
                <div class="zaixian-jl" style="display:block">
                    <h3>基本信息</h3>
                    <div class="clearfix ms">
                        <ul class="fl-lef first">

                            <li class="clearfix">
                                <em class="dis-block dis-inlin fl-lef">姓名：</em>
                                <span class="dis-block dis-inlin fl-lef"><?php echo ($userinfo['username']); ?></span>
                            </li>
                            <li class="clearfix">
                                <em class="dis-block dis-inlin fl-lef">性别：</em>
                                <span class="dis-block dis-inlin fl-lef"><?php echo ($userinfo['sex']); ?></span>
                            </li>
                            <?php if($userinfo['age']){?>
                            <li class="clearfix">
                                <em class="dis-block dis-inlin fl-lef">年龄：</em>
                                <span class="dis-block dis-inlin fl-lef"><?php echo $userinfo['age'] ?></span>
                            </li>
                            <?php }?>
                            <li class="clearfix">
                                <em class="dis-block dis-inlin fl-lef">在职状态：</em>
                                <span class="dis-block dis-inlin fl-lef"><?php echo ($userinfo['stage']); ?></span>
                            </li>
                        </ul>
                        <ul class="fl-lef">
                            <li class="clearfix">
                                <em class="dis-block dis-inlin fl-lef">联系电话：</em>
                                <span class="dis-block dis-inlin fl-lef"><?php echo ($userinfo['mobile']); ?></span>
                            </li>
                             <?php if($userinfo['email']){?>
                            <li class="clearfix">
                                <em class="dis-block dis-inlin fl-lef">邮箱：</em>
                                <span class="dis-block dis-inlin fl-lef"><?php echo $userinfo['email'] ?></span>
                            </li>
                            <?php }?>
                            <?php if($userinfo['qqnum']){?>
                            <li class="clearfix">
                                <em class="dis-block dis-inlin fl-lef">QQ号码：</em>
                                <span class="dis-block dis-inlin fl-lef"><?php echo $userinfo['qqnum'] ?></span>
                            </li>
                            <?php }?>

                        </ul>
                    </div>
                    <?php if($userinfo['personal']){?>
                    <div style="height:10px;width:100%;background:#f5f5f5;margin:10px 0;"></div>
                    <h3 style="margin-top:25px;margin-bottom:10px;">自我评价</h3>
                    <div class="clearfix" style="color: #727272;line-height: 23px;margin-top: 0;padding: 10px 20px 10px 10px;width: 600px;margin-left: 40px;">
                        <div class="clearfix p1 wk"><?php echo $userinfo['personal']?></div>
                    </div>

                    <?php }?>
                    <?php if($userinfo['education']){?>
                    <div style="height:10px;width:100%;background:#f5f5f5;margin:10px 0;"></div>
                    <h3 style="margin-top:25px;margin-bottom:10px;">教育经历</h3>
                    <div class="clearfix" style="color: #727272;line-height: 23px;margin-top: 0;padding: 10px 20px 10px 10px;width: 600px;margin-left: 40px;">
                        <div class="clearfix p1 wk"><?php echo $userinfo['education']?></div>
                    </div>

                    <?php }?>
                    <?php if($userinfo['workexper']){?>
                    <div style="height:10px;width:100%;background:#f5f5f5;margin:10px 0;"></div>
                    <h3 style="margin-top:25px;margin-bottom:10px;">工作经历</h3>
                    <div class="clearfix" style="color: #727272;line-height: 23px;margin-top: 0;padding: 10px 20px 10px 10px;width: 600px;margin-left: 40px;">
                        <div class="clearfix p1 wk"><?php echo $userinfo['workexper']?></div>
                    </div>

                    <?php }?>
                    <?php if($userinfo['uploadName']){?>
                    <div style="height:10px;width:100%;background:#f5f5f5;margin:10px 0;"></div>
                    <h3 style="margin-top:25px;margin-bottom:10px;">附件简历</h3>
                    <div class="clearfix ms hover-hand">
                        <div class="load-jl">
                            <span class="dis-block"></span>
                            <b><?php echo $userinfo['uploadName'];?></b>
                            <em class="dis-block" style="display: none;"><a class="clearfix_img" href="<?php echo $userinfo['uploadUrl'] ?>">点击下载</a></em>
                        </div>
                    </div>    

                    <?php }?>
                    <?php if($userinfo['because']){?>
                    <div style="height:10px;width:100%;background:#f5f5f5;margin:10px 0;"></div>
                    <h3 style="margin-top:25px;margin-bottom:10px;">推荐理由</h3>
                    <div class="clearfix" style="color: #727272;line-height: 23px;margin-top: 0;padding: 10px 20px 10px 10px;width: 600px;margin-left: 40px;">
                        <div class="clearfix p1 wk"><?php echo $userinfo['because']?></div>
                    </div>
                    <?php }?>
                    <div class="clearfix ms wk">

                        <?php if(!$userinfo['uploadName']){?>
                        <span class="my-btn hover-hand fl-lef" style="margin-left:135px;margin-top:20px;" id="export_reason">导出简历</span>
                        <?php }?>


                        <span class="my-btn hover-hand fl-lef btn" style="margin-left:30px;margin-top:20px;" onclick="history.back()">返回</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" value="<?php echo ($id); ?>" id="view_id">
    <input type="hidden" value="<?php echo ($jid); ?>" id="view_jid">
    <input type="hidden" value="<?php echo ($btid); ?>" id="view_btid">
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


        $(".load-jl").mouseenter(function() {
            $(".load-jl em").show();
        })
        $(".load-jl").mouseleave(function() {
            $(".load-jl em").hide();
        })

        $(function() {
            $("#export_reason").click(function() {
                var id = $("#view_id").val();
                var jid = $("#view_jid").val();
                var btid = $("#view_btid").val();
                if (!id || !jid || !btid) {
                    sys_wind("系统繁忙！");
                    return false;
                }
                window.location.href = "/Home/Company/download/id/" + id + "/jid/" + jid + "/btid/" + btid + ".html"
            });
        })
    </script>
</body>

</html>