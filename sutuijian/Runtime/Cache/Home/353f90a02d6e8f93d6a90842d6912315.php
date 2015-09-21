<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="/Public/img/favicon.ico" type="image/ico">
        <title>人人猎-上传简历坐等收钱</title>
        <link rel="stylesheet" type="text/css" href="/Public/css/new-resizer.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/new-recommends.css">
        <script type="text/javascript" src="/Public/js/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="/Public/js/al-index.js"></script>
        <link rel="stylesheet" type="text/css" href="/Public/css/uploadify.css">
        <link rel="stylesheet" type="text/css" href="/Public/css/style.css">
        <script type="text/javascript" charset="utf-8" src="/Public/js/jquery.uploadify-3.1.js"></script>
        <style>
            .scjl_tc .jlsc_cg_no {
                width: 225px;
                margin:0 auto;
                margin-top:48px;
            }
            .scjl_tc .jlsc_cg_no h4 {
                margin:0 auto;
                font-size: 26px;
                text-align: center;
            }
            .scjl_tc .jlsc_cg_no p {
                margin:0 auto;
                font-size:18px;
                margin-top:28px;
            }
            .scjl_tc .jlsc_cg_no button {
                display: block;
                width: 150px;
                height: 40px;
                background: #2380b8;
                font-size: 14px;
                line-height: 40px;
                color: #ffffff;
                margin:0 auto;
                margin-top:46px;
                border-radius:5px;
                cursor:pointer;
            }
        </style>
    </head>

    <body style="background:#ffffff">

        <div class="mask" style="display:none;"></div>
        <div class="alt-srdz" style="display:none">
            <div class="alr-head">
                <img src="/Public/img/alt-head.png" alt="">
                <a href="javascript:void(0);" class="clos" id="close_x"></a>
            </div>
            <div class="con-text">
                <p>您成功上传了简历，请在设定的联系时间内，保持手机畅通，人人猎会根据您的简历匹配合适的工作，并与您联络。
                </p>
            </div>
            <div class="btn-z">
                <span class="my-btn2 m fl-lef" id="ok_btn">确定</span>
                <span class="my-btn2 fl-lef" id="close">取消</span>
            </div>
        </div>
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
            <div class="jlsc_cg_no" style="display:none">
                <h4>简历上传失败</h4>
                <p>&nbsp;</p>
                <button onclick='fail_ok();'>确定</button>
            </div>
        </div>
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
        <?php if(!empty($_SESSION['username']) || !empty($_SESSION['cusername'])){ $username = ($_SESSION['username']?$_SESSION['username']:$_SESSION['cusername']); $arUserinfo = M("userinfo")->where("username='$username'")->find(); $flag = $arUserinfo['flag']; if($flag==1){ $arHaedUserinfo = M("company")->where("username='$username'")->find(); if($arHaedUserinfo['comlogo']){ $logoTmp = substr($arHaedUserinfo['comlogo'],0,1); if($logoTmp != "/"){ $arHaedUserinfo['comlogo'] = "/".$arHaedUserinfo['comlogo']; } } }elseif($flag==0){ $arHaedUserinfo = M("member")->where("username='$username'")->find(); } if(strlen($username)=="31" && substr($username,0,3) == "wx_"){ $username = "微信用户"; } if(substr($username,0,3) == "qq_"){ $username = $_COOKIE[$username]; } ?>
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

     <div class="pc-zhuce" style="display: none" id='conZhuce'>
    <!--<a href="javascript:;" class="close"></a>-->
    <h3></h3>
    <dl>
        <dt>
        <ul class="pc-nav">
            <li class="nav1 mover3" id='tjrzc'>推荐人<input type="hidden" name="usertype" value="0"/></li>
            <li class="nav2" id='qyzc'>招聘企业</li>
        </ul>
        <ul class="list" id="list1">
            <li><input type="text" name="username" value="请输入用户名" default="请输入用户名"></li>
            <li><input type="text" name="mobile" value="请输入手机号" default="请输入手机号"></li>
            <li><input type="text" class="vfition" name="vfition" value="请输入验证码" default="请输入验证码">
                <label class="vfit_btn1" style="display: block" id="get_reg_code">获取验证码</label>
                <label class="vfit_btn2"  style="display: none"><i>60</i>秒后重新获取</label>
            </li>
            <li><input type="text" class="possword"  name="possword" value="请输入密码" default="请输入密码" ></li>
            <p id="zhuceerror" style="display: none"></p>
        </ul>
        <ul class="list" id="list2" style="display:none;">
            <li><input type="text" name="cpname" value="请输入公司名称" default="请输入公司名称"></li>
            <li><input type="text" name="address" value="请输入公司地址" default="请输入公司地址"></li>
            <li><input type="text" name="mobile" value="请输入手机号" default="请输入手机号"></li>
            <li><input type="text" class="vfition" name="vfition" value="请输入验证码" default="请输入验证码"><label class="vfit_btn1" style="display: block" id="get_reg_code">获取验证码</label><label class="vfit_btn2"  style="display: none"><i>60</i>秒后重新获取</label></li>
            <li><input type="text" name="username" value="请输入用户名" default="请输入用户名"></li>
            <li><input type="text" class="possword"  name="possword" value="请输入密码" default="请输入密码" ></li>
            <p id="zhuceerror" style="display: none"></p>
        </ul>
        <div class="yanzheng">
            <input class="radio1" type="radio" name="xieyi" id="xieyaya">
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
            <li><input class="DLUser" type="text" name="usernamees" value='<?php echo $_COOKIE[username];?>'/><span><?php if(!($_COOKIE[username] && $_COOKIE[password])){ echo "请输入用户名/手机号";}?></span></li>
            <li><input class="DLpassword" type="password" name="passwordes" value='<?php echo $_COOKIE[password];?>'/><span><?php if(!($_COOKIE[username] && $_COOKIE[password])){ echo "请输入密码";}?></span></li>
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
    <div class="wrap yjfk">
        <div class="yjfk-banner"><img src="/Public/img/rcmd-img/srdz-img.png" alt=""></div>
        <div class="content-t" style="padding-top:10px;">
            <h5><b>1</b> 上传简历</h5>
            <p class="jl-p clearfix"><span></span><em>即日起，凡在人人猎上传个人简历便可以参与——“上传简历，坐等收钱”活动；</em></p>

            <h5><b>2</b> 简历要求</h5>
            <p class="jl-p clearfix"><span></span><em>    在人人猎上传的个人简历要求同时满足 , 年薪10万以上的中高端互联网人才、正在看工作机会；
                </em></p>

            <h5><b>3</b> 系统匹配</h5>
            <p class="jl-p clearfix"><span></span><em>
                    人人猎系统自动检索与候选人匹配的工作机会 , 人人猎求职顾问与您沟通时先进行人工匹配合适职位 ;当有新发布的职位时，系统将为您自动匹配优质职位；</em></p>

            <h5><b>4</b> 面试入职</h5>
            <p class="jl-p clearfix"><span></span><em>
                    最多参加人人猎帮你安排的2-3次面试，即可offer,而且还可以拿到<b>几千、几万元</b>的推荐奖励。</em></p>

            <div class="text">还等什么，快快上传简历吧。</div>
            <img src="/Public/img/rcmd-img/hongb.png" alt="" class="hongb">
        </div>
        <div class="content-b">
            <div class="yjfk-header">
                <span class="fl-lef dis-block">上传简历</span>
                <div class="fl-rig clearfix">

                    <b class="dis-block fl-lef">温馨提示：</b>
                    <em class="clearfix dis-block fl-lef"><i></i><label class="fl-lef dis-block">人人猎会对您的个人信息进行保密，绝不会非法透露给第三方</label></em>
                </div>
            </div>
            <div class="yjfk-con clearfix" style="margin-bottom:10px;">
                <div class="fl-lef clearfix"><span class="fl-lef"><i>*</i>真实姓名：</span><input placeholder="输入真实姓名,系统会对个人信息保密" class="input1" type="text" id="name"></div>
                <div class="fl-rig clearfix"><span class="fl-lef"><i>*</i>手机号码：</span><input placeholder="请输入手机号码" class="input1" type="text" id="mobile"></div>
            </div>
            <div class="yjfk-con clearfix" style="margin-top:10px;">
                <div class="fl-lef clearfix"><span class="fl-lef"><i>*</i>求职意愿：</span><input placeholder="请输入详细职位、如:高级UI设计师" class="input1" type="text" id="want"></div>
                <div class="fl-rig clearfix">
                    <span class="fl-lef"><i>*</i>验证码：</span>
                    <input placeholder="请输入验证码" class="input1 wh140" type="text" id="verify" >
                    <label id="getcode">获取验证码</label>
                    <label style="display:none;background:#b4b4b4;">获取验证码</label>
                </div>
            </div>
            <div class="yjfk-con clearfix" style="margin-top:10px;">
                <div class="fl-lef clearfix" id="file1">
                    <span class="fl-lef"><i>*</i>上传简历：</span>
                    <input placeholder="" class="input1 wh140" type="text" disabled>
                    <label id="upload_resume">上传简历</label>
                </div>
                <div class="fl-lef clearfix" style="display:none" id="file2">
                    <span class="fl-lef"><i>*</i>上传简历：</span>
                    <span  type="text" id="resume_name" class="input1 wh140" style="display:inline-block;border:1px solid #dddddd;overflow:hidden;"> </span>
                    <label id="del_resume" onclick="del_resume();">删除</label>
                </div>
                <input type='hidden' value='1' id='updateNUm'>
                <input type='hidden' id='updateFile' name='updateFile' value=''>
                <input type='hidden'  id='updatePath' name='updatePath' value=''>
                <script type="text/javascript">
                    var img_id_upload = new Array(); //初始化数组，存储已经上传的图片名
                    var i = 0; //初始化数组下标
                    var uploadLimit = 1;
                    var buttonName = "上传简历";
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

                                var filedata = data.split("&&");
                                if (typeof filedata[1] == "undefined" || filedata[1] == "" || typeof filedata[0] == "undefined" || filedata[0] == "") {
                                    $(".Close4").hide();
                                    $(".secord").hide();
                                    $(".jlsc_cg_no ").show();
                                    return;
                                }
                                $(".Close4").hide();
                                $(".secord").hide();
                                $(".jlsc_cg ").show();
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

                <div class="fl-rig clearfix"><span class="fl-lef"><i>*</i>方便联系时间：</span><input placeholder="请输入方便联系的时间 如：星期五下午六点以后" class="input1" type="text" id="able_time"></div>
            </div>
            <div class="yjfk-con clearfix" style="margin-top:10px;">
                <div class="fl-lef clearfix"><span class="fl-lef"><i>*</i>其他说明</span><input placeholder="请输入其他更多的要求  如：想在海淀区西二旗附近的公司"  class="input1 wh808" type="text" id="other"></div>
            </div>
            <div class="clearfix ero" id="bankError" style="display: none;">
                <b class="fl-lef dis-block dis-inlin" style="margin-left:20px;">温馨提示:</b>
                <span class="fl-lef dis-block dis-inlin clearfix">
                    <i class="fl-lef dis-block dis-inlin"></i>
                    <span class="fl-lef dis-block dis-inlin" id="error"></span>
                </span>
            </div>
        </div>
        <span class="my-btn hover-hand" id="btn">确定</span>
        <span class="my-btn" style="display:none;">确定</span>
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

    <script type="text/javascript">

        //上传简历成功后，点击弹窗的确定按钮
        function jlcom() {
            $("#file1").hide(); //将可以上传简历的按钮隐藏
            $("#file2").show(); //将删除简历的按钮显示
            $(".Close4").show();
            var updateFile = $("#updateFile").val();//获取简历的文件名字
            var updatePath = $("#updatePath").val();//获取简历的文件路径
            var title = $("#name").val();  //获取上传简历的人的名字
            $(".scjl_tc").hide(); //隐藏弹框

            $(".mask").hide();
            $(".secord").show();//将弹框中上传简历的按钮显示，上传成功的提示隐藏
            $("#file_upload-queue").html("");

            //给删除简历按钮赋值
            if (title) {
                $("#resume_name").html('<a class="wk dis-block" style="width:100%;height:100%;"  href=\'' + updatePath + updateFile + '\'>' + title + "--" + updateFile + '</a>');
            } else {
                $("#resume_name").html('<a class="wk dis-block" style="width:100%;height:100%;"  href=\'' + updatePath + updateFile + '\'>' + updateFile + '</a>');
            }

        }

        //删除简历操作
        function del_resume() {

            $("#file1").show();
            $("#file2").hide();
            $(".Close4").hide();
            $(".jlsc_cg").hide();
            $("#updateFile").val("");
            $("#updatePath").val("");
            $("#updateNUm").val("1");

        }
        //
        function fail_ok(){
            $(".mask").hide();
            $(".scjl_tc").hide();
            $(".jlsc_cg_no").hide();
            $(".secord").show();
            $("#file_upload-queue").html("");
        }
        $(function () {
            //点击上传简历按钮，蓝色
            $("#upload_resume").click(function () {
                $(".mask").show();
                $(".scjl_tc").show();
            })
            //点击弹框的叉子关闭
            $('.scjl_tc .Close4').on('click', function () {
                $('.mask').hide();
                $('.scjl_tc').slideUp();
            })
        })

        $(document).ready(function () {

            var wait = 60;
            function time(o) {

                if (wait == 0) {
                    $("#getcode").show();
                    $("#getcode").next().hide();
                    wait = 60;
                } else {
                    o.innerHTML = "(" + wait + ")重新发送";
                    wait--;
                    setTimeout(function () {
                        time(o)
                    },
                            1000)
                }
            }
            $('#getcode').click(function () {

                //避免重复点击
                $(this).hide();
                $(this).next().show();

                var o = $(this).next()[0];
                var mobile = $("#mobile").val();
                if ($.trim(mobile) == "" || $.trim(mobile).length != 11) {
                    $("#mobile").focus();
                    $("#error").text("请正确填写手机号码");
                    $("#bankError").show();
                    $(this).show();
                    $(this).next().hide();
                    return;
                }
                $.post("/Home/Upresume/send_msg", {
                    mobile: mobile
                }, function (data) {
                    if (data.code != "200") {
                        $('#getcode').show();
                        $('#getcode').next().hide();
                        $("#error").text(data.msg);
                        $("#bankError").show();
                        return;
                    } else {
                        time(o);
                    }
                }, "json");

            })

            //点击完成定制按钮
            $('#btn').click(function () {

                //防止重复点击
                $(this).hide();
                $(this).next().show();

                var name = $.trim($("#name").val());
                var mobile = $.trim($("#mobile").val());
                var able_time = $("#able_time").val();
                var want = $("#want").val();
                var verify = $.trim($("#verify").val());
                var updateFile = $.trim($("#updateFile").val());
                var updatePath = $.trim($("#updatePath").val());
                var other = $.trim($("#other").val());

                if (name == "") {
                    $("#error").text("请填写姓名");
                    $("#bankError").show();
                    $(this).show();
                    $(this).next().hide();
                    return;
                }
                if (mobile == "") {
                    $("#error").text("请填写手机号码");
                    $("#bankError").show();
                    $(this).show();
                    $(this).next().hide();
                    return;
                }
                if (want == "") {
                    $("#error").text("请填写求职意愿");
                    $("#bankError").show();
                    $(this).show();
                    $(this).next().hide();
                    return;
                }
                if (verify == "") {
                    $("#error").text("请填写验证码");
                    $("#bankError").show();
                    $(this).show();
                    $(this).next().hide();
                    return;
                }

                if (updateFile == "") {
                    $("#error").text("请上传简历");
                    $("#bankError").show();
                    $(this).show();
                    $(this).next().hide();
                    return;
                }

                if (able_time == "") {
                    $("#error").text("请填写方便联系时间");
                    $("#bankError").show();
                    $(this).show();
                    $(this).next().hide();
                    return;
                }

                $.post("/Home/Upresume/info_save", {
                    name: name,
                    mobile: mobile,
                    verify: verify,
                    able_time: able_time,
                    updateFile: updateFile,
                    updatePath: updatePath,
                    other: other,
                    want: want

                }, function (data) {
                    if (data.code != "200") {
                        $('#btn').show();
                        $('#btn').next().hide();
                        $("#error").text(data.msg);
                        $("#bankError").show();
                        return;
                    } else {
                        $(".mask").show();
                        $(".alt-srdz").show();

                    }
                }, "json");


            })
            //点击取消
            $('#close,#ok_btn,#close_x').click(function () {

                $(".mask").hide();
                $(".alt-srdz").hide();
                location.href = "/";
            })


        })
    </script>
    <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
    <script type="text/javascript">
        var url = "http://www.renrenlie.com/Home/Upresume/index.html";
        var jiathis_config = {
            url: url,
            title: "人人猎-上传简历坐等收钱",
            summary: "人人猎--上传简历坐等收钱",
            pic: "http://www.renrenlie.com/Public/img/web_logo.png"
        }
    </script> 
    <script src="http://v2.jiathis.com/code/jiathis_r.js?move=0"></script> 
</body>
</html>