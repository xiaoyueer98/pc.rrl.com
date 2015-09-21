<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="/Public/img/favicon.ico" type="image/ico">
        <?php if($act == 'CurrectJobList'):?>
        <title>正在招聘-人人猎</title>
        <?php elseif($act == 'OldJobList'):?>
        <title>往期招聘-人人猎</title>
        <?php else:?>
        <title>发布职位-人人猎</title>
        <?php endif;?>
        <meta name="keywords" content="人人猎,人人猎网，人人猎头,renrenlie.com,www.renrenlie.com,人人猎首页,人人猎官网，人人都是猎头" />
        <meta name="description" content="人人猎（www.renrenlie.com)是企业低成本极速直招平台，让企业一周内搞定招聘需求，为推荐人提供“人力资源”变现通道。" />
        <link rel="stylesheet" type="text/css" href="/Public/css/new-resizer.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/new-company.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/lanrenzhijia.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/boss.css">
        <script type="text/javascript" src="/Public/js/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="/Public/js/jquery.styleSelect.js"></script>
        <script type="text/javascript" src="/Public/js/laydate.js"></script>
        <script type="text/javascript" src="/Public/js/al-index.js"></script>
        <script type="text/javascript" src="/Public/js/new-company-common.js"></script>
        <script type="text/javascript" src="/Public/js/job.js"></script>
        <script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.config.js"></script>
        <script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.all.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
        <link rel="stylesheet" type="text/css" href="/Public/css/company.css">
        <script>
                    $(document).ready(function() {
            $(".down-menu1").styleSelect({styleClass: "selectDark"});
                    $(".down-menu2").styleSelect({styleClass: "selectDark"});
                    $(".down-menu3").styleSelect({styleClass: "selectDark"});
                    $(".down-menu4").styleSelect({styleClass: "selectDark"});
                    $(".down-menu5").styleSelect({styleClass: "selectDark"});
                    $(".down-menu6").styleSelect({styleClass: "selectDark"});
            });                                     </script>
          <style>
              .edit{width:19px;height:25px;margin-right:5px;display:inline-block;margin-top:5px;background:url(/Public/img/rcmd-img/edit-icon.png) no-repeat center 8px}
              .edit-no{width:19px;height:25px;margin-right:5px;display:inline-block;margin-top:5px;background:url(/Public/img/rcmd-img/edit-icon-no.png) no-repeat center 8px}
              .delete{width:23px;height:25px;display:inline-block;margin-top:5px;background:url(/Public/img/rcmd-img/delete-icon.png) no-repeat center 9px}
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
                        <img src="/Public/img/new-index/position-btn.png" alt="">
                    </span>
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
                    <li class="first dis-block dis-inlin fl-lef<?php if($act == 'SendJob'):?> m<?php endif;?>"><a href='/Home/Company/SendJob.html' <?php if($act == 'SendJob'):?>class="m"<?php endif;?>>发布职位</a></li>
                    <li class="first dis-block dis-inlin  fl-lef<?php if($act == 'CurrectJobList'):?> m<?php endif;?>"><a href='/Home/Company/SendJob/act/joblist.html' class="back-none<?php if($act == 'CurrectJobList'):?> m<?php endif;?>">正在招聘</a></li>
                    <li class="first dis-block dis-inlin fl-lef<?php if($act == 'OldJobList'):?> m<?php endif;?>"><a class="back-none<?php if($act == 'OldJobList'):?> m<?php endif;?>" href='/Home/Company/SendJob/act/lastjoblist.html'>往期发布</a></li>
                </ul>
                <div class="add-resume<?php if($act == 'CurrectJobList' || $act == 'OldJobList'):?> undis<?php endif;?>">
                    <div class="public upload-resume" style="display:block;position:relative">
                        <h3>职位基本信息</h3>
                        <ul>
                            <li class="clearfix" style="position:relative;z-index:20;">
                                <em class="dis-block dis-inlin fl-lef back-none">职位名称</em>
                                <input type='hidden' value='<?php echo $arJob[id] ?>' id="jobid">
                                <input placeholder="请输入职位名称&nbsp 如：UI设计师" class="input dis-block dis-inlin fl-lef" type="text" name = "jobtitle" id = "title" value="<?php echo $arJob['title']?>">
                            </li>
                            <li class="clearfix" style="position:relative;z-index:19;">
                                <em class="dis-block dis-inlin fl-lef back-none">行业类别</em>
                                <span style="position: relative;" class="dis-block dis-inlin fl-lef record-set-span cheack">
                                    <input class="xuanze_val" name="strycate" type="hidden" value='<?php echo $arJob[strycate]?>'/>
                                    <input class="dis-inlin dis-block fl-lef xuanze record-set-input text" type="text" name='xuanze_val' value='<?php echo $arJob[strycatedata];?>'/>
                                    <b class="xuanze"></b>
                                    <div class="tuanchu1 pa libao undis" id='xuanze_window' >
                                        <div class="anniu tar">
                                            <a class="qux" href="javascript:;">[取消]</a>
                                            <a class="qued" href="javascript:;">[确定]</a>
                                            <a class="fwb fs14 fl fcf" style="float:left">行业类别：</a>
                                          
                                        </div>
                                        <?php foreach($arStrycate as $strycateList):?>
                                        <dl>
                                            <dt><b><?php echo $strycateList['cascname']; ?></b></dt>
                                            <dd>
                                                <div style="float:none"><span class="fwb"><?php echo $strycateList['cascname']; ?></span></div>
                                                <?php foreach($strycateList['casclist'] as $cateSon):?>
                                                <div><input type="radio" value="<?php echo $cateSon['id']; ?>"  name="zwm_val"/><span><?php echo $cateSon['cascname']; ?></span></div>	
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
                            <li class="clearfix" style="position:relative;z-index:18;">
                                <em class="dis-block dis-inlin fl-lef back-none">职位类别</em>
                                <span class="dis-block dis-inlin fl-lef record-set-span  cheack" style="position:relative">
                                    <input class="zw_xuanze_val" name="Jobcate" type="hidden" value="<?php echo $arJob[Jobcate]?>"/>
                                    <input class="dis-inlin dis-block fl-lef record-set-input zw_xuanze text" type="text" name='zw_xuanze_val' value="<?php echo $arJob[Jobcatedata]?>"/>
                                    <b class="zw_xuanze"></b>
                                    <div class="tuanchu2 pa libao" style="display:none" id='zw_xuanze_window'>
                                         
                                        <div class="anniu tar">
                                            <a class="qux" href="javascript:;">[取消]</a>
                                            <a class="qued" href="javascript:;">[确定]</a>
                                            <a class="fwb fs14"  style="float:left">职位类别：</a></div>
                                        <?php foreach($arJobcate as $JobcateList):?>
                                        <dl>
                                            <dt><b><?php echo $JobcateList['cascname']; ?></b></dt>
                                            <dd style="display:none">
                                                <div style="float:none"><span class="fwb"><?php echo $JobcateList['cascname']; ?></span></div>
                                                <?php foreach($JobcateList['casclist'] as $cateSon):?>
                                                <div><input type="radio" value="<?php echo $cateSon['id']; ?>" name="zwt_val"/><span><?php echo $cateSon['cascname']; ?></span></div>	
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
                            <li class="clearfix" style="position:relative;z-index:17;">
                                <em class="dis-block dis-inlin fl-lef back-none">工作地点</em>
                                <span class="dis-block dis-inlin fl-lef record-set-span xuanze_span  cheack" style="position:relative">
                                    <!--原为
                                    <input class="dq_xuanze_val" name="area" type="hidden" value="<?php echo $userinfo['area']; ?>"/>
                                    <input class="dis-inlin dis-block fl-lef record-set-input dq_xuanze text" type="text" value="<?php echo $userinfo['area_data']; ?>" name='dq_xuanze_val'/>
                                    -->
                                    <input class="dq_xuanze_val" name="area" type="hidden" value="<?php echo $arJob['jobplace']; ?>"/>
                                    <input class="dis-inlin dis-block fl-lef record-set-input dq_xuanze text" type="text" value="<?php echo $arJob['jobplacedata']; ?>" name='dq_xuanze_val'/>
                                    <b class="dq_xuanze"></b>

                                    <div class="tuanchu3 pa libao" style="display:none"  id='dq_xuanze_window'>
                                        <div class="anniu tar">
                                            <a class="qux" href="javascript:;">[取消]</a>
                                            <a class="qued" href="javascript:;">[确定]</a>
                                            <a class="fwb fs14"  style="float:left">地区名称：</a>
                                            
                                            
                                        </div>
                                        <?php foreach($arArea as $AreaList):?>
                                        <dl>
                                            <dt><b><?php echo $AreaList['cascname']; ?></b></dt>
                                            <dd>
                                                <div style="float:none"><span class="fwb"><?php echo $AreaList['cascname']; ?></span></div>
                                                <?php foreach($AreaList['casclist'] as $cateSon):?>
                                                <div><input type="radio" name="area_val" value="<?php echo $cateSon['id']; ?>" /><span><?php echo $cateSon['cascname']; ?></span></div>	
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
                            <li class="clearfix" style="position:relative;z-index:16;">
                                <em class="dis-block dis-inlin fl-lef back-none"> 招聘人数</em>
                                <input placeholder="请输入您要招聘的人数数量" class="input dis-block dis-inlin fl-lef" type="text" name = "jobemploy" id = "employ" value="<?php echo $arJob['employ']?>">
                            </li>
                            <li class="clearfix" style="position:relative;z-index:15;">
                                <em class="dis-block dis-inlin fl-lef back-none">月薪待遇</em>
                                <span class="dis-block dis-inlin fl-lef">

                                    <select onchange="treatmentChange()"  class="down-menu1" style="width:195px;top:38px;left:-197px;display:none;"  name = "jobtreatment" id = "treatment">
                                        <option value="0" tar="0">请选择此岗位的职位月薪</option>
                                        <?php if(is_array($jobInfo[1]['config_list'])): $i = 0; $__LIST__ = $jobInfo[1]['config_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$arConfigList): $mod = ($i % 2 );++$i;?><option value="<?php echo ($arConfigList['datavalue']); ?>" tar="<?php echo ($arConfigList['id']); ?>" <?php if($arJob['treatment']==$arConfigList['datavalue']):?>selected="selected"<?php endif;?>><?php echo ($arConfigList['dataname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>										
                                    </select>
                                </span>
                            </li>
                            <li class="clearfix" style="position:relative" style="position:relative;z-index:14;">
                                <em class="dis-block dis-inlin fl-lef back-none">细分行业</em>
                                <span style="position:relative" class="dis-block dis-inlin fl-lef record-set-span cheack" onclick="$('.tuanchu4').show();">
                                    <input type="hidden"  name="match_industry" id="match_industry" class="dq_xuanze_val" value='<?php echo $arJob["match_industry"]?>'>
                                    <input type="text" readonly="true" id="match_industry_val"  placeholder="择期望候选人上份工作的行业"  class="dis-inlin dis-block fl-lef record-set-input  text" value='<?php echo $xfhy[$arJob["match_industry"]]?>'>
                                    <b class="xfhy_xuanze" onclick="$('.tuanchu4').show();"></b>

                                </span>
                                <div style="position:absolute;left:75px;top:38px;"  class="tuanchu4 pa libao undis" >
                                    <div class="anniu tar">
                                        <a class="qux" href="javascript:;">[取消]</a>
                                            <a class="qued" href="javascript:;">[确定]</a>
                                            <a class="fwb fs14"  style="float:left">细分行业：</a>
                                            
                                    </div>
                                    <?php foreach($xfhy as $key=>$val):?>
                                    <dl><dt><b tag="<?php echo $key;?>"><?php echo $val;?></b></dt><dd class="clear"></dd></dl>
                                    <?php endforeach;?>
                                </div>
                            </li>
                            <li class="clearfix" style="position:relative;z-index:13;">
                                <em class="dis-block dis-inlin fl-lef back-none">公司背景</em>
                                <span class="dis-block dis-inlin fl-lef">

                                    <select id="match_company" name = "match_company" class="down-menu3" style="width:195px;top:38px;left:-197px;display:none;"> 
                                        <option value="请选择">请选择期望候选人互联网从业背景</option>
                                        <option value="A" <?php if($arJob['match_company']=='A'):?>selected="selected"<?php endif;?>>一线公司 （BAT，即百度、阿里、腾讯）</option>
                                        <option value="B" <?php if($arJob['match_company']=='B'):?>selected="selected"<?php endif;?>>二线公司 （BAT外的其它互联网上市公司）</option>
                                        <option value="C" <?php if($arJob['match_company']=='C'):?>selected="selected"<?php endif;?>>三线公司 （C轮融资）</option>
                                        <option value="D" <?php if($arJob['match_company']=='D'):?>selected="selected"<?php endif;?>>四线公司 （已融资）</option>
                                        <option value="E" <?php if($arJob['match_company']=='E'):?>selected="selected"<?php endif;?>>其它公司 （包括自有资金）</option>
                                    </select>
                                </span>
                            </li>
                            <li class="clearfix" style="position:relative;z-index:12;">
                                <em class="dis-block dis-inlin fl-lef back-none">汇报对象</em>
                                <input placeholder="请输入此职位的汇报对象" class="input dis-block dis-inlin fl-lef" type="text" name="report_obj" value="<?php echo $arJob['report']?>">
                            </li>
                            <li class="clearfix" style="position:relative;z-index:11;">
                                <em class="dis-block dis-inlin fl-lef back-none">下属人数</em>
                                <input placeholder="请输入此职位的下属人数" class="input dis-block dis-inlin fl-lef" type="text"  name="report_number" value="<?php echo $arJob['report_number']?>">
                            </li>
                            <li class="clearfix" style="position:relative;z-index:10;">
                                <em class="dis-block dis-inlin fl-lef back-none">截止时间</em>
                                <input placeholder="截止时间" id="laydate1" class="input dis-block dis-inlin fl-lef" type="text" name="jobendtime"  readonly="true"  value="<?php if($arJob['endtime']):echo date('Y-m-d',$arJob['endtime']);endif;?>">
                            </li>
                        </ul>
                        <h3 style="margin-top:30px;">职位要求</h3>
                        <ul>
                            <li class="clearfix" style="position:relative;z-index:9;">
                                <em class="dis-block dis-inlin fl-lef back-none">学历要求</em>
                                <span class="dis-block dis-inlin fl-lef">
                                    <select name = "jobeducation" id = "education"  class="down-menu4" style="width:195px;top:38px;left:-197px;display:none;">
                                        <option value="0">请选择对学历要求</option>
                                        <?php if(is_array($jobInfo[3]['config_list'])): $i = 0; $__LIST__ = $jobInfo[3]['config_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$arConfigList): $mod = ($i % 2 );++$i;?><option value="<?php echo ($arConfigList['datavalue']); ?>" <?php if($arJob['education']==$arConfigList['datavalue']):?>selected="selected"<?php endif;?>><?php echo ($arConfigList['dataname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>

                                </span>
                            </li>
                            <li class="clearfix" style="position:relative;z-index:8;">
                                <em class="dis-block dis-inlin fl-lef back-none"> 语言能力</em>
                                <span class="dis-block dis-inlin fl-lef">
                                    <select id="joblang" name="jobjoblang" class="down-menu5" style="width:195px;top:38px;left:-197px;display:none;">
                                        <option value="0">请选择对语言能力的要求</option>
                                        <?php if(is_array($ynData)): $i = 0; $__LIST__ = $ynData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$yn): $mod = ($i % 2 );++$i;?><option value="<?php echo ($yn['datavalue']); ?>" <?php if($arJob['joblang']==$yn['datavalue']):?>selected="selected"<?php endif;?>><?php echo ($yn['dataname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>
                                </span>
                            </li>
                            <li class="clearfix" style="position:relative;z-index:7;">
                                <em class="dis-block dis-inlin fl-lef back-none">工作经验</em>
                                <span class="dis-block dis-inlin fl-lef">
                                    <select class="down-menu6" style="width:195px;top:38px;left:-197px;display:none;" name = "jobexperience" id = "experience">
                                        <option value="0" selected="selected">请选择对工作经验的要求</option>
                                        <?php if(is_array($jobInfo[2]['config_list'])): $i = 0; $__LIST__ = $jobInfo[2]['config_list'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$arConfigList): $mod = ($i % 2 );++$i;?><option value="<?php echo ($arConfigList['datavalue']); ?>" <?php if($arJob['experience']==$arConfigList['datavalue']):?>selected="selected"<?php endif;?> ><?php echo ($arConfigList['dataname']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </select>

                                </span>
                            </li>
                        </ul>
                        <h3 style="margin-top:30px;">工作职责</h3>
                        <div class="recmd-reason">
                            <textarea name = "jobeditor" id = "editor" style="width:576px;height:300px;margin-top:10px;margin-left: 70px;"><?php echo $arJob['workdesc']?></textarea>
                        </div>
                        <h3 style="margin-top:40px;">岗位要求</h3>
                        <div class="recmd-reason">
                            <textarea name = "jobeditor1" id = "editor1" style="width:576px;height:300px;margin-top:10px;margin-left: 70px;"><?php echo $arJob['content']?></textarea>
                        </div>
                        <h3 style="margin-top:30px;">其他</h3>
                        <div class="qita">
                            <input type='hidden' value="<?php echo $arJob['meth']; ?>" id='old_meth'>
                            <input type='hidden' value="<?php echo $arJob['email']; ?>" id='old_email'>
                            <input type='hidden' value="<?php echo $arJob['mobile']; ?>" id='old_mobile'>
                            <p>本职位管理员联系方式
                                <input class="radio" type="radio" id = "meth" name = "jobmeth" checked value="1" onclick="clickDefault('default')">
                                <label for="wo">请使用默认联系方式</label>
                                <input class="radio"  type="radio" name = "jobmeth" value="2" id = "meth" <?php if($arJob[meth]==2):?>  checked <?php endif;?> onclick="clickDefault('write')">
                                <label for="wo">请使用其他联系方式</label></p>
                            <div class="myinput-box clearfix undis" id="defaults" <?php if($arJob[meth]==2):?>  style="display:block;" <?php endif;?>>
                                <label for="">联系人：</label>
                                <input type="text" class="text" placeholder="输入联系人姓名" name = "jobemail" id = "email" value="<?php echo $arJob['email']; ?>">
                                <label for="">手机：</label>
                                <input type="text" class="text"  placeholder="输入手机号"  name = "jobmobile" id = "mobile" value="<?php echo $arJob['mobile']; ?>">
                            </div>
                            <div class="zpzif clearfix">
                                <em>招聘资费：</em>
                                <span class="zf-text"><input type="text"  name = "jobTariffed" id = "tariff" size="5" value='<?php if($arJob["Tariff"]){echo $arJob["Tariff"]/100;}?>'><b>00</b></span>
                                <i>元</i>
                                <i id = "money"></i>
                            </div>
                        </div>
                        <p style="margin-left:103px;margin-top:20px;" class="error undis send-job-error">错误</p>
                        <button class="btn btn1" onclick="checkSendJob()">保存</button>
                    </div>
                </div>
                <div class="add-resume track-state<?php if($act != 'CurrectJobList'):?> undis<?php endif;?>">
                    <div class="con"> 
                        <div class="titl">正在招聘列表</div>
                        <?php if(!empty($_SESSION['fitCount'])): ?>
                        <div class="clearfix ero ts" style="display:block;margin-bottom: 10px;">

                            <b class="fl-lef dis-block dis-inlin" style="margin-left:0px;">温馨提示：</b>
                            <span class="fl-lef dis-block dis-inlin clearfix">
                                <i class="fl-lef dis-block dis-inlin"></i>
                                <span id="fitjobCount" class="fl-lef dis-block dis-inlin" style="width:590px;">您成功发布了<?php echo $_SESSION['jobname'] ;$_SESSION['jobname'] =null;?>职位，现有<b style='color:#f99e07;'><?php echo $_SESSION['fitCount'];$_SESSION['fitCount']=null;?></b>个匹配的候选人。</span>
                            </span>
                        </div>
                        <?php endif;?>
                        <?php if($arCurrectList['jobList']):?>
                        <table style="width:689px;" class="data_list"> 
                            <tbody> 
                                <tr class="t"> 
                                    <th>序号</th> 
                                    <th>职位名称</th> 
                                    <th>招聘费</th> 
                                    <th>状态</th> 
                                    <th>推荐人数</th> 
                                    <th>截止日期</th> 
                                    <th>操作<b class="dis-block"></b></th> 
                                </tr> 
                                <tr style="border:none;height:10px!important;">
                                    <td style="border:none;height:10px!important;"></td>
                                </tr> 
                                <?php foreach($arCurrectList['jobList'] as $key=>$jobInfo):?>
                                <tr> 
                                    <td class="wh47 wk" style="border-left: 1px solid #b3b3b3;"><?php echo $jobInfo['sort_id']?></td> 
                                    <td class="wh168 wk"><a href="/Home/Company/viewSendJob/id/<?php echo $jobInfo['id'];?>.html" class="ml-10"><?php echo $jobInfo['title']?></td> 
                                    <td class="wh80 wk table-text-left"><?php echo $jobInfo['Tariff']?> <span class='mr-10'><img src="/Public/img/company-img/icon2.png" class="cur_point" alt="增加推荐费" title='增加推荐费' onclick="addTariff(<?php echo ($jobInfo['id']); ?>, <?php echo ($jobInfo['Tariff']); ?>)"></span></td> 
                                    <td class="wh124 wk table-text-left position-name" style="position:relative"><?php echo $jobInfo['status']?> </td> 
                                    <td class="wh47 wk hover-hand" tid="729"><?php if($ischecked == "true"):?><a href="/Home/Company/ResumeList/id/<?php echo $jobInfo['id']?>.html"><?php echo $jobInfo['total']?></a><?php else: echo $jobInfo['total']; endif;?></td> 
                                    <td class="wh95 wk table-text-left"><?php echo $jobInfo['endtime']?></td> 
                                    <!--<td class="wh102 wk"><img src="/Public/img/company-img/icon3.png" class="cur_point" title="删除职位" onclick="deleteJob(<?php echo ($jobInfo['id']); ?>)"></td>--> 
                                    <td class="wh162 wk" style="padding-left:20px;">
                                        <?php if($jobInfo['checkinfo']==="false"):?>
                                        <a style="line-height: 40px;margin-left:10px;" class="dis-inlin dis-block fl-lef" <?php if($jobInfo['checkinfo']==="false"):?> href="/Home/Company/SendJob/act/setResume/id/<?php echo $jobInfo['id'];?>.html"<?php endif;?>><span class="edit dis-inlin hover-hand"></span><em>编辑</em></a>
                                        <?php else:?>
                                        <a style="line-height: 40px;margin-left:10px;" class="dis-inlin dis-block fl-lef" ><span class="edit-no dis-inlin hover-hand"></span><em style="color: #979797;">编辑</em></a>
                                        <?php endif;?>
                                        
                                        <a style="line-height: 40px;" class="dis-inlin dis-block fl-left removeResume" href="javascript:" onclick="deleteJob(<?php echo ($jobInfo['id']); ?>)" ><span class="delete dis-inlin hover-hand" ></span><em>删除</em></a>
                                    </td>
                                </tr>  
                                <?php endforeach;?>
                            </tbody> 
                        </table> 
                        <?php echo $arCurrectList['page'];?>

                        <?php else:?>
                        <table style="width:689px;" class="data_list"> 
                            <tbody> 
                                <tr class="t"> 
                                    <th>序号</th> 
                                    <th>职位名称</th> 
                                    <th>招聘费</th> 
                                    <th>状态</th> 
                                    <th>推荐人数</th> 
                                    <th>截止日期</th> 
                                    <th>操作<b class="dis-block"></b></th> 
                                </tr> 
                                <tr style="border:none;height:10px!important;">
                                    <td style="border:none;height:10px!important;"></td>
                                </tr> 
                                <tr> 
                                    <td  class="wk" colspan="7"  style="border-left: 1px solid #b3b3b3;"><b>暂无记录</b></td>
                                </tr>
                            </tbody> 
                        </table> 
                        <?php endif;?>

                    </div>  
                </div>

                <div class="add-resume track-state<?php if($act != 'OldJobList'):?> undis<?php endif;?>">
                    <div class="con"> 
                        <div class="titl">往期招聘列表</div>
                        <?php if($arOldList['jobList']):?>
                        <table style="width:689px;" class="data_list"> 
                            <tbody> 
                                <tr class="t"> 
                                    <th>序号</th> 
                                    <th>职位名称</th> 
                                    <th>招聘费</th> 
                                    <th>状态</th> 
                                    <th>推荐人数</th> 
                                    <th>截止日期</th> 
                                </tr> 
                                <tr style="border:none;height:10px!important;">
                                    <td style="border:none;height:10px!important;"></td>
                                </tr> 
                                <?php foreach($arOldList['jobList'] as $key=>$jobInfo):?>
                                <tr> 
                                    <td class="wh47 wk" style="border-left: 1px solid #b3b3b3;"><?php echo $jobInfo['sort_id']?></td> 
                                    <td class="wh168 wk table-text-left"><span class="ml-10"><?php echo $jobInfo['title']?></span></td> 
                                    <td class="wh80 wk table-text-left"><?php echo $jobInfo['Tariff']?> </td> 
                                    <td class="wh124 wk table-text-left position-name" style="position:relative"><?php echo $jobInfo['status']?> </td> 
                                    <td class="wh47 wk hover-hand"><?php echo $jobInfo['total'];?></a></td> 
                                    <td class="wh95 wk table-text-left"><?php echo $jobInfo['endtime']?></td> 
                                </tr>  
                                <?php endforeach;?>
                            </tbody> 
                        </table> 
                        <?php echo $arOldList['page'];?>

                        <?php else:?>
                        <table style="width:689px;" class="data_list"> 
                            <tbody> 
                                <tr class="t"> 
                                    <th>序号</th> 
                                    <th>职位名称</th> 
                                    <th>招聘费</th> 
                                    <th>状态</th> 
                                    <th>推荐人数</th> 
                                    <th>截止日期</th> 
                                    <th>操作<b class="dis-block"></b></th> 
                                </tr> 
                                <tr style="border:none;height:10px!important;">
                                    <td style="border:none;height:10px!important;"></td>
                                </tr> 
                                <tr> 
                                    <td  class="wk" colspan="7"  style="border-left: 1px solid #b3b3b3;"><b>暂无记录</b></td>
                                </tr>
                            </tbody> 
                        </table> 
                        <?php endif;?>
                    </div>  
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" value="0" id="deleteid"/>
    <div class="popup_ft" id="addTariffWind">
        <h3>增加推荐费</h3>
        <a class="close cur_point"></a>
        <ul>
            <li class="clearfix" style="padding-left:25px;"><span>推荐费：</span>
                <input type="hidden" id="jobid">
                <span style="border:1px #ccc solid;border-radius:5px;padding:0 5px;"> <input  style="border:none;text-align: right;"  type="text" id="TariffValue"  onkeyup="value = value.replace(/[^\d]/g, '')"onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"><em>00</em></span><div style="padding-top:4px">&nbsp;&nbsp;元</div></li>
            <li class="clearfix" style="margin-top:20px;"><span style="color: #2380b8">小提示：</span><em class="emc">增加推荐费，可以刺激推荐人推荐的兴趣及动力，
                    缩短招聘周期。推荐费只可以上调，不可以下调。
                </em></li>
            <li class="clearfix"><button class="cur_point" id="confAddTriff">确认</button></li>
        </ul>
    </div>

    <div class="qd-qx-alert Pop-up">
        <p>确定删除此候选人记录吗？</p>
        <div>
            <span class="qd btn hover-hand m" onclick="goDelete()">确定</span>
            <span class="qx btn hover-hand" onclick="$('.Pop-up').slideUp(); $('.mask').hide();">取消</span>
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
                var ue = UE.getEditor('editor');
                var ue2 = UE.getEditor('editor1');
                var maxDate = new Date().getFullYear() + "-" + (new Date().getMonth() + 2) + "-" + new Date().getDate();
                laydate({
                elem: '#laydate1',
                        format: 'YYYY-MM-DD',
                        festival: true, //显示节日
                        min: laydate.now(), //-1代表昨天，-2代表前天，以此类推
                        max: maxDate, //+1代表明天，+2代表后天，以此类推
                        choose: function(datas) { //选择日期完毕的回调
                        //  alert('得到：' + datas);
                        }
                });
                $(function(){
                $(".tuanchu4 b").click(function(o){
                $("#match_industry").val($(this).attr("tag"));
                        $("#match_industry_val").val($(this).text());
                        $(".tuanchu4").hide();
                });
                })
    </script>
</body>

</html>