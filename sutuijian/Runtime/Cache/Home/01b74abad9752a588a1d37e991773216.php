<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="/Public/img/favicon.ico" type="image/ico">
        <title>推荐职位-人人猎</title>
        <meta name="keywords" content="人人猎,人人猎网，人人猎头,renrenlie.com,www.renrenlie.com,人人猎首页,人人猎官网，人人都是猎头" />
        <meta name="description" content="人人猎（www.renrenlie.com)是企业低成本极速直招平台，让企业一周内搞定招聘需求，为推荐人提供“人力资源”变现通道。" />
        <link rel="stylesheet" type="text/css" href="/Public/css/boss.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/new-resizer.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/new-recommends.css">
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/al-index.js"></script>
        <script type="text/javascript" src="/Public/js/record-common.js"></script>
    </head>
    <body>

    <div class="mask" id='mask'></div>
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
                <div class="recommend-candidates2" style="display:block">

                    <div class="new-step2 clearfix">
                        <div class="st1">
                            <b class="m">1</b>
                            <span class="m">选择职位：</span>
                            <em class="m"><?php echo ($jobInfo['title']); ?></em>
                        </div>
                        <div class="st2 m">
                            <b class="m">2</b>
                            <span class="m">选择候选人 : </span>
                            <em class="m">简历列表</em>
                        </div>
                        <div class="st3">
                            <b class="">3</b>
                            <span class=""> 确认推荐：</span>
                            <em class=""></em>
                        </div>
                    </div>


                    <div class="option-btn2">
                        <div class="public l fl-lef m">
                            <span class="m">没有符合选定职位的候选人简历</span>
                            <em class="m"><a href="/Home/Login/addResume.html">添加候选人简历</a></em>
                        </div>
                        <div class="c">or</div>
                        <div class="public r fl-rig">
                            <span>有符合选定职位的候选人简历</span>
                            <em><a href="javascript:;">进入候选人简历列表</a></em>
                        </div>
                    </div>
                    <form action="/Home/Login/RecommendTheCandidate3" method="post" id='submitForm'>
                        <input type="hidden" name="comid" value="<?php echo $_GET['comid']; ?>">
                        <input type="hidden" name="position" value="<?php echo $_GET['position']; ?>">
                        <input type="hidden" name="jobid" value="<?php echo $_GET['jobid']; ?>">
                        <input type="hidden" name="audstarttime">
                        <div class="table-list">
                            <table class="data_list">
                                <thead>
                                <th>序号</th>
                                <th>姓名</th>
                                <th>性别</th>
                                <th>状态</th>
                                <th>手机</th>
                                <th>选择</th>
                                </thead>
                                <tbody>
                                <?php if(is_array($resumelist)): $i = 0; $__LIST__ = $resumelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                        <td  class="wh45 wk"><?php echo ($vo["sort_id"]); ?></td>
                                        <td  class="wh210 wk"><?php echo ($vo["username"]); ?></td>
                                        <td class="wh86 wk"><?php if($vo["sex"] == 1): ?>女<?php else: ?>男<?php endif; ?></td>
                                    <td class="wh161 wk"><?php echo ($vo["state"]); ?></td>
                                    <td class="wh122 wk"><?php echo ($vo["mobile"]); ?></td>
                                    <td class="wh52 wk "><input type="Radio" name="id[]" id="id[]" value="<?php echo ($vo["id"]); ?>" fname="<?php echo ($vo["username"]); ?>"   class="checkbox <?php echo ($vo["limit"]); ?> <?php echo ($vo["isRecord"]); ?> " <?php if($vo["isRecord"] == (disabled or isthiscompany or isthreecompany)): ?>disabled<?php endif; ?>></td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                            <?php echo $page;?>

                        </div>
                        <div class="recoml_btm">
                            <input type="button" class="button1 hover-hand" value="立即推荐" onclick = "checkSelectInfo(<?php echo ($jobid); ?>);"/>
                        </div>
                    </form>
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
    <input type="hidden" value="<?php echo ($count); ?>" id="bt_count">
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
        /* 当鼠标移到表格上是，当前一行背景变色 */
        $(document).ready(function() {
            $(".data_list tr td").mouseover(function() {
                $(this).parent().find("td").css("background-color", "#eee");
            });
        })
        /* 当鼠标在表格上移动时，离开的那一行背景恢复 */
        $(document).ready(function() {
            $(".data_list tr td").mouseout(function() {
                var bgc = $(this).parent().attr("bg");
                $(this).parent().find("td").css("background-color", bgc);
            });
        })

        $(document).ready(function() {
            var color = "#fafafa"
            $(".data_list tr:odd td").css("background-color", color);  //改变偶数行背景色
            /* 把背景色保存到属性中 */
            $(".data_list tr:odd").attr("bg", color);
            $(".data_list tr:even").attr("bg", "#fff");
        })
        $(function() {
            var bt_count = $("#bt_count").val();
            if (bt_count == 0) {
                sys_window("暂无候选人，请增加简历后再推荐该职位！", "/Home/login/ModifyRencom/addtype/1.html");
                return false;
            }
        })

        function checkSelectInfo(jid) {
            var selectNum = 0;
            var username = '';
            $('input[name="id[]"]:checked').each(function() {
                username = $(this).attr("fname");
                selectNum = selectNum + 1;
            });
            var isSelectNum = 0
            $('.disabled').each(function() {
                isSelectNum = isSelectNum + 1;
            })
            if (selectNum == 0) {
                sys_window("请选择您要推荐的人");
                return false;
            }
            if (selectNum > 3) {
                sys_window("每次推荐的人员不能超过3个");
                return false;
            }
            if (isSelectNum == 10) {
                sys_window("每个企业发布的招聘，您只能推荐十个人哦");
                return false;
            }
            $.post("/Home/Login/checkSelectUser.html", {
                'jid': jid
            }, function(data) {
                if (data >= 10) {
                    sys_window("每个企业发布的招聘，您只能推荐十个人哦");
                } else {
                    $("#jllbname").html(username);
                    $("#mask").show();
                    $("#hxrmssj").show();
                }
            }, "json")


        }

        $(function() {
            $("#zaigoutongyixia").click(function() {
                $("#mask").hide();
                $("#hxrmssj").hide();
            });
            $("#querentuijian").click(function() {
                var audstarttime = $("#audstarttime").val();
                if (!audstarttime) {
                    sys_window("请输入候选人面试时间");
                    return false;
                } else {
                    $("input[name='audstarttime']").val(audstarttime);
                }
                $("#submitForm").submit();
            });
            //如果已经推荐给该职位
            $(".disabled").click(function() {
                this.checked = false;
                sys_window("该候选人已经推荐给该职位");

            })
            //如果选择推荐给过这家公司的候选人
            $(".isthiscompany").click(function() {
                this.checked = false;
                sys_window("同一个候选人只能推荐给该公司的一个职位");

            })
            //如果选择已经推荐给过3家公司的候选人
            $(".isthreecompany").click(function() {
                this.checked = false;
                sys_window("同一个候选人同时只能给3个企业");
            })
        })
    </script>
</body>

</html>