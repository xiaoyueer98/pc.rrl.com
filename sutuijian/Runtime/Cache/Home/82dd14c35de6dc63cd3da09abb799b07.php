<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="/Public/img/favicon.ico" type="image/ico">
        <title>私人定制</title>
        <link rel="stylesheet" type="text/css" href="/Public/css/new-resizer.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/new-recommends.css">
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/al-index.js"></script>
    </head>
    
    <body style="background:#ffffff">
    <div class="mask" style="display:block;"></div>
    <div class="alt-srdz" style="display:block">
        <div class="alr-head">
            <img src="/Public/img/alt-head.png" alt="">
            <a href="javascript:void(0);" class="clos"></a>
        </div>
        <div class="con-text">
            <p>您成功上传了简历，请在设定的联系时间内，保持手机畅通，人人猎会根据您的简历匹配合适的工作，并与您联络。
</p>
        </div>
        <div class="btn-z">
            <span class="my-btn2 m fl-lef">确定</span>
            <span class="my-btn2 fl-lef">取消</span>
        </div>
    </div>
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

    <div class="yjfk-banner"><img src="/Public/img/rcmd-img/srdz-img.png" alt=""></div>
    <div class="wrap yjfk">
        
        <div class="content-t">
           <h5><b>1</b> 上传简历</h5>
           <p class="jl-p clearfix"><span></span><em>即日起，凡在人人猎上传个人简历便可以参与——“上传简历，坐等收钱”活动；</em></p>

           <h5><b>2</b> 简历要求</h5>
           <p class="jl-p clearfix"><span></span><em>    在人人猎上传的个人简历要求同时满足 , 年薪10万以上的中高端互联网人才、正在看工作机会；
                                                                     </em></p>

           <h5><b>3</b> 系统匹配</h5>
           <p class="jl-p clearfix"><span></span><em>
人人猎系统自动检索与候选人匹配的工作机会 , 人人猎求职顾问与您沟通时先进行人工匹配合适职位 ;当有新发布的职位时，系统将为您自动匹配优质职位；</em></p>

           <h5><b>4</b> 面试入职</h5>
           <p class="jl-p clearfix"><span></span><em>
最多参加人人猎帮你安排的2-3次面试，即可offer,而且还可以拿到<b>几千、几万元</b>的推荐奖励。</em></p>
            
            <div class="text">还等什么，快快上传简历吧。</div>
            <img src="/Public/img/rcmd-img/hongb.png" alt="" class="hongb">
        </div>
        <div class="content-b">
            <div class="yjfk-header">
                <span class="fl-lef dis-block">上传简历</span>
                <div class="fl-rig clearfix">

                    <b class="dis-block fl-lef">温馨提示：</b>
                    <em class="clearfix dis-block fl-lef"><i></i><label class="fl-lef dis-block">人人猎会对您的个人信息进行保密，绝不会非法透露给第三方</label></em>
                </div>
            </div>
            <div class="yjfk-con clearfix" style="margin-bottom:10px;">
                <div class="fl-lef clearfix"><span class="fl-lef"><i>*</i>真实姓名：</span><input placeholder="输入真实姓名,系统会对个人信息保密" class="input1" type="text"></div>
                <div class="fl-rig clearfix"><span class="fl-lef"><i>*</i>手机号码：</span><input placeholder="请输入手机号码" class="input1" type="text"></div>
            </div>
            <div class="yjfk-con clearfix" style="margin-top:10px;">
                <div class="fl-lef clearfix"><span class="fl-lef"><i>*</i>求职意愿：</span><input placeholder="请输入详细职位、如:高级UI设计师" class="input1" type="text"></div>
                <div class="fl-rig clearfix"><span class="fl-lef"><i>*</i>验证码：</span><input placeholder="请输入验证码" class="input1 wh140" type="text"><label>获取验证码</label></div>
            </div>
            <div class="yjfk-con clearfix" style="margin-top:10px;">
                <div class="fl-lef clearfix"><span class="fl-lef"><i>*</i>上传简历：</span><input placeholder="" class="input1 wh140" type="text"><label>上传简历</label></div>

               <div class="fl-rig clearfix"><span class="fl-lef"><i>*</i>方便联系时间：</span><input placeholder="请输入方便联系的时间 如：星期五下午六点以后" class="input1" type="text"></div>
            </div>
            <div class="yjfk-con clearfix" style="margin-top:10px;">
                <div class="fl-lef clearfix"><span class="fl-lef"><i>*</i>其他说明</span><input placeholder="请输入其他更多的要求  如：想在海淀区西二旗附近的公司"  class="input1 wh808" type="text"></div>
            </div>
            <div class="clearfix ero" id="bankError" style="display: block;">
                <b class="fl-lef dis-block dis-inlin" style="margin-left:20px;">温馨提示:</b>
                <span class="fl-lef dis-block dis-inlin clearfix">
                    <i class="fl-lef dis-block dis-inlin"></i>
                    <span class="fl-lef dis-block dis-inlin">请输入收款银行！请输入收款银行！请输入收款银行！</span>
                </span>
            </div>
        </div>
        <span class="my-btn">完成定制</span>
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

    <div class="return-index">
        <span></span>
        <i style="opacity: 0;"></i>
        <a href="/" style="display: none;">返回首页</a>
    </div>
    <div class="return-index scrol-top">
        <span></span>
        <i style="opacity: 0;"></i>
        <a href="javascript:void(0);" style="display: none;">返回顶部</a>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
          
        })
    </script>
</body>
</html>