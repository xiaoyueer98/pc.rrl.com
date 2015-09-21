<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="/Public/img/favicon.ico" type="image/ico">
        <title>职位搜索-人人猎</title>
        <meta name="keywords" content="人人猎,人人猎网，人人猎头,renrenlie.com,www.renrenlie.com,人人猎首页,人人猎官网，人人都是猎头" />
        <meta name="description" content="人人猎（www.renrenlie.com)是企业低成本极速直招平台，让企业一周内搞定招聘需求，为推荐人提供“人力资源”变现通道。" />
        <link rel="stylesheet" type="text/css" href="/Public/css/new-resizer.css">
        <link rel="stylesheet" href="/Public/css/menu_v2.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/boss.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/new-recommends.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/lanrenzhijia2.css">
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/jquery.styleSelect2.js"></script>
        <!--<script type="text/javascript" src="/Public/js/menu_v2.js"></script>-->
        <script type="text/javascript" src="/Public/js/al-index.js"></script>
        <script type="text/javascript" src="/Public/js/window.js"></script>
        <script type="text/javascript" src="/Public/js/denglu.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $(".mySelect3").styleSelect({styleClass: "selectFruits", optionsWidth: 1, speed: 'fast'});
                $(".down-menu").styleSelect({styleClass: "selectDark"});
            });
        </script>
    </head>
    <body>
        <div class="mask1" style="display: none;"></div>
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
        <div class="job-listings-nav clearfix">
            <ul class="myul">
                <li class="hover-hand">职位高级搜索</li>
            </ul>
            <div class="m2-l fl-lef">
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

            </div>
            <div class="m2-r fl-rig">
                <div class="job-search2">
                    <h3>高级搜索</h3>

                    <div class="input-list clearfix">
                        <ul class="clearfix">
                            <li class="clearfix dis-inlin fl-lef">
                                <em class="dis-block dis-inlin fl-lef">职位名称</em>
                                <input type="text" name="title" id="title" value="<?php echo $title;?>">
                            </li>
                            <li class="clearfix dis-inlin fl-lef">
                                <em class="dis-block dis-inlin fl-lef">公司名称</em>
                                <input type="text" name="cpname" id="cpname">
                            </li>
                            <li class="clearfix dis-inlin fl-lef">
                                <em class="dis-block dis-inlin fl-lef">行业类别</em>
                                <span class="dis-block dis-inlin fl-lef">
                                    <select name="industry" id="industry"  class="down-menu" style="width:195px;top:38px;left:-197px;display:none;">
                                        <option selected="selected" value="">不限</option>
                                        <?php if(is_array($arIndustry)): $i = 0; $__LIST__ = $arIndustry;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$Industry): $mod = ($i % 2 );++$i;?><option value="<?php echo ($Industry['id']); ?>"><?php echo ($Industry['cascname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </span>
                            </li>
                            <li class="clearfix dis-inlin fl-lef">
                                <em class="dis-block dis-inlin fl-lef">职位类别</em>

                                <span class="dis-block dis-inlin fl-lef">
                                    <select name="position" id="positionss"  class="down-menu" style="width:195px;top:38px;left:-197px;display:none;">
                                        <option selected="selected" value="">不限</option>
                                        <?php if(is_array($arPosition)): $i = 0; $__LIST__ = $arPosition;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$Position): $mod = ($i % 2 );++$i;?><option value="<?php echo ($Position['id']); ?>" ><?php echo ($Position['cascname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </span>
                            </li>
                            <!--
                            <li class="clearfix dis-inlin fl-lef">
                                <em class="dis-block dis-inlin fl-lef">工作地点</em>
                                <span class="dis-block dis-inlin fl-lef">
                                    <select id="area"  class="down-menu" style="width:195px;top:38px;left:-197px;display:none;">
                                        <option selected="selected" value="">不限</option>
                                        <option value="20">北京</option>
                            <!--
                            <?php if(is_array($workarea)): $i = 0; $__LIST__ = $workarea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$DQ): $mod = ($i % 2 );++$i;?><option value="<?php echo ($DQ['id']); ?>"><?php echo ($DQ['cascname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            -->
                            <!--
                                    </select>
                                </span>
                            </li>
                            -->
                            <li class="clearfix dis-inlin fl-lef">
                                <em class="dis-block dis-inlin fl-lef">工资待遇</em>
                                <span class="dis-block dis-inlin fl-lef">
                                    <select name='treatment' id="treatment"   class="down-menu" style="width:195px;top:38px;left:-197px;display:none;">
                                        <option selected="selected" value="">不限</option>
                                        <?php if(is_array($money)): $i = 0; $__LIST__ = $money;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?><option value='<?php echo ($m["datavalue"]); ?>'><?php echo ($m["dataname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </span>
                            </li>
                            <li class="clearfix dis-inlin fl-lef">
                                <em class="dis-block dis-inlin fl-lef">发布时间</em>
                                <span class="dis-block dis-inlin fl-lef">
                                    <select  name='puttime' id="puttime" class="down-menu" style="width:195px;top:38px;left:-197px;display:none;">
                                        <option selected="selected" value="">不限</option>
                                        <?php if(is_array($positime)): $i = 0; $__LIST__ = $positime;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pt): $mod = ($i % 2 );++$i;?><option value='<?php echo ($pt["datavalue"]); ?>'><?php echo ($pt["dataname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </span>
                            </li>
                        </ul>
                        <button onclick="search()">搜索</button>

                    </div>
                    <div style="background:#f5f5f5;width:100%;height:15px;margin-top:20px;"></div>
                    <div class="job-list">
                        <h3 style="margin-top:33px;">搜索结果</h3>

                        <div class='listUl'>
                            <?php if(!empty($arJobList)):?>
                            <?php foreach($arJobList as $jobInfo):?>
                            <div class="clearfix list">
                                <span class="np-logo dis-block dis-inlin fl-lef">
                                    <?php if($jobInfo['type'] == 2):?>
                                    <img src="/Public/img/company_logo/bmkh.png" alt="" width="50px" height="50px">
                                    <?php else:?>
                                    <img src="<?php echo $jobInfo['thumlogo'];?>" alt="" width="50px" height="50px">
                                    <?php endif;?>
                                </span>
                                <ul class="r fl-rig">
                                    <li class="clearfix li1">
                                        <a href="/Home/Index/EnterIndex2/comid/<?php echo $jobInfo['cpid'];?>/jobid/<?php echo $jobInfo['guid'];?>.html" target="_blank"><em class="dis-inlin dis-block fl-lef"><?php echo $jobInfo['title'];?></em></a>
                                        <span class="adrs dis-inlin dis-block fl-lef">[<?php echo $jobInfo['jobplace'];?>]</span>
                                        <a href="/Home/Index/EnterIndex/comid/<?php echo $jobInfo['cpid'];?>.html" target="_blank"><h6 class="dis-inlin dis-block fl-rig"><?php echo $jobInfo['cpname'];?></h6></a>
                                    </li>
                                    <li class="clearfix li2">
                                        <!-- <span class="dis-inlin dis-block fl-lef"></span> -->
                                        <span class="dis-inlin dis-block fl-lef"><?php echo $jobInfo['treatment'];?></span>
                                        <span class="dis-inlin dis-block fl-lef"><?php echo $jobInfo['experience'];?></span>
                                        <span class="dis-inlin dis-block fl-lef"><?php echo $jobInfo['education'];?></span>
                                        <div class="fl-rig dis-inlin dis-block">
                                            <span class="c-r dis-inlin dis-block fl-lef">招聘人数：</span>
                                            <span class="ic dis-inlin dis-block fl-lef" style="color: black;"><?php echo $jobInfo['employ'];?></span>                                                                               
                                            <span class="c-r dis-inlin dis-block fl-lef">推荐人数：</span>
                                            <span class="ic dis-inlin dis-block fl-lef" style="color: red;font-weight: bold"><?php echo $jobInfo['record_num'];?></span>

                                        </div>
                                        <div class="fl-rig dis-inlin dis-block">
                                            <span class="c-r dis-inlin dis-block fl-lef">所属行业：</span>
                                            <span class="ic dis-inlin dis-block fl-lef"><?php echo $jobInfo['strycate'];?></span>                                                                               
                                            <span class="c-r dis-inlin dis-block fl-lef">融资阶段：</span>
                                            <span class="ic dis-inlin dis-block fl-lef"><?php echo $jobInfo['stage'];?></span>
                                            <span class="c-r dis-inlin dis-block fl-lef">规模：</span> 
                                            <span class="ic dis-inlin dis-block fl-lef"><?php echo $jobInfo['scale'];?></span>
                                        </div>
                                    </li>
                                    <li class="clearfix li3">
                                        <em class="c3-l	dis-inlin dis-block fl-lef">候选人成功入职，你即得奖励  <i>￥<?php echo $jobInfo['Tariff'];?></i></em>
                                        <span class="c-r dis-inlin dis-block fl-rig">[<?php echo $jobInfo['starttime'];?>]</span>
                                    </li>
                                </ul>
                            </div>
                            <?php endforeach;?>
                            <?php else:?>
                            <p style="text-align:center;color:#000000;font-size:12px;margin:50px 0;">
                                <b style="font-size:14px;line-height:40px;">抱歉，没有找到相关的职位<br></b>
                                <b >请查看输入关键词是否有误</b>或调整关键字，如将“前端 <b>H5</b>”改为“<b>前端</b>”
                            </p>
                            <?php endif;?>

                            <?php echo $page;?>
                            <div style="width:712px;height:0px;margin-top:20px;border-bottom:1px #b5b5b5 dashed;margin-left:38px;"></div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="hid" value="1"/>

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
    function search(obj)
    {
        //var newdesc=$("#this").val();
        var positionsstmp = $("#positionsstmp").val()
        var position = $("#positionss option:selected").val();
        var nowpage = $("#hid").val();
        var industry = $("#industry option:selected").val();
        // var area = $("#area").val();
        var treatment = $("#treatment").val();
        // var Tariff = $("#Tariff").val();
        var puttime = $("#puttime").val();
        var title = $("#title").val();
        // var newdesc=$(obj).text();
        var area = "";
        var cpname = $("#cpname").val();
        $.ajax({
            url: "/Home/Index/searchs",
            type: "post",
            data: {"position": position, "industry": industry, "area": area, "treatment": treatment, "puttime": puttime, 'title': title, 'cpname': cpname},
            url:"/Home/Index/searchs",
                    success: function (msg)
                    {
                        $(".listUl").html(msg);
                    }

        });
    }
    function page(i) {

        var positionsstmp = $("#positionsstmp").val()
        var position = $("#positionss option:selected").val();
        var nowpage = $("#hid").val();
        var industry = $("#industry option:selected").val();
        // var area = $("#area").val();
        var treatment = $("#treatment").val();
        // var Tariff = $("#Tariff").val();
        var puttime = $("#puttime").val();
        var title = $("#title").val();
        var area = "";
        var cpname = $("#cpname").val();
        $.ajax({
            url: "/Home/Index/page",
            type: "post",
            data: {'i': i, "position": position, "industry": industry, "area": area, "treatment": treatment, "puttime": puttime, 'title': title, 'cpname': cpname},
            success: (function (mgsp) {
                $(".listUl").html(mgsp);
            })
        });
    }
    $(".m2-l>div").click(function () {
        $(this).addClass("m");
        $(this).find("h6").addClass("m");
        $(this).find("p").addClass("m");
        $(this).siblings().removeClass("m")
        $(this).siblings().find("h6").removeClass("m");
        $(this).siblings().find("p").removeClass("m");
    });
    var index;
    var list = $(".m2-r .nav li");
    var divs = $(".m2-r>div");
    list.on("click", function () {
        that = $(this);
        index = that.index();
        that.addClass("m").siblings().removeClass("m");
        $(this).find("a").addClass("m").parent("li").siblings().find("a").removeClass("m");
        divs.eq(index).show().siblings("div").hide();
    });

    var list2 = $(".m2-r .nav3 li");
    var divs2 = $(".add-resume>div");
    list2.on("click", function () {
        that = $(this);
        index = that.index();
        that.addClass("m").siblings().removeClass("m");
        $(this).find("a").addClass("m").parent("li").siblings().find("a").removeClass("m");
        divs2.eq(index).show().siblings("div").hide();
    });
</script>
</body>

</html>