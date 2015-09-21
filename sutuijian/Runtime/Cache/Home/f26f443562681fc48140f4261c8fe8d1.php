<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="/Public/img/favicon.ico" type="image/ico">

        <title>用户中心-人人猎</title>
        <meta name="keywords" content="人人猎,人人猎网，人人猎头,renrenlie.com,www.renrenlie.com,人人猎首页,人人猎官网，人人都是猎头" />
        <meta name="description" content="人人猎（www.renrenlie.com)是企业低成本极速直招平台，让企业一周内搞定招聘需求，为推荐人提供“人力资源”变现通道。" />

        <link rel="stylesheet" type="text/css" href="/Public/css/new-resizer.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/new-recommends.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/boss.css">
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/al-index.js"></script>
        <script type="text/javascript" src="/Public/js/record-common.js"></script>
        <script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.config.js"></script>
        <script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.all.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
        <script type="text/javascript" src="/Public/js/jquery.ui.js"></script>
        <link rel="stylesheet" href="/Public/css/smoothness/jquery.ui.css" type="text/css" />
        <style>
            .u-base-info{text-align:  right;color: #2c76c0;margin-right: 40px;display: none;position: absolute}
            .u-base-info:hover{ color: #09498b!important;text-decoration: none;}
        </style>
    </head>
    <body>
        <div class="mask" id="mask"></div>
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
        <div class="ms1 clearfix">
            <a href="/Home/Login/index.html">
            <div class="m1-l fl-lef">
                <img src="/Public/img/rcmd-img/reco-icon.png" alt="">
                <span>推荐人用户中心</span>
                <img src="/Public/img/rcmd-img/reco-icon.png" alt="">
            </div>
            </a>
            <div class="m1-r fl-rig">
                <span class="gjz dis-block dis-inlin fl-lef">关键字</span>
                <div class="search dis-inlin fl-lef" id="search-div">
                    <input id="searchbox" class="dis-block dis-inlin post fl-lef" value="" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; JAVA &nbsp; Android &nbsp; IOS " type="text">
                    <span class="btn hover-hand dis-block dis-inlin post fl-lef btn-search">
                        <img src="/Public/img/new-index/position-btn.png" alt="">
                    </span>
                </div>
            </div>
        </div>
        <div class="ms2 clearfix">
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
            <div class="m2-r fl-rig">
                <ul class="nav">
                    <li class="m first dis-block dis-inlin fl-lef"><a class="m">基本信息</a></li>
                    <li class="dis-block dis-inlin fl-lef"><a>收款账号</a></li>
                    <li class="dis-block dis-inlin fl-lef"><a>推荐设置</a></li>
                    <li class="dis-block dis-inlin fl-lef"><a>安全设置</a></li>
                </ul>
                <!--基本信息-->
                <div class="basic-infor">
                    <div id="baseInfoInput" class="undis">
                        <form enctype="multipart/form-data" action="/Home/Login/setUserBaseInfo" method="post" id="submitBaseInfo">
                            <h3>基本信息</h3>
                            <div class="clearfix">
                                <ul class="l  fl-lef clearfix">
                                    <li style="margin-top:23px;" class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef">姓&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp名：</em>
                                        <input class="dis-block dis-inlin fl-lef" type="text" placeholder="请输入真实姓名" name='cnname' value="<?php echo $userinfo['cnname']?>">
                                    </li>
                                    <li class="clearfix age-father sex-label">
                                        <em class="dis-block dis-inlin fl-lef">性&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp别：</em>
                                        <label class="dis-block dis-inlin fl-lef nan<?php if($userinfo['sex']!='女'):?> m<?php endif;?>" flag='0'></label>
                                        <em class="pub dis-block dis-inlin fl-lef">男</em>
                                        <label class="dis-block dis-inlin fl-lef<?php if($userinfo['sex']=='女'):?> m<?php endif;?>" flag='1'></label>
                                        <em class="pub dis-block dis-inlin fl-lef">女</em>
                                    </li>
                                    <li class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef">年&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp龄：</em>
                                        <input class="age" type="text" placeholder="18" name='age' value="<?php echo $userinfo['age']?>">
                                    </li>
                                    <li class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef">手机号码：</em>
                                        <input class="dis-block phone dis-inlin fl-lef" type="text" placeholder="请输入手机号码" name="mobile" value="<?php echo $userinfo['mobile']?>"><span class="hover-hand phone-btn dis-block dis-inlin fl-lef" id="changeMobile">验证手机号码</span>
                                    </li>
                                    <li class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef">邮箱号码：</em>
                                        <input class="dis-block dis-inlin fl-lef" type="text" placeholder="请输入邮箱号码" name="email" value="<?php echo $userinfo['email']?>">
                                    </li>
                                    <li class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef back-none">qq号码：</em>
                                        <input class="dis-block dis-inlin fl-lef" type="text" placeholder="请输入qq号码" name='qqnum' value="<?php echo $userinfo['qqnum']?>">
                                    </li>
                                    <li class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef back-none">微信号码：</em>
                                        <input class="dis-block dis-inlin fl-lef" type="text" placeholder="请输入微信号码" name='weixin' value="<?php echo $userinfo['weixin']?>">
                                    </li>
                                </ul>
                                <div class="r fl-rig">
                                    <span class="dis-block">
                                        <div id="preview"  style="height:100%;width: 100%;padding: 0px;display: none">   
                                            <img id="imghead"  width=100% height=100% border=0 >   
                                        </div> 
                                        
                                        <img <?php if($userinfo['avatar']):?> src="/<?php echo ($userinfo['avatar']); ?>" <?php endif;?> >
                                        
                                    </span>
                                    <i class="dis-block">更换头像
                                        <input type="file" class="end-hp"  name="avatar" onchange="previewImage(this), 'avatar'" />
                                    </i>
                                </div>
                            </div>
                            <div style="margin-top:20px;" class="si">
                                <h3 class="si-title">自我介绍</h3>
                                <script id="editor" name="editor" type="text/plain" style="width:676px;height:300px;margin-top:10px;margin-left:12px;"><?php echo $userinfo['intro']?></script>
                            </div>
                            <ul class="l  fl-lef clearfix" style="margin-left:0;">
                                <li class="clearfix ero"  id="baseError">
                                    <!-- <p class="error undis" id="baseError">错误</p> -->
                                    <b class="fl-lef dis-block dis-inlin" style="margin-left:12px;">温馨提示:</b>
                                    <span class="fl-lef dis-block dis-inlin clearfix">
                                        <i class="fl-lef dis-block dis-inlin"></i>
                                        <span class="fl-lef dis-block dis-inlin">请填写姓名</span>
                                    </span>
                                </li>
                            </ul>
                            <input type="hidden" name="sex">
                            <span style="margin-top:50px;margin-left:12px;" class="infor-end-btn dis-block" id='baseInfoConfirm'>确定</span>	
                        </form>
                    </div>
                    <div id="baseInfo">
                        <h3 class="back-none">基本信息</h3>
                        <div class="clearfix">


                            <ul class="l fl-lef clearfix">
                                <li style="position:relative" class="clearfix" onmousemove="$('.u-base-info1').show();" onmouseout="$('.u-base-info1').hide();">
                                    <em class="dis-block dis-inlin fl-lef back-none">姓&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp名：</em>
                                    <span class="dsply"><?php echo $userinfo['cnname']?></span>
                                    <span style="position:absolute;right:5px;top:8px;" class="back-none u-base-info cur_point fl-rig u-base-info1" onclick="$('#baseInfoUpdate').click();">编辑</span>
                                </li>
                                <li style="position:relative" class="clearfix age-father" onmousemove="$('.u-base-info2').show();" onmouseout="$('.u-base-info2').hide();">
                                    <em class="dis-block dis-inlin fl-lef back-none">性&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp别：</em>
                                    <span class="dsply"><?php echo $userinfo['sex']?></span>
                                    <span style="margin-top:8px;margin-left:300px;" class="back-none u-base-info cur_point fl-rig u-base-info2" onclick="$('#baseInfoUpdate').click();">编辑</span>
                                </li>
                                <li style="position:relative" class="clearfix" onmousemove="$('.u-base-info3').show();" onmouseout="$('.u-base-info3').hide();">
                                    <em class="dis-block dis-inlin fl-lef back-none">年&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp龄：</em>
                                    <span class="dsply"><?php echo $userinfo['age']?></span>
                                    <span style="position:absolute;right:5px;top:8px;" class="back-none u-base-info cur_point fl-rig u-base-info3 bj" onclick="$('#baseInfoUpdate').click();">编辑</span>
                                </li>
                                <li style="position:relative" class="clearfix" onmousemove="$('.u-base-info4').show();" onmouseout="$('.u-base-info4').hide();">
                                    <em class="dis-block dis-inlin fl-lef back-none">手机号码：</em>
                                    <span class="dsply"><?php echo $userinfo['mobile']?></span>
                                    <span style="position:absolute;right:5px;top:8px;" class="back-none u-base-info cur_point fl-rig u-base-info4" onclick="$('#baseInfoUpdate').click();">编辑</span>
                                </li>
                                <li style="position:relative" class="clearfix" onmousemove="$('.u-base-info5').show();" onmouseout="$('.u-base-info5').hide();">
                                    <em class="dis-block dis-inlin fl-lef back-none">邮箱号码：</em>
                                    <span class="dsply"><?php echo $userinfo['email']?></span>
                                    <span style="position:absolute;right:5px;top:8px;" class="back-none u-base-info cur_point fl-rig u-base-info5" onclick="$('#baseInfoUpdate').click();">编辑</span>
                                </li>
                                <li style="position:relative" class="clearfix" onmousemove="$('.u-base-info6').show();" onmouseout="$('.u-base-info6').hide();">
                                    <em class="dis-block dis-inlin fl-lef back-none">qq号码：</em>
                                    <span class="dsply"><?php echo $userinfo['qqnum']?></span>
                                    <span style="position:absolute;right:5px;top:8px;" class="back-none u-base-info cur_point fl-rig u-base-info6" onclick="$('#baseInfoUpdate').click();">编辑</span>
                                </li>
                                <li style="position:relative" class="clearfix" onmousemove="$('.u-base-info6').show();" onmouseout="$('.u-base-info6').hide();">
                                    <em class="dis-block dis-inlin fl-lef back-none">微信号码：</em>
                                    <span class="dsply"><?php echo $userinfo['weixin']?></span>
                                    <span style="position:absolute;right:5px;top:8px;" class="back-none u-base-info cur_point fl-rig u-base-info6" onclick="$('#baseInfoUpdate').click();">编辑</span>
                                </li>

                            </ul>
                            <div class="r fl-rig">
                                <span class="dis-block">
                                   
                                        <img  <?php if($userinfo['avatar']):?> src="/<?php echo ($userinfo['avatar']); ?>" <?php endif;?> alt="">
                                    
                                </span>
                            </div>
                        </div>

                        <div style="margin-top:20px;" class="si">
                            <h3 class="si-title">自我介绍</h3>
                            <span><?php echo $userinfo['intro']?></span>
                        </div>
                        <button class="infor-end-btn dis-block" id='baseInfoUpdate'>修改</button>	
                    </div>
                </div>
                <!--基本信息end-->
                <!--收款账号-->
                <div class="receive-account undis">
                    <h3>收款账号</h3>
                    <div class="content undis" id='bankInfoInput'>
                        <h4>我的账号</h4>
                        <div class="clearfix ero" style="display:block;margin-bottom:10px" >
                            <b class="fl-lef dis-block dis-inlin" style="margin-left:43px;">重要提示:</b>
                            <span class="fl-lef dis-block dis-inlin clearfix" style="height:auto">
                                <i class="fl-lef dis-block dis-inlin"></i>
                                <span class="fl-lef dis-block dis-inlin" style="width:350px;height:auto!important;line-height:20px;">您输入的银行卡号（请详细填写支行或分行）和真实姓名会作为打款的唯一凭证，一旦填写不能随时修改,此信息仅为候选人入职奖励所用，不会对外公开。</span>
                            </span>
                        </div>
                        <dl>
                            <dt class="fl-lef"><img src="/Public/img/ra_icon.png" alt=""></dt>
                            <dd class="fl-lef">
                                <p><em>收款银行：</em><input type="text" value="<?php echo $userinfo['bankname'];?>" name='bankname'></p>
                                <p><em>收款账号：</em><input type="text" value="<?php echo $userinfo['banknumber'];?>" name='banknumber' onkeyup="value = value.replace(/[^\d]/g, '')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" maxlength="19"></p>

                            </dd>
                        </dl>
                        <!-- <p style="margin-left:60px;" class="error fl-lef undis" id="bankError">错误</p> -->
                        <div class="clearfix ero" id="bankError">
                            <b class="fl-lef dis-block dis-inlin" style="margin-left:43px;">温馨提示:</b>
                            <span class="fl-lef dis-block dis-inlin clearfix">
                                <i class="fl-lef dis-block dis-inlin"></i>
                                <span class="fl-lef dis-block dis-inlin">请填写姓名</span>
                            </span>
                        </div>

                        <button style="margin-left:186px;margin-top:30px;" class="infor-end-btn dis-block"  id='bankInfoConfirm'>保存</button>
                    </div>
                    <div class="content" id='bankInfo'>
                        <h4>我的账号</h4>
                        <dl>
                            <dt class="fl-lef"><img src="/Public/img/ra_icon.png" alt=""></dt>
                            <dd class="fl-lef">
                                <p><em>收款银行：</em><span id="bankname"><?php echo $userinfo['bankname'];?></span></p>
                                <p><em>收款账号：</em><span id="banknumber"><?php echo $userinfo['banknumber'];?></span></p>
                            </dd>
                        </dl>
                        <button style="margin-left:181px;" class="infor-end-btn dis-block" id='bankInfoUpdate'>修改</button>
                    </div>
                </div>
                <!--收款账号end-->
                <div class="Recmd-settings basic-infor undis" >
                    <div id="recordInfo">
                        <h3 class="back-none">推荐设置</h3>
                        <div class="clearfix">
                            <ul class="l fl-lef clearfix" style="width:700px;">
                                <li class="clearfix">
                                    <em class="dis-block dis-inlin fl-lef back-none">期望行业:</em>
                                    <p class="dsply" id='strycate_html'><?php echo $userinfo['strycate_data']; ?></p>
                                </li>

                                <li class="clearfix">
                                    <em class="dis-block dis-inlin fl-lef back-none">期望职位:</em>
                                    <p class="dsply" id='Jobcate_html'><?php echo $userinfo['Jobcate_data']; ?></p>
                                </li>

                                <li class="clearfix">
                                    <em class="dis-block dis-inlin fl-lef back-none">地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;区:</em>
                                    <p class="dsply" id='areas_html'><?php echo $userinfo['area_data']; ?></p>
                                </li>
                                <li class="clearfix">
                                    <em class="dis-block dis-inlin fl-lef back-none">截止时间:</em>
                                    <p class="dsply" id='maxdate_html'><?php echo $userinfo['maxdate'];?></p>
                                </li>
                                <li class="clearfix">
                                    <em class="dis-block dis-inlin fl-lef back-none">熟悉公司:</em>
                                    <p class="dsply" id='companys_html'>
                                        <?php foreach($link_companys as $coms): echo $coms;?>&nbsp;&nbsp;&nbsp;<?php endforeach;?>
                                    </p>
                                </li>
                                <li class="clearfix">
                                    <em class="dis-block dis-inlin fl-lef back-none">熟悉职位:</em>
                                    <p class="dsply" id='postions_html'>
                                        <?php foreach($link_postions as $pos): echo $pos;?>&nbsp;&nbsp;&nbsp;<?php endforeach;?>
                                    </p>
                                </li>
                                <li class="clearfix">
                                    <em class="dis-block dis-inlin fl-lef back-none">擅长领域:</em>
                                    <p class="dsply" id='area_html'>

                                        <?php foreach($link_areas as $ars): echo $ars;?>&nbsp;&nbsp;&nbsp;<?php endforeach;?></p>
                                </li>
                                <button style="margin-left:101px;" class="infor-end-btn dis-block" id="recordInfoUpdate">修改</button>

                            </ul>
                        </div>
                    </div>
                    <div id="recordInfoInput" class="undis">
                        <h3 class="back-none">行业方向设置</h3>
                        <ul class="record-set-ul" style='margin-top:17px;'>
                            <li class="clearfix">
                                <em class="dis-block dis-inlin fl-lef">期望行业</em>
                                <span style="position: relative;" class="dis-block dis-inlin fl-lef record-set-span">
                                    <input class="xuanze_val" name="strycate" type="hidden" value="<?php echo $userinfo['strycate']; ?>" />
                                    <input class="dis-inlin dis-block fl-lef xuanze record-set-input" type="text" value="<?php echo $userinfo['strycate_data']; ?>" name='xuanze_val'/>
                                    <i class="dis-inlin dis-block fl-lef xuanze"></i>
                                    <div class="tuanchu1 pa libao undis" id='xuanze_window' >
                                        <div class="anniu tar">
                                            <span class="fwb fs14 fl fcf">职位名称：</span>
                                            <a class="buxian" href="javascript:;">[不限]</a>
                                            &nbsp;&nbsp;<a class="qued" href="javascript:;">[确定]</a>
                                            &nbsp;&nbsp;<a class="qux" href="javascript:;">[取消]</a>
                                        </div>
                                        <?php foreach($arStrycate as $strycateList):?>
                                        <dl>
                                            <dt><b><?php echo $strycateList['cascname']; ?></b></dt>
                                            <dd>
                                                <div style="float:none"><input type="checkbox" value="<?php echo $strycateList['id']; ?>" /><span class="fwb"><?php echo $strycateList['cascname']; ?></span></div>
                                                <?php foreach($strycateList['casclist'] as $cateSon):?>
                                                <div><input type="checkbox" value="<?php echo $cateSon['id']; ?>" /><span><?php echo $cateSon['cascname']; ?></span></div>	
                                                <?php endforeach;?>    
                                                <div class="queding clear tac">
                                                    <a href="javascript:;" class="xiaoshi fwb fs12 jz">确定</a>
                                                </div>
                                            </dd>
                                            <dd class="clear"></dd>
                                        </dl>
                                        <?php endforeach;?>                      
                                        <div class="clear"></div>

                                    </div>
                                </span>

                            </li>
                            <li class="clearfix">
                                <em class="dis-block dis-inlin fl-lef">期望职位</em>
                                <span class="dis-block dis-inlin fl-lef record-set-span" style="position:relative">
                                    <input class="zw_xuanze_val" name="Jobcate" type="hidden" value="<?php echo $userinfo['Jobcate']; ?>"/>
                                    <input class="dis-inlin dis-block fl-lef record-set-input zw_xuanze" type="text" value="<?php echo $userinfo['Jobcate_data']; ?>" name='zw_xuanze_val'/>
                                    <i class="dis-inlin dis-block fl-lef zw_xuanze"></i>
                                    <div class="tuanchu2 pa libao" style="display:none" id='zw_xuanze_window'>
                                        <div class="anniu tar"><span class="fwb fs14 fl fcf">职位名称：</span><a class="buxian" href="javascript:;">[不限]</a>&nbsp;&nbsp;<a class="qued" href="javascript:;">[确定]</a>&nbsp;&nbsp;<a class="qux" href="javascript:;">[取消]</a></div>
                                        <?php foreach($arJobcate as $JobcateList):?>
                                        <dl>
                                            <dt><b><?php echo $JobcateList['cascname']; ?></b></dt>
                                            <dd style="display:none">
                                                <div style="float:none"><input type="checkbox"  value="<?php echo $JobcateList['id']; ?>" /><span class="fwb"><?php echo $JobcateList['cascname']; ?></span></div>
                                                <?php foreach($JobcateList['casclist'] as $cateSon):?>
                                                <div><input type="checkbox" value="<?php echo $cateSon['id']; ?>" /><span><?php echo $cateSon['cascname']; ?></span></div>	
                                                <?php endforeach;?> 
                                                <div class="queding clear tac">
                                                    <a href="javascript:;" class="xiaoshi fwb fs12 jz">确定</a>
                                                </div>
                                            </dd>
                                            <dd class="clear"></dd>
                                        </dl>
                                        <?php endforeach;?> 
                                        <div class="clear"></div>
                                    </div>
                                </span>
                            </li>
                            <h5>地区设置</h5>
                            <li class="clearfix">
                                <em class="dis-block dis-inlin fl-lef">地区</em>
                                <span class="dis-block dis-inlin fl-lef record-set-span xuanze_span" style="position:relative">
                                    <input class="dq_xuanze_val" name="area" type="hidden" value="<?php echo $userinfo['area']; ?>"/>
                                    <input class="dis-inlin dis-block fl-lef record-set-input dq_xuanze" type="text" value="<?php echo $userinfo['area_data']; ?>" name='dq_xuanze_val'/>

                                    <i class="dis-inlin dis-block fl-lef dq_xuanze"></i>
                                    <div class="tuanchu3 pa libao" style="display:none"  id='dq_xuanze_window'>
                                        <div class="anniu tar"><span class="fwb fs14 fl fcf">地区名称：</span><a class="buxian" href="javascript:;">[不限]</a>&nbsp;&nbsp;<a class="qued" href="javascript:;">[确定]</a>&nbsp;&nbsp;<a class="qux" href="javascript:;">[取消]</a></div>
                                        <?php foreach($arArea as $AreaList):?>
                                        <dl>
                                            <dt><b><?php echo $AreaList['cascname']; ?></b></dt>
                                            <dd>
                                                <div style="float:none"><input type="checkbox" name="area_val[]" value="<?php echo $AreaList['id']; ?>" /><span class="fwb"><?php echo $AreaList['cascname']; ?></span></div>
                                                <?php foreach($AreaList['casclist'] as $cateSon):?>
                                                <div><input type="checkbox" name="area_val[]" value="<?php echo $cateSon['id']; ?>" /><span><?php echo $cateSon['cascname']; ?></span></div>	
                                                <?php endforeach;?> 								
                                                <div class="queding clear tac">
                                                    <a href="javascript:;" class="xiaoshi fwb fs12 jz">确定</a>
                                                </div>
                                            </dd>
                                            <dd class="clear"></dd>
                                        </dl>
                                        <?php endforeach;?> 
                                        <div class="clear"></div>

                                    </div>
                                </span>
                            </li>
                            <h5>时间设置</h5>
                            <li class="clearfix">
                                <em class="dis-block dis-inlin fl-lef">截止时间</em>
                                <span class="dis-block dis-inlin fl-lef record-set-span">
                                    <input type="text" name="recordSetingMaxdate" readonly="readonly" class="dis-inlin dis-block fl-lef record-set-input" id="recordSetingMaxdate" value="<?php echo $userinfo['maxdate'];?>"/>
                                    <i class="dis-inlin dis-block fl-lef"></i>
                                </span>
                            </li>
                        </ul>
                        <h3 style="margin-top:25px;" class="back-none">我的人脉标签设置</h3>
                        <dl class="clearfix add-tags">
                            <dt class="dis-block dis-inlin fl-lef">熟悉公司</dt>
                            <dd class="dis-block dis-inlin fl-lef clearfix">
                                <div class="my-label clearfix" id="companyList"  <?php if(empty($link_companys) && empty($arCompanyList)):?>style='border-bottom:none'<?php endif;?>>
                                     <?php if(!$link_companys){?>
                                     <?php if($arCompanyList){?>
                                     <?php foreach($arCompanyList as $arCompanyInfo){?>
                                     <span class="dis-block dis-inlin fl-lef"><?php echo $arCompanyInfo['cascname'];?><i>X</i></span>
                                    <?php }?>
                                    <?php }?>
                                    <?php }else{?>
                                    <?php if($link_companys){?>
                                    <?php foreach($link_companys as $value){?>
                                    <span class="dis-block dis-inlin fl-lef"><?php echo $value;?><i>X</i></span>
                                    <?php }?>
                                    <?php }?>
                                    <?php }?>
                                </div>
                                <div class="botm">
                                    <input class="dis-inlin dis-block fl-lef"  type="text">
                                    <span class="hover-hand dis-inlin dis-block fl-lef">粘贴</span>
                                </div>
                            </dd>
                        </dl> 
                        <!--   <div class="biaoqian clearfix">
                             <h6 class="fl-lef dis-block dis-inlin myh3">熟悉公司</h6>
                             <p class="dis-inlin fl-lef mylabel">
                                 <span class="dis-block dis-inlin fl-lef">年底双薪</span>
                                 <span class="dis-block dis-inlin fl-lef">年底双薪</span>
                                 <span class="dis-block dis-inlin fl-lef">年双薪</span>
                                 <span class="dis-block dis-inlin fl-lef">年底双薪</span>
                                 <span class="dis-block dis-inlin fl-lef">双薪</span>
                                 <span class="dis-block dis-inlin fl-lef">年底双薪</span>
                                 <span class="dis-block dis-inlin fl-lef">年底双薪</span>
                                 <span class="dis-block dis-inlin fl-lef">年底双薪</span>
                                 <a href="javascript:void(0)">编辑</a>
                             </p>
                             <div class="odiv dis-inlin fl-lef">
                                 <div class="top">
                                     <em class="dis-block dis-inlin fl-lef">公司亮点</em>
                                     <b class="dis-block dis-inlin fl-rig hover-hand"></b>
                                 </div>
                                 <div class="content">
                                     <p class="p1">已添加亮点<i>(最多可选择16个亮点)</i></p>
                                     <div class="m clearfix">
                                         <span>年底双薪<i class="hover-hand"></i></span>
                                     </div>
                                     <div class="clearfix">
                                         <input class="dis-block dis-inlin fl-lef myinput" type="text">
                                         <b class="dis-block dis-inlin fl-lef paset-btn hover-hand">粘贴</b>
                                     </div>
                                     <div class="mar-lef25 mar-top label-parent">
                                         <h5>选择常用亮点</h5>
                                         <span class="hover-hand">股票期权</span>
                                         <span class="hover-hand">股票期权</span>
                                         <span class="hover-hand">股票期权</span>
                                         <span class="hover-hand">股票期权</span>
                                         <span class="hover-hand">股票期权</span>
                                         <span class="hover-hand">股票期权</span>
                                         <span class="hover-hand">股票期权</span>
 
                                         <span class="hover-hand">股票期权</span>
                                         <span class="hover-hand">股票期权</span>
                                     </div>
                                     <b style="margin-left:25px;" class="confirm-btn dis-inlin paset-btn dis-block fl-lef hover-hand">确认</b>
                                     <b class="cancel dis-inlin paset-btn dis-block fl-lef hover-hand">取消</b>
                                 </div>
                             </div>
                         </div>
                         <div class="biaoqian clearfix">
                             <h6 class="fl-lef dis-block dis-inlin myh3">熟悉职位</h6>
                             <p class="dis-inlin fl-lef mylabel">
                                 <span class="dis-block dis-inlin fl-lef">年底双薪</span>
                                 <span class="dis-block dis-inlin fl-lef">年底双薪</span>
                                 <span class="dis-block dis-inlin fl-lef">年双薪</span>
                                 <span class="dis-block dis-inlin fl-lef">年底双薪</span>
                                 <span class="dis-block dis-inlin fl-lef">双薪</span>
                                 <span class="dis-block dis-inlin fl-lef">年底双薪</span>
                                 <span class="dis-block dis-inlin fl-lef">年底双薪</span>
                                 <span class="dis-block dis-inlin fl-lef">年底双薪</span>
                                 <a href="javascript:void(0)">编辑</a>
                             </p>
                             <div class="odiv dis-inlin fl-lef">
                                 <div class="top">
                                     <em class="dis-block dis-inlin fl-lef">公司亮点</em>
                                     <b class="dis-block dis-inlin fl-rig hover-hand"></b>
                                 </div>
                                 <div class="content">
                                     <p class="p1">已添加亮点<i>(最多可选择16个亮点)</i></p>
                                     <div class="m clearfix">
                                         <span>年底双薪<i class="hover-hand"></i></span>
                                     </div>
                                     <div class="clearfix">
                                         <input class="dis-block dis-inlin fl-lef myinput" type="text">
                                         <b class="dis-block dis-inlin fl-lef paset-btn hover-hand">粘贴</b>
                                     </div>
                                     <div class="mar-lef25 mar-top label-parent">
                                         <h5>选择常用亮点</h5>
                                         <span class="hover-hand">股票期权</span>
                                         <span class="hover-hand">股票期权</span>
                                         <span class="hover-hand">股票期权</span>
                                         <span class="hover-hand">股票期权</span>
                                         <span class="hover-hand">股票期权</span>
                                         <span class="hover-hand">股票期权</span>
                                         <span class="hover-hand">股票期权</span>
 
                                         <span class="hover-hand">股票期权</span>
                                         <span class="hover-hand">股票期权</span>
                                     </div>
                                     <b style="margin-left:25px;" class="confirm-btn dis-inlin paset-btn dis-block fl-lef hover-hand">确认</b>
                                     <b class="cancel dis-inlin paset-btn dis-block fl-lef hover-hand">取消</b>
                                 </div>
                             </div>
                         </div>
                         <div class="biaoqian clearfix">
                             <h6 class="fl-lef dis-block dis-inlin myh3">熟悉领域</h6>
                             <p class="dis-inlin fl-lef mylabel">
                                 <span class="dis-block dis-inlin fl-lef">年底双薪</span>
                                 <span class="dis-block dis-inlin fl-lef">年底双薪</span>
                                 <span class="dis-block dis-inlin fl-lef">年双薪</span>
                                 <span class="dis-block dis-inlin fl-lef">年底双薪</span>
                                 <span class="dis-block dis-inlin fl-lef">双薪</span>
                                 <span class="dis-block dis-inlin fl-lef">年底双薪</span>
                                 <span class="dis-block dis-inlin fl-lef">年底双薪</span>
                                 <span class="dis-block dis-inlin fl-lef">年底双薪</span>
                                 <a href="javascript:void(0)">编辑</a>
                             </p>
                             <div class="odiv dis-inlin fl-lef">
                                 <div class="top">
                                     <em class="dis-block dis-inlin fl-lef">公司亮点</em>
                                     <b class="dis-block dis-inlin fl-rig hover-hand"></b>
                                 </div>
                                 <div class="content">
                                     <p class="p1">已添加亮点<i>(最多可选择16个亮点)</i></p>
                                     <div class="m clearfix">
                                         <span>年底双薪<i class="hover-hand"></i></span>
                                     </div>
                                     <div class="clearfix">
                                         <input class="dis-block dis-inlin fl-lef myinput" type="text">
                                         <b class="dis-block dis-inlin fl-lef paset-btn hover-hand">粘贴</b>
                                     </div>
                                     <div class="mar-lef25 mar-top label-parent">
                                         <h5>选择常用亮点</h5>
                                         <span class="hover-hand">股票期权</span>
                                         <span class="hover-hand">股票期权</span>
                                         <span class="hover-hand">股票期权</span>
                                         <span class="hover-hand">股票期权</span>
                                         <span class="hover-hand">股票期权</span>
                                         <span class="hover-hand">股票期权</span>
                                         <span class="hover-hand">股票期权</span>
 
                                         <span class="hover-hand">股票期权</span>
                                         <span class="hover-hand">股票期权</span>
                                     </div>
                                     <b style="margin-left:25px;" class="confirm-btn dis-inlin paset-btn dis-block fl-lef hover-hand">确认</b>
                                     <b class="cancel dis-inlin paset-btn dis-block fl-lef hover-hand">取消</b>
                                 </div>
                             </div>
                         </div> -->
                        <dl class="clearfix add-tags">
                            <dt class="dis-block dis-inlin fl-lef">熟悉职位</dt>
                            <dd class="dis-block dis-inlin fl-lef clearfix">
                                <div class="my-label clearfix" id="postionList" <?php if(empty($arPostionList) && empty($link_postions)):?>style='border-bottom:none'<?php endif;?>>
                                     <?php if(!$link_postions){?>
                                     <?php if($arPostionList){?>
                                     <?php foreach($arPostionList as $arPostionInfo){?>
                                     <span class="dis-block dis-inlin fl-lef"><?php echo $arPostionInfo['cascname'];?><i>X</i></span>
                                    <?php }?>
                                    <?php }?>
                                    <?php }else{?>
                                    <?php if($link_postions){?>
                                    <?php foreach($link_postions as $value){?>
                                    <span class="dis-block dis-inlin fl-lef"><?php echo $value;?><i>X</i></span>
                                    <?php }?>
                                    <?php }?>
                                    <?php }?>
                                </div>
                                <div class="botm">
                                    <input class="dis-inlin dis-block fl-lef ip1" type="text">
                                    <span class="hover-hand dis-inlin dis-block fl-lef">粘贴</span>
                                </div>
                            </dd>
                        </dl>
                        <dl class="clearfix add-tags">
                            <dt class="dis-block dis-inlin fl-lef">擅长领域</dt>
                            <dd class="dis-block dis-inlin fl-lef clearfix">
                                <div class="my-label clearfix" id="areaList" <?php if(empty($link_areas) && empty($arAreaList)):?>style='border-bottom:none'<?php endif;?>>
                                     <?php if(!$link_areas){?>
                                     <?php if($arAreaList){?>
                                     <?php foreach($arAreaList as $arAreaInfo){?>
                                     <span class="dis-block dis-inlin fl-lef"><?php echo $arAreaInfo['cascname'];?><i>X</i></span>
                                    <?php }?>
                                    <?php }?>
                                    <?php }else{?>
                                    <?php if($link_areas){?>
                                    <?php foreach($link_areas as $value){?>
                                    <span class="dis-block dis-inlin fl-lef"><?php echo $value;?><i>X</i></span>
                                    <?php }?>
                                    <?php }?>
                                    <?php }?>
                                </div>
                                <div class="botm">
                                    <input class="dis-inlin dis-block fl-lef"  type="text">
                                    <span class="hover-hand dis-inlin dis-block fl-lef">粘贴</span>
                                </div>
                            </dd>
                        </dl>
                        <p style="margin-left:95px;margin-top:10px;" class="error undis">错误</p>
                        <button style="margin-left:101px;" class="infor-end-btn dis-block" id="recordInfoConfirm">保存</button>
                    </div>
                </div>
                <div class="change-pswd undis">
                    <h3>更改密码</h3>
                    <ul>
                        <li class="clearfix">
                            <em class="dis-inlin dis-block fl-lef">原始密码：</em>
                            <input placeholder="请输入原始密码" class="dis-inlin dis-block fl-lef" type="text" name="update-opassword">
                        </li>
                        <li class="clearfix">
                            <em class="dis-inlin dis-block fl-lef">新密码：</em>
                            <input placeholder="请输入新密码" class="dis-inlin dis-block fl-lef" type="text"  name="update-password">
                        </li>
                        <li class="clearfix">
                            <em class="dis-inlin dis-block fl-lef">重复密码：</em>
                            <input placeholder="请再次输入新密码" class="dis-inlin dis-block fl-lef" type="text" name="update-repassword">
                        </li>
                        <!-- <p style="margin-left:95px;margin-top:10px;" class="error update-pwd-error undis">错误</p> -->
                        <div class="clearfix ero update-pwd-error" style="display: none;">
                            <b class="fl-lef dis-block dis-inlin" style="margin-left:22px;">温馨提示:</b>
                            <span class="fl-lef dis-block dis-inlin clearfix" style="margin-left:20px;">
                                <i class="fl-lef dis-block dis-inlin"></i>
                                <span class="fl-lef dis-block dis-inlin"></span>
                            </span>
                        </div>
                        <button id="passwordUpdate" class="infor-end-btn dis-block">修改</button>
                    </ul>
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

    <div id="change_telehone_step1" class="wjmima openWind" style="display: none">
        <a class="Close"></a>
        <h3></h3>
        <div class="jindutiao">
            <img src="/Public/img/replace_phone1.png" alt="">
        </div>
        <ul class="InputUl">
            <li><em>更换手机号码：</em><i id="changeMobileTmp"></i></li>
            <li><button class='btn'  id="change_telehone_code_step1">免费获取验证码</button><label class="vfit_btn2"  style="display: none" id="change_telehone_time_step1"><i>60</i>秒后重新获取</label></li>
            <li><input type="text" style="width:107px;" id="change_telehone_ccode_step1"><input class="phone_btn" type="button" value="下一步" id="change_telehone_btn_step1"></li>
            <li id="change_error" class="undis"><p style="padding-left: 21px"></p></li>
        </ul>
    </div>
    <div id="change_telehone_step2" class="wjmima openWind" style="display: none">
        <a class="Close"></a>
        <h3></h3>
        <div class="jindutiao">
            <img src="/Public/img/replace_phone2.png" alt="">
        </div>

        <ul class="InputUl">
            <li><em class="myem">新手机号码：</em><input class="myinput"  type="text" id="change_telehone_telephone_step2"><button class='btn' id="change_telehone_code_step2">获取短信验证码</button><label class="vfit_btn2"  style="display: none" id="change_telehone_time_step2"><i>60</i>秒后重新获取</label></li>

            <li><em class="myem">输入验证码：</em><input type="text" style="width:109px;" id="change_telehone_ccode_step2"><input class="phone_btn" type="button" value="下一步"  id="change_telehone_btn_step2"></li>
            <li id="change_error2"><p style="padding-left: 21px"></p></li>
        </ul>

    </div>
    <div id="change_telehone_step3" class="wjmima openWind" style="display: none">
        <a class="Close"></a>
        <h3></h3>
        <div class="jindutiao">
            <img src="/Public/img/replace_phone3.png" alt="">
        </div>
        <ul class="InputUl">
            <li><h4>恭喜您手机验证成功</h4></li>
            <li><button class="end">完成</button></li>
        </ul>
    </div>
    <div id="regtelephone" class="denglu yzsj openWind" style="display:none">
        <a class="Close"></a>
        <h4>验证手机</h4>
        <ul class="jcid">
            <li><div id="telephoneCheck">您的手机号码是：</div></li>
            <li  style="text-align: center;">
                <button class='btn cur_point' id="getcheckCode" style="background: none repeat scroll 0 0 #2380b8;border: medium none;border-radius: 5px;color: #ffffff;font-size: 14px;font-weight: bold; height: 30px;width: 174px;text-align: center;">获取短信验证码</button><label class="vfit_btn2"  style="display: none" id="codetimes"><i>60</i>秒后重新获取</label>

            </li>
            <li><div><em>验证码：</em><input class="inpu1" type="text" id="code"><i class="error3" style="display:none;">不能为空</i></div></li>
            <li><div><input type="button" class="butonqr cur_point" value="确认" id="checkbtn"></div></li>
        </ul>
        <input type="hidden" id="isFinshed">
    </div>
    <input type='hidden' id ="hash" value = "<?php $_SESSION['cookie']=time();echo md5('rrl_'.$_SESSION['cookie']);?>"; >
    <script>

        $('#recordSetingMaxdate').datepicker({
            dateFormat: 'yy-mm-dd',
            dayNamesMin: ['日', '一', '二', '三', '四', '五', '六'],
            monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
            monthNamesShort: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
            altField: '#abc',
            altFormat: 'dd/mm/yy',
            showWeek: true,
            weekHeader: '周',
            firstDay: 1,
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            closeText: '关闭',
            currentText: '今天dd',
            minDate: 0,
            yearRange: '0:2220',
            defaultDate: 30,
            maxDate: new Date(new Date().getFullYear() + 1, new Date().getMonth(), new Date().getDate()),
        });
        var ue = UE.getEditor('editor');
        $(".m2-l>div").click(function() {
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
        list.on("click", function() {
            that = $(this);
            index = that.index();
            that.addClass("m").siblings().removeClass("m");
            $(this).find("a").addClass("m").parent("li").siblings().find("a").removeClass("m");
            divs.eq(index).show().siblings("div").hide();
            //alert(23)
        });

        //var inputValue = $(".botm input").val();
        var myspans = $(".my-label span i");
        myspans.click(function() {
            $(this).parent().remove();
        })
        var btn = $(".botm span");
        btn.click(function() {
            //alert(inputValue);
            var myVal = $(this).prev().val();
            if (myVal.trim().length !== 0) {
                $(this).parent().prev().append("<span class='dis-block dis-inlin fl-lef'>" + myVal + "<i>X</i></span>");
            }
            //myVal == "";
            var myspans = $(".my-label span i");
            myspans.click(function() {
                $(this).parent().remove();
            })
        })
        $("#passwordUpdate").click(function() {
            var opassword = $("input[name='update-opassword']").val();
            var password = $("input[name='update-password']").val();
            var repassword = $("input[name='update-repassword']").val();
            if (!opassword) {
                $("input[name='update-opassword']").focus();
                $(".update-pwd-error span span").html("请输入原始密码");
                $(".update-pwd-error").show();
                return false;
            }
            if (password != repassword) {
                $(".update-pwd-error span span").html("两次输入不一致");
                $(".update-pwd-error").show();
                return false;
            }
            if (!password || password == "请输入密码") {
                $("input[name='update-password']").focus();
                $(".update-pwd-error span span").html("密码不能为空");
                $(".update-pwd-error").show();
                return false;
            }

            if (password.length == 0)
            {
                $("input[name='update-password']").focus();
                $(".update-pwd-error span span").html("密码不能为空");
                $(".update-pwd-error").show();
                return false;
            }
            else if (password.length < 6 || password.length > 16)
            {
                $("input[name='update-password']").focus();
                $(".update-pwd-error span span").html("密码应为6-16个字符之间");
                $(".update-pwd-error").show();
                return false;
            }
            else
            {
                var preg = /[`,，。;；'"‘’“” \u4e00-\u9fa5　]+/;
                if (preg.test(password))
                {
                    $("input[name='update-password']").focus();
                    $(".update-pwd-error span span").html("密码不能含有特殊字符");
                    $(".update-pwd-error").show();
                    return false;
                }
                else
                {
                    //验证密码复杂度
                    var preg1 = /^[0-9]{6,}$/;
                    var preg2 = /^[a-zA-Z]{6,}$/;
                    if (preg1.test(password) || preg2.test(password))
                    {
                        $("input[name='update-password']").focus();
                        $(".update-pwd-error span span").html("密码不能是纯字母或纯数字");
                        $(".update-pwd-error").show();
                        return false;
                    }
                    else
                    {
                        $(".update-pwd-error").hide();
                    }
                }

            }
            $.post("/Home/Login/changePassword.html", {
                'opassword': opassword,
                'password': password
            }, function(data) {
                $(".update-pwd-error span span").html(data.msg);
                $(".update-pwd-error").show();
            }, "json")
        });
        //收款账号保存
        $("#bankInfoConfirm").click(function() {
            var bankname = $("input[name='bankname']").val();
            var banknumber = $("input[name='banknumber']").val();
            if (!bankname) {
                $("#bankError span span").html("请输入收款银行！");
                $("#bankError").show();
                $("input[name='bankname']").focus();
                return false;
            }
            if (!banknumber) {
                $("#bankError span span").html("请输入账号！");
                $("#bankError").show();
                $("input[name='banknumber']").focus();
                return false;
            }

            $.post("/Home/Login/SetBanksInfo.html", {'bankname': bankname, "banknumber": banknumber}, function(data) {
                if (data.code != "500") {
                    $("#bankname").html(bankname);
                    $("#banknumber").html(banknumber);
                    $("#bankInfoInput").hide();
                    $("#bankInfo").show();
                } else {
                    $("#bankError span span").html(data.msg);
                    $("#bankError").show();
                }
            }, "json")
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var myspans = $(".basic-infor .biaoqian .odiv .m span i");
            myspans.click(function() {
                $(this).parent().remove();
                //alert(23)
            })
            var btn = $(".biaoqian .odiv .paset-btn");
            btn.click(function() {
                var myVal = $(this).prev().val();
                if (myVal.trim().length !== 0) {
                    $(this).parent().prev().append("<span class='dis-block dis-inlin fl-lef hover-hand'>" + myVal + "<i></i></span>");
                }
                var myspans = $(".basic-infor .biaoqian .odiv .m span i");
                ;
                myspans.click(function() {
                    $(this).parent().remove();
                })
            })

            $(".label-parent span").click(function() {
                //alert(23)
                var text = $(this).text();
                $(this).parents(".content").find(".m").append("<span class='dis-block dis-inlin fl-lef hover-hand'>" + text + "<i></i></span>");


                var myspans = $(".basic-infor .biaoqian .odiv .m span i");
                ;
                myspans.click(function() {
                    $(this).parent().remove();
                })
            })

            $(".biaoqian .odiv .confirm-btn").click(function() {

                var content = "";
                if ($(".odiv .content .m span").size() > 0) {
                    $(".odiv .content .m span").each(function() {
                        content += '<span class="dis-block dis-inlin fl-lef">' + $(this).text() + '</span>';
                    });
                    content += '<a href="javascript:void(0)">编辑</a>';
                    $(this).parents(".biaoqian").find(".mylabel").html(content);
                }
                ;
                $(this).parents(".odiv").hide();

                //$(".basic-infor .biaoqian .mylabel a")
                $(this).parents(".biaoqian").find(".mylabel").find("a").click(
                        function() {
                            $(this).parents(".biaoqian").find(".odiv").show();
                        })
            });
            $(".biaoqian .odiv .top b").click(function() {
                //$(".biaoqian .odiv").hide();
                $(this).parents(".odiv").hide();
            });

            $(".biaoqian .odiv .cancel").click(function() {
                $(this).parents(".odiv").hide();
            })
            $(".basic-infor .biaoqian .mylabel a").click(function() {
                $(this).parent().next().show();
            })
            $(".biaoqian .mylabel a").click(function() {
                $(this).parents(".biaoqian").find(".odiv").show();
                $(this).parents(".biaoqian").siblings(".biaoqian").find(".odiv").hide();
            })
        })
    </script>
</body>
</html>