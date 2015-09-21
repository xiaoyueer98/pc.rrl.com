<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="/Public/img/favicon.ico" type="image/ico">
        <title>找回密码-人人猎</title>
        <meta name="keywords" content="人人猎,人人猎网，人人猎头,renrenlie.com,www.renrenlie.com,人人猎首页,人人猎官网，人人都是猎头" />
        <meta name="description" content="人人猎（www.renrenlie.com)是企业低成本极速直招平台，让企业一周内搞定招聘需求，为推荐人提供“人力资源”变现通道。" />
        <link rel="stylesheet" type="text/css" href="/Public/css/new-resizer.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/focuspic2.css">
        <link rel="stylesheet" href="/Public/css/menu_v2.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/boss.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/new-index.css">
        <script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/focuspic2.js"></script>
        <script type="text/javascript" src="/Public/js/menu_v2.js"></script>
        <script type="text/javascript" src="/Public/js/denglu.js"></script>
        <script type="text/javascript" src="/Public/js/al-index.js"></script>
        <script type="text/javascript" src="/Public/js/window.js"></script>
    </head>
    <body>
        <div class="mask"></div>
        <div class="mask1"></div>
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

    <div class="wrapper">
    <div class="wrap">
        <div class="ms1">
            <div class="con1 clearfix">
                <span class="aa dis-inlin dis-block fl-lef">关键字</span>
                <div class="dis-block dis-inlin post fl-lef">
                    <input id="searchbox" class="dis-block dis-inlin post fl-lef" value="" placeholder="&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp JAVA &nbsp Android &nbsp IOS " type="text">
                    <span class="btn hover-hand dis-block dis-inlin post fl-lef btn-search">
                        <img src="/Public/img/new-index/position-btn.png" alt="">
                    </span>
                </div>
            </div>
            <div class="con2 clearfix">
                <span class="dis-inlin dis-block fl-lef">热门职位：</span>
                <ul class="dis-inlin dis-block fl-lef">
                    <li class="dis-inlin dis-block fl-lef"><a href="/Home/Index/search/position/产品经理.html">产品经理</a></li>
                    <li class="dis-inlin dis-block fl-lef"><a href="/Home/Index/search/position/PHP工程师.html">PHP工程师</a></li>
                    <li class="dis-inlin dis-block fl-lef"><a href="/Home/Index/search/position/IOS工程师.html">IOS工程师</a></li>
                    <li class="dis-inlin dis-block fl-lef"><a href="/Home/Index/search/position/前端工程师.html">前端工程师</a></li>
                    <li class="dis-inlin dis-block fl-lef"><a href="/Home/Index/search/position/运营总监.html">运营总监</a></li>
                </ul>
            </div>
        </div>
        <div class="ms2 clearfix">
            <div class="promo dis-inlin dis-block fl-lef">
                <div class="promo-bd">
                    <div style="position:absolute;left:-790px;">
                        <div>
                            <a href="/Home/Customized/index.html">
                                <img src="/Public/img/new-index/nindexlb4.jpg">
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="/Public/img/new-index/al-banner.png">
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="/Public/img/new-index/nindexlb1.png">
                            </a>
                        </div>
                        <div>
                            <a href="#">
                                <img src="/Public/img/new-index/nindexlb2.jpg">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="promo-ft">
                    <div id="J_PromoOpt" class="promo-opt">
                        <a href="javascript:;" class="J_Prev prev">
                            <i>
                            </i>
                        </a>
                        <a href="javascript:;" class="J_Next next">
                            <i>
                            </i>
                        </a>
                    </div>
                    <ul class="promo-nav">
                        <li class="selected">
                            <a href="javascript:void(0);">
                                1
                            </a>	
                        </li>	
                        <li>
                            <a href="javascript:void(0);">
                                2
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                3
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                4
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="ms2-r dis-inlin dis-block fl-rig">
                <a href="/Home/Customized/index.html" target='_blank'><img src="/Public/img/new-index/hd2.png" alt=""></a>
                <a  href='/Home/Active/new_sign_up.html' target='_blank'><img src="/Public/img/new-index/shalong-hd.png" alt=""></a>
                
                <a href="/Home/Upresume/index.html"><img src="/Public/img/new-index/hd3.png" alt=""></a>
                 <!-- <a href="javascript:void(0);" class="hd3">
                   <div id="marquee5">
                       <ul>
                           <?php foreach($arInventedData as $v){?>
                           <li>
                               <span><?php echo $v['title']?></span>
                               
                           </li>
                           <?php }?>
                         
                          
                       </ul>
                   </div> 
                                </a>  -->
            </div>
        </div>
        <div class="ms3 clearfix">
            <div id="J_Cat" class="cat fl-lef">
    <div class="cat-hd">
        <a href="/Home/Index/search.html">
            <h2>
                全部职位分类
            </h2>
        </a>
    </div>
    <div id="J_CatBd" class="cat-bd">
        <div id="J_CatMenu" class="cat-menu">
            <ul class="cat-menu-bd">
                <li class="J_Cat cat-1" data-id="1">
                    <h3>
                        管理类 
                    </h3>
                    <ul class="clearfix" style="border:none">
                        <li class="dis-inlin dis-block fl-lef"><a href="/Home/Index/search/position/CTO.html">CTO</a></li>
                    </ul>
                </li>

                <li class="J_Cat cat-1" data-id="1">
                    <h3>
                        技术类
                    </h3>
                    <ul class="clearfix" style="border:none">
                        <li class="dis-inlin dis-block fl-lef"><a href="/Home/Index/search/position/php.html">php</a></li>
                        <li class="dis-inlin dis-block fl-lef"><a href="/Home/Index/search/position/java.html">java</a></li>
                        <!-- <li class="dis-inlin dis-block fl-lef"><a href="/Home/Index/search/position/Python.html">Python</a></li> -->
                        <li class="dis-inlin dis-block fl-lef"><a href="/Home/Index/search/position/.net.html">.net</a></li>
                        <li class="dis-inlin dis-block fl-lef"><a href="/Home/Index/search/position/Android.html">Android</a></li>
                        <li class="dis-inlin dis-block fl-lef"><a href="/Home/Index/search/position/IOS.html">IOS</a></li>
                        <li class="dis-inlin dis-block fl-lef"><a href="/Home/Index/search/position/前端.html">前端</a></li>
                        <li class="dis-inlin dis-block fl-lef"><a href="/Home/Index/search/position/测试.html">测试</a></li>
                        <li class="dis-inlin dis-block fl-lef"><a href="/Home/Index/search/position/运维.html">运维</a></li>
                        <li class="dis-inlin dis-block fl-lef"><a href="/Home/Index/search/position/DBA.html">DBA</a></li>
                    </ul>
                </li>

                <li class="J_Cat cat-1" data-id="1">
                    <h3>
                        产品类
                    </h3>
                    <ul class="clearfix" style="border:none">
                        <li class="dis-inlin dis-block fl-lef"><a href="/Home/Index/search/position/PM.html">PM</a></li>
                        <li class="dis-inlin dis-block fl-lef"><a href="/Home/Index/search/position/UI.html">UI</a></li>
                        <li class="dis-inlin dis-block fl-lef"><a href="/Home/Index/search/position/UE.html">UE</a></li>
                    </ul>
                </li>

                <li class="J_Cat cat-1" data-id="1">
                    <h3>
                        运营类
                    </h3>
                    <ul class="clearfix" style="border:none">
                        <li class="dis-inlin dis-block fl-lef"><a href="/Home/Index/search/position/运营.html">运营</a></li>
                        <li class="dis-inlin dis-block fl-lef"><a href="/Home/Index/search/position/推广.html">推广</a></li>
                    </ul>
                </li>

                <li class="J_Cat cat-1" data-id="1">
                    <h3>
                        市场类
                    </h3>
                    <ul class="clearfix" style="border:none">
                        <li class="dis-inlin dis-block fl-lef"><a href="/Home/Index/search/position/地推.html">地推</a></li>
                        <li class="dis-inlin dis-block fl-lef"><a href="/Home/Index/search/position/BD.html">BD</a></li>
                    </ul>
                </li>

                <li class="J_Cat cat-1" data-id="1">
                    <h3>
                        职能类
                    </h3>
                    <ul class="clearfix" style="border:none">
                        <li class="dis-inlin dis-block fl-lef"><a href="/Home/Index/search/position/人事.html">HR</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

            <div class="ms3-r fl-rig">
                <ul class="nav">
                    <li class="fl-lef href hover-hand">热门职位</li>
                    <li class="fl-lef hover-hand">最新职位</li>
                </ul>
                <div class="con-public con-remen" style="display:block">
                    <?php if(is_array($comp2)): $i = 0; $__LIST__ = $comp2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cp): $mod = ($i % 2 );++$i;?><div class="clearfix list">
                           <span class="np-logo dis-block dis-inlin fl-lef">
                            <?php if($cp['type'] == 1):?>
                             <img src="<?php echo ($cp["thumlogo"]); ?>" alt="" width="50px" height="50px">
                            <?php else:?>
                             <img src="/Public/img/company_logo/bmkh.png" alt="" width="50px" height="50px">
                            <?php endif;?>
                            </span>
                            <ul class="r fl-rig">
                                <li class="clearfix li1">
                                    <a href="/Home/Index/EnterIndex2/comid/<?php echo ($cp["cpid"]); ?>/jobid/<?php echo ($cp["guid"]); ?>.html" target="_blank"><em class="dis-inlin dis-block fl-lef"><?php echo ($cp["title"]); ?></em></a>
                                    <span class="adrs dis-inlin dis-block fl-lef">[<?php echo ($cp["jobplace"]); ?>]</span>
                                    <a href="/Home/Index/EnterIndex2/comid/<?php echo ($cp["cpid"]); ?>/jobid/<?php echo ($cp["guid"]); ?>.html" target="_blank"><h6 class="dis-inlin dis-block fl-rig"><?php echo ($cp["cpname"]); ?></h6></a>
                                </li>
                                <li class="clearfix li2">
                                    <span class="dis-inlin dis-block fl-lef">月薪：</span>
                                    <span class="dis-inlin dis-block fl-lef"><?php echo ($cp["treatment"]); ?></span>
                                    <span class="dis-inlin dis-block fl-lef"><?php echo ($cp["experience"]); ?></span>
                                    <span class="dis-inlin dis-block fl-lef"><?php echo ($cp["education"]); ?></span>
                                    <div class="fl-rig dis-inlin dis-block">
                                        <span class="c-r dis-inlin dis-block fl-lef">招聘人数：</span>
                                        <span class="ic dis-inlin dis-block fl-lef" style="color: black;"><?php echo $cp['employ'];?></span>                                                                               
                                        <span class="c-r dis-inlin dis-block fl-lef">推荐人数：</span>
                                        <span class="ic dis-inlin dis-block fl-lef" style="color: red;font-weight: bold"><?php echo $cp['record_num'];?></span>

                                    </div>

                                    <div class="fl-rig dis-inlin dis-block">
                                        <?php if($cp["strycate"] != null): ?><span class="c-r dis-inlin dis-block fl-lef">所属行业：</span>
                                            <span class="ic dis-inlin dis-block fl-lef"><?php echo ($cp["strycate"]); ?></span><?php endif; ?>
                                        <?php if($cp["stage"] != null): ?><span class="c-r dis-inlin dis-block fl-lef">融资阶段：</span>
                                            <span class="ic dis-inlin dis-block fl-lef"><?php echo ($cp["stage"]); ?></span><?php endif; ?>
                                        <?php if($cp["scale"] != null): ?><span class="c-r dis-inlin dis-block fl-lef">规模：</span> 
                                            <span class="ic dis-inlin dis-block fl-lef"><?php echo ($cp["scale"]); ?></span><?php endif; ?>
                                    </div>

                                </li>
                                <li class="clearfix li3">
                                    <em class="c3-l	dis-inlin dis-block fl-lef">候选人成功入职，你即得奖励  <i>￥<?php echo ($cp["Tariff"]); ?></i></em>
                                    <span class="c-r dis-inlin dis-block fl-rig">[<?php echo ($cp["starttime"]); ?>]</span>
                                </li>
                            </ul>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                    <div class="clearfix"><span class="dis-block tsm" onclick="location.href = '/Home/Index/search.html'" style="cursor:pointer;">查看更多》</span></div>
                </div>
                <div class="con-public con-zuixin" style="display:none;">
                    <?php if(is_array($comp)): $i = 0; $__LIST__ = $comp;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cp): $mod = ($i % 2 );++$i;?><div class="clearfix list">
                            <span class="np-logo dis-block dis-inlin fl-lef">
                            <?php if($cp['type'] == 1):?>
                             <img src="<?php echo ($cp["thumlogo"]); ?>" alt="" width="50px" height="50px">
                            <?php else:?>
                             <img src="/Public/img/company_logo/bmkh.png" alt="" width="50px" height="50px">
                            <?php endif;?>
                            </span>
                            <ul class="r fl-rig">
                                <li class="clearfix li1">
                                    <a href="/Home/Index/EnterIndex2/comid/<?php echo ($cp["cpid"]); ?>/jobid/<?php echo ($cp["guid"]); ?>.html " target="_blank"><em class="dis-inlin dis-block fl-lef"><?php echo ($cp["title"]); ?></em></a>
                                    <span class="adrs dis-inlin dis-block fl-lef" style="background:none;">[<?php echo ($cp["jobplace"]); ?>]</span>
                                    <a href="/Home/Index/EnterIndex2/comid/<?php echo ($cp["cpid"]); ?>/jobid/<?php echo ($cp["guid"]); ?>.html" target="_blank"><h6 class="dis-inlin dis-block fl-rig"><?php echo ($cp["cpname"]); ?></h6></a>
                                </li>
                                <li class="clearfix li2">
                                    <span class="dis-inlin dis-block fl-lef">月薪：</span>
                                    <span class="dis-inlin dis-block fl-lef"><?php echo ($cp["treatment"]); ?></span>
                                    <span class="dis-inlin dis-block fl-lef"><?php echo ($cp["experience"]); ?></span>
                                    <span class="dis-inlin dis-block fl-lef"><?php echo ($cp["education"]); ?></span>
                                    <div class="fl-rig dis-inlin dis-block">
                                        <span class="c-r dis-inlin dis-block fl-lef">招聘人数：</span>
                                        <span class="ic dis-inlin dis-block fl-lef" style="color: black;"><?php echo $cp['employ'];?></span>                                                                               
                                        <span class="c-r dis-inlin dis-block fl-lef">推荐人数：</span>
                                        <span class="ic dis-inlin dis-block fl-lef" style="color: red;font-weight: bold"><?php echo $cp['record_num'];?></span>

                                    </div>
                                    <div class="fl-rig dis-inlin dis-block">
                                        <?php if($cp["strycate"] != null): ?><span class="c-r dis-inlin dis-block fl-lef">所属行业：</span>
                                            <span class="ic dis-inlin dis-block fl-lef"><?php echo ($cp["strycate"]); ?></span><?php endif; ?>
                                        <?php if($cp["stage"] != null): ?><span class="c-r dis-inlin dis-block fl-lef">融资阶段：</span>
                                            <span class="ic dis-inlin dis-block fl-lef"><?php echo ($cp["stage"]); ?></span><?php endif; ?>
                                        <?php if($cp["scale"] != null): ?><span class="c-r dis-inlin dis-block fl-lef">规模：</span> 
                                            <span class="ic dis-inlin dis-block fl-lef"><?php echo ($cp["scale"]); ?></span><?php endif; ?>
                                    </div>

                                </li>
                                <li class="clearfix li3">
                                    <em class="c3-l	dis-inlin dis-block fl-lef">候选人成功入职，你即得奖励  <i>￥<?php echo ($cp["Tariff"]); ?></i></em>
                                    <span class="c-r dis-inlin dis-block fl-rig">[<?php echo ($cp["starttime"]); ?>]</span>
                                </li>
                            </ul>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                    <div class="clearfix"><span class="dis-block tsm" onclick="location.href = '/Home/Index/search.html'" style="cursor:pointer;">查看更多》</span></div>
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

    <!--客服悬框begin-->
    <div class="scr-top">
        <ul>
            <li> 
                <img class="dis-block" src="/Public/img/new-index/wx-pic.png" alt="">
            </li>
            <li class="m-li2">
                <span><wb:follow-button uid="5540068389" type="gray_1" width="67" height="24" ></wb:follow-button></span>
            </li>
            <li class="m-li3"><a href="http://wpa.qq.com/msgrd?v=3&amp;uin=1158321049&amp;site=qq&amp;menu=yes" target="_blank" title="欢迎登录人人猎网--人人都是猎头"><img src="/Public/img/new-index/qqkf.png" alt=""></a></li>
            <li class="m-li4"><a href="#"><img src="/Public/img/new-index/scr-top.png" alt=""></a></li>
        </ul>
    </div>
    <div id="findpwd_kuang" class="wjmima">
        <a class="Close"></a>
        <h3></h3>
        <div class="jindutiao">
            <img src="/Public/img/wjmima3.png" alt="">
        </div>
        <!--  <form action="/Home/Index/save" method="post">  -->

        <ul class="InputUl" style="margin-top:0px">

            <?php if($find_pwd_third):?>
            <li style="padding-top:20px;">用户名：<label><?php echo $username ?></label></li>
            <?php else:?>
            <li style="padding-top:20px;margin-left:-70px;"><?php echo $username1 ?></li>
            <?php endif;?>
            <li><input type="password" class="" id="findpassword" name="password" placeholder="请输入新密码" onkeydown="KeyDown();"></li>
            <li><input type="password" class="" id="findrepassword" placeholder="再次输入新密码" onkeydown="KeyDown();"></li>
            <li>
                <input type="hidden" value="<?php echo ($username); ?>" class="" id="findname" name="username">
                <input type="hidden" class="" value="<?php echo ($verify); ?>" id="findverify">
            </li>
            <!--  <li><input type="hidden" class="" value="<?php echo ($tableName); ?>" name="type"></li> -->
            <p class="error2" style="display: none">两次密码输入不相符</p>
        </ul>
        <input class="mimaqueren1 cur_point" type="submit" value="确认" id="zhaomima">
        <!--  </form>  -->
    </div>
    <script type="text/javascript">

        $(function () {
            $("#zhaomima").attr("disabled", false);
        })
        $("#findpassword,#findrepassword").focus(function () {
            $(this).css("color", "#343434");
        })
        $("#zhaomima").click(function () {

            var username = $("#findname").val();
            var password = $("#findpassword").val();
            var repassword = $("#findrepassword").val();
            var verify = $("#findverify").val();


            if (!(username)) {
                $('.error2').html('参数错误')
                $('.error2').show();
                return false;
            }
            if (!password) {
                $('.error2').html('请输入初始密码')
                $('.error2').show();
                return false;
            }
            if (password != repassword) {
                $('.error2').html('两次输入密码不一致')
                $('.error2').show();
                return false;
            }
            $("#zhaohuimima").attr("disabled", "disabled");
            $.post("/Home/Index/save", {
                'username': username,
                'password': password,
                'verify': verify
            }, function (data) {
                if (data.code == 200) {
                    $("#findpwd_kuang").hide();
                    $(".mask").hide();
                    sys_window("重置成功", "/Home/Index/index");
//                    location.href = "/Home/Index/index";
                    return false;
                } else {
                    $("#zhaohuimima").attr("disabled", false);
                    $('.error2').html(data.msg)
                    $('.error2').show();
                    return false;
                }
            }, "json")
        });
        function KeyDown()
        {
            if (event.keyCode == 13)
            {
                $("#zhaomima").click();
            }
        }
    </script>
</body>
</html>