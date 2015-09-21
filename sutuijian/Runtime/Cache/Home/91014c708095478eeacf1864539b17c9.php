<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="/Public/img/favicon.ico" type="image/ico">
        <title>成功案例-人人猎</title>
        <meta name="keywords" content="人人猎,人人猎网，人人猎头,renrenlie.com,www.renrenlie.com,人人猎首页,人人猎官网，人人都是猎头" />
        <meta name="description" content="人人猎（www.renrenlie.com)是企业低成本极速直招平台，让企业一周内搞定招聘需求，为推荐人提供“人力资源”变现通道。" />

        <link rel="stylesheet" type="text/css" href="/Public/css/boss.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/new-resizer.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/new-recommends.css">
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/al-index.js"></script>
        <script type="text/javascript" src="/Public/js/window.js"></script>
    </head>
    <body>
        <div class="mask1" style="display: none;"></div>
        <div class="mask"></div>
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
        <div class="successful-case clearfix">
            <div class="banner clearfix"><img src="/Public/img/rcmd-img/success-case.png" alt=""></div>
            <div class="list">
                <ul class="clearfix">
                    <li>
                        <img src="/Public/img/rcmd-img/mll-logo.png" alt="">
                        <h3>美丽来</h3>
                        <h6>(天使轮)</h6>
                        <p>专注于中高端女性上门服务的美容o2o，在人人猎成功招到高级Android、php等人才。</p>
                    </li>
                    <li>
                        <img src="/Public/img/rcmd-img/ysy-logo.png" alt="">
                        <h3>云视野</h3>
                        <h6>(天使轮)</h6>
                        <p>知名投资人投资的中国独家掌握云验光技术，为顾客上门专业验光配镜的眼镜O2O。在人人猎成功招到 php等人才。</p>
                    </li>
                    <li>
                        <img src="/Public/img/rcmd-img/yj-logo.png" alt="">
                        <h3>易结网</h3>
                        <h6>(A轮)</h6>
                        <p>IDG投资的婚嫁O2O平台领航者，为结婚新人打造最佳婚礼服务平台。通过人人猎成功招到移动开发工程师等人才。</p>
                    </li>
                    <li>
                        <img src="/Public/img/rcmd-img/kmf-logo.png" alt="">
                        <h3>盈禾优仕</h3>
                        <h6>(A轮)</h6>
                        <p>专注于出国考试相关的网络备考工具与服务，通过人人猎成功招到高级 Android、php等人才。</p>
                    </li>
                </ul>
                <ul class="clearfix" style="padding-top:0;">
                    <li>
                        <img src="/Public/img/rcmd-img/exc-logo.png" alt="">
                        <h3>E洗车</h3>
                        <h6>(A轮)</h6>
                        <p>致力于为广大车主提供24小时预约上门洗车，搭建移动互联网“e洗车”全国平台。在人人猎成功招到前端开发、Android等人才。</p>
                    </li>
                    <li>
                        <img src="/Public/img/rcmd-img/hqw-logo.png" alt="">
                        <h3>好巧网</h3>
                        <h6>(A轮)</h6>
                        <p>好巧网是国内最好用的国际酒店搜索网站之一，专注服务于自助出境的游客。在人人猎成功招到php工程师等人才。</p>
                    </li>
                    <li>
                        <img src="/Public/img/rcmd-img/jsjy-logo.png" alt="">
                        <h3>金色家园</h3>
                        <h6>(天使轮)</h6>
                        <p>由江苏省同科投资集团投资总注册资金1亿元人民币。通过人人猎成功招到O2O总经理等人才。</p>
                    </li>
                    <li>
                        <img src="/Public/img/rcmd-img/hyd-logo.png" alt="">
                        <h3>好运到</h3>
                        <h6>(天使轮)</h6>
                        <p>好运到是一家专注于大数据移动医疗的初创公司。在人人猎成功招到合伙人、Android等人才。</p>
                    </li>
                </ul>
                <ul class="clearfix" style="padding-top:0;">
                    <li>
                        <img src="/Public/img/rcmd-img/xy-logo.png" alt="">
                        <h3>新游</h3>
                        <h6>(A轮)</h6>
                        <p>新游是一家至力于全球游戏分发领域的创新公司。产品：游戏下载平台。创始人：丁春妹 ，前 百度高管。通过人人猎平台成功招到了java 、Android、ui、php等人才。</p>
                    </li>
                    <li>
                        <img src="/Public/img/rcmd-img/md-logo.png" alt="">
                        <h3>摩德</h3>
                        <h6>(天使轮)</h6>
                        <p>我们不仅仅是一支IT服务团队，同时也是数字化营销团队。我们汇集了经验丰富的电商服务精英、满怀激情的软件精英、设计精英，与客户共同应对艰巨的市场挑战。通过人人猎平台成功招到了php、Android等人才。</p>
                    </li>
                    <li>
                        <img src="/Public/img/rcmd-img/sdj-logo.png" alt="">
                        <h3>少东家</h3>
                        <h6>(天使轮)</h6>
                        <p>少东家是专注于电子商务平台的一家初创公司，创始团队的核心成员来自BAT，公司发展迅猛，马上进入A轮融资。通过人人猎平台成功招到了PHP等职位。</p>
                    </li>
                    <li>
                        <img src="/Public/img/rcmd-img/xhh-logo.png" alt="">
                        <h3>先花花</h3>
                        <h6>(B轮)</h6>
                        <p>“先花一亿元”是先花信息技术（北京）有限公司继先花花App后，推出的一款面向年轻人的社交金融服务平台，是一款代表互联网金融未来发展趋势的创新产品。通过人人猎平台成功招到了ios等职位。</p>
                    </li>
                </ul>

                <ul class="clearfix" style="padding-top:0;">
                    <li>
                        <img src="/Public/img/rcmd-img/fxxk-logo.png" alt="">
                        <h3>分享销客</h3>
                        <h6>(D轮)</h6>
                        <p>2014年7月完成由北极光领头的B轮融资，同年11月完成由DCM领投5千万美金的C轮，2015年6月完成D轮融资（以一年之内完成B、C、D三轮融资的速度震惊了互联网市场），目前团队已达到1000人规模。通过人人猎平台成功招到iOS人才。</p>
                    </li>
                    <li>
                        <img src="/Public/img/rcmd-img/zm-logo.png" alt="">
                        <h3>慈铭</h3>
                        <h6>(自有资金)</h6>
                        <p>慈铭健康体检管理集团股份有限公司是一家按照“早诊断、早发现、早治疗”暨“预防为主”的医学思想创建的以健康体检为主营业务的连锁化经营的专业体检机构。通过人人猎平台成功招到高级java工程师。</p>
                    </li>
                    <li>
                        <img src="/Public/img/rcmd-img/51sb-logo.png" alt="">
                        <h3>51社保</h3>
                        <h6>(A轮)</h6>
                        <p>51社保网隶属北京众合天下管理咨询有限公司旗下，是中国最大的社保专业网站，中国领先的社保实务品牌，中国互联网社保服务领跑者。在人人猎平台成功招到PHP人才。</p>
                    </li>
                    <li>
                        <img src="/Public/img/rcmd-img/zhb-logo.png" alt="">
                        <h3>智汇邦</h3>
                        <h6>(自有资金)</h6>
                        <p>智汇邦是权威的海内外高层次人才数据库和高端人才在线社交平台，旨在为高层次人才在华创新创业搭建桥梁，为其职业和事业发展提供快速便捷的服务。在人人猎平台成功招到产品总监。</p>
                    </li>
                </ul>

                <ul class="clearfix" style="padding-top:0;">
                    <li>
                        <img src="/Public/img/rcmd-img/sf-logo.png" alt="">
                        <h3>顺丰</h3>
                        <h6>(不需要融资)</h6>
                        <p>顺丰始终专注于服务质量的提升，不断满足市场的需求，在中国大陆、香港、澳门、台湾建立了庞大的信息采集、市场开发、物流配送、快件收派等业务机构及服务网络。</p>
                    </li>
                    <li>
                        <img src="/Public/img/rcmd-img/sk-logo.png" alt="">
                        <h3>寺库</h3>
                        <h6>(D轮以上)</h6>
                        <p>寺库（SECOO）致力打造全球奢侈品交流平台的多元化集团，总部设于北京。主要业务涉及奢侈品网上销售、奢侈品实体体验会所、奢侈品鉴定、养护服务等主营业务。寺库通过人人猎平台成功招到高级前端工程师。</p>
                    </li>
                    <li>
                        <img src="/Public/img/rcmd-img/zphd-logo.png" alt="">
                        <h3>泽普互动</h3>
                        <h6>(C轮)</h6>
                        <p>Zepp (泽普互动（北京）科技有限公司)由前微软和Intel的资深工程师于2011年成立,核心业务是基于传感器融合技术，Acoustic等传感器融合领域。通过人人猎平台成功招到IOS工程师。
</p>
                    </li>
                    <li>
                        <img src="/Public/img/rcmd-img/talk-logo.png" alt="">
                        <h3>51Talk</h3>
                        <h6>(C轮)</h6>
                        <p>51Talk的创始人CEO黄佳佳先生来自于清华大学外语系， 首创“外教一对一，在线学英语”的互联网学习模式。通过人人猎平台成功招到IOS工程师。通过人人猎平台成功招到公关总监。</p>
                    </li>
                </ul>
            </div>
            <!-- <div class="list list2">
                <ul class="clearfix ">
                    <li><img src="/Public/img/rcmd-img/pic1.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic2.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic3.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic4.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic5.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic6.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic7.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic8.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic9.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic10.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic11.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic12.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic13.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic14.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic15.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic16.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic17.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic18.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic19.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic20.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic21.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic22.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic23.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic24.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic25.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic26.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic27.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic28.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic29.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic30.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic31.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic32.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic33.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic34.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic35.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic36.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic37.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic38.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic39.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic40.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic41.png" alt=""></li>
                    <li><img src="/Public/img/rcmd-img/pic42.png" alt=""></li>
                </ul>
            </div> -->
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

</body>
</html>