<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="/Public/img/favicon.ico" type="image/ico">
        <title><?php echo trim($jobInfo['title']);?>-人人猎</title>
        <meta name="keywords" content="人人猎,人人猎网，人人猎头,renrenlie.com,www.renrenlie.com,人人猎首页,人人猎官网，人人都是猎头" />
        <meta name="description" content="人人猎（www.renrenlie.com)是企业低成本极速直招平台，让企业一周内搞定招聘需求，为推荐人提供“人力资源”变现通道。" />
        <link rel="stylesheet" type="text/css" href="/Public/css/new-resizer.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/focuspic2.css">
        <link rel="stylesheet" href="/Public/css/menu_v2.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/boss.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/new-index.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/new-recommends.css">
        <script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/focuspic2.js"></script>
        <script type="text/javascript" src="/Public/js/menu_v2.js"></script>
        <script type="text/javascript" src="/Public/js/al-index.js"></script>
        <script type="text/javascript" src="/Public/js/window.js"></script>
        <script type="text/javascript" src="/Public/js/denglu.js"></script>
    </head>
    <body>
        <div class="mask" id="mask" <?php if($showWindow == 1){echo "style='display:block'";}?>></div>
        <div class="denglu" <?php if($showWindow == 1){echo "style='display:block'";}?> id="odl">
             <a href="/"><h3 class="dl2_hd"></h3></a>
            <dl>
                <dt style="width:100%;border:none;">
                <p style="margin-top:40px;height:50px;line-height:30px;font-size:20px;text-align:center;color:#2284bb">欢迎来到人人猎，查看职位明细信息！<br>请选择快速登录</p>
                <ul class="clearfix ul_ul1">
                    <li class="li_1"><a href="<?php echo U('login?type=qq');?>"><img src="/Public/img/qq_icon.png"></a></li>
                    <!--<li><a href="<?php echo U('login?type=qq');?>"><img src="/Public/img/qq2.png"></a></li> -->
                    <li class="li_1"><a href="<?php echo U('login?type=sina');?>"><img src="/Public/img/weibo.png"></a></li>
                    <!-- <li class="li_1"><img src="/Public/img/weixin2.png"></li> -->
                    <li class="li_1"><a href="<?php echo U('login?type=weixin');?>"><img src="/Public/img/weixin.png"></a></li>
                    <li class="li_1"><a href="<?php echo U('login?type=renren');?>"><img src="/Public/img/renren.png"></a></li>

                </ul>
                <p style="margin-top:65px;text-align:right;padding-right:20px"><a style="font-size:12px;margin-left:5px;color:#2284bb" href="javascript:;" id="odengluBon">登录</a><a style="margin-left:10px;font-size:12px;color:#2284bb" href="javascript:;" id="ozhuceBon">注册</a></p>
                </dt>
            </dl>

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
        <?php if($flag === "0"):?>


        <div class="new-step clearfix">
            <div class="st1">
                <b class="m">1</b>
                <span class="m">选择职位：</span>
                <em class="m" title="<?php echo $jobInfo['title'];?>"><?php echo $jobInfo['title'];?></em>
            </div>
            <div class="st2">
                <b>2</b>
                <span>选择候选人 : </span>
                <em></em>
            </div>
            <div class="st3">
                <b>3</b>
                <span> 确认推荐：</span>
                <em></em>
            </div>
        </div>

        <?php endif;?>
        <div class="post-datel clearfix">
            <div class="public-t">
                <div class="t-head">
                    <div class="con">
                        <div class="l dis-inlin dis-block fl-lef">
                            <h2 ><?php echo $jobInfo['title'];?></h2>
                            <?php if($jobInfo['type'] == 2):?>
                            <p class="m"></p>
                            <?php else:?>
                            <p><?php echo $comInfo['cpname'];?></p>
                            <?php endif;?>

                        </div>
                        <div class="r dis-inlin dis-block fl-rig">
                            <form action="/Home/Login/RecommendTheCandidate/comid/<?php echo $comInfo['id'];?>/jobid/<?php echo $jobInfo['id'];?>.html" method="post"  id='recordFrom2'>
                                <div class="wxts2 undis userinfo-notice">
                                    <span class="fl-lef">温馨提示：</span>
                                    <span class="fl-lef">验证手机号码后才可以推荐！</span>
                                    <a class="fl-rig" href="/Home/Login/userinfo.html">立即去验证</a>
                                </div>
                                <span class="hover-hand dis-block btn"  onclick="checkuseres(2)">我要推荐</span>
                            </form>
                            <?php if(empty($clectInfo)):?>
                            <?php if($username && $flag !=1):?>
                            <span class="hover-hand collection<?php if(!empty($clectInfo)):?> m<?php endif;?>" id="colloctJob" jid="<?php echo $jobInfo[id];?>"></span>
                            <?php endif;?>
                            <?php else:?>
                            <span class="hover-hand collection m" id="colloctJob"  jid="<?php echo $jobInfo[id];?>"></span>
                            <?php endif;?>
                        </div>
                    </div>
                </div> 
                <div class="r fl-rig" style='position: absolute;margin-top: 25px;margin-left: 680px'>
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
                <div class="contant clearfix">
                    <div class="l dis-inlin fl-lef">
                        <h3 class="clearfix">
                            <em class="dis-block dis-inlin fl-lef"><?php echo $jobInfo['treatment'];?> </em>
                            <span class="dis-block dis-inlin fl-rig">候选人成功入职，你即得奖励 ￥<?php echo $jobInfo['Tariff'];?></span>
                    
                        </h3>
                       
                        <ul style="width:830px;">
                            <li class="li1">
                                <span>招聘人数：<?php echo $jobInfo['employ'];?></span>
                                <span>推荐人数：<i><?php echo $jobInfo['tn'];?></i></span>
                                <span><?php echo $jobInfo['jobplace'];?></span>
                                <span><?php echo $jobInfo['education'];?></span>
                                <span <?php if(!$jobInfo['report']):?> class="last-span"<?php endif;?>><?php echo $jobInfo['experience'];?> </span>
                                <?php if($jobInfo['report']):?><span>汇报对象：<?php echo $jobInfo['report'];?></span><?php endif;?>
                                <?php if($jobInfo['report_number']):?><span class="last-span">下属人数：<?php echo $jobInfo['report_number'];?></span><?php endif;?>
                            </li>
                            <?php if($comInfo['address']):?>
                            <li class="clearfix"><em class="dis-block dis-inlin fl-lef">办公地址：</em><span class="dis-block dis-inlin fl-lef"><?php echo $comInfo['address'];?></span></li>
                            <?php endif;?>
                            <?php if($comInfo['webname']):?>
                            <li class="clearfix"><em class="dis-block dis-inlin fl-lef">网&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址：</em><span class="dis-block dis-inlin fl-lef"><?php echo $comInfo['webname'];?></span></li>
                            <?php endif;?>
                            <?php if($comInfo['stage']):?>
                            <li class="clearfix"><em class="dis-block dis-inlin fl-lef">融资阶段：</em><span class="dis-block dis-inlin fl-lef"><?php echo $comInfo['stage'];?></span></li>
                            <?php endif;?>
                            <?php if($jobInfo['starttime']):?>
                            <li class="clearfix"><em class="dis-block dis-inlin fl-lef">发布时间：</em><span class="dis-block dis-inlin fl-lef"><?php echo $jobInfo['starttime'];?></span></li>
                            <?php endif;?>
                            <?php if($jobInfo['endtime']):?>
                            <li class="clearfix"><em class="dis-block dis-inlin fl-lef">截止日期：</em><span class="dis-block dis-inlin fl-lef"><?php echo $jobInfo['endtime'];?></span></li>
                            <?php endif;?>
                            <li class="clearfix last-li">
                                <?php if($jobBright):?>
                                <?php foreach($jobBright as $brightInfo):?>
                                <?php if($brightInfo):?>
                                <span><?php echo $brightInfo;?></span>
                                <?php endif;?>
                                <?php endforeach;?>
                                <?php endif;?>

                            </li>
                        </ul>
                    </div>
                    
                </div>
            </div>
            <div class="public-c clearfix">
                <ul class="nav clearfix">
                    <li class="hover-hand fl-lef dis-inlin m" id='jobInfoBtn'>职位信息</li>
                    <li class="hover-hand fl-lef dis-inlin" id='comInfoBtn'>公司简介</li>
                    <li class="hover-hand fl-lef dis-inlin" id='evaluation'>累计评价<b><?php echo $commentCount;?></b></li>
                </ul>
            </div>
            <div class="public-f">
                <div class="cont"  id='jobInfo'>
                    <h3>岗位职责</h3>
                    <ul>
                        <li>
                            <?php echo $jobInfo['workdesc'];?>
                        </li>
                    </ul>
                    <h3>任职要求</h3>
                    <ul>
                        <li><?php echo $jobInfo['content'];?></li>
                    </ul>
                    <?php if($jobInfo['softlytip']):?>
                    <div class="wxts">
                        <span class='tips'>职位温馨提示</span>
                        <?php echo $jobInfo['softlytip'];?>
                    </div>
                    <?php endif;?>
                    <?php if($comInfo['remark']):?>
                    <h3>补充说明</h3>
                    <ul>
                        <li>  <?php echo $comInfo['remark'];?></li>
                    </ul>
                    <?php endif;?>

                </div>
                <div class="cont undis" id='companyInfo'>
                    <?php if($comInfo['intro']):?>
                    <h3>公司介绍</h3>
                    <ul>
                        <li>
                            <?php echo $comInfo['intro'];?>
                        </li>
                    </ul>
                    <?php endif;?>
                    <?php if($comInfo['bright']):?>
                    <h3>公司亮点</h3>
                    <ul>
                        <li>
                            <?php echo $comInfo['bright'];?>
                        </li>
                    </ul>
                    <?php endif;?>
                    <?php if($comInfo['remark']):?>
                    <h3>补充说明</h3>
                    <ul>
                        <li>
                            <?php echo $comInfo['remark'];?>
                        </li>
                    </ul>
                    <?php endif;?>
                </div>


                <div class="cont undis"  id='evaluationInfo'>
                    <ul class="tb-r-comments">
                        <?php if($arCommentList):?>
                        <?php foreach($arCommentList as $commentInfo):?>
                        <li class="clearfix comment-info">
                            <div class="tb-buyer fl-lef">
                                <span class="dis-inlin dis-block tx"><img src="<?php echo $commentInfo['avatar']?>" width="40px" heigth='40px'></span>
                                <span class="dis-inlin dis-block use"><?php echo $commentInfo['username']?></span>
                            </div>
                            <div class="tb-bd fl-lef">
                                <p>
                                    <?php echo $commentInfo['content']?>
                                </p>
                                <span><?php echo $commentInfo['created_at']?></span>
                            </div>
                        </li>
                        <?php endforeach;?>
                        <?php echo $page;?>
                        <input type='hidden' id='jid' value='<?php echo $jobInfo["id"];?>'>
                        <?php endif;?>
                    </ul>

                </div>
                <form action="/Home/Login/RecommendTheCandidate/position/<?php echo trim($jobInfo['title']);?>/comid/<?php echo $comInfo['id'];?>/jobid/<?php echo $jobInfo['id'];?>.html" method="post"  id='recordFrom1'>
                    <span class="record-btn hover-hand" onclick="checkuseres(1)">我要推荐</span>
                    <div class="wxts2 wxts3 userinfo-notice undis">
                        <span class="fl-lef">温馨提示：</span>
                        <span class="fl-lef">验证手机号码后才可以推荐！</span>
                        <a class="fl-rig" href="/Home/Login/userinfo.html">立即去验证 </a>
                    </div>
                </form>
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

    <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
    <input type="hidden" value="<?php echo $_SESSION['username'];?>" id='fusername'>
    <input type="hidden" value="<?php echo $flag;?>" id='fflag'>

    <script type="text/javascript">
                        $(function() {
                            $(".close").hide();  //将注册框的叉号隐藏掉

                            $("#jobInfoBtn").click(function() {
                                $(this).addClass("m");
                                $("#comInfoBtn").removeClass("m");
                                $("#jobInfo").show();
                                $("#companyInfo").hide();
                                $("#evaluationInfo").hide();
                                $("#evaluation").removeClass("m");
                            });
                            $("#evaluation").click(function() {
                                $(this).addClass("m");
                                $("#jobInfoBtn").removeClass("m");
                                $("#comInfoBtn").removeClass("m");
                                $("#evaluationInfo").show();
                                $("#jobInfo").hide();
                                $("#companyInfo").hide();
                            });
                            $("#comInfoBtn").click(function() {
                                $(this).addClass("m");
                                $("#jobInfoBtn").removeClass("m");
                                $("#companyInfo").show();
                                $("#jobInfo").hide();
                                $("#evaluation").removeClass("m");
                                $("#evaluationInfo").hide();
                            });

                            $("#odengluBon").click(function() {
                                $("#odl").hide();
                                $(".dengluBtn2").show();
                                $(".Close").hide();
                            });
                            $("#ozhuceBon").click(function() {
                                $("#conZhuce").show();
                                $(".Close").hide();
                            });
                        })

                        $("#shareAction").click(function() {
                            var url = "<?php echo $share['url']?>";
                            $.post("/Home/Index/saveShareUrl.html", {
                                'url': url
                            }, function(data) {
                            }, "json")
                        });
                        function checkuseres(type) {

                            var username = $("#fusername").val();
                            var flag = $("#fflag").val();
                            if (flag == 1) {

                                sys_window("您是企业账号，请登录推荐人账号再试！");
                                return false;
                            }
                            if (!username) {
                                $(".dengluBtn").click();
                                //$('.mask').show();
                                //$('.dlpd').show();
                                return false;
                            }
                            $.post("/Home/Login/isComplatdUser.html", {}, function(data) {
                                if (data.code == "200") {
                                    $("#recordFrom" + type).submit();
                                } else {
                                    $(".userinfo-notice").show();
                                }
                            }, "json")

                        }

                        $(function() {
                            $("#colloctJob").click(function() {
                                var jobid = $(this).attr("jid");
                                var username = $("#fusername").val();
                                if (!jobid || !username) {
                                    return false;
                                }

                                var params = {"jobid": jobid, "username": username};
                                $.post("/Home/Index/collectJob.html", params, function(data) {
                                    if (data.code == "200")
                                    {
                                        $("#colloctJob").addClass("m");
                                        location.reload();
                                    }
                                    else
                                    {
                                        sys_window("关注失败");
                                    }

                                }, "json")
                            })
                        })
                        $(function() {
                            $("#shareLogin").click(function() {
                                $(".denglu").show();
                                $(".duqq").hide();
                            });
                            $("#shareRegiest").click(function() {
                                $(".zhuce").show();
                                $(".duqq").hide();
                            });
                        })

                        function page(i) {
                            var jid = $("#jid").val();
                            $.ajax({
                                url: "/Home/Index/commentPage",
                                type: "post",
                                data: {'jid': jid, 'i': i},
                                success: (function(mgsp) {

                                    $("#evaluationInfo").html(mgsp);
                                })
                            });
                        }
                        
                        
    </script>
    <script >
        var jiathis_config = {
            imageWidth: 26,
            marginTop: 150,
            url: "<?php echo ($share['url']); ?>",
            title: "<?php echo ($share['title']); ?>",
            summary: "<?php echo ($share['description']); ?>",
            pic: "http://www.renrenlie.com/Public/img/web_logo.png"
        }
    </script> 
</body>
</html>