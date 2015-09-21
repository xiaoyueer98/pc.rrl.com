<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="/Public/img/favicon.ico" type="image/ico">
        <title>推荐职位-人人猎</title>
        <meta name="keywords" content="人人猎,人人猎网，人人猎头,renrenlie.com,www.renrenlie.com,人人猎首页,人人猎官网，人人都是猎头" />
        <meta name="description" content="人人猎（www.renrenlie.com)是企业低成本极速直招平台，让企业一周内搞定招聘需求，为推荐人提供“人力资源”变现通道。" />
        <link rel="stylesheet" type="text/css" href="/Public/css/new-resizer.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/new-recommends.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/lanrenzhijia2.css">
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/jquery.styleSelect2.js"></script>
        <script type="text/javascript" src="/Public/js/al-index.js"></script>
        <script type="text/javascript" src="/Public/js/record-common.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".mySelect3").styleSelect({styleClass: "selectFruits", optionsWidth: 1, speed: 'fast'});
                $(".down-menu").styleSelect({styleClass: "selectDark"});
            });
        </script>
    </head>
    <body>
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
        <div class="ms2 clearfix">

            <div class="m2-l fl-lef">
                <a href="/Home/Login/index.html">
                    <div class="m1-l" style="padding:0;height: 56px;padding-top: 10px;padding-left: 5px;">
                        <img src="/Public/img/rcmd-img/reco-icon.png" alt="">
                        <span>推荐人用户中心</span>
                        <img src="/Public/img/rcmd-img/reco-icon.png" alt="">
                    </div>
                </a>
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
            </div>

            <div class="m2-r fl-rig">
                <div class="step1">
                    <div class="new-step2 clearfix">
                        <div class="st1">
                            <b class="m">1</b>
                            <span class="m">选择职位</span>
                            <em class="m"></em>
                        </div>
                        <div class="st2">
                            <b >2</b>
                            <span >选择候选人  </span>
                        </div>
                        <div class="st3">
                            <b class="">3</b>
                            <span class=""> 确认推荐：</span>
                            <em class=""></em>
                        </div>
                    </div>

                    <div style="background:#f5f5f5;width:100%;padding:5px 0;margin-top:20px;" class="clearfix">
                        <div style="display: block;margin-bottom: 5px;margin-top:5px;" class="clearfix ero ts">
                            <b style="margin-left:0px;" class="fl-lef dis-block dis-inlin">温馨提示:</b>
                            <span class="fl-lef dis-block dis-inlin clearfix">
                                <i class="fl-lef dis-block dis-inlin"></i>
                                <span id="fitjobCount" style="width:647px;" class="fl-lef dis-block dis-inlin">
                                    上传优质简历，坐等收钱。                            </span>
                            </span>
                        </div>
                    </div>
                    <div class="input-list clearfix">
                        <h3 class="clearfix">
                            <em class="fl-lef dis-inlin dis-block">搜索要推荐的职位</em>
                            <a href="/Home/Login/JobSearch/act/collect.html"><span class="fl-rig btn hover-hand dis-inlin dis-block position-ollection-btn">职位收藏夹</span></a>
                            <span class="fl-rig btn hover-hand dis-inlin dis-block sousuo">高级搜索</span>
                        </h3>
                        <div class="m-input clearfix<?php if($act =='collect'):?> undis<?php endif;?>" >
                            <input class="dis-inlin dis-block fl-lef title1"   type="text" name="title" id="title" value="<?php echo $title;?>">
                            <span class="dis-inlin dis-block fl-lef hover-hand" onclick="search()"><b>搜索</b></span>
                        </div>
                        <ul class="clearfix myul" style="display:none">
                            <li class="clearfix dis-inlin fl-lef">
                                <em class="dis-block dis-inlin fl-lef">职位名称</em>
                                <input type="text" name="title" class="title2" value="<?php echo $title;?>">
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
                            <button onclick="search()">搜索</button>
                        </ul>
                    </div>
                    <div style="background:#f5f5f5;width:100%;height:15px;margin-top:20px;"></div>
                    <div class='listUl joblist<?php if($act =='collect'):?> undis<?php endif;?>'>
                         <div class="job-list">
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
                                        <a href="/Home/Index/EnterIndex2/comid/<?php echo $jobInfo['cpid'];?>/jobid/<?php echo $jobInfo['guid'];?>.html"><em class="dis-inlin dis-block fl-lef"><?php echo $jobInfo['title'];?></em></a>
                                        <span class="adrs dis-inlin dis-block fl-lef">[<?php echo $jobInfo['jobplace'];?>]</span>
                                        <a href="/Home/Index/EnterIndex/comid/<?php echo $jobInfo['cpid'];?>.html"><h6 class="dis-inlin dis-block fl-rig"><?php echo $jobInfo['cpname'];?></h6></a>
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
                        </div>
                        <?php echo $page;?>
                    </div>
                    <div class="track-state collectList" <?php if($act !='collect'):?>style="display:none"<?php endif;?>>
                         <div class="con"> 
                            <table style="width:689px;" class="data_list"> 
                                <tbody> 
                                    <tr class="t"> 
                                        <th>序号</th> 
                                        <th>职位</th> 
                                        <th>所属公司</th> 
                                        <th>招聘人数</th> 
                                        <th>推荐人数</th> 
                                        <th>推荐费（元）</th> 
                                        <th>截止日期</th>
                                    </tr> 
                                <?php if(arCollectList): if(is_array($arCollectList)): $i = 0; $__LIST__ = $arCollectList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr style="height:5px;"></tr>
                                        <tr>
                                            <td  style="border-left: 1px solid #b3b3b3;"><?php echo ($vo["sort_id"]); ?></td>
                                            <td class="table-text-left"><a href="/Home/Index/EnterIndex2/comid/<?php echo ($vo["cpid"]); ?>/jobid/<?php echo ($vo["j_id"]); ?>.html"><?php echo ($vo["title"]); ?></a></td>
                                            <td class="table-text-left"><a href="/Home/Index/EnterIndex/comid/<?php echo ($vo["cpid"]); ?>.html"><?php echo ($vo["cpname"]); ?></a></tb>
                                            <td><?php echo ($vo["employ"]); ?></tb>
                                            <td><?php echo ($vo["count"]); ?></tb>
                                            <td><?php echo ($vo["Tariff"]); ?></tb>
                                            <td><?php echo ($vo["endtime"]); ?></td>
                                            <!--<td><span class="sp2"><img src="/Public/img/dle.png" alt=""></span></td> -->
                                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                    <?php else: ?>
                                    <tr >
                                        <td  class="wk" colspan="7" ><b>暂无记录</b></td>
                                    </tr><?php endif; ?>  
                                </tbody> 
                            </table> 
                            <?php echo $page;?>
                        </div>  
                    </div>
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
    $(".step1 .input-list h3 .sousuo").click(function() {
        if ($(this).hasClass("current")) {
            $(".step1 .input-list .myul").hide();
            $(".step1 .m-input").show();
            $(".title1").attr("id", "title");
            $(".title2").attr("id", "");
            $(this).removeClass("current").removeClass("m");
        } else {
            $(".title2").attr("id", "title");
            $(".title1").attr("id", "");
            $(".step1 .input-list .myul").show();
            $(".step1 .m-input").hide();
            $(this).addClass("current").addClass("m")
        }


    })
    function search(type)
    {

        //var newdesc=$("#this").val();
        var positionsstmp = $("#positionsstmp").val()
        var position = $("#positionss option:selected").val();
        var nowpage = $("#hid").val();
        var industry = $("#industry option:selected").val();
        var area = $("#area").val();
        var treatment = $("#treatment").val();
        // var Tariff = $("#Tariff").val();
        var puttime = $("#puttime").val();
        var title = $("#title").val();
        var area = "";
        var cpname = $("#cpname").val();


        $.ajax({
            url: "/Home/Login/searchs.html",
            type: "post",
            data: {"position": position, "industry": industry, "area": area, "treatment": treatment, "puttime": puttime, 'title': title, 'cpname': cpname},
            success: function(msg)
            {

                $(".track-state").hide();
                $(".joblist").show();
                $(".listUl").html(msg);
            }

        });
    }
    function page(i) {

        var positionsstmp = $("#positionsstmp").val()
        var position = $("#positionss option:selected").val();
        var nowpage = $("#hid").val();
        var industry = $("#industry option:selected").val();
        var area = $("#area").val();
        var treatment = $("#treatment").val();
        // var Tariff = $("#Tariff").val();
        var puttime = $("#puttime").val();
        var title = $("#title").val();
        var area = "";
        var cpname = $("#cpname").val();
        $.ajax({
            url: "/Home/Login/searchs.html",
            type: "post",
            data: {'i': i, "position": position, "industry": industry, "area": area, "treatment": treatment, "puttime": puttime, 'title': title, 'cpname': cpname},
            success: (function(mgsp) {

                $(".track-state").hide();
                $(".joblist").show();
                $(".listUl").html(mgsp);
            })
        });
    }
    $(".qxconfirm").click(function() {
        $(".Pop-up").hide();
    });

</script>
</body>

</html>