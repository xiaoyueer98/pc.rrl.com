<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="/Public/img/favicon.ico" type="image/ico">
        <title>人人猎-沙龙活动报名</title>
        <meta name="keywords" content="人人猎,人人猎网，人人猎头,renrenlie.com,www.renrenlie.com,人人猎首页,人人猎官网，人人都是猎头" />
        <meta name="description" content="人人猎（www.renrenlie.com)是企业低成本极速直招平台，让企业一周内搞定招聘需求，为推荐人提供“人力资源”变现通道。" />
        <link rel="stylesheet" type="text/css" href="/Public/css/new-resizer.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/salon.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/boss.css">
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/al-index.js"></script>
        <style>
            .tijiao_btn{
                border:none;
                width: 168px;
                height: 40px;
                line-height: 40px;
                text-align: center;
                color: #fff!important;
                font-size: 14px;
                background: #0983c6;
                display: block;
                margin-top:40px;
            }
        </style>
    </head>
    <body>
        <div class="mask" id="mask"></div> 
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
        <div class="new-salon1 clearfix">
            <h2></h2>
            <div class="m1 clearfix">
                <h3></h3>
                <div class="l fl-lef">
                    <ul>
                        <li class="clearfix"><em class="dis-inlin dis-block fl-lef">时间：</em><span class="dis-inlin dis-block fl-lef"><?php echo ($arSalonActive["activetime"]); ?></span></li>
                        <!-- <li class="clearfix"><em class="dis-inlin dis-block fl-lef">标题：</em><span class="dis-inlin dis-block fl-lef"><?php echo ($arSalonActive["activename"]); ?>。</span></li> -->
                        <li class="clearfix"><em class="dis-inlin dis-block fl-lef">主题：</em><span class="dis-inlin dis-block fl-lef"><?php echo ($arSalonActive["theme"]); ?>。</span></li>
                        <li class="clearfix"><em class="dis-inlin dis-block fl-lef">电话：</em><span class="dis-inlin dis-block fl-lef">010-57188076</span></li>
                        <li class="clearfix mydizhi hover-hand">
                            <em class="dis-inlin dis-block fl-lef">地址：</em>
                            <span style="position:relative" class="dis-inlin dis-block fl-lef">海淀区西二旗辉煌国际2号楼2206. <a href="">（近距指引）
                                    <div class="tu">
                                        <div class="clearfix">
                                            <img src="/Public/img/activity-img/tu1.jpg" alt="">
                                        </div>
                                        <div class="clearfix">
                                            <img src="/Public/img/activity-img/tu2.jpg" alt="">
                                        </div>
                                        <div class="clearfix">
                                            <img src="/Public/img/activity-img/tu3.jpg" alt="">
                                        </div>
                                        <div class="clearfix">
                                            <img src="/Public/img/activity-img/tu4.jpg" alt="">
                                        </div>
                                        <div class="clearfix">
                                            <img src="/Public/img/activity-img/tu5.jpg" alt="">
                                        </div>
                                    </div></a></span>
                        </li>
                    </ul>
                </div>
                <div class="r fl-rig">
                    <span class="cx">查询</span>
                    <script type="text/javascript" src="http://api.map.baidu.com/api?v=1.3&ak=7nqCp5QGXqGaxpBkOIvb16po"></script>
                    <input id="text_" type="hidden" value="北京市海淀区西二旗辉煌国际2号楼2206" style="margin-right:100px;"/>
                    <input id="result_" type="hidden" />
                    <div class="ditu" id="container"></div>
                </div>
            </div>
            <h1>报名表<span class="fl-rig dis-block dis-inlin">*表示必填项</span></h1>
            <div class="m2 clearfix">
                <h3></h3>
                <div class="l fl-lef">
                    <ul>
                        <li class="clearfix"><em class="dis-inlin dis-block fl-lef m">姓&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp名：</em><input type="text" placeholder="输入真实姓名,系统会对个人信息保密" class="dis-inlin dis-block fl-lef" id="name"></li>
                        <li class="clearfix"><em class="dis-inlin dis-block fl-lef">用&nbsp户&nbsp名：</em><input type="text" placeholder="如果是本网站用户，请填写用户名" class="dis-inlin dis-block fl-lef" id="username"></li>
                        <li class="clearfix"><em class="dis-inlin dis-block fl-lef">公&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp司：</em><input type="text" placeholder="请输入您目前所任职的公司" class="dis-inlin dis-block fl-lef" id="company"></li>
                        <li class="clearfix"><em class="dis-inlin dis-block fl-lef">职&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp位：</em><input type="text" placeholder="输入职位" class="dis-inlin dis-block fl-lef" id="jobposition"></li>
                        <li class="clearfix"><em class="dis-inlin dis-block fl-lef m">手机号码：</em><input type="text" placeholder="输入手机号码，用以接收沙龙活动短信息" class="dis-inlin dis-block fl-lef" id="mobile"></li>
                        <li class="clearfix"><em class="dis-inlin dis-block fl-lef">Q&nbspQ号码：</em><input type="text" placeholder="输入QQ号码" class="dis-inlin dis-block fl-lef" id="qq"></li>
                        <li class="clearfix"><em class="dis-inlin dis-block fl-lef">微信号码：</em><input type="text" placeholder="输入微信号码" class="dis-inlin dis-block fl-lef" id="weixin"></li>
                        <!-- <li><p class="error" id="salonError" style="margin-left:20px;margin-top:10px;display:none;">错误</p></li> -->
                        <li class="clearfix ero" id="salonError">
                            <b class="fl-lef dis-block dis-inlin">温馨提示:</b>
                            <span class="fl-lef dis-block dis-inlin clearfix">
                                <i class="fl-lef dis-block dis-inlin"></i>
                                <em class="fl-lef dis-block dis-inlin"></em>
                            </span>
                        </li>
                        <li><button class="hover-hand tijiao_btn" id="salonBtn">提交</button></li>
                    </ul>
                </div>
                <div class="r fl-lef">
                    <h4>感兴趣的话题</h4>
                    <textarea placeholder="" id="topic"></textarea>
                    <h4>建议（对人人猎）</h4>
                    <textarea placeholder="" id="adivce"></textarea>
                </div>
                <img class="fl-rig dis-block dis-inlin myimg" src="/Public/img/rcmd-img/sl-pic.png" alt="">
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
        $(document).ready(function () {
            $(".mydizhi a").on("mouseenter", function () {
                $(".tu").show();
            }).on("mouseleave", function () {
                $(".tu").hide();
            });
        })
    </script>
    <script type="text/javascript">
        var map = new BMap.Map("container");
        map.centerAndZoom("北京", 12);
        map.enableScrollWheelZoom();    //启用滚轮放大缩小，默认禁用
        map.enableContinuousZoom();    //启用地图惯性拖拽，默认禁用

        map.addControl(new BMap.NavigationControl());  //添加默认缩放平移控件
        map.addControl(new BMap.OverviewMapControl()); //添加默认缩略地图控件
        map.addControl(new BMap.OverviewMapControl({isOpen: true, anchor: BMAP_ANCHOR_BOTTOM_RIGHT}));   //右下角，打开

        var localSearch = new BMap.LocalSearch(map);
        localSearch.enableAutoViewport(); //允许自动调节窗体大小

        searchByStationName();
        function searchByStationName() {
            map.clearOverlays();//清空原来的标注
            var keyword = document.getElementById("text_").value;
            localSearch.setSearchCompleteCallback(function (searchResult) {
                var poi = searchResult.getPoi(0);
                document.getElementById("result_").value = poi.point.lng + "," + poi.point.lat;
                map.centerAndZoom(poi.point, 13);
                var marker = new BMap.Marker(new BMap.Point(poi.point.lng, poi.point.lat));  // 创建标注，为要查询的地方对应的经纬度
                map.addOverlay(marker);
                var content = document.getElementById("text_").value + "<br/><br/>经度：" + poi.point.lng + "<br/>纬度：" + poi.point.lat;
                var infoWindow = new BMap.InfoWindow("<p style='font-size:14px;'>" + content + "</p>");
                marker.addEventListener("click", function () {
                    this.openInfoWindow(infoWindow);
                });
                // marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
            });
            localSearch.search(keyword);
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#salonBtn")[0].disabled = false;
            $("#salonBtn").click(function () {

                this.disabled = true;

                var name = $("#name").val();
                var username = $("#username").val();
                var mobile = $("#mobile").val();
                var jobposition = $("#jobposition").val();
                var company = $("#company").val();
                var qq = $("#qq").val();
                var weixin = $("#weixin").val();
                var topic = $("#topic").val();
                var advice = $("#advice").val();
                if ($.trim(name) == "") {
                    this.disabled = false;
                    $("#salonError").show();
                    $("#salonError span em").html("请填写姓名");
                    return;
                }
                if ($.trim(mobile) == "") {
                    this.disabled = false;
                    $("#salonError").show();
                    $("#salonError span em").html("请填写手机号码");
                    return;

                } else {
                    var hash = "<?php $_SESSION['cookie']=time();echo md5('rrl_'.$_SESSION['cookie']);?>";
                    $.post("/Home/Active/signup_repeat_judged", {
                        'mobile': mobile,
                    }, function (data) {

                        if (data.code != "200") {
                            $("#salonBtn")[0].disabled = false;
                            $("#salonError").show();
                            $("#salonError span em").html(data.msg);
                            return;
                        } else {
                            $.post("/Home/Active/sign_up_save", {
                                'name': name,
                                'username': username,
                                'mobile': mobile,
                                'jobposition': jobposition,
                                'company': company,
                                'qq': qq,
                                'weixin': weixin,
                                'topic': topic,
                                'advice': advice,
                                'hash': hash,
                            }, function (data) {

                                if (data.code != "200") {
                                    $("#salonBtn")[0].disabled = false;
                                    $("#salonError").show();
                                    $("#salonError span em").html(data.msg);
                                    return;
                                } else {
                                    alert(data.msg);
                                    location.href = "/Home/Active/salon_show";
                                }
                            }, "json");
                        }
                    }, "json");

                }
            })
            //        $(".shalong").keyup(function (e) {
            //            if (e.keyCode == "13") {
            //                    $("#salonBtn").click();   //服务器控件loginsubmit点击事件被触发
            //                    return false;
            //        }
            //        })

            $(".dengluBtn,#denglu3").click(function () {
                $(".mask").show();
                $("#conZhuce").hide();
                $(".denglu").show();
            })

            $("#dengluBtn2,#zhuce").click(function () {
                $(".mask").show();
                $(".denglu").hide();
                $("#conZhuce").show();
            })
            $(".Close,.close").click(function () {
                $(".mask").hide();
                $("#conZhuce").hide();
                $(".denglu").hide();
                //location.href = $("#hrefUrl").val();
            })

        })
        $("input[name='usernamees']").focus(function () {
            $(this).next().hide();
        })
        $("input[name='usernamees']").blur(function () {
            if ($(this).val() == "") {
                $(this).next().show();
            }
        })
        $("input[name='passwordes']").focus(function () {
            $(this).next().hide();
        })
        $("input[name='passwordes']").blur(function () {
            if ($(this).val() == "") {
                $(this).next().show();
            }
        })

    </script>
</body>
</html>