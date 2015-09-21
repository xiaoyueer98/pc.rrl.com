<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎-用户中心</title>
        <meta name="keywords" content="人人猎,人人猎网，人人猎头,renrenlie.com,www.renrenlie.com,人人猎首页,人人猎官网，人人都是猎头" />
        <meta name="description" content="人人猎（www.renrenlie.com)是企业低成本极速直招平台，让企业一周内搞定招聘需求，为推荐人提供“人力资源”变现通道。" />
        <link rel="stylesheet" type="text/css" href="/Public/css/new-resizer.css">
        <link rel="stylesheet" href="/Public/css/menu_v2.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/new-recommends.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/lanrenzhijia2.css">
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/jquery.styleSelect2.js"></script>
        <script type="text/javascript" src="/Public/js/menu_v2.js"></script>
        <script type="text/javascript" src="/Public/js/al-index.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $(".mySelect3").styleSelect({styleClass: "selectFruits", optionsWidth: 1, speed: 'fast'});
                $(".down-menu").styleSelect({styleClass: "selectDark"});
            });
        </script>
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
        <div class="ms2 clearfix" style="background:#fff;">

            <div class="m2-l fl-lef">
                <div class="login-neitv m" style="padding:0;padding-top: 10px;padding-left: 5px;margin-bottom:10px">
                    <span class="img img-l m"></span>
                    <span class="con m">推荐人用户中心</span>
                    <span class="img m"></span>
                </div>
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
                
            </div>
            <div class="m2-r fl-rig">
                <div class="rcmd-login">
                    <div class="head">
                        <dl>
                            <dt class="dis-inlin dis-block fl-lef">
                            <?php if($arUser['avatar']):?>
                            <img src="/<?php echo $arUser['avatar'];?>" alt="">
                            <?php endif;?>
                            </dt>
                            <dd class="dis-inlin dis-block fl-lef">
                                <div class="clearfix"><span class="dis-inlin dis-block fl-lef">用户名：</span><em class="dis-inlin dis-block fl-lef">
                                        <?php  if(strpos($arUser['username'],"qq_")===0){ echo "qq用户"; }elseif(strpos($arUser['username'],"wx_")===0){ echo "微信用户"; }elseif(strpos($arUser['username'],"renren_")===0){ echo "人人用户"; }elseif(strpos($arUser['username'],"sina_")===0){ echo "新浪用户"; }else{ echo $arUser['username']; } ?>
                                    </em></div>
                                <div class="clearfix"><span class="dis-inlin dis-block fl-lef">手&nbsp&nbsp&nbsp&nbsp机：</span><em class="dis-inlin dis-block fl-lef"><?php echo $arUser['mobile']?></em></div>
                                <?php if($arUser['email']):?>
                                <div class="clearfix"><span class="dis-inlin dis-block fl-lef">邮&nbsp&nbsp&nbsp&nbsp箱：</span><em class="dis-inlin dis-block fl-lef"><?php echo $arUser['email']?></em></div>
                                <?php endif;?>
                            </dd>
                        </dl>
                        <span class="date"><?php echo $regTime;?></span>
                        <span class="date2">天</span>
                    </div>
                    <div class="rcmdlogin-con1" style='min-height: 0;'>
                        <div class="t clearfix">
                            <span class="dis-block dis-inlin fl-lef span1"></span>
                            <em class="dis-block dis-inlin fl-lef">任务</em>
                        </div>
                        <ul  style='list-style: decimal;margin-left:50px;'>
                            <?php if($Info['userinfo_completed'] && $Info['is_mobile'] && $Info['is_resume'] && $Info['is_record']):?>
                            <li>暂无任务；</li>
                            <?php else:?>
                            <?php if(!$Info['userinfo_completed']):?>
                            <li><a href='/Home/Login/userinfo.html' style='color:#000;'>个人资料需要完善,马上去完善；</a></li>
                            <?php endif;?>
                            <?php if(!$Info['is_mobile']):?>
                            <li><a href='/Home/Login/Recommended.html' style='color:#000;'>简历库（候选人）还没有，马上上传吧；</a></li>
                            <?php endif;?>
                            <?php if(!$Info['is_resume']):?>
                            <li><a href='/Home/Login/JobSearch.html' style='color:#000;'>快去为候选人推荐合适的职位吧；</a></li>
                            <?php endif;?>
                            <?php if(!$Info['is_record']):?>
                            <li><a href='/Home/Login/userinfo.html' style='color:#000;'>还没验证手机号码，赶快去验证吧；</a></li>
                            <?php endif;?>
                            <?php endif;?>
                        </ul>
                    </div>

                    <div class="rcmdlogin-con1">
                        <div class="t clearfix">
                            <span class="dis-block dis-inlin fl-lef span2"></span>
                            <em class="dis-block dis-inlin fl-lef">财富</em>
                        </div>
                        <ul>
                            <li class="clearfix"><span>1.简&nbsp历&nbsp库：</span><a href="/Home/Login/Recommended.html"><b><?php echo $resumeCount;?></b></a>份</li>
                            <li class="clearfix"><span>2.推荐次数：</span><a href="/Home/Login/Recording.html"><b><?php echo $recordCount;?></b></a>次</li>
                            <li class="clearfix"><span>3.累积收益：</span><a href="/Home/Login/Recording.html"><b><?php echo $feeCount;?></b></a>元</li>
                        </ul>
                    </div>

                    <div class="rcmdlogin-con1">
                        <div class="t clearfix">
                            <span class="dis-block dis-inlin fl-lef span3"></span>
                            <em class="dis-block dis-inlin fl-lef">进程</em>
                        </div>
                        <ul>
                            <li class="clearfix"><span>1.正在面试进程中的候选人：</span><a href="/Home/Login/Recording.html"><b><?php echo $isAudstartCount;?></b></a>个</li>
                            <li class="clearfix"><span>2.进入收款状态的候选人：</span><a href="/Home/Login/Recording.html"><b><?php echo $isSinkCount;?></b></a>个</li>
                        </ul>
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

    <script type="text/javascript">
        $(".step1 .input-list h3 .sousuo").click(function () {
            $(".step1 .input-list h3 em").text("搜索要推荐的职位");
            $(".job-list").show();
            $(".track-state").hide();
            if ($(this).hasClass("current")) {
                $(".step1 .input-list .myul").slideUp();
                $(".step1 .m-input").slideDown();
                $(this).removeClass("current").removeClass("m");
                $(".job-list").show();
                $(".track-state").hide();
            } else {
                $(".step1 .input-list .myul").slideDown();
                $(".step1 .m-input").slideUp();
                $(this).addClass("current").addClass("m")
            }
            ;
        });
        $(".step1 .input-list h3 .position-ollection-btn").click(function () {
            $(".step1 .m-input").hide();
            $(".step1 .input-list .myul").hide();
            $(".track-state").show();
            $(".job-list").hide();
            $(".step1 .input-list").css({"border": "none"});
            $(".step1 .input-list h3 em").text("收藏的职位")
        })
        /* 当鼠标移到表格上是，当前一行背景变色 */
        $(document).ready(function () {
            $(".data_list tr td").mouseover(function () {
                $(this).parent().find("td").css("background-color", "#eee");
            });
        })
        /* 当鼠标在表格上移动时，离开的那一行背景恢复 */
        $(document).ready(function () {
            $(".data_list tr td").mouseout(function () {
                var bgc = $(this).parent().attr("bg");
                $(this).parent().find("td").css("background-color", bgc);
            });
        })
        $(document).ready(function () {
            var color = "#fafafa"
            $(".data_list tr:odd td").css("background-color", color);  //改变偶数行背景色
            /* 把背景色保存到属性中 */
            $(".data_list tr:odd").attr("bg", color);
            $(".data_list tr:even").attr("bg", "#fff");
        })
    </script>
</body>

</html>