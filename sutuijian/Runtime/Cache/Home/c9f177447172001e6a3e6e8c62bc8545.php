<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="/Public/img/favicon.ico" type="image/ico">
        <title>人人猎-上传简历坐等收钱</title>
        <meta name="keywords" content="人人猎,人人猎网，人人猎头,renrenlie.com,www.renrenlie.com,人人猎首页,人人猎官网，人人都是猎头" />
        <meta name="description" content="人人猎（www.renrenlie.com)是企业低成本极速直招平台，让企业一周内搞定招聘需求，为推荐人提供“人力资源”变现通道。" />
        <link rel="stylesheet" type="text/css" href="/Public/css/new-resizer.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/new-recommends.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/style.css">
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/al-index.js"></script>
        <style>
            .tanchu{
                width: 300px;
                height: 120px;
                padding:10px 0;
                background: #ffffff;
                box-shadow: 1px 1px 10px #2c2b2b;
                position: fixed;
                left: 50%;
                top: 50%;
                margin-left:-150px;
                margin-top: -90px;
                z-index: 100;
                border-radius: 15px;
            }
            .tanchu dl{
                margin:0 auto;
                width: 260px;
                margin-top: 10px;
            }

            .tanchu dl dd{
                text-align: center;
                color: #2380b8;
                line-height: 30px;
                font-size: 16px;
                font-weight: bold;
            }
            .tanchu dl dd button{
                width: 110px;
                height: 30px;
                background: #2380b8;
                border-radius: 5px;
                border:none;
                color: #ffffff;
                margin-top:10px;
            } 
        </style>
    </head>

    <body style="background:#ffffff">
        <div class="mask" style="display:none;"></div>
        <div style="display:none;" id="like_alert_kuang">
            <div class="tanchu">
                <dl>
                    <dd id="alert_title">您目前是企业账户，请切换至推荐人账户后，参与活动</dd>
                    <dd id="alert_ok"><button>确定</button></dd>
                </dl>
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

    <div class="pc-zhuce" style="display: none" id='conZhuce'>
    <!--<a href="javascript:;" class="close"></a>-->
    <h3></h3>
    <dl>
        <dt>
        <ul class="pc-nav">
            <li class="nav1 mover3" id='tjrzc'>推荐人<input type="hidden" name="usertype" value="0"/></li>
            <li class="nav2" id='qyzc'>招聘企业</li>
        </ul>
        <ul class="list" id="list1">
            <li><input type="text" name="username" value="请输入用户名" default="请输入用户名"></li>
            <li><input type="text" name="mobile" value="请输入手机号" default="请输入手机号"></li>
            <li><input type="text" class="vfition" name="vfition" value="请输入验证码" default="请输入验证码">
                <label class="vfit_btn1" style="display: block" id="get_reg_code">获取验证码</label>
                <label class="vfit_btn2"  style="display: none"><i>60</i>秒后重新获取</label>
            </li>
            <li><input type="text" class="possword"  name="possword" value="请输入密码" default="请输入密码" ></li>
            <p id="zhuceerror" style="display: none"></p>
        </ul>
        <ul class="list" id="list2" style="display:none;">
            <li><input type="text" name="cpname" value="请输入公司名称" default="请输入公司名称"></li>
            <li><input type="text" name="address" value="请输入公司地址" default="请输入公司地址"></li>
            <li><input type="text" name="mobile" value="请输入手机号" default="请输入手机号"></li>
            <li><input type="text" class="vfition" name="vfition" value="请输入验证码" default="请输入验证码"><label class="vfit_btn1" style="display: block" id="get_reg_code">获取验证码</label><label class="vfit_btn2"  style="display: none"><i>60</i>秒后重新获取</label></li>
            <li><input type="text" name="username" value="请输入用户名" default="请输入用户名"></li>
            <li><input type="text" class="possword"  name="possword" value="请输入密码" default="请输入密码" ></li>
            <p id="zhuceerror" style="display: none"></p>
        </ul>
        <div class="yanzheng">
            <input class="radio1" type="radio" name="xieyi" id="xieyaya">
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
            <li><input class="DLUser" type="text" name="usernamees" value='<?php echo $_COOKIE[username];?>'/><span><?php if(!($_COOKIE[username] && $_COOKIE[password])){ echo "请输入用户名/手机号";}?></span></li>
            <li><input class="DLpassword" type="password" name="passwordes" value='<?php echo $_COOKIE[password];?>'/><span><?php if(!($_COOKIE[username] && $_COOKIE[password])){ echo "请输入密码";}?></span></li>
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

    <div class="wrap yjfk" style="margin-top:10px;padding-top:0">
        <div class="yjfk-banner" style="margin-bottom:10px"><img src="/Public/img/rcmd-img/srdz-img.png" alt=""></div>
        <div class="content-t" style="padding-top:10px">
            
            <p class="jl-p clearfix" style="margin:0px auto；margin-bottom:10px;">
                <label class="dis-block clearfix">
                    <b class="dis-block dis-inlin fl-lef" style="color:#333333;">HR:</b>
                    <em style="width:930px;margin-left:10px;">如果你是HR，你所在的公司若招聘1人，往往会面试4-5人，面试过后但未录用的人，其实可以<b>大额变现</b>。</em>
                </label>
                <label class="dis-block clearfix" style="margin-top:10px;">
                    <b class="dis-block dis-inlin fl-lef" style="color:#333333;">猎头:</b>
                    <em style="width:920px;margin-left:10px;">如果你是猎头，每月会详细了解50名候选人，但是一般只有1-2名候选人拿到offer，你可以将剩余的50人<b>大额变现</b>。</em>
                </label>
            </p>
            <h5><b>1.</b>上传简历</h5>
            <p class="jl-p clearfix"><em>你只需每天下班后，将候选人简历上传至人人猎，要求上传的候选人简历满足：<br>
                    <i>1 . 年薪<b>10万</b>以上互联网中高端人才；</i><br>
                    <i>2 . 候选人<b>正在看</b>工作机会。</i> </em></p>
            <h5><b>2.</b>系统匹配</h5>
            <p class="jl-p clearfix"><em>人人猎会将你上传的候选人简历<b>匹配</b>到与之最合适的工作机会，并协调面试预约。</em></p>

            <h5><b>3.</b> 随心掌控</h5>
            <p class="jl-p clearfix"><em>当你上传候选人进入人人猎推荐流程后，可随时在用户中心查看候选人<b>面试状态</b>。</em></p>

            <h5><b>4.</b> 入职拿钱</h5>
            <p class="jl-p clearfix"><em>候选人入职后，就可得到相应的推荐<b>奖金</b>。</em></p>
            <div class="text">整个过程，只需要上传简历，还等什么？快快参与吧！</div>
            <img src="/Public/img/rcmd-img/hongb.png" alt="" class="hongb">
        </div>
        <span class="my-btn hover-hand" id='btn'>立即上传简历</span>
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
        $(document).ready(function() {
            $("#btn").click(function() {
                $.post(
                        "/Home/Upresume/is_login",
                        "",
                        function(re) {
                            if ($.trim(re) == 1) {
                                location.href = "/Home/Login/Recommended/act/addResume.html";
                                return;
                            } else if ($.trim(re) == 2) {
                                $(".mask").show();
                                $("#like_alert_kuang").show();
                                return;
                            } else {
                                $(".mask").show();
                                $(".denglu").show();
                                return;
                            }
                        }, "json");
            })
            $("#alert_ok").click(function() {
                $(".mask").hide();
                $("#like_alert_kuang").hide();
            })
        })
    </script>
    <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
    <script type="text/javascript">
        var url = "<?php echo $share['pcurl']?>";
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