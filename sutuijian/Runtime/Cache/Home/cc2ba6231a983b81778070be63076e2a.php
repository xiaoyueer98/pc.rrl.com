<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="/Public/img/favicon.ico" type="image/ico">
        <title>跟踪状态-人人猎</title>
        <meta name="keywords" content="人人猎,人人猎网，人人猎头,renrenlie.com,www.renrenlie.com,人人猎首页,人人猎官网，人人都是猎头" />
        <meta name="description" content="人人猎（www.renrenlie.com)是企业低成本极速直招平台，让企业一周内搞定招聘需求，为推荐人提供“人力资源”变现通道。" />
        <link rel="stylesheet" type="text/css" href="/Public/css/new-resizer.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/new-recommends.css">
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/al-index.js"></script>
        <script type="text/javascript" src="/Public/js/record-common.js"></script>
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
                <ul class="nav nav2">
                    <li class="dis-block dis-inlin fl-lef"><a href='/Home/Login/Recording.html'>正在推荐</a></li>
                    <li class="m dis-block dis-inlin fl-lef"><a  class="m" href='/Home/Login/Recorded.html'>历史推荐</a></li>
                </ul>


                <div class="recommending track-state" style="display:block">
                    <div class="con"  <?php if(empty($arRecordList)):?>style='padding-bottom: 0px;border-bottom:none;'<?php endif;?>>
                         <table style="width:689px;"  class="data_list">
                            <tbody>
                                <tr class="t">
                                    <th>序号</th>
                                    <th class="header-name hover-hand <?php echo $orderw?>">姓名 <span class="<?php echo $ordern?>" <?php if(empty($arRecordList)){echo "style='display:none'";}?>></span> </th>
                                    <th>推荐公司</th>
                                    <th>推荐职位</th>
                                    <th>推荐进度</th>
                                    <th>可面试时间</th>
                                    <th>推荐费（元）</th>
                                    <th>总招聘人数</th>
                                </tr>
                                <tr  style='border:none;height:10px!important;'><td  style='border:none;height:10px!important;'></td></tr>
                                <?php if(!empty($arRecordList)):?>
                                <?php foreach($arRecordList as $arRecordInfo):?>
                                <tr>
                                    <td class="wh47 wk"  style="border-left: 1px solid #b3b3b3;"><?php echo $arRecordInfo['sort_id'];?></td>
                                    <td class="wh85 wk table-text-left"><?php echo $arRecordInfo['username'];?></td>
                                    <td class="wh152 wk table-text-left"><a href="/Home/Index/EnterIndex/comid/<?php echo $arRecordInfo['cpid'];?>.html"><?php echo $arRecordInfo['cpname'];?></a></td>
                                    <td class="wh96 wk table-text-left"><a href="/Home/Index/EnterIndex2/comid/<?php echo $arRecordInfo['cpid'];?>/jobid/<?php echo $arRecordInfo['j_id'];?>.html"><?php echo $arRecordInfo['Jobcate'];?></a></td>


                                    <?php if($arRecordInfo['notice_list']):?>
                                    <td class="wh124 wk shenhe hover-hand" style="position:relative" tid="<?php echo $arRecordInfo['id'];?>" onclick="showDisMsg('<?php echo $arRecordInfo[disreason];?>')">
                                        <?php echo $arRecordInfo['status'];?>
                                    </td>
                                    <?php else:?>
                                    <td  class="wh124 wk"> <?php echo $arRecordInfo['status'];?></td>
                                    <?php endif;?>
                                    <td  class="wh124 wk table-text-left"><?php echo $arRecordInfo['audstartdate'];?></td>
                                    <td class="wh112 wk"><?php echo $arRecordInfo['Tariff'];?></td>
                                    <td class="wh112 wk"><?php echo $arRecordInfo['employ'];?></td>
                                </tr>
                                <?php if($arRecordInfo['notice_list']):?>
                            <tbody class="state" id="state_<?php echo $arRecordInfo['id'];?>">
                                <?php foreach($arRecordInfo['notice_list'] as $key=>$noticeList):?>
                                <tr>
                                    <td colspan="1"></td>
                                    <td class="wh168 wk" colspan="2"><?php echo date("Y-m-d H:i",$noticeList['created_at']);?></td>
                                    <td class="prompt">
                                        <b></b><i <?php if($key ===0):?>class="m"<?php endif;?>></i>
                                    </td>
                                    <td class="wh220 wk" colspan="4"><?php echo $noticeList['content'];?></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                            <?php endif;?>
                            <tr  style='border:none;height:5px!important;'><td  style='border:none;height:5px!important;'></td></tr>
                            <?php endforeach;?>
                            <?php else:?>
                            <tr >
                                <td  class="wk" colspan="8" ><b>暂无记录</b></td>
                            </tr>
                            <?php endif;?>
                            </tbody>
                        </table>
                        <?php echo $page;?>
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
        function showDisMsg(msg) {
            // sys_window(msg);
        }
        $(".header-name").click(function () {
            if ($(this).hasClass("current")) {
                //倒序
                location.href = "/Home/Login/Recorded/order/desc.html";
//                $(this).find("span").removeClass("m");
//                $(this).removeClass("current");
            } else {
                //正序
                location.href = "/Home/Login/Recorded/order/asc.html"
//                $(this).find("span").addClass("m");
//                $(this).addClass("current");
            }
            ;
        });
        $(function () {
            $(".shenhe").click(function () {
                var id = $(this).attr("tid");
                $(".state").hide(100);
                $(".state2").hide(100);

                if ($("#state_" + id).css("display") == "none") {
                    $("#state_" + id).show(100);
                } else {
                    $("#state_" + id).hide(100);
                }
            });
        });
        $(".m2-l>div").click(function () {
            $(this).addClass("m");
            $(this).find("h6").addClass("m");
            $(this).find("p").addClass("m");
            $(this).siblings().removeClass("m")
            $(this).siblings().find("h6").removeClass("m");
            $(this).siblings().find("p").removeClass("m");
        });

    </script>
</body>

</html>