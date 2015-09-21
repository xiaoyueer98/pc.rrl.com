<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en"> 
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="/Public/img/favicon.ico" type="image/ico">
        <title>人人猎-私人订制工作机会</title>
        <meta name="keywords" content="人人猎,人人猎网，人人猎头,renrenlie.com,www.renrenlie.com,人人猎首页,人人猎官网，人人都是猎头" />
        <meta name="description" content="人人猎（www.renrenlie.com)是企业低成本极速直招平台，让企业一周内搞定招聘需求，为推荐人提供“人力资源”变现通道。" />
        <link rel="stylesheet" type="text/css" href="/Public/css/new-resizer.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/new-recommends.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/boss.css">
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/al-index.js"></script>
    </head>
    <div class="mask" style="display:none;"></div>
    <div class="alt-srdz" style="display:none">
        <div class="alr-head">
            <img src="/Public/img/alt-head.png" alt="">
            <a href="javascript:void(0);" class="clos" id="close"></a>
        </div>
        <div class="con-text">
            <p>您成功完成了工作机会——私人订制，请您在设定的联系时间内，保持手机畅通，一旦有合适的工作机会，您的私人求职顾问将会与您联络。</p>
        </div>
        <div class="btn-z" style="width:168px;">
            <span class="my-btn2 m fl-lef" id="ok_btn">确定</span>
        </div>
    </div>
    <body style="background:#ffffff">
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

    <input type='hidden' id ="hash" value = "<?php $_SESSION['cookie']=time();echo md5('rrl_'.$_SESSION['cookie']);?>"; >
<div class="pc-zhuce" style="display: none" id='conZhuce'>
    <a href="javascript:;" class="close"></a>
    <h3></h3>
    <dl>
        <dt>
        <ul class="pc-nav">
            <li class="nav1 mover3" id='tjrzc'>推荐人<input type="hidden" name="usertype" value="0"/></li>
            <li class="nav2" id='qyzc'>招聘企业</li>
        </ul>
        <ul class="list" id="list1">
            <li><input type="text" name="username" value="请输入用户名" default="请输入用户名" onkeydown="ZC_KeyDown(event);" ></li>
            <li><input type="text" name="mobile" value="请输入手机号" default="请输入手机号" onkeydown="ZC_KeyDown(event);"></li>
            <li><input type="text" class="vfition" name="vfition" value="请输入验证码" default="请输入验证码" onkeydown="ZC_KeyDown(event);">
                <label class="vfit_btn1" style="display: block" id="get_reg_code">获取验证码</label>
                <label class="vfit_btn2"  style="display: none"><i>60</i>秒后重新获取</label>
            </li>
            <li><input type="text" class="possword"  name="possword" value="请输入密码" default="请输入密码" onkeydown="ZC_KeyDown(event);"></li>
            <p id="zhuceerror" style="display: none"></p>
        </ul>
        <ul class="list" id="list2" style="display:none;">
            <li><input type="text" name="cpname" value="请输入公司名称" default="请输入公司名称" onkeydown="ZC_KeyDown(event);"></li>
            <li><input type="text" name="address" value="请输入公司地址" default="请输入公司地址" onkeydown="ZC_KeyDown(event);"></li>
            <li><input type="text" name="mobile" value="请输入手机号" default="请输入手机号" onkeydown="ZC_KeyDown(event);"></li>
            <li><input type="text" class="vfition" name="vfition" value="请输入验证码" default="请输入验证码" onkeydown="ZC_KeyDown(event);"><label class="vfit_btn1" style="display: block" id="get_reg_code">获取验证码</label><label class="vfit_btn2"  style="display: none"><i>60</i>秒后重新获取</label></li>
            <li><input type="text" name="username" value="请输入用户名" default="请输入用户名" onkeydown="ZC_KeyDown(event);"></li>
            <li><input type="text" class="possword"  name="possword" value="请输入密码" default="请输入密码"  onkeydown="ZC_KeyDown(event);"></li>
            <p id="zhuceerror" style="display: none"></p>
        </ul>
        <div class="yanzheng">
            <input class="radio1" type="radio" name="xieyi" id="xieyaya" onkeydown="ZC_KeyDown(event);">
            <span>已阅读并接受人人猎网<a href="javascript:;" id="xieyisss">《用户协议和隐私条款》</a></span>
        </div>
        <button id="register">确认</button>
        </dt>
        <dd>
            <div class="yd">
                <span>已有账号</span>
                <em id="denglu3">点此登录</em>
            </div>
            <p>使用联合账号登录</p>
            <ul class="Sign" >
                <li><a href="/Home/Index/login?type=qq"><img src="/Public/img/qq_icon.png"></a></li>
                <li><a href="/Home/Index/login?type=sina"><img src="/Public/img/weibo.png"></a></li>
                <li><a href="/Home/Index/login?type=weixin"><img src="/Public/img/weixin.png"></a></li>
                <li><a href="/Home/Index/login?type=renren"><img src="/Public/img/renren.png"></a></li>
            </ul>
            <ul class="Grey" style="display:none">
                <li><img src="/Public/img/qq2.png"></li>
                <li><img src="/Public/img/Sina2.png"></li>
                <li><img src="/Public/img/weixin2.png"></li>
                <li><img src="/Public/img/renren2.png"></li>
            </ul>
        </dd>
    </dl>
</div>
 <script type="text/javascript" src="/Public/js/zhuce.js"></script>

    <div  class="denglu dengluBtn2">
    <a class="Close"></a>
    <h3></h3>
    <dl>
        <dt>
        <ul class="InputUl">
            <li><input onkeydown="DL_KeyDown(event);" class="DLUser" type="text" name="usernamees" value='<?php echo $_COOKIE[username];?>'/><span><?php if(!($_COOKIE[username] && $_COOKIE[password])){ echo "请输入用户名/手机号";}?></span></li>
            <li><input onkeydown="DL_KeyDown(event);" class="DLpassword" type="password" name="passwordes" value='<?php echo $_COOKIE[password];?>'/><span><?php if(!($_COOKIE[username] && $_COOKIE[password])){ echo "请输入密码";}?></span></li>
            <p class="error2"></p>
        </ul>
        <div class="yanzheng">
            <input type="checkbox" id="remembeme" <?php if($_COOKIE[username] && $_COOKIE[password]){ echo "checked";}?>>
                   <span>记住我<a href="/Home/Index/findpwd.html">忘记密码？</a></span>
        </div>
        <input type="submit" class="zhucequeren" value="确认" id="denglubutton">
        <div class="weixin_img">
            <img src="/Public/img/erweima_img.jpg" alt="">
        </div>
        </dt>
        <dd>
            <div class="yd">
                <span>还没账号</span>
                <em id="dengluBtn2">点此注册</em>
            </div>
            <p>使用联合账号登录</p>
            <ul>
                <li><a href="/Home/Index/login?type=qq"><img src="/Public/img/qq_icon.png"></a></li>
                <!-- <li><a href="<?php echo U('login?type=qq');?>"><img src="/Public/img/qq2.png"></a></li> -->
                <li><a href="/Home/Index/login?type=sina"><img src="/Public/img/weibo.png"></a></li>
                <li><a href="/Home/Index/login?type=weixin"><img src="/Public/img/weixin.png"></a></li>
                <!-- <li class="dl_weixin"><img src="/Public/img/weixin.png"></li> -->
                <li><a href="/Home/Index/login?type=renren"><img src="/Public/img/renren.png"></a></li>
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
 <script type="text/javascript" src="/Public/js/denglu.js"></script>
    <div class="wrap yjfk">
        <div class="yjfk-banner"><img src="/Public/img/rcmd-img/fk-banner.png" alt=""></div>
        <div class="content-t" style="position:relative">
            <h3>人人猎————最可靠的私人求职顾问</h3>
            <p class="text1">若你是年薪10万元以上的中高端人才，若你想收入更高、发展前程更好。若你希望你足不出户就有“高大上”的工作机会找上门。你最可靠的私人求职顾问--人人猎，帮你<b>“私人订制”</b>。人人猎,让与你匹配的工作机会轻松找到你。</p>
            <p>1.你只需将你正在看更好工作机会的计划，通过在线填写“订制卡片”告诉人人猎的资深顾问。</p>
            <p>2.人人猎免费帮你寻找与你最匹配的工作机会，并安排靠谱的面试机会。</p>
            <p>3.你无需接听骚扰电话、无需一次次向各企业重述你的个人信息，你只需参加2-3个靠谱的面试，从中选择最 适合你的优质工作机会。</p>
            <p>4.你入职以后，除可以领取<b>几千、几万</b>的自荐奖金外，你还会额外得到面试车补<b>1000元</b>。想想都很美吧！人人猎实现你的高薪工作梦+大额奖金+高额面试车补。</p>
            <p>马上参与， 请填写<b>工作机会私人订制卡片</b>，靠谱的工作机会就会自动找上门！</p>             
            <div style="margin-top:30px;position:absolute;right:-71px;top:257px">

                <div class="jiathis_style_24x24" id="shareAction" style="padding: 8px;width: 297px;">
                    <a class="jiathis_button_qzone"></a>
                    <a class="jiathis_button_weixin"></a>
                    <a class="jiathis_button_tsina"></a>

                    <a class="jiathis_button_tqq"></a>
                    <a class="jiathis_button_renren"></a>
                    <a class="jiathis_button_cqq"></a>
                    <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" style="padding:0px!important;  margin-right: -2px;" target="_blank"></a>
                    <a class="jiathis_counter_style" style="margin-right: 35px;"></a>
                </div>
            </div>
            <div class="content-b">
                <div class="yjfk-header">
                    <span class="fl-lef dis-block">工作机会私人订制卡片</span>
                    <div class="fl-rig clearfix">

                        <b class="dis-block fl-lef">温馨提示：</b>
                        <em class="clearfix dis-block fl-lef"><i></i><label class="fl-lef dis-block">人人猎会对您的个人信息进行严格保密，绝不会非法透露给第三方</label></em>
                    </div>
                </div>
                <div class="yjfk-con clearfix" style="margin-bottom:10px;">
                    <div class="fl-lef clearfix"><span class="fl-lef"><i>*</i>姓&nbsp名：</span><input placeholder="输入真实姓名,系统会对个人信息保密" class="input1" type="text" id="name"></div>
                    <div class="fl-rig clearfix"><span class="fl-lef"><i>*</i>手机号码：</span><input placeholder="请输入手机号码" class="input1" type="text" id="mobile"></div>
                </div>
                <div class="yjfk-con clearfix" style="margin-top:10px;">
                    <div class="fl-lef clearfix"><span class="fl-lef"><i>*</i>方便联系的时间</span><input placeholder="如：随时、周六日、其他指定时间" class="input1" type="text" id="able_time"></div>
                    <div class="fl-rig clearfix"><span class="fl-lef"><i>*</i>验证码：</span><input placeholder="请输入验证码" class="input1 wh140" type="text" id="verify"><label id="getcode">获取验证码</label></div>
                </div>
                <div class="yjfk-con clearfix" style="margin-top:10px;">
                    <div class="fl-lef clearfix"><span class="fl-lef"><i>*</i>求职意愿：</span><input placeholder="输入职位名称"  class="input1 wh808" type="text" id="want"></div>
                </div>
                <div class="clearfix ero" id="bankError" style="display: none;">
                    <b class="fl-lef dis-block dis-inlin" style="margin-left:20px;">错误提示:</b>
                    <span class="fl-lef dis-block dis-inlin clearfix" >
                        <i class="fl-lef dis-block dis-inlin"></i>
                        <span class="fl-lef dis-block dis-inlin" id="error"></span>
                    </span>
                </div>
            </div>
            <button class="my-btn" id="btn">完成订制</button>
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

         <!--<div class="return-index">
            <span></span>
            <i style="opacity: 0;"></i>
            <a href="/" style="display: none;">返回首页</a>
        </div>
        <div class="return-index scrol-top">
            <span></span>
            <i style="opacity: 0;"></i>
            <a href="javascript:void(0);" style="display: none;">返回顶部</a>
        </div> -->

    <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            var wait = 60;

            function time(o) {

                if (wait == 0) {
                    o.innerHTML = "获取验证码";
                    o.removeAttribute("disabled", false);
                    $('#getcode').css("background", "#206daf");
                    wait = 60;
                } else {
                    o.setAttribute("disabled", true);
                    o.innerHTML = "(" + wait + ")重新发送";
                    wait--;
                    setTimeout(function() {
                        time(o)
                    },
                            1000)
                }
            }
            $('#getcode').click(function() {

                this.disabled = true;

                var o = this;
                var mobile = $("#mobile").val();
                if ($.trim(mobile) == "") {
                    $("#mobile").focus();
                    $("#error").text("请填写手机号码");
                    $("#bankError").show();
                    this.disabled = false;
                    return;
                }
                $('#getcode').css("background", "#b4b4b4");
                var hash = "<?php $_SESSION['cookie']=time();echo md5('rrl_'.$_SESSION['cookie']);?>";
                $.post("/Home/Customized/send_msg", {
                    mobile: mobile,
                    hash:hash
                }, function(data) {
                    if (data.code != "200") {
                        $('#getcode')[0].disabled = false;
                        $('#getcode').css("background", "#206daf");
                        $("#error").text(data.msg);
                        $("#bankError").show();
                        return;
                    } else {
                        time(o);
                    }
                }, "json");
            })



            //点击完成定制按钮
            $('#btn').click(function() {
                this.disabled = true;
                var name = $.trim($("#name").val());
                var mobile = $.trim($("#mobile").val());
                var able_time = $("#able_time").val();
                var want = $("#want").val();
                var verify = $.trim($("#verify").val());
                if (name == "") {
                    $("#error").text("请填写姓名");
                    $("#bankError").show();
                    this.disabled = false;
                    return;
                }
                if (mobile == "") {
                    $("#error").text("请填写手机号码");
                    $("#bankError").show();
                    this.disabled = false;
                    return;
                }
                if (verify == "") {
                    $("#error").text("请填写验证码");
                    $("#bankError").show();
                    this.disabled = false;
                    return;
                }
                if (able_time == "") {
                    $("#error").text("请填写方便联系时间");
                    $("#bankError").show();
                    this.disabled = false;
                    return;
                }
                if (want == "") {
                    $("#error").text("请填写求职意愿");
                    $("#bankError").show();
                    this.disabled = false;
                    return;
                }
                $.post("/Home/Customized/info_save", {
                    name: name,
                    mobile: mobile,
                    verify: verify,
                    able_time: able_time,
                    want: want

                }, function(data) {
                    if (data.code != "200") {
                        $('#btn')[0].disabled = false;
                        $("#error").text(data.msg);
                        $("#bankError").show();
                        return;
                    } else {
                        $(".mask").show();
                        $(".alt-srdz").show();

                    }
                }, "json");


            })
            //点击取消
            $('#close,#ok_btn').click(function() {

                $(".mask").hide();
                $(".alt-srdz").hide();
                location.href = "/";
            })


        })

    </script>

    <script type="text/javascript">
        var url = "<?php echo $domain.$share['pcurl']?>";
        var jiathis_config = {
            url: url,
            title: "<?php echo $share['title']?>",
            summary: "<?php echo $share['desc']?>",
            pic: "<?php echo $share['img']?>"
        }
    </script> 
    <script src="http://v2.jiathis.com/code/jiathis_r.js?move=0"></script> 


</body>
</html>