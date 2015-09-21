<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="/Public/img/favicon.ico" type="image/ico">
        <title>个人中心-人人猎</title>
        <meta name="keywords" content="人人猎,人人猎网，人人猎头,renrenlie.com,www.renrenlie.com,人人猎首页,人人猎官网，人人都是猎头" />
        <meta name="description" content="人人猎（www.renrenlie.com)是企业低成本极速直招平台，让企业一周内搞定招聘需求，为推荐人提供“人力资源”变现通道。" />
        <link rel="stylesheet" type="text/css" href="/Public/css/new-resizer.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/new-company.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/lanrenzhijia.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/company.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/boss.css">
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/jquery.styleSelect.js"></script>
        <script type="text/javascript" src="/Public/js/laydate.js"></script>
        <script type="text/javascript" src="/Public/js/al-index.js"></script>
        <script type="text/javascript" src="/Public/js/new-company-common.js"></script>
        <script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.config.js"></script>
        <script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.all.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
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
        <div class="ms1 clearfix">
            <a href="/Home/Company/index.html">
            <div class="m1-l fl-lef">
                <img src="/Public/img/rcmd-img/reco-icon.png" alt="">
                <span>企业用户中心</span>
                <img src="/Public/img/rcmd-img/reco-icon.png" alt="">
            </div>
            </a>
            <div class="m1-r fl-rig">
                <span class="gjz dis-block dis-inlin fl-lef">关键字</span>
                <div class="search dis-inlin fl-lef">
                    <input id="searchbox" class="dis-block dis-inlin post fl-lef" value="" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; JAVA &nbsp; Android &nbsp; IOS " type="text">
                    <span class="btn hover-hand dis-block dis-inlin post fl-lef btn-search">
                        <img src="/Public/img/new-index/position-btn.png">                    </span>
                </div>
            </div>
        </div>
        <div class="ms2 clearfix">
            <div class="m2-l fl-lef">
    <a href='/Home/Company/EnterpriseInformation.html'>
        <div class="odiv hover-hand <?php if($first_class == 1): echo 'm'; endif;?>">
            <span>1</span>
            <h6 class="tit1 <?php if($first_class == 1): echo 'm'; endif;?>">完善资料<em <?php if($leftNavCompleted['userinfo_completed'] == true): echo 'class="m"'; endif;?>></em></h6>
            <p class="tx <?php if($first_class == 1): echo 'm'; endif;?>">方便推荐人了解公司及职位</p>
        </div>
    </a>
    <i class="dis-block"><img src="/Public/img/rcmd-img/btmjd.png" alt=""></i>
    <a href='/Home/Company/SignContract.html'>
        <div class="odiv hover-hand <?php if($first_class == 2): echo 'm'; endif;?>">
            <span>2</span>
            <h6 class="tit2 <?php if($first_class == 2): echo 'm'; endif;?>">签订合同<em <?php if($leftNavCompleted['contract_completed'] == true): echo 'class="m"'; endif;?>></em></h6>

            <p class="tx <?php if($first_class == 2): echo 'm'; endif;?>">签订合同后，就可以发布职位了</p>
        </div>
    </a>
    <i class="dis-block"><img src="/Public/img/rcmd-img/btmjd.png" alt=""></i>
       
        <div  id="sendJobDiv" class="odiv odiv3 hover-hand <?php if($first_class == 3): echo 'm'; endif;?>">
            <span>3</span>
            <h6 class="tit3 <?php if($first_class == 3): echo 'm'; endif;?>">发布职位<em <?php if($leftNavCompleted['job_completed'] == true): echo 'class="m"'; endif;?>></em></h6>
            <p class="tx <?php if($first_class == 3): echo 'm'; endif;?>">职位通过系统审核，就会有推荐</p>
            <a href="javascript:;" class="j"></a>
        </div>
    
    <i class="dis-block"><img src="/Public/img/rcmd-img/btmjd.png" alt=""></i>
    <a href='/Home/Company/ResumeList.html'>
        <div class="odiv hover-hand<?php if($first_class == 4): echo ' m'; endif;?>">
            <span>4</span>
            <h6 class="tit4<?php if($first_class == 4): echo ' m'; endif;?>">查看候选人<em <?php if($leftNavCompleted['record_completed'] == true): echo 'class="m"'; endif;?>></em></h6>
            <p class="jlk<?php if($first_class == 4): echo ' m'; endif;?>">(简历库)</p>
            <p class="tx<?php if($first_class == 4): echo ' m'; endif;?>">如符合要求，请安排面试</p>
        </div>
    </a>
    <i class="dis-block"><img src="/Public/img/rcmd-img/btmjd.png" alt=""></i>
    <a href='/Home/Company/toBePaid.html'>
        <div class="odiv hover-hand<?php if($first_class == 5): echo ' m'; endif;?>">
            <span>5</span>
            <h6 class="tit5<?php if($first_class == 5): echo ' m'; endif;?>">入职管理<em></em></h6>
            <p class="tx<?php if($first_class == 5): echo ' m'; endif;?>">候选人入职后，支付招聘费</p>
        </div>
    </a>
</div>
<script type="text/javascript">
    $(document).ready(function(e){
        $(".m2-l .odiv3").on("mouseenter",function(){
           $(this).find(".j").show();
        });
        $(".m2-l .odiv3").on("mouseleave",function(){
            $(this).find(".j").hide();
        });
    })
</script>
            <div class="m2-r fl-rig">
                <ul class="nav nav2">
                    <li class="m first dis-block dis-inlin fl-lef"><a class="m">基本信息</a></li>
                    <li class="first dis-block dis-inlin fl-lef"><a class="back-none">安全设置</a></li>
                </ul>
                <div class="box-1">
                    <div class="add-resume save_base_info undis">
                        <div class="public upload-resume" style="display:block;position:relative">
                            <form action="<?php echo U('Company/saveCompanyBaseInfo');?>" id="submitBaseInfo"  name= "submitBaseInfo" method = 'post'  enctype="multipart/form-data">
                                <h3>企业信息</h3>
                                <ul>
                                    <li class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef back-none">公司名称</em>
                                        <input placeholder="请输入公司名称" class="input dis-block dis-inlin fl-lef" type="text" name="cpname" value='<?php echo $arCompanyInfo["cpname"];?>'>
                                    </li>
                                    <li  class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef back-none">
                                            公司性质
                                        </em>
                                        <span class="dis-block dis-inlin fl-lef">

                                            <select id="nature" name="nature"  class="down-menu" style="width:195px;top:38px;left:-197px;display:none;">
                                                <option value="请选择" <?php if($arCompanyInfo['nature'] == "-1"):?>selected=selected<?php endif;?>>请选择公司性质</option>
                                                <?php foreach($arNatureList as $natureList):?>
                                                <option value="<?php echo $natureList['datavalue'];?>" <?php if($arCompanyInfo['nature'] == $natureList['datavalue']):?>selected=selected<?php endif;?>><?php echo $natureList['dataname'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </span>
                                    </li>
                                    <li  class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef back-none">
                                            公司规模
                                        </em>
                                        <span class="dis-block dis-inlin fl-lef">

                                            <select id="scale" name="scale"  class="down-menu" style="width:195px;top:38px;left:-197px;display:none;">
                                                <option value="请选择" <?php if($arCompanyInfo['scale'] == "-1"):?>selected=selected<?php endif;?>>请选择公司规模</option>
                                                <?php foreach($arScaleList as $ScaleList):?>
                                                <option value="<?php echo $ScaleList['datavalue'];?>"  <?php if($arCompanyInfo['scale'] == $ScaleList['datavalue']):?>selected=selected<?php endif;?>><?php echo $ScaleList['dataname'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </span>
                                    </li>
                                    <li  class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef back-none">
                                            公司阶段
                                        </em>
                                        <span class="dis-block dis-inlin fl-lef">

                                            <select id="stage" name="stage"  class="down-menu" style="width:195px;top:38px;left:-197px;display:none;">
                                                <option value="请选择" <?php if($arCompanyInfo['stage'] == "-1"):?>selected=selected<?php endif;?>>请选择公司阶段</option>
                                                <?php foreach($arStageList as $StageList):?>
                                                <option value="<?php echo $StageList['datavalue'];?>"  <?php if($arCompanyInfo['stage'] == $StageList['datavalue']):?>selected=selected<?php endif;?>><?php echo $StageList['dataname'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </span>
                                    </li>


                                    <li class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef back-none">成立日期</em>
                                        <input placeholder="请选择成立日期" id="laydate1" class="input dis-block dis-inlin fl-lef" type="text" name="brightregdata" value='<?php echo $arCompanyInfo[brightregdata]?$arCompanyInfo[brightregdata]:"";?>' readonly="true">
                                    </li>
                                    <li class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef back-none">公司网址</em>
                                        <input placeholder="请输入公司网址" class="input dis-block dis-inlin fl-lef" type="text" name="webname" value='<?php echo $arCompanyInfo[webname]?$arCompanyInfo[webname]:"";?>'>
                                    </li>
                                </ul>
                                <h3 style="margin-top:40px;">营业执照</h3>
                                <ul class="icense">
                                    <div id="preview2"  style="padding: 0px;<?php if(!$arCompanyInfo['licence']):?>display: none<?php endif;?>">   
                                        <dt><img id="imghead2"  width=100% height=100% border=0 <?php if($arCompanyInfo['licence']):?>src="<?php echo $arCompanyInfo['licence'];?>"<?php endif;?>>   </dt>
                                    </div> 
                                    <?php if($arCompanyInfo['checklicence'] =="1"):?>
                                    <li class="clearfix myicense" style="position:relative">
                                        <em class="dis-block dis-inlin fl-lef"></em>
                                        <span class="myspan dis-inlin dis-block fl-lef">已通过审核</span>

                                    </li>
                                    <?php else:?>
                                    <li class="clearfix myicense" style="position:relative">
                                        <em class="dis-block dis-inlin fl-lef"></em>
                                        <span class="myspan dis-inlin dis-block fl-lef">上传公司营业执照</span>
                                        <input class="hover-hand" type="file" tabindex="8" name="licence" onchange="previewImage2(this), 'avatar'">
                                    </li>
                                    <?php endif;?>
                                </ul>

                                <h3 style="margin-top:40px;">公司简介</h3>
                                <div class="recmd-reason">
                                    <script id="editor1" type="text/plain" style="width:576px;height:300px;margin-top:10px;margin-left: 100px;" name="intro"><?php echo $arCompanyInfo[intro];?></script>
                                </div>

                                <h3 style="margin-top:40px;">公司亮点</h3>
                                <div class="recmd-reason">
                                    <script id="editor2" type="text/plain" style="width:576px;height:300px;margin-top:10px;margin-left: 100px;" name="bright"><?php echo $arCompanyInfo[bright];?></script>
                                </div>
                                <h3 style="margin-top:40px;">联系我们</h3>
                                <ul>
                                    <li class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef back-none">办公地址</em>
                                        <input placeholder="请输入办公地址" class="input dis-block dis-inlin fl-lef" type="text" name="address" value='<?php echo $arCompanyInfo[address]?$arCompanyInfo[address]:"";?>'>
                                    </li>
                                    <li class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef back-none">联系人</em>
                                        <input placeholder="请输入联系人" class="input dis-block dis-inlin fl-lef" type="text" name="cnname" value='<?php echo $arCompanyInfo[cnname]?$arCompanyInfo[cnname]:"";?>'>
                                    </li>
                                    <li class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef back-none">座机</em>
                                        <input placeholder="请输入座机" class="input dis-block dis-inlin fl-lef" type="text" name="telephone" value='<?php echo $arCompanyInfo[telephone]?$arCompanyInfo[telephone]:"";?>'>
                                    </li>
                                    <input type="hidden" value="<?php echo ($arCompanyInfo['mobile']); ?>" id="mobilemobile">
                                    <?php if($arCompanyInfo[mobile]): ?><li><em class="dis-block dis-inlin fl-lef back-none">手机 </em>
                                            <input type="text"  class="input dis-block dis-inlin fl-lef" id="mobile" name="mobile" value="<?php echo ($arCompanyInfo['mobile']); ?>" disabled="disabled"/>
                                            <input class="Enterxg cur_point" type="button" value="修改" style="width: 80px;background: none repeat scroll 0 0 #2380b8;color: #fff;height: 36px;border:none;" id="change_telehone"></li><?php endif; ?>
                                    <?php if(!$arCompanyInfo[mobile]): ?><li>
                                            <em class="dis-block dis-inlin fl-lef back-none">手机 </em>
                                            <input type="text" id="mobile" name="mobile" class="input dis-block dis-inlin fl-lef" value="<?php echo ($arCompanyInfo['mobile']); ?>" />
                                            <input class="Enterxg cur_point" type="button" value="手机验证" style="width: 80px;background: none repeat scroll 0 0 #2380b8;color: #fff;height: 34px" id="ccheck_telehone"></li><?php endif; ?>


                                    <li class="clearfix">
                                        <em class="dis-block dis-inlin fl-lef back-none">邮箱</em>
                                        <input placeholder="请输入邮箱" class="input dis-block dis-inlin fl-lef" type="text" name="email" value='<?php echo $arCompanyInfo[email]?$arCompanyInfo[email]:"";?>'>
                                    </li>
                                </ul>

                                <dl class="photo">
                                    <dt style="overflow:hidden;border-radius:120px;">
                                    <div id="preview"  style="height:100%;width: 100%;padding: 0px;<?php if(!$arCompanyInfo['comlogo']):?>display: none<?php endif;?>">  
                                        <img id="imghead"  width=100% height=100% border=0 <?php if($arCompanyInfo['comlogo']):?>src="<?php echo $arCompanyInfo['comlogo'];?>"<?php endif;?>>
                                    </div>   
                                    </dt>
                                    <?php if($arCompanyInfo['checklogo'] =="1"):?>

                                    <?php else:?>
                                    <dd>企业LOGO</dd>
                                    <input type="file" class="hover-hand" tabindex="16" onchange="previewImage(this), 'avatar'" name="comlogo">
                                    <?php endif;?>


                                </dl>
                                <p style="margin-left:103px;margin-top:20px;" class="error update_base_error undis">错误</p>
                                <button class="btn btn1 save_base_btn my-btn">保存</button>
                            </form>
                        </div>
                    </div>


                    <div class="add-resume update_base_info">
                        <div class="public upload-resume" style="display:block;position:relative">
                            <h3>企业信息</h3>
                            <ul>
                                <li class="clearfix">
                                    <em class="dis-block dis-inlin fl-lef back-none">公司名称</em>
                                    <span class="infor-dis dis-block dis-inlin fl-lef"><?php echo $arCompanyInfo['cpname']?$arCompanyInfo['cpname']:"暂未填写";?></span>
                                </li>
                                <li class="clearfix">
                                    <em class="dis-block dis-inlin fl-lef back-none">公司性质</em>
                                    <span class="infor-dis dis-block dis-inlin fl-lef"><?php echo $arCompanyInfo['naturedata']?$arCompanyInfo['naturedata']:"暂未填写";?></span>
                                </li>
                                <li class="clearfix">
                                    <em class="dis-block dis-inlin fl-lef back-none">公司规模</em>
                                    <span class="infor-dis dis-block dis-inlin fl-lef"><?php echo $arCompanyInfo['scaledata']?$arCompanyInfo['scaledata']:"暂未填写";?></span>
                                </li>
                                <li class="clearfix">
                                    <em class="dis-block dis-inlin fl-lef back-none"> 公司阶段</em>
                                    <span class="infor-dis dis-block dis-inlin fl-lef"><?php echo $arCompanyInfo['stagedata']?$arCompanyInfo['stagedata']:"暂未填写";?></span>
                                </li>

                                <li class="clearfix">
                                    <em class="dis-block dis-inlin fl-lef back-none">成立日期</em>
                                    <span class="infor-dis dis-block dis-inlin fl-lef"><?php echo $arCompanyInfo['brightregdata']?$arCompanyInfo['brightregdata']:"暂未填写";?></span>
                                </li>
                                <li class="clearfix">
                                    <em class="dis-block dis-inlin fl-lef back-none">公司网址</em>
                                    <span class="infor-dis dis-block dis-inlin fl-lef"><?php echo $arCompanyInfo['webname']?$arCompanyInfo['webname']:"暂未填写";?></span>
                                </li>
                            </ul>
                            <h3 style="margin-top:40px;">营业执照</h3>
                            <ul class="icense">
                                <li class="clearfix myicense" style="height:auto;">
                                    
                                       <?php if($arCompanyInfo['licence']):?>
                                         <em style="background:none!important;"></em>
                                   
                                         <span class="license-img dis-inlin dis-block fl-lef" style="margin-left: 75px;">
                                        <img src="<?php echo $arCompanyInfo['licence'];?>" >
                                        </span>
                                        <?php else:?>
                                       <em class="dis-block dis-inlin fl-lef"></em>
                                    
                                        <i style="font-size: 16px;">暂未上传</i>
                                        <?php endif;?>
                                    
                                </li>
                            </ul>
                            <div class="biaoqian clearfix">
                                <h3 class="fl-lef dis-block dis-inlin">公司简介</h3>
                                <div class="recmd-reason">
                                    <span class="jianjie-dis">
                                        <?php if($arCompanyInfo['intro']):?>
                                        <?php echo $arCompanyInfo['intro'];?>
                                        <?php else:?>
                                        暂未填写
                                        <?php endif;?>
                                    </span>
                                </div>
                            </div>
                            <div class="biaoqian clearfix">
                                <h3 class="fl-lef dis-block dis-inlin">公司亮点</h3>
                                <div class="recmd-reason">
                                    <span class="jianjie-dis">
                                        <?php if($arCompanyInfo['bright']):?>
                                        <?php echo $arCompanyInfo['bright'];?>
                                        <?php else:?>
                                        暂未填写
                                        <?php endif;?>
                                    </span>
                                </div>
                            </div>
                            <h3 style="margin-top:40px;">联系我们</h3>
                            <ul>
                                <li class="clearfix">
                                    <em class="dis-block dis-inlin fl-lef back-none">办公地址</em>
                                    <span class="infor-dis dis-block dis-inlin fl-lef"><?php echo $arCompanyInfo['address']?$arCompanyInfo['address']:"暂未填写";?></span>
                                </li>
                                <li class="clearfix">
                                    <em class="dis-block dis-inlin fl-lef back-none">联系人</em>
                                    <span class="infor-dis dis-block dis-inlin fl-lef"><?php echo $arCompanyInfo['cnname']?$arCompanyInfo['cnname']:"暂未填写";?></span>
                                </li>
                                <li class="clearfix">
                                    <em class="dis-block dis-inlin fl-lef back-none">座机</em>
                                    <span class="infor-dis dis-block dis-inlin fl-lef"><?php echo $arCompanyInfo['telephone']?$arCompanyInfo['telephone']:"暂未填写";?></span>
                                </li>
                                <li class="clearfix">
                                    <em class="dis-block dis-inlin fl-lef back-none">手机</em>
                                    <span class="infor-dis dis-block dis-inlin fl-lef"><?php echo $arCompanyInfo['mobile']?$arCompanyInfo['mobile']:"暂未填写";?></span>
                                </li>
                                <li class="clearfix">
                                    <em class="dis-block dis-inlin fl-lef back-none">邮箱</em>
                                    <span class="infor-dis dis-block dis-inlin fl-lef"><?php echo $arCompanyInfo['email']?$arCompanyInfo['email']:"暂未填写";?></span>
                                </li>
                            </ul>
                            <dl class="photo">
                                
                                <?php if($arCompanyInfo['comlogo']):?>
                                <dt>
                                <img src="<?php echo $arCompanyInfo['comlogo'];?>">
                                 </dt>
                                <?php else:?>
                                  <dt>
                                  </dt>
                                <div style="font-size: 16px;margin-left: 50px;margin-top: 20px;">暂未上传</div>
                                <?php endif;?>
                               
                            </dl>

                            <button class="btn btn1  my-btn update_base_btn">修改</button>
                        </div>

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
                        <p style="margin-left:95px;margin-top:10px;" class="error update-pwd-error undis">错误</p>
                        <div style="margin: 20px;">
                        <button id="passwordUpdate" class="btn btn1 my-btn">修改</button>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="change_telehone_step1" class="wjmima openWind" style="display: none">
        <a class="Close"></a>
        <h3></h3>
        <div class="jindutiao">
            <img src="/Public/img/replace_phone1.png" alt="">
        </div>
        <ul class="InputUl">
            <li><em>更换手机号码：</em><i><?php echo ($arCompanyInfo['mobile']); ?></i></li>
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
       
        $(document).ready(function() {
            $(".mySelect3").styleSelect({styleClass: "selectFruits", optionsWidth: 1, speed: 'fast'});
            $(".down-menu").styleSelect({styleClass: "selectDark"});
        });
        var ue1 = UE.getEditor('editor1');
        var ue2 = UE.getEditor('editor2');

        var list = $(".m2-r .nav li");
        list.eq(0).click(function() {
            $(".box-1").show();
            $(".change-pswd").hide();
            $(this).addClass("m");
            $(this).siblings().removeClass("m");
            $(this).find("a").addClass("m");
            $(this).siblings().find("a").removeClass("m");
        })
        list.eq(1).click(function() {
            $(".box-1").hide();
            $(".change-pswd").show();
            $(this).addClass("m");
            $(this).siblings().removeClass("m");
            $(this).find("a").addClass("m");
            $(this).siblings().find("a").removeClass("m");
        })

        $(".update_base_btn").click(function() {
            $(".update_base_info").hide();
            $(".save_base_info").show();
        });
        $(".save_base_btn").click(function() {
            $(".update_base_error").hide();
            var cpname = $("input[name='cpname']").val();
            var nature = $("#nature").val();
            var scale = $("#scale").val();
            var stage = $("#stage").val();
            var brightregdata = $("input[name='brightregdata']").val();
            var webname = $("input[name='webname']").val();
            var licence = $("input[name='licence']").val();
            var intro = ue1.getContentTxt();
            var bright = ue2.getContentTxt();
            var address = $("input[name='address']").val();
            var cnname = $("input[name='cnname']").val();
            var telephone = $("input[name='telephone']").val();
            var email = $("input[name='email']").val();
            if (!cpname) {
                $(".update_base_error").html("请输入公司名称");
                $(".update_base_error").show();
                $("input[name='cpname']").focus();
                return false;
            }
            if (cpname.length > 50) {
                $(".update_base_error").html("公司名称过长");
                $(".update_base_error").show();
                $("input[name='cpname']").focus();
                return false;
            }
            if (!nature || nature == "请选择") {
                $(".update_base_error").html("请选择公司性质");
                $(".update_base_error").show();
                return false;
            }
            if (!scale || scale == "请选择") {
                $(".update_base_error").html("请选择公司规模");
                $(".update_base_error").show();
                return false;
            }
            if (!stage || stage == "请选择") {
                $(".update_base_error").html("请选择公司阶段");
                $(".update_base_error").show();
                return false;
            }
            if (!brightregdata) {
                $(".update_base_error").html("请选择公司成立日期");
                $(".update_base_error").show();
                $("input[name='brightregdata']").focus();
                return false;
            }
            if (!webname) {
                $(".update_base_error").html("请输入公司网址");
                $(".update_base_error").show();
                $("input[name='webname']").focus();
                return false;
            }
            /*
             if (!licence) {
             $(".update_base_error").html("请选择公司营业执照");
             $(".update_base_error").show();
             return false;
             }
             */
            if (!intro) {
                $(".update_base_error").html("请输入公司介绍");
                $(".update_base_error").show();
                return false;
            }
            if (!bright) {
                $(".update_base_error").html("请输入公司亮点");
                $(".update_base_error").show();

                return false;
            }
            if (!address) {
                $(".update_base_error").html("请输入公司办公地址");
                $(".update_base_error").show();
                $("input[name='address']").focus();
                return false;
            }
            if (!cnname) {
                $(".update_base_error").html("请输入联系人");
                $(".update_base_error").show();
                $("input[name='cnname']").focus();
                return false;
            }
            if (!email) {
                $(".update_base_error").html("请输入邮箱地址");
                $(".update_base_error").show();
                $("input[name='email']").focus();
                return false;
            }
            $.post("/Home/Company/changeUserEmail.html", {"email":email}, function(data) {
                if (data.code != "500") {
                        $("#submitBaseInfo").submit();
                } else {
                    $(".update_base_error").html(data.msg);
                    $(".update_base_error").show();
                    return false;
                }
            }, "json")
            return false;
        });

        $("#passwordUpdate").click(function() {
            var opassword = $("input[name='update-opassword']").val();
            var password = $("input[name='update-password']").val();
            var repassword = $("input[name='update-repassword']").val();
            if (!opassword) {
                $("input[name='update-opassword']").focus();
                $(".update-pwd-error").html("请输入原始密码");
                $(".update-pwd-error").show();
                return false;
            }
            if (password != repassword) {
                $(".update-pwd-error").html("两次输入不一致");
                $(".update-pwd-error").show();
                return false;
            }
            if (!password || password == "请输入密码") {
                $("input[name='update-password']").focus();
                $(".update-pwd-error").html("密码不能为空");
                $(".update-pwd-error").show();
                return false;
            }

            if (password.length == 0)
            {
                $("input[name='update-password']").focus();
                $(".update-pwd-error").html("密码不能为空");
                $(".update-pwd-error").show();
                return false;
            }
            else if (password.length < 6 || password.length > 16)
            {
                $("input[name='update-password']").focus();
                $(".update-pwd-error").html("密码应为6-16个字符之间");
                $(".update-pwd-error").show();
                return false;
            }
            else
            {
                var preg = /[`,，。;；'"‘’“” \u4e00-\u9fa5　]+/;
                if (preg.test(password))
                {
                    $("input[name='update-password']").focus();
                    $(".update-pwd-error").html("密码不能含有特殊字符");
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
                        $(".update-pwd-error").html("密码不能是纯字母或纯数字");
                        $(".update-pwd-error").show();
                        return false;
                    }
                    else
                    {
                        $(".update-pwd-error").hide();
                    }
                }

            }
            $.post("/Home/Company/changePassword.html", {
                'opassword': opassword,
                'password': password
            }, function(data) {
                $(".update-pwd-error").html(data.msg);
                $(".update-pwd-error").show();
            }, "json")
        });
    </script>
    <script type="text/javascript">
        !function() {
            laydate.skin('yahui');//切换皮肤，请查看skins下面皮肤库
            laydate({elem: '#demo'});//绑定元素
        }();
        laydate({
            elem: '#laydate1',
            format: 'YYYY-MM-DD',
            festival: true, //显示节日
            min: "1980-01-01", //-1代表昨天，-2代表前天，以此类推
            max: laydate.now(), //+1代表明天，+2代表后天，以此类推
            choose: function(datas) { //选择日期完毕的回调
                //  alert('得到：' + datas);
            }
        });

        $(".Close").click(function() {

            $(".openWind").hide();
            $(".mask").hide();
        });

    </script>
</body>

</html>