<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="/Public/img/favicon.ico" type="image/ico">
        <title>维护候选人简历-人人猎</title>
        <meta name="keywords" content="人人猎,人人猎网，人人猎头,renrenlie.com,www.renrenlie.com,人人猎首页,人人猎官网，人人都是猎头" />
        <meta name="description" content="人人猎（www.renrenlie.com)是企业低成本极速直招平台，让企业一周内搞定招聘需求，为推荐人提供“人力资源”变现通道。" />

        <link rel="stylesheet" type="text/css" href="/Public/css/new-resizer.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/new-recommends.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/lanrenzhijia.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/lanrenzhijia.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/boss.css">
        <script type="text/javascript" src="/Public/js/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="/Public/js/jquery.styleSelect.js"></script>
        <script type="text/javascript" src="/Public/js/al-index.js"></script>
        <script type="text/javascript" src="/Public/js/record-common.js"></script>
        <script type="text/javascript" src="/Public/js/jquery.styleSelect.js"></script>
        <script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.config.js"></script>
        <script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.all.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
        <link rel="stylesheet" type="text/css" href="/Public/css/uploadify.css">
        <script type="text/javascript" charset="utf-8" src="/Public/js/jquery.uploadify-3.1.js"></script>
        <style>
            .add-resume .public ul li b.dq_xuanze { width: 33px;height: 36px;float: left;display: block;border-left: 1px solid #B3B3B3;margin: 0px;background: transparent url("/Public/img/company-img/icon1.png") no-repeat scroll center center; background-size:100% 100%; }
        </style>
    </head>
    <body>
        <div class="scjl_tc" style="display: none">
            <h3>上传简历附件</h3>
            <a class="Close4"></a>
            <div class='secord'>
                <div class="button_sc">
                    <span>选择上传简历</span>
                    <input type="file" name="file_upload" id="file_upload" class="sc_jl"/>
                </div>
                <div class="wjgs">
                    支持word、pdf、ppt、txt、wps格式文件<br>文件大小需小于10M
                </div>
                <!-- <div class="gif_loading"></div>-->
            </div>
            <div class="jlsc_cg" style="display:none">
                <h4>简历上传成功</h4>
                <p>&nbsp;</p>
                <button onclick='jlcom()'>确定</button>
            </div>
        </div>
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
                <div style="background:#fff;margin-bottom:15px;padding:20px 0">

                    <div class="new-step2 clearfix">
                        <div class="st1">
                            <b class="m">1</b>
                            <span class="m">选择职位：</span>
                            <em class="m"><?php echo $jobinfo['title'];?></em>
                        </div>
                        <div class="st2 m">
                            <b class="m">2</b>
                            <span class="m">选择候选人 : </span>
                            <em class="m">上传简历</em>
                        </div>
                        <div class="st3">
                            <b class="">3</b>
                            <span class=""> 确认推荐：</span>
                            <em class=""></em>
                        </div>
                    </div>


                    <div class="option-btn2">
                        <div class="public l fl-lef">
                            <span >没有符合选定职位的候选人简历</span>
                            <em><a href="javascript:;">添加候选人简历</a></em>
                        </div>
                        <div class="c">or</div>
                        <div class="public r fl-rig m">
                            <span class="m">有符合选定职位的候选人简历</span>
                            <em  class="m"><a href="/Home/Login/RecommendTheCandidate/comid/<?php echo $cid?>/jobid/<?php echo $jid?>.html">进入候选人简历列表</a></em>
                        </div>
                    </div>

                    <div class="add-resume" style="display:block;margin-top:0">

                        <ul class="nav3 clearfix">
                            <li class="dis-block dis-inlin fl-lef hover-hand m">上传简历模式</li>
                            <li class="dis-block dis-inlin fl-lef hover-hand">在线简历模式</li>
                        </ul>

                        <div class="public upload-resume" style="position:relative;">
                            <form action="/Home/Login/btjadd" method="post" enctype="multipart/form-data"  class="resubmitForm1" onsubmit="return;">
                                <h3>候选人信息</h3>
                                <ul>
                                    <li class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef">姓&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp名</em>
                                        <input placeholder="请输入真实姓名" class="input dis-block dis-inlin fl-lef" type="text" name="tusername" id="username1" value="<?php echo ($resumeInfo['username']); ?>">
                                        <p class="error dis-inlin fl-lef error-username1" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p>
                                    </li>
                                    <li class="clearfix sex-label1">
                                        <em class="dis-block dis-inlin fl-lef">性&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp别</em>
                                        <label class="dis-block dis-inlin fl-lef<?php if($resumeInfo['sex']!='1'):?> m<?php endif;?>"  flag='0'></label>
                                        <b class="dis-block dis-inlin fl-lef">男</b>
                                        <label class="dis-block dis-inlin fl-lef<?php if($resumeInfo['sex']=='1'):?> m<?php endif;?>"  flag='1'></label>
                                        <b class="dis-block dis-inlin fl-lef">女</b>
                                        <input type="hidden" name="sex" id="sex1">

                                    </li>

                                    <li class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef">年&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp龄</em>
                                        <input placeholder="请输入年龄" style="width:96px;" class="input dis-block dis-inlin fl-lef" type="text" name="age" id="age1" value="<?php echo ($resumeInfo['age']); ?>" onkeyup="value = value.replace(/[^\d]/g, '')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" maxlength="2">
                                        <p class="error dis-inlin fl-lef error-age1" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p>
                                    </li>
                                    <li class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef">邮&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp箱</em>
                                        <input placeholder="请输入邮箱地址" class="input dis-block dis-inlin fl-lef" type="text" name="email" id="emailed1"  value="<?php echo ($resumeInfo['email']); ?>">
                                        <p class="error dis-inlin fl-lef error-emailed1" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p>
                                    </li>
                                    <li class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef back-none">Q&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspQ</em>
                                        <input placeholder="请输入qq号码" class="input dis-block dis-inlin fl-lef" type="text" name="qqnum" id="qqnum1"   value="<?php echo ($resumeInfo['qqnum']); ?>">
                                    </li>

                                    <li class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef">联系电话</em>
                                        <input placeholder="请输入手机号" class="input dis-block dis-inlin fl-lef" type="text"  name="mobile" id="mobile1" value="<?php echo ($resumeInfo['mobile']); ?>" onkeyup="value = value.replace(/[^\d]/g, '')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" maxlength="11">
                                        <p class="error dis-inlin fl-lef error-mobile1" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p>
                                    </li>
                                    <li class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef">在职状态</em>
                                        <span class="dis-block dis-inlin fl-lef">
                                            <select class="down-menu" style="width:195px;top:38px;left:-197px;display:none;"  name="state" id="state1">
                                                <option value="请选择"<?php if(!isset($resumeInfo['state'])):?>selected=selected<?php endif;?>>请选择在职状态</option>
                                                <?php foreach($zzstatus as $zzstatuslist):?>
                                                <option value="<?php echo $zzstatuslist['datavalue']?>" <?php if($zzstatuslist['datavalue'] == $resumeInfo['state']):?>selected=selected <?php endif;?>><?php echo $zzstatuslist['dataname']?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </span>
                                        <p class="error dis-inlin fl-lef error-state1" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p>
                                    </li>
                                    <!--
                                    <li class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef">公司背景</em>
                                        <span class="dis-block dis-inlin fl-lef">
                                            <select  class="down-menu" style="width:195px;top:38px;left:-197px;display:none;"  name="match_company" id="match_company1">
                                                <option value="请选择" <?php if(!$resumeInfo['match_company']):?>selected=selected<?php endif;?>>请选择知名公司工作背景</option>
                                                <option value="A" <?php if($resumeInfo['match_company'] == "A"):?>selected=selected<?php endif;?>>一线公司 （BAT，即百度、阿里、腾讯）</option>
                                                <option value="B" <?php if($resumeInfo['match_company'] == "B"):?>selected=selected<?php endif;?>>二线公司 （BAT外的其它互联网上市公司）</option>
                                                <option value="C" <?php if($resumeInfo['match_company'] == "C"):?>selected=selected<?php endif;?>>三线公司 （C轮融资）</option>
                                                <option value="D" <?php if($resumeInfo['match_company'] == "D"):?>selected=selected<?php endif;?>>四线公司 （天使、A轮、B轮）</option>
                                                <option value="E" <?php if($resumeInfo['match_company'] == "E"):?>selected=selected<?php endif;?>>其它公司 （包括自有资金）</option>
                                            </select>
                                        </span>
                                        <p class="error dis-inlin fl-lef error-match_company1" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p>
                                    </li>

                                    <li class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef">学&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp历</em>
                                        <span class="dis-block dis-inlin fl-lef">
                                            <select class="down-menu" style="width:195px;top:38px;left:-197px;display:none;" name="match_educational" id="match_educational1">
                                                <option value="请选择" <?php if(!$resumeInfo['match_educational']):?>selected=selected<?php endif;?>>请选择学历</option>
                                                <option value="A"  <?php if($resumeInfo['match_educational'] == "A"):?>selected=selected<?php endif;?>>大专或大专以下</option>
                                                <option value="B" <?php if($resumeInfo['match_educational'] == "B"):?>selected=selected<?php endif;?>>本科</option>
                                                <option value="C" <?php if($resumeInfo['match_educational'] == "C"):?>selected=selected<?php endif;?>>研究生</option>
                                                <option value="D" <?php if($resumeInfo['match_educational'] == "D"):?>selected=selected<?php endif;?>>博士</option>
                                            </select>
                                        </span>
                                        <p class="error dis-inlin fl-lef error-match_educational1" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p>
                                    </li>
                                    
                                    <li class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef">期望薪资</em>
                                        <span class="dis-block dis-inlin fl-lef">
                                            <select  class="down-menu" style="width:195px;top:38px;left:-197px;display:none;"  name="match_treatment" id="match_treatment1">
                                                <option value="请选择" <?php if(!$resumeInfo['match_treatment']):?>selected=selected<?php endif;?>>请选择期望薪资</option>
                                                <option value="A" <?php if($resumeInfo['match_treatment'] == "A"):?>selected=selected<?php endif;?>>8000-12000元</option>
                                                <option value="B" <?php if($resumeInfo['match_treatment'] == "B"):?>selected=selected<?php endif;?>>12000-15000元</option>
                                                <option value="C" <?php if($resumeInfo['match_treatment'] == "C"):?>selected=selected<?php endif;?>>15000-20000元</option>
                                                <option value="D" <?php if($resumeInfo['match_treatment'] == "D"):?>selected=selected<?php endif;?>>20000-40000元</option>
                                                <option value="E" <?php if($resumeInfo['match_treatment'] == "E"):?>selected=selected<?php endif;?>>40000-60000元</option>
                                                <option value="F" <?php if($resumeInfo['match_treatment'] == "F"):?>selected=selected<?php endif;?>>60000-80000元</option>
                                                <option value="G" <?php if($resumeInfo['match_treatment'] == "G"):?>selected=selected<?php endif;?>>80000元以上</option>	
                                            </select>
                                        </span>
                                        <p class="error dis-inlin fl-lef error-match_treatment1" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p>
                                    </li>
                                    <li class="clearfix" style="position:relative">
                                        <em class="dis-block dis-inlin fl-lef">细分行业</em>
                                        <span style="position:relative" class="dis-block dis-inlin fl-lef record-set-span xuanze_span  cheack" onclick="$('.tuanchu1').show();">
                                            <input type="hidden"  name="match_industry" id="match_industry1" class="dq_xuanze_val" value="<?php echo ($resumeInfo['match_industry']); ?>">
                                            <input type="text" style="width:310px;" readonly="true" id="match_industry_val1"  value="<?php echo ($resumeInfo['xfhy']); ?>" class="dis-inlin dis-block fl-lef record-set-input dq_xuanze text">
                                            <b class="dq_xuanze"></b>

                                        </span>
                                        <div style="position:absolute;left:75px;top:38px;"  class="tuanchu1 pa libao undis" id="wh100">
                                            <div class="anniu tar">
                                                <span class="fwb fs14 fl fcf">细分行业：</span>
                                                <a class="qued" href="javascript:void(0);">[确定]</a>
                                                <a class="qux" href="javascript:void(0);">[取消]</a>
                                            </div>
                                            <?php foreach($xfhy as $key=>$val):?>
                                            <dl><dt><b tag="<?php echo $key;?>"><?php echo $val;?></b></dt><dd class="clear"></dd></dl>
                                            <?php endforeach;?>
                                        </div>
                                    
                                        
                                        <span class="dis-block dis-inlin fl-lef">
                                            <select name="match_industry" id="match_industry1" class="down-menu"> 
                                                <option value="请选择"<?php if(!$resumeInfo['match_industry']):?>selected=selected<?php endif;?>>请选择候选人从业最久的行业</option>
                                                <option value="A" <?php if($resumeInfo['match_industry'] == "A"):?>selected=selected<?php endif;?>>互联网金融（P2P）</option>
                                                <option value="B" <?php if($resumeInfo['match_industry'] == "B"):?>selected=selected<?php endif;?>>旅游</option>
                                                <option value="C" <?php if($resumeInfo['match_industry'] == "C"):?>selected=selected<?php endif;?>>教育</option>
                                                <option value="D" <?php if($resumeInfo['match_industry'] == "D"):?>selected=selected<?php endif;?>>医疗</option>
                                                <option value="E" <?php if($resumeInfo['match_industry'] == "E"):?>selected=selected<?php endif;?>>电商</option>
                                                <option value="F" <?php if($resumeInfo['match_industry'] == "F"):?>selected=selected<?php endif;?>>搜索</option>
                                                <option value="G" <?php if($resumeInfo['match_industry'] == "G"):?>selected=selected<?php endif;?>>传媒广告</option>	
                                                <option value="H" <?php if($resumeInfo['match_industry'] == "H"):?>selected=selected<?php endif;?>>非TMT（非互联网行业）</option>
                                            </select> 
                                        </span>
                                        
                                        <p class="error dis-inlin fl-lef error-match_industry1" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p>
                                    </li>
                                    
                                    <li class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef">职位级别</em>
                                        <span class="dis-block dis-inlin fl-lef">
                                            <select  id="match_title1" name="match_title"  style="width: 300px" class="down-menu">
                                                <option value="请选择"<?php if(!$resumeInfo['match_title']):?>selected=selected<?php endif;?>>请选择过往工作最高职位级别</option>
                                                <option value="A" <?php if($resumeInfo['match_title'] == "A"):?>selected=selected<?php endif;?>>总裁级（如副总、总裁、VP、总监等）</option>
                                                <option value="B" <?php if($resumeInfo['match_title'] == "B"):?>selected=selected<?php endif;?>>经理级（经理、主管等）</option>
                                                <option value="C" <?php if($resumeInfo['match_title'] == "C"):?>selected=selected<?php endif;?>>员工级（如工程师等）</option>
                                            </select>
                                        </span>
                                        <p class="error dis-inlin fl-lef error-match_title1" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p>
                                    </li>
                                    -->
                                    <li class="clearfix" style="height:60px;">
                                        <em class="dis-block dis-inlin fl-lef">期望职位</em>
                                        <input type="text" name="keyword" class="input dis-block dis-inlin fl-lef" id="keyword1" placeholder="系统将根据此关键词推荐给相应的职位，如php、前端、android等" value="<?php echo $resumeInfo['keyword']?>">
                                        <em class="back-none" style="margin-left:13px; color:#C92626">
                                            <p class="error dis-inlin fl-lef error-keyword1" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p>
                                            <br>（系统将根据此关键词推荐给相应的职位，请尽量精准，如php、前端、android等）</em>
                                    </li>
                                    <!--
                                    <li class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef">熟练程度</em>
                                        <span class="dis-block dis-inlin fl-lef">
                                            <select  id="match_skill1" name="match_skill"  class="down-menu">
                                                <option value="请选择"<?php if(!$resumeInfo['match_skill']):?>selected=selected<?php endif;?>>请选择核心技术熟练程度</option>
                                                <option value="A" <?php if($resumeInfo['match_skill'] == "A"):?>selected=selected<?php endif;?>>精通</option>
                                                <option value="B" <?php if($resumeInfo['match_skill'] == "B"):?>selected=selected<?php endif;?>>熟悉</option>
                                                <option value="C" <?php if($resumeInfo['match_skill'] == "C"):?>selected=selected<?php endif;?>>了解</option>
                                                <option value="D" <?php if($resumeInfo['match_skill'] == "D"):?>selected=selected<?php endif;?>>没有</option>
                                            </select> 
                                        </span>
                                        <p class="error dis-inlin fl-lef error-match_skill1" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p>
                                    </li>
                                    <li class="clearfix">
                                    <?php if($resumeInfo == ''): ?><em class="dis-block dis-inlin fl-lef">现居地址</em>
                                        <span class="dis-block dis-inlin fl-lef" style="width:364px;height:34px;">
                                            <input type='text' name="area1" value='北京' class="dis-inlin dis-block fl-lef" disabled="disabled" style='width:30px!important;height:34px;'>

                                            <select style="height:34px;" name="area" class="dis-inlin dis-block fl-lef" id="area1" width="20px">
                                                <option value="<?php echo ($userBaseInfo['area_id']); ?>"><?php echo ($userBaseInfo['area']); ?></option>
                                            </select>
                                            <input style="width:190px;height:32px;" type="text" name="match_area" id="match_area1" value="<?php echo ($resumeInfo['match_area']); ?>" placeholder="输入你的现居住地址"  class="dis-block dis-inlin fl-lef">
                                        </span>
                                        <p class="error dis-inlin fl-lef error-area1" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p><?php endif; ?>
                                    <?php if($resumeInfo != ''): ?><em class="dis-block dis-inlin fl-lef">现居地址</em>
                                        <input type="text" name="match_area" id="match_area1" value="<?php echo ($resumeInfo['match_area']); ?>" placeholder="输入你的现居住地址"  class="input dis-block dis-inlin fl-lef">
                                        <p class="error dis-inlin fl-lef error-match_area1" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p><?php endif; ?>
                                    </li>
                                    -->
                                </ul>
                                <h3>附件简历</h3>
                                <div class="resume-annex">
                                    <dl class="clearfix scjl_click hover-hand" <?php if($resumeInfo[upload] && $resumeInfo[upload] !="/Uploads/word/"){ echo "style='display:none'";}?> id="upd11">
                                        <dt class="dis-block dis-inlin fl-lef">
                                        <img src="/Public/img/rcmd-img/load-resume-icon.png" alt="">
                                        </dt>
                                        <dd class="dis-block dis-inlin fl-lef jianliurl fl-lef">请上传您的简历</dd>
                                    </dl>

                                    <dl class="clearfix" style="padding:12px 0px 20px 72px;width:435px;<?php if(!$resumeInfo[upload] || $resumeInfo[upload] =='/Uploads/word/'){ echo "display:none";}?>"  id="upd12">
                                        <dt class="fl-lef" style="margin-top:5px;margin-left:0;width:42px;"><img src="/Public/img/cwjl.png"></dt>
                                                                                                                                                                          <dd style="font-size: 16px;width: 183px;margin-top: -5px; text-align: center; line-height: 35px;" class="jianliurl fl-lef"> <a class="wk dis-block" style="width:100%;height:100%;" href='<?php echo $resumeInfo[upload];?>'><?php echo $resumeInfo[updateName];?></a></dd>
                                                                                                                                                                          <span style="color: #2380b8;position: absolute;bottom: 57px;right: 20px;cursor:pointer" onclick="$('#upd11').show();
                                                                                                                                                            $('#upd12').hide();
                                                                                                                                                            $('.jianliurl').html('重新上传简历')">删除</span>
                                                                                                                                                                          </dl>
                                                                                                                                                                          <input type='hidden' value='1' id='updateNUm'>
                                                                                                                                                                          <input type='hidden' id='updateFile' name='updateFile' value='<?php echo ($resumeInfo[updateFile]); ?>'>
                                                                                                                                                                          <input type='hidden'  id='updatePath' name='updatePath' value='<?php echo ($resumeInfo[updatePath]); ?>'>
                                                                                                                                                                          <script type="text/javascript">
                                                                                                                                                                              var img_id_upload = new Array(); //初始化数组，存储已经上传的图片名
                                                                                                                                                                              var i = 0; //初始化数组下标
                                                                                                                                                                              var uploadLimit = 1;
                                                                                                                                                                              var buttonName = "<?php if($resumeInfo[updateFile]){ echo '重新上传简历';}else{echo '上传简历';}?>";
                                                                                                                                                                              $(function () {
                                                                                                                                                                                  $('#file_upload').uploadify({
                                                                                                                                                                                      'auto': true, //关闭自动上传
                                                                                                                                                                                      'removeTimeout': 600, //文件队列上传完成1秒后删除
                                                                                                                                                                                      'swf': '/Public/css/uploadify.swf',
                                                                                                                                                                                      'uploader': '/Home/Index/uploadify.html',
                                                                                                                                                                                      'method': 'post', //方法，服务端可以用$_POST数组获取数据
                                                                                                                                                                                      'buttonText': buttonName, //设置按钮文本
                                                                                                                                                                                      'multi': true, //允许同时上传多张图片
                                                                                                                                                                                      'uploadLimit': uploadLimit, //一次最多只允许上传10张图片
                                                                                                                                                                                      'fileTypeDesc': '请选择 Word,PDF文件', //只允许上传图像
                                                                                                                                                                                      'fileTypeExts': '*.doc; *.docx; *.pdf', //限制允许上传的图片后缀
                                                                                                                                                                                      'fileSizeLimit': '10000000000MB', //限制上传的图片大小
                                                                                                                                                                                      'onUploadSuccess': function (file, data, response) { //每次成功上传后执行的回调函数，从服务端返回数据到前端
                                                                                                                                                                                          $(".Close4").hide();
                                                                                                                                                                                          $(".secord").hide();
                                                                                                                                                                                          $(".jlsc_cg ").show();
                                                                                                                                                                                          var filedata = data.split("&&");
                                                                                                                                                                                          $("#updateFile").val(filedata[1]);
                                                                                                                                                                                          $("#updatePath").val(filedata[0]);
                                                                                                                                                                                          var cancel = $("#" + file.id + " .cancel a");
                                                                                                                                                                                          if (cancel) {
                                                                                                                                                                                              $("#updateNUm").val(parseInt($("#updateNUm").val()) + 1);
                                                                                                                                                                                              var uploadLimit = $("#updateNUm").val();
                                                                                                                                                                                              cancel.on('click', function () {
                                                                                                                                                                                                  //在这此处处理...
                                                                                                                                                                                                  //通过uploadify的settings方式重置上传限制数量
                                                                                                                                                                                                  $('#file_upload').uploadify('settings', 'uploadLimit', uploadLimit);
                                                                                                                                                                                                  //防止手快多点几次x，把x隐藏掉
                                                                                                                                                                                                  $(this).hide();
                                                                                                                                                                                              });
                                                                                                                                                                                          }
                                                                                                                                                                                      }
                                                                                                                                                                                  });
                                                                                                                                                                              });
                                                                                                                                                                          </script>
                                                                                                                                                                      </div>
                                                                                                                                                                      <div style="display: block;margin-left: 24px;margin-bottom: 20px;margin-top: 10px;" class="clearfix ero ts">
                                        <span class="fl-lef" style="font-size:18px;font-weight:bold;"><img src='/Public/img/rcmd-img/icon2.png' style='margin-right:10px;'>推荐理由</span>
                                        <span class="dis-block dis-inlin clearfix">
                                            <i class="fl-lef dis-block dis-inlin"></i>
                                            <span  style="width:497px;" class="fl-lef dis-block dis-inlin">指您个人在某方面有突出的技能、您的个人价值点。</span>
                                        </span>
                                    </div>
                                    <div class="recmd-reason">
                                        <script id="editor" name="because" type="text/plain" style="width:606px;height:300px;margin-top:10px;margin-left: 70px"><?php echo ($resumeInfo[because]); ?></script>
                                        </div>
                                        <ul style="display: none">
                                            <li >
                                                <input type="checkbox" id="ck1" style="margin-top:10px;margin-right: 10px;" name="isRecord" <?php if($matchResume):?>checked  onclick="return false"<?php endif;?>/><label for="ck" style='font-size: 18px;font-weight: bold;'>委托系统管理</label><br>
                                            <span style="color:#c92626;margin-left: 10px;height: 57px;margin-left: 10px;margin-top:10px;width: 605px;border: 1px dashed #a0a0a0!important;" class="dis-inlin">注：勾选此项上传简历后，坐等候选人入职，赚取收益（上传简历，有新职位发布时、人人猎系统会自动匹配你简历库中相关候选人，沟通满足企业要求的候选人对该职位的意愿，协调候选人入职后，你就马上得到推荐奖金-整个流程中只需上传简历)<br></span>
                                        </li>
                                    </ul>
                                    <input type='hidden' name='mssj'>
                                    <input type="hidden" value="<?php echo ($resumeInfo['id']); ?>" name="resume_id">
                                    <p style="margin-left:103px;margin-top:70px;" class="error undis" id="resume_error1">错误</p>
                                    <center> <span  class="btn btn2 hover-hand" onclick="savaResumeType(1);" style="margin-top: 60px;width: 127px;margin-left: -10px">立即推荐</span></center>
                                        <input type='hidden' value='1' name='Recordtype'>
                                    </form>
                                </div>

                                <div class="public undis" style="position:relative;">
                                <form action="/Home/Login/btjadd" method="post" enctype="multipart/form-data" class="resubmitForm2">
                                    <h3>候选人信息</h3>
                                    <ul>
                                        <li class="clearfix">
                                            <em class="dis-block dis-inlin fl-lef">姓&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp名</em>
                                            <input placeholder="请输入真实姓名" class="input dis-block dis-inlin fl-lef" type="text" name="tusername" id="username2" value="<?php echo ($resumeInfo['username']); ?>">
                                            <p class="error dis-inlin fl-lef error-username2" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p>
                                        </li>
                                        <li class="clearfix sex-label2">
                                            <em class="dis-block dis-inlin fl-lef">性&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp别</em>
                                            <label class="dis-block dis-inlin fl-lef <?php if($resumeInfo['sex']!='1'):?> m<?php endif;?>"  flag='0'></label>
                                            <b class="dis-block dis-inlin fl-lef">男</b>
                                            <label class="dis-block dis-inlin fl-lef<?php if($resumeInfo['sex']=='1'):?> m<?php endif;?>"  flag='1'></label>
                                            <b class="dis-block dis-inlin fl-lef">女</b>
                                            <input type="hidden" name="sex" id="sex2">

                                        </li>

                                        <li class="clearfix">
                                            <em class="dis-block dis-inlin fl-lef">年&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp龄</em>
                                            <input placeholder="请输入年龄" style="width:96px;" class="input dis-block dis-inlin fl-lef" type="text" name="age" id="age2" value="<?php echo ($resumeInfo['age']); ?>" onkeyup="value = value.replace(/[^\d]/g, '')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" maxlength="2">
                                            <p class="error dis-inlin fl-lef error-age2" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p>
                                        </li>
                                        <li class="clearfix">
                                            <em class="dis-block dis-inlin fl-lef">邮&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp箱</em>
                                            <input placeholder="请输入邮箱地址" class="input dis-block dis-inlin fl-lef" type="text" name="email" id="emailed2"  value="<?php echo ($resumeInfo['email']); ?>">
                                            <p class="error dis-inlin fl-lef error-emailed2" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p>
                                        </li>
                                        <li class="clearfix">
                                            <em class="dis-block dis-inlin fl-lef back-none">Q&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspQ</em>
                                            <input placeholder="请输入qq号码" class="input dis-block dis-inlin fl-lef" type="text" name="qqnum" id="qqnum2"   value="<?php echo ($resumeInfo['qqnum']); ?>">
                                        </li>

                                        <li class="clearfix">
                                            <em class="dis-block dis-inlin fl-lef">联系电话</em>
                                            <input placeholder="请输入手机号" class="input dis-block dis-inlin fl-lef" type="text"  name="mobile" id="mobile2" value="<?php echo ($resumeInfo['mobile']); ?>" onkeyup="value = value.replace(/[^\d]/g, '')" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" maxlength="11">
                                            <p class="error dis-inlin fl-lef error-mobile2" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p>
                                        </li>
                                        <li class="clearfix">
                                            <em class="dis-block dis-inlin fl-lef">在职状态</em>
                                            <span class="dis-block dis-inlin fl-lef">
                                                <select class="down-menu" style="width:195px;top:38px;left:-197px;display:none;"  name="state" id="state2">
                                                    <option value="请选择" <?php if(!isset($resumeInfo['state'])):?>selected=selected<?php endif;?>>请选择在职状态</option>
                                                    <?php foreach($zzstatus as $zzstatuslist):?>
                                                    <option value="<?php echo $zzstatuslist['datavalue']?>" <?php if($zzstatuslist['datavalue'] == $resumeInfo['state']):?>selected=selected <?php endif;?>><?php echo $zzstatuslist['dataname']?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </span>
                                            <p class="error dis-inlin fl-lef error-state2" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p>
                                        </li>
                                        <!--
                                        <li class="clearfix">
                                            <em class="dis-block dis-inlin fl-lef">公司背景</em>
                                            <span class="dis-block dis-inlin fl-lef">
                                                <select  class="down-menu" style="width:195px;top:38px;left:-197px;display:none;"  name="match_company" id="match_company2">
                                                    <option value="请选择" <?php if(!$resumeInfo['match_company']):?>selected=selected<?php endif;?>>请选择知名公司工作背景</option>
                                                    <option value="A" <?php if($resumeInfo['match_company'] == "A"):?>selected=selected<?php endif;?>>一线公司 （BAT，即百度、阿里、腾讯）</option>
                                                    <option value="B" <?php if($resumeInfo['match_company'] == "B"):?>selected=selected<?php endif;?>>二线公司 （BAT外的其它互联网上市公司）</option>
                                                    <option value="C" <?php if($resumeInfo['match_company'] == "C"):?>selected=selected<?php endif;?>>三线公司 （C轮融资）</option>
                                                    <option value="D" <?php if($resumeInfo['match_company'] == "D"):?>selected=selected<?php endif;?>>四线公司 （天使、A轮、B轮）</option>
                                                    <option value="E" <?php if($resumeInfo['match_company'] == "E"):?>selected=selected<?php endif;?>>其它公司 （包括自有资金）</option>
                                                </select>
                                            </span>
                                            <p class="error dis-inlin fl-lef error-match_company2" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p>
                                        </li>

                                        <li class="clearfix">
                                            <em class="dis-block dis-inlin fl-lef">学&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp历</em>
                                            <span class="dis-block dis-inlin fl-lef">
                                                <select class="down-menu" style="width:195px;top:38px;left:-197px;display:none;" name="match_educational" id="match_educational2">
                                                    <option value="请选择"<?php if(!$resumeInfo['match_educational']):?>selected=selected<?php endif;?>>请选择学历</option>
                                                    <option value="A"  <?php if($resumeInfo['match_educational'] == "A"):?>selected=selected<?php endif;?>>大专或大专以下</option>
                                                    <option value="B" <?php if($resumeInfo['match_educational'] == "B"):?>selected=selected<?php endif;?>>本科</option>
                                                    <option value="C" <?php if($resumeInfo['match_educational'] == "C"):?>selected=selected<?php endif;?>>研究生</option>
                                                    <option value="D" <?php if($resumeInfo['match_educational'] == "D"):?>selected=selected<?php endif;?>>博士</option>
                                                </select>
                                            </span>
                                            <p class="error dis-inlin fl-lef error-match_educational2" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p>
                                        </li>

                                        <li class="clearfix">
                                            <em class="dis-block dis-inlin fl-lef">期望薪资</em>
                                            <span class="dis-block dis-inlin fl-lef">
                                                <select  class="down-menu" style="width:195px;top:38px;left:-197px;display:none;"  name="match_treatment" id="match_treatment2">
                                                    <option value="请选择"<?php if(!$resumeInfo['match_treatment']):?>selected=selected<?php endif;?>>请选择期望薪资</option>
                                                    <option value="A" <?php if($resumeInfo['match_treatment'] == "A"):?>selected=selected<?php endif;?>>8000-12000元</option>
                                                    <option value="B" <?php if($resumeInfo['match_treatment'] == "B"):?>selected=selected<?php endif;?>>12000-15000元</option>
                                                    <option value="C" <?php if($resumeInfo['match_treatment'] == "C"):?>selected=selected<?php endif;?>>15000-20000元</option>
                                                    <option value="D" <?php if($resumeInfo['match_treatment'] == "D"):?>selected=selected<?php endif;?>>20000-40000元</option>
                                                    <option value="E" <?php if($resumeInfo['match_treatment'] == "E"):?>selected=selected<?php endif;?>>40000-60000元</option>
                                                    <option value="F" <?php if($resumeInfo['match_treatment'] == "F"):?>selected=selected<?php endif;?>>60000-80000元</option>
                                                    <option value="G" <?php if($resumeInfo['match_treatment'] == "G"):?>selected=selected<?php endif;?>>80000元以上</option>	
                                                </select>
                                            </span>
                                            <p class="error dis-inlin fl-lef error-match_treatment2" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p>
                                        </li>
                                        <li class="clearfix" style="position:relative">
                                                <em class="dis-block dis-inlin fl-lef">细分行业</em>
                                                <span style="position:relative" class="dis-block dis-inlin fl-lef record-set-span xuanze_span  cheack" onclick="$('.tuanchu2').show();">
                                                    <input type="hidden"  name="match_industry" id="match_industry2" class="dq_xuanze_val" value="<?php echo ($resumeInfo['match_industry']); ?>">
                                                    <input type="text" style="width:310px;" id="match_industry_val2"  value="<?php echo ($resumeInfo['xfhy']); ?>" class="dis-inlin dis-block fl-lef record-set-input dq_xuanze text">
                                                <b class="dq_xuanze"></b>

                                            </span>
                                            <div style="position:absolute;left:75px;top:38px;"  class="tuanchu2 pa libao undis" id="tuanchu2">
                                                <div class="anniu tar">
                                                    <span class="fwb fs14 fl fcf">细分行业：</span>
                                                    <a class="qux" href="javascript:;">[取消]</a>
                                                    <a class="qued" href="javascript:;">[确定]</a>
                                                </div>
                                                <?php foreach($xfhy as $key=>$val):?>
                                                <dl><dt><b tag="<?php echo $key;?>"><?php echo $val;?></b></dt><dd class="clear"></dd></dl>
                                                <?php endforeach;?>
                                            </div>
                                            
                                            <span class="dis-block dis-inlin fl-lef">
                                                <select name="match_industry" id="match_industry1" class="down-menu"> 
                                                    <option value="请选择"<?php if(!$resumeInfo['match_industry']):?>selected=selected<?php endif;?>>请选择候选人从业最久的行业</option>
                                                    <option value="A" <?php if($resumeInfo['match_industry'] == "A"):?>selected=selected<?php endif;?>>互联网金融（P2P）</option>
                                                    <option value="B" <?php if($resumeInfo['match_industry'] == "B"):?>selected=selected<?php endif;?>>旅游</option>
                                                    <option value="C" <?php if($resumeInfo['match_industry'] == "C"):?>selected=selected<?php endif;?>>教育</option>
                                                    <option value="D" <?php if($resumeInfo['match_industry'] == "D"):?>selected=selected<?php endif;?>>医疗</option>
                                                    <option value="E" <?php if($resumeInfo['match_industry'] == "E"):?>selected=selected<?php endif;?>>电商</option>
                                                    <option value="F" <?php if($resumeInfo['match_industry'] == "F"):?>selected=selected<?php endif;?>>搜索</option>
                                                    <option value="G" <?php if($resumeInfo['match_industry'] == "G"):?>selected=selected<?php endif;?>>传媒广告</option>	
                                                    <option value="H" <?php if($resumeInfo['match_industry'] == "H"):?>selected=selected<?php endif;?>>非TMT（非互联网行业）</option>
                                                </select> 
                                            </span>
                                            
                                            <p class="error dis-inlin fl-lef error-match_industry2" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p>
                                        </li>
                                        <li class="clearfix">
                                            <em class="dis-block dis-inlin fl-lef">职位级别</em>
                                            <span class="dis-block dis-inlin fl-lef">
                                                <select  id="match_title2" name="match_title"  style="width: 300px" class="down-menu">
                                                        <option value="请选择" <?php if(!$resumeInfo['match_title']):?>selected=selected<?php endif;?>>请选择过往工作最高职位级别</option>
                                                        <option value="A" <?php if($resumeInfo['match_title'] == "A"):?>selected=selected<?php endif;?>>总裁级（如副总、总裁、VP、总监等）</option>
                                                        <option value="B" <?php if($resumeInfo['match_title'] == "B"):?>selected=selected<?php endif;?>>经理级（经理、主管等）</option>
                                                        <option value="C" <?php if($resumeInfo['match_title'] == "C"):?>selected=selected<?php endif;?>>员工级（如工程师等）</option>
                                                    </select>
                                                </span>
                                                <p class="error dis-inlin fl-lef error-match_title2" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p>
                                        </li>
                                        -->
                                        <li class="clearfix" style="height:60px;">
                                            <em class="dis-block dis-inlin fl-lef">期望职位</em>
                                            <input type="text" name="keyword" class="input dis-block dis-inlin fl-lef" id="keyword2" value="<?php echo $resumeInfo['keyword']?>" placeholder="系统将根据此关键词推荐给相应的职位，如php、前端、android等">
                                            <em class="back-none" style="margin-left:13px;color:#C92626;">
                                                <p class="error dis-inlin fl-lef error-keyword2" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p>
                                                <br>（系统将根据此关键词推荐给相应的职位，请尽量精准，如php、前端、android等）</em>
                                        </li>
                                        <!--
                                        <li class="clearfix">
                                            <em class="dis-block dis-inlin fl-lef">熟练程度</em>
                                            <span class="dis-block dis-inlin fl-lef">
                                                <select  id="match_skill2" name="match_skill"  class="down-menu">
                                                    <option value="请选择"<?php if(!$resumeInfo['match_skill']):?>selected=selected<?php endif;?>>请选择核心技术熟练程度</option>
                                                    <option value="A" <?php if($resumeInfo['match_skill'] == "A"):?>selected=selected<?php endif;?>>精通</option>
                                                    <option value="B" <?php if($resumeInfo['match_skill'] == "B"):?>selected=selected<?php endif;?>>熟悉</option>
                                                    <option value="C" <?php if($resumeInfo['match_skill'] == "C"):?>selected=selected<?php endif;?>>了解</option>
                                                    <option value="D" <?php if($resumeInfo['match_skill'] == "D"):?>selected=selected<?php endif;?>>没有</option>
                                                </select> 
                                            </span>
                                            <p class="error dis-inlin fl-lef error-match_skill2" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p>
                                        </li>


                                        <li class="clearfix">
                                        <?php if($resumeInfo == ''): ?><em class="dis-block dis-inlin fl-lef">现居地址</em>
                                            <span class="dis-block dis-inlin fl-lef" style="width:364px;height:34px;">
                                                <input type='text' name="area2" value='北京' class="dis-inlin dis-block fl-lef" disabled="disabled" style='width:30px!important;height:34px;'>
                                                <select style="height:35px;" name="area" class="dis-inlin dis-block fl-lef" id="area2" width="20px">
                                                    <option value="<?php echo ($userBaseInfo['area_id']); ?>"><?php echo ($userBaseInfo['area']); ?></option>
                                                </select>
                                                <input style="width:190px;height:32px;" type="text" name="match_area" id="match_area2" value="<?php echo ($resumeInfo['match_area']); ?>" placeholder="输入你的现居住地址"  class="dis-block dis-inlin fl-lef">
                                            </span>
                                            <p class="error dis-inlin fl-lef error-area2" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p><?php endif; ?>
                                        <?php if($resumeInfo != ''): ?><em class="dis-block dis-inlin fl-lef">现居地址</em>
                                            <input type="text" name="match_area" id="match_area2" value="<?php echo ($resumeInfo['match_area']); ?>" placeholder="输入你的现居住地址"  class="input dis-block dis-inlin fl-lef">
                                            <p class="error dis-inlin fl-lef error-match_area2" style="margin-left:10px;line-height:34px;height:34px!important;">错误</p><?php endif; ?>
                                        </li>
                                        -->
                                    </ul>
                                    <div style="width:100%;height:10px;margin-top:20px; background:#f5f5f5;"></div>
                                    <div style="display: block;margin-left: 24px;margin-bottom: 20px;margin-top: 10px;" class="clearfix ero ts">
                                        <span class="fl-lef" style="font-size:18px;font-weight:bold;"><img src='/Public/img/rcmd-img/icon2.png' style='margin-right:10px;'>教育经历</span>
                                        <span class="dis-block dis-inlin clearfix">
                                            <i class="fl-lef dis-block dis-inlin"></i>
                                            <span  style="width:497px;" class="fl-lef dis-block dis-inlin">指您大学以后的教育以及培训记录。</span>
                                        </span>
                                    </div>
                                    <div class="odiv">
                                        <div class="con clearfix">
                                            <ul class="clearfix mg-tp20">
                                                <li class="clearfix">

                                                    <script id="editor2" type="text/plain" style="width:606px;height:300px;" name="education"><?php echo ($resumeInfo[education]); ?></script>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div style="width:100%;height:10px;margin-top:20px; background:#f5f5f5;"></div>
                                    <div style="display: block;margin-left: 24px;margin-bottom: 20px;margin-top: 10px;" class="clearfix ero ts">
                                        <span class="fl-lef" style="font-size:18px;font-weight:bold;"><img src='/Public/img/rcmd-img/icon2.png' style='margin-right:10px;'>工作经历</span>
                                        <span class="dis-block dis-inlin clearfix">
                                            <i class="fl-lef dis-block dis-inlin"></i>
                                            <span  style="width:497px;" class="fl-lef dis-block dis-inlin">指您的过往工作经历，含项目经验。</span>
                                        </span>
                                    </div>
                                    <div class="odiv">
                                        <div class="con clearfix">
                                            <ul class="clearfix mg-tp20">
                                                <li class="clearfix">
                                                    <script id="editor3" type="text/plain" style="width:606px;height:300px;"  name="workexper"><?php echo ($resumeInfo[workexper]); ?></script>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--
                                    <div style="width:100%;height:10px;margin-top:20px; background:#f5f5f5;"></div>
                                    <div style="display: block;margin-left: 24px;margin-bottom: 20px;margin-top: 10px;" class="clearfix ero ts">
                                        <span class="fl-lef" style="font-size:18px;font-weight:bold;"><img src='/Public/img/rcmd-img/icon2.png' style='margin-right:10px;'>资质证书</span>
                                        <span class="dis-block dis-inlin clearfix">
                                            <i class="fl-lef dis-block dis-inlin"></i>
                                            <span  style="width:497px;" class="fl-lef dis-block dis-inlin">指您获取的各种技能的专业证书</span>
                                        </span>
                                    </div>
                                    
                                    <div class="odiv">

                                        <div class="con clearfix">
                                            <ul class="clearfix mg-tp20">
                                                <li class="clearfix">
                                                    <script id="editor4" type="text/plain" style="width:606px;height:300px;"   name="cercate"><?php echo ($resumeInfo[cercate]); ?></script>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    -->
                                    <div style="width:100%;height:10px;margin-top:20px; background:#f5f5f5;"></div>
                                    <div style="display: block;margin-left: 24px;margin-bottom: 20px;margin-top: 10px;" class="clearfix ero ts">
                                        <span class="fl-lef" style="font-size:18px;font-weight:bold;"><img src='/Public/img/rcmd-img/icon2.png' style='margin-right:10px;'>推荐理由</span>
                                        <span class="dis-block dis-inlin clearfix">
                                            <i class="fl-lef dis-block dis-inlin"></i>
                                            <span  style="width:497px;" class="fl-lef dis-block dis-inlin">指您个人在某方面有突出的技能、您的个人价值点。</span>
                                        </span>
                                    </div>
                                    <div class="odiv">
                                        <div class="con clearfix">
                                            <ul class="clearfix mg-tp20">
                                                <li class="clearfix">
                                                    <script id="editor5" type="text/plain" style="width:606px;height:300px;"  name="because"><?php echo ($resumeInfo[because]); ?></script>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <ul  style="display: none">
                                            <li >
                                                <input type="checkbox" id="ck2" style="margin-top:10px;margin-right: 10px;" name="isRecord" <?php if($matchResume):?>checked  onclick="return false"<?php endif;?>/><label for="ck" style='font-size: 18px;font-weight: bold;'>委托系统管理</label><br>
                                            <span style="color:#c92626;margin-left: 10px;height: 57px;margin-left: 10px;margin-top:10px;width: 605px;border: 1px dashed #a0a0a0!important;" class="dis-inlin">注：勾选此项上传简历后，坐等候选人入职，赚取收益（上传简历，有新职位发布时、人人猎系统会自动匹配你简历库中相关候选人，沟通满足企业要求的候选人对该职位的意愿，协调候选人入职后，你就马上得到推荐奖金-整个流程中只需上传简历)<br></span>
                                        </li>
                                    </ul>
                                    <input type='hidden' name='mssj'>
                                    <input type='hidden' name='jltype'>
                                    <input type="hidden" value="<?php echo ($resumeInfo['id']); ?>" name="resume_id">
                                    <p style="margin-left:103px;margin-top:70px;" class="error undis" id="resume_error2">错误</p>
                                    <center> <span  class="btn btn2 hover-hand" onclick="savaResumeType(2);" style="margin-top: 60px;width: 127px;margin-left: -10px">立即推荐</span></center>

                                        <input type='hidden' value='1' name='Recordtype'>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="eject undis" id='hxrmssj'>
                    <div class="eject-t">
                        <div class="new-step2 clearfix">
                            <div class="st1">
                                <b class="m">1</b>
                                <span class="m">选择职位：</span>
                                <em class="m"><?php echo ($jobInfo['title']); ?></em>
                            </div>
                            <div class="st2 m">
                                <b class="m">2</b>
                                <span class="m">选择候选人 : </span>
                                <em class="m"  id="jllbname">简历列表</em>
                            </div>
                            <div class="st3">
                                <b class="">3</b>
                                <span class=""> 确认推荐：</span>
                                <em class=""></em>
                            </div>
                        </div>

                    </div>
                    <div class="content">
                        <div class="clearfix">
                            <em class="dis-block dis-inlin fl-lef">候选人面试时间</em>
                            <input class="dis-block dis-inlin fl-lef" type="text" id="audstarttime">
                        </div>
                        <p>（例如：3月5日全天或3月6日下午，3月5日-7日下午5点以后）</p>
                    </div>
                    <div class="clearfix ero" id="bankError" style="display: block;">
                        <b class="fl-lef dis-block dis-inlin" style="margin-left:105px;">温馨提示:</b>
                    <span class="fl-lef dis-block dis-inlin clearfix" style="height:auto">
                            <i class="fl-lef dis-block dis-inlin"></i>
                            <span class="fl-lef dis-block dis-inlin wk" style="width:500px;height:auto;line-height:20px;">向企业推荐候选人之前，必须同候选人进行沟通。一旦发现“盲目提交”（未经过候选人同意即提交职位候选人）遭到客户投诉，人人猎将终止你的推荐人用户资格。</span>
                    </span>
                    <span class="btn-l btn m hover-hand dis-block dis-inlin" id='querentuijian'>确认推荐</span>
                    <span class="btn-r btn hover-hand dis-block dis-inlin" id='zaigoutongyixia'>再沟通一下</span>
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
            
            $(".m2-l>div").click(function () {
                $(this).addClass("m");
                $(this).find("h6").addClass("m");
                $(this).find("p").addClass("m");
                $(this).siblings().removeClass("m")
                $(this).siblings().find("h6").removeClass("m");
                $(this).siblings().find("p").removeClass("m");
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
            $(".public ul li label").click(function () {
                $(this).addClass("m").siblings("label").removeClass("m")
            })
        </script>
        <script>
            var ue1 = UE.getEditor('editor');
            var ue2 = UE.getEditor('editor2');
            var ue3 = UE.getEditor('editor3');
            var ue4 = UE.getEditor('editor4');
            var ue5 = UE.getEditor('editor5');
            $(function () {
                changeHy(20, 'area2');
                changeHy(20, 'area1');
            })
            function changeHy(b, h) {
                if (b !== "请选择") {
                    $.ajax({
                        type: "post",
                        data: {"id": b},
                        dataType: "json",
                        url: "/Home/Login/getData",
                        success: function (datas) {
                            if (h == "strycate") {
                                var html = "<option>请选择行业</option>";
                            } else if (h == "Jobcate") {
                                var html = "<option>请选择职位</option>";
                            } else if (h == "area") {
                                var html = "<option>请选择市</option>";
                            }
                            for (var i = 0; i < datas.length; i++) {
                                html += "<option value='" + datas[i].cascname + "'>" + datas[i].cascname + "</option>";
                            }
                            $("#" + h).html(html);
                        }

                    });
                }
            }
            function savaResumeType(type) {
                var username = $("#username" + type).val();
                var age = $("#age" + type).val();
                var state = $("#state" + type).val();
                var mobile = $("#mobile" + type).val();
                var email = $("#emailed" + type).val();
                var qqnum = $("#qqnum" + type).val();
//                    var match_company = $("#match_company" + type).val();
//                    var match_educational = $("#match_educational" + type).val();
//                    var match_treatment = $("#match_treatment" + type).val();
//                    var match_area = $("#match_area" + type).val();
                var updateFile = $("#updateFile").val();
                $("#sex" + type).val($(".sex-label" + type + " .m").attr("flag"));
                //关键字
                var keyword = $("#keyword" + type).val();
                //细分行业
//                    var match_industry = $("#match_industry" + type).val();
                //候选人职位级别
//                    var match_title = $("#match_title" + type).val();
                //熟练程度
//                    var match_skill = $("#match_skill" + type).val();


                if (!username) {
                    $(".error-username" + type).html('请填写姓名');
                    $(".error-username" + type).show();
                    $("#username" + type).focus();
                    $("#resume_error" + type).html('请填写姓名');
                    $("#resume_error" + type).show();
                    return false;
                } else {
                    $(".error-username" + type).hide();
                }
                if (!age) {
                    $(".error-age" + type).html('请填写年龄');
                    $(".error-age" + type).show();
                    $("#age" + type).focus();
                    $("#resume_error" + type).html('请填写年龄');
                    $("#resume_error" + type).show();
                    return false;
                } else {
                    $(".error-age" + type).hide();
                }

                if (!email) {
                    $(".error-emailed" + type).html('请填写邮箱');
                    $(".error-emailed" + type).show();
                    $("#emailed" + type).focus();
                    $("#resume_error" + type).html('请填写邮箱');
                    $("#resume_error" + type).show();
                    return false;
                } else {
                    $(".error-emailed" + type).hide();
                }

//                     if (!qqnum) {
//                     $("#qqnum" + type).focus();
//                     $("#resume_error" + type).html('请填写QQ号');
//                     $("#resume_error" + type).show();
//                     return false;
//                     }
                var has = false;
                if (!mobile) {
                    $(".error-mobile" + type).html('请填写联系电话');
                    $(".error-mobile" + type).show();
                    $("#mobile" + type).focus();
                    $("#resume_error" + type).html('请填写联系电话');
                    $("#resume_error" + type).show();
                    return false;
                } else {
                       
                        $.ajax({
                            url: "/Home/Login/judge_resume_mobile",
                            async: false,
                            data:{'mobile':mobile},
                            type:"POST",
                            dataType: "json",
                            success: function (data) {
                                
                                if ($.trim(data.code) == 200) {
                                    
                                    $(".error-mobile" + type).hide();
                                    has = false;
                                    
                                } else {
                                    
                                    $(".error-mobile" + type).html('该候选人系统中已经存在');
                                    $(".error-mobile" + type).show();
                                    $("#mobile" + type).focus();
                                    $("#resume_error" + type).html('该候选人系统中已经存在');
                                    $("#resume_error" + type).show();
                                    btn2.hide();
                                    btn1.show();
                                    has = true;
                                }
                            }

                        });
                        if(has){
                            return false;
                        }
                        
                }
                

                if (!state) {
                    $("#resume_error" + type).html('请选择候选人在职状态');
                    $("#resume_error" + type).show();
                    return false;
                }
                if (state == '请选择') {
                    $(".error-state" + type).html('请选择候选人在职状态');
                    $(".error-state" + type).show();
                    $("#resume_error" + type).html('请选择候选人在职状态');
                    $("#resume_error" + type).show();
                    return false;
                } else {
                    $(".error-state" + type).hide();
                }
//                    if (match_company == "请选择") {
//                        $(".error-match_company" + type).html('请选择知名公司工作背景');
//                        $(".error-match_company" + type).show();
//                        $(".error-resume_error" + type).html('请选择知名公司工作背景');
//                        $(".error-resume_error" + type).show();
//                        $("#resume_error" + type).html('请选择知名公司工作背景');
//                        $("#resume_error" + type).show();
//                        return false;
//                    } else {
//                        $(".error-match_company" + type).hide();
//                    }
//                    if (match_educational == "请选择") {
//                        $(".error-match_educational" + type).html('请选择学历');
//                        $(".error-match_educational" + type).show();
//                        $("#resume_error" + type).html('请选择学历');
//                        $("#resume_error" + type).show();
//                        return false;
//                    } else {
//                        $(".error-match_educational" + type).hide();
//                    }
//
//                    if (match_treatment == "请选择") {
//                        $(".error-match_treatment" + type).html('请选择期望薪资');
//                        $(".error-match_treatment" + type).show();
//                        $("#resume_error" + type).html('请选择期望薪资');
//                        $("#resume_error" + type).show();
//                        return false;
//                    } else {
//                        $(".error-match_treatment" + type).hide();
//                    }
//
//                    if (!match_industry || match_industry == '请选择') {
//                        $(".error-match_industry" + type).html('请选择候选人从业最久的行业');
//                        $(".error-match_industry" + type).show();
//                        $("#resume_error" + type).html('请选择候选人从业最久的行业');
//                        $("#resume_error" + type).show();
//                        return false;
//                    } else {
//                        $(".error-match_industry" + type).hide();
//                    }
//                    if (!match_title || match_title == '请选择') {
//                        $(".error-match_title" + type).html('请选择过往工作职位最高级别');
//                        $(".error-match_title" + type).show();
//                        $("#resume_error" + type).html('请选择过往工作职位最高级别');
//                        $("#resume_error" + type).show();
//                        return false;
//                    } else {
//                        $(".error-match_title" + type).hide();
//                    }
                if (!keyword) {
                    $(".error-keyword" + type).html('请填写投递期望职位');
                    $(".error-keyword" + type).show();
                    $("#keyword" + type).focus();
                    $("#resume_error" + type).html('请填写投递期望职位');
                    $("#resume_error" + type).show();
                    return false;
                } else {
                    $(".error-keyword" + type).hide();
                }
//                    if (!match_skill || match_skill == '请选择') {
//                        $(".error-match_skill" + type).html('请选择核心技术的熟练情况');
//                        $(".error-match_skill" + type).show();
//                        $("#resume_error" + type).html('请选择核心技术的熟练情况');
//                        $("#resume_error" + type).show();
//                        return false;
//                    } else {
//                        $(".error-match_skill" + type).hide();
//                    }
//                    if (!match_area) {
//                        $(".error-area" + type).html('请填写候选人居住地');
//                        $(".error-area" + type).show();
//                        $("#match_area" + type).focus();
//                        $("#resume_error" + type).html('请填写候选人居住地');
//                        $("#resume_error" + type).show();
//                        return false;
//                    } else {
//                        $(".error-area" + type).hide();
//                    }



                if (type == 1) {
                    var because = ue1.getContentTxt();
                    if (!because) {
                        $("#resume_error" + type).html('推荐理由不能为空');
                        $("#resume_error" + type).show();
                        return false;
                    }
                    if (!updateFile) {
                        $("#resume_error" + type).html('请上传附件简历');
                        $("#resume_error" + type).show();
                        return false;
                    }
                } else {
                    /*
                     //自我评价
                     var because2 = ue2.getContentTxt();
                     if (!because2) {
                     $("#errorClass" + type).html('自我评价不能为空');
                     $("#errorClass" + type).show();
                     return false;
                     }
                     */
                    //教育经历
                    var because2 = ue2.getContentTxt();
                    if (!because2) {
                        $("#resume_error" + type).html('教育经历不能为空');
                        $("#resume_error" + type).show();
                        return false;
                    }
                    //工作经历
                    var because3 = ue3.getContentTxt();
                    if (!because3) {
                        $("#resume_error" + type).html('工作经历不能为空');
                        $("#resume_error" + type).show();
                        return false;
                    }

                    //推荐理由
                    var because5 = ue5.getContentTxt();
                    if (!because5) {
                        $("#resume_error" + type).html('推荐理由不能为空');
                        $("#resume_error" + type).show();
                        return false;
                    }

                }

                $("input[name='jltype']").val(type);
                $(".mask").show();
                $("#hxrmssj").show();

            }
            $('.scjl_click').on('click', function () {
                $(".jlsc_cg").hide();
                $('.mask').show();
                $('.scjl_tc').slideDown();
            })

            $('.scjl_tc .Close4').on('click', function () {
                $('.mask').hide();
                $('.scjl_tc').slideUp();
            })
            $(document).ready(function () {
                $(".mySelect3").styleSelect({styleClass: "selectFruits", optionsWidth: 1, speed: 'fast'});
                $(".down-menu").styleSelect({styleClass: "selectDark"});
            });

            $(function () {
                $(".m2-l>div").click(function () {
                    $(this).addClass("m");
                    $(this).find("h6").addClass("m");
                    $(this).find("p").addClass("m");
                    $(this).siblings().removeClass("m")
                    $(this).siblings().find("h6").removeClass("m");
                    $(this).siblings().find("p").removeClass("m");
                });
                var index;
                var list = $(".m2-r .nav li").eq(0);
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
                $(".public ul li label").click(function () {
                    $(this).addClass("m").siblings("label").removeClass("m")
                })
            })
            $("#zaigoutongyixia").click(function () {
                var type = $("input[name='jltype']").val();
                $(".resubmitForm" + type).submit();
            });
            $("#querentuijian").click(function () {
                var audstarttime = $("#audstarttime").val();
                if (!audstarttime) {
                    alert("请输入面试时间！");
                    return false;
                }
                var type = $("input[name='jltype']").val();
                $("input[name='mssj']").val(audstarttime);
                $(".resubmitForm" + type).submit();
            });
            $(".qxconfirm").click(function () {
                $(".Pop-up").hide();
            });
            /* 当鼠标移到表格上是，当前一行背景变色 */
            $(document).ready(function () {
                $(".data_list tr td").mouseover(function () {
                    $(this).parent().find("td").css("background-color", "#dad7d7");
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
                var color = "#f0f0f0"
                $(".data_list tr:odd td").css("background-color", color);  //改变偶数行背景色
                /* 把背景色保存到属性中 */
                $(".data_list tr:odd").attr("bg", color);
                $(".data_list tr:even").attr("bg", "#fff");
            })
            $(function () {
                $(".tuanchu1 b").click(function (o) {
                    $("#match_industry1").val($(this).attr("tag"));
                    $("#match_industry_val1").val($(this).text());
                    $(".tuanchu1").hide();
                });
                $(".tuanchu2 b").click(function (o) {
                    $("#match_industry2").val($(this).attr("tag"));
                    $("#match_industry_val2").val($(this).text());
                    $(".tuanchu2").hide();
                });
            })
        </script>
    </body>

</html>