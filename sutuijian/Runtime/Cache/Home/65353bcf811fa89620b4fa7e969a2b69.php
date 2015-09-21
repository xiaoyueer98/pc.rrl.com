<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="/Public/img/favicon.ico" type="image/ico">
        <title>公司详情-人人猎</title>
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
        <div class="post-datel clearfix">
            <div class="public-t">
                <div class="t-head">
                    <div class="con">
                        <div class="l dis-inlin dis-block fl-lef" style="width:100%;">
                            <?php if($companyInfo['comlogo']):?>
                            <dt class="myfile">
                            <span class="dis-block dis-inlin fl-lef logo"> <img src="<?php echo $companyInfo['comlogo'];?>"></span>
                            </dt>
                            <?php endif;?>

                            <h2 class="myh2 fl-lef dis-inlin"><?php echo $companyInfo['cpname'];?></h2>
                        </div>
                    </div>
                </div>
                <div class="contant clearfix">
                    <div class="l dis-inlin fl-lef">
                        <ul>
                            <?php if($companyInfo['address']):?>
                            <li class="clearfix"><em class="dis-block dis-inlin fl-lef">地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址：</em><span class="dis-block dis-inlin fl-lef"><?php echo $companyInfo['address'];?></span></li>
                            <?php endif;?>
                            <?php if($companyInfo['nature']):?>
                            <li class="clearfix"><em class="dis-block dis-inlin fl-lef">公司性质：</em><span class="dis-block dis-inlin fl-lef"><?php echo $companyInfo['nature'];?></span></li>
                            <?php endif;?>
                            <?php if($companyInfo['stage']):?>
                            <li class="clearfix"><em class="dis-block dis-inlin fl-lef">公司阶段：</em><span class="dis-block dis-inlin fl-lef"><?php echo $companyInfo['stage'];?></span></li>
                            <?php endif;?>
                            <?php if($companyInfo['scale']):?>
                            <li class="clearfix"><em class="dis-block dis-inlin fl-lef">公司规模：</em><span class="dis-block dis-inlin fl-lef"><?php echo $companyInfo['scale'];?></span></li>
                            <?php endif;?>
                            <?php if($companyInfo['webname']):?>
                            <li class="clearfix"><em class="dis-block dis-inlin fl-lef">公司网址：</em><span class="dis-block dis-inlin fl-lef"><?php echo $companyInfo['webname'];?></span></li>
                            <?php endif;?>

                        </ul>
                    </div>
                    <?php if($companyInfo['address']):?>
                    <div class="r r2 fl-rig">
                        <script type="text/javascript" src="http://api.map.baidu.com/api?v=1.3&ak=7nqCp5QGXqGaxpBkOIvb16po"></script>
                        <input id="text_" type="hidden" value="<?php echo $companyInfo['address'];?>" style="margin-right:100px;"/>
                        <input id="result_" type="hidden" />
                        <div id="container" 
                             style="position: absolute;
                             width:400px; 
                             height: 300px; 
                             border: 1px solid gray;
                             overflow:hidden;">
                        </div>
                        <script type="text/javascript">
                            var map = new BMap.Map("container");
                            map.centerAndZoom("北京", 12);
                            map.enableScrollWheelZoom();    //启用滚轮放大缩小，默认禁用
                            map.enableContinuousZoom();    //启用地图惯性拖拽，默认禁用

                            map.addControl(new BMap.NavigationControl());  //添加默认缩放平移控件
                            map.addControl(new BMap.OverviewMapControl()); //添加默认缩略地图控件
                            map.addControl(new BMap.OverviewMapControl({isOpen: true, anchor: BMAP_ANCHOR_BOTTOM_RIGHT}));   //右下角，打开

                            var localSearch = new BMap.LocalSearch(map);
                            localSearch.enableAutoViewport(); //允许自动调节窗体大小

                            searchByStationName();
                            function searchByStationName() {
                                map.clearOverlays();//清空原来的标注
                                var keyword = document.getElementById("text_").value;
                                localSearch.setSearchCompleteCallback(function(searchResult) {
                                    var poi = searchResult.getPoi(0);
                                    document.getElementById("result_").value = poi.point.lng + "," + poi.point.lat;
                                    map.centerAndZoom(poi.point, 13);
                                    var marker = new BMap.Marker(new BMap.Point(poi.point.lng, poi.point.lat));  // 创建标注，为要查询的地方对应的经纬度
                                    map.addOverlay(marker);
                                    var content = document.getElementById("text_").value + "<br/><br/>经度：" + poi.point.lng + "<br/>纬度：" + poi.point.lat;
                                    var infoWindow = new BMap.InfoWindow("<p style='font-size:14px;'>" + content + "</p>");
                                    marker.addEventListener("click", function() {
                                        this.openInfoWindow(infoWindow);
                                    });
                                    // marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
                                });
                                localSearch.search(keyword);
                            }
                        </script>
                    </div>
                    <?php endif;?>

                </div>
            </div>
            <div class="public-c clearfix">
                <ul class="nav clearfix">
                    <li class="hover-hand fl-lef dis-inlin  m"><a class="m" href="javascript:;">公司简介</a></li>
                </ul>
            </div>
            <div class="public-f" style="">
                <div class="cont">
                    <?php if($companyInfo['intro']):?>
                    <h3>公司介绍</h3>
                    <ul>
                        <li>
                            <?php echo $companyInfo['intro'];?>
                        </li>
                    </ul>
                    <?php endif;?>
                    <?php if($companyInfo['bright']):?>
                    <h3>公司亮点</h3>
                    <ul>
                        <li>
                            <?php echo $companyInfo['bright'];?>
                        </li>
                    </ul>
                    <?php endif;?>
                    <?php if($companyInfo['remark']):?>
                    <h3>补充说明</h3>
                    <ul>
                        <li>
                            <?php echo $companyInfo['remark'];?>
                        </li>
                    </ul>
                    <?php endif;?>


                    <div class="job-list">
                        <h3 style="margin-top:33px;border-bottom:1px #9F9F9F dashed;padding-bottom:5px;width:870px;">公司热招职位</h3>
                        <?php foreach($arJobList as $jobInfo):?>
                        <div class="clearfix list">

                            <ul class="r fl-rig">
                                <li class="clearfix li1">
                                    <a href="/Home/Index/EnterIndex2/comid/<?php echo $companyInfo['id'];?>/jobid/<?php echo $jobInfo['guid']?>.html" target="_blank"><em class="dis-inlin dis-block fl-lef"><?php echo $jobInfo['title']?></em></a>
                                    <span class="adrs dis-inlin dis-block fl-lef">[<?php echo $jobInfo['jobplace']?>]</span>
                                    <a href="/Home/Index/EnterIndex2/comid/<?php echo $companyInfo['id'];?>/jobid/<?php echo $jobInfo['guid']?>.html"><h6 class="dis-inlin dis-block fl-rig"><?php echo $comInfo['cpname'];?></h6></a>
                                </li>
                                <li class="clearfix li2">
                                    <span class="dis-inlin dis-block fl-lef">月薪：</span>
                                    <span class="dis-inlin dis-block fl-lef"><?php echo $jobInfo['treatment'];?></span>
                                    <span class="dis-inlin dis-block fl-lef"><?php echo $jobInfo['experience'];?></span>
                                    <span class="dis-inlin dis-block fl-lef"><?php echo $jobInfo['education'];?></span>
                                </li>
                                <li class="clearfix li3">
                                    <em class="c3-l   dis-inlin dis-block fl-lef">候选人成功入职，你即得奖励  <i>￥<?php echo $jobInfo['Tariff'];?></i></em>
                                    <span class="c-r dis-inlin dis-block fl-rig">[<?php echo $jobInfo['starttime'];?>]</span>
                                </li>
                            </ul>
                        </div>
                        <?php endforeach;?>
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

    <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>	
</body>
</html>