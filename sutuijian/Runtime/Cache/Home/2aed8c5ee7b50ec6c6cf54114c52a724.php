<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>人人猎</title>
        <meta name="keywords" content="人人猎,人人猎网，人人猎头,renrenlie.com,www.renrenlie.com,人人猎首页,人人猎官网，人人都是猎头" />
        <meta name="description" content="人人猎（www.renrenlie.com)是企业低成本极速直招平台，让企业一周内搞定招聘需求，为推荐人提供“人力资源”变现通道。" />
        <link rel="stylesheet"  href="/Public/css/webchatnew/reset.css">  
        <link rel="stylesheet"  href="/Public/css/webchatnew/from_wap.css">  
        <script type="text/javascript" src="/Public/js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/Public/js/iscroll.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <meta content="yes" name="apple-mobile-web-app-capable" />
        <meta content="black" name="apple-mobile-web-app-status-bar-style" />
        <meta content="telephone=no" name="format-detection" />
        <style>
            .mask1{
                position: fixed;
                z-index: 3;
                display: block;
                width: 100%;
                height: 100%;
                background: #000;
                opacity: .7;
                filter: alpha(opacity=70);
            }  
        </style>
    </head>
    <body>
    <style>
.mask{
	position: fixed;
	z-index: 3;
	display: block;
	width: 100%;
	height: 100%;
	background: #000;
	opacity: .7;
	filter: alpha(opacity=70);
}    
.tanchu{
	width: 300px;
	height: 120px;
	padding:10px 0;
	background: #ffffff;
	box-shadow: 1px 1px 10px #2c2b2b;
	position: fixed;
	left: 50%;
	top: 50%;
	margin-left:-150px;
	margin-top: -90px;
	z-index: 4;
	border-radius: 15px;
}
.tanchu dl{
	margin:0 auto;
	width: 260px;
	margin-top: 10px;
}

.tanchu dl dd{
	text-align: center;
	color: #2380b8;
	line-height: 30px;
	font-size: 16px;
	font-weight: bold;
}
.tanchu dl dd button{
	width: 110px;
	height: 30px;
	background: #2380b8;
	border-radius: 5px;
	border:none;
	color: #ffffff;
	margin-top:10px;
}    
</style>
<div style="display:none;" id="like_alert_kuang">
<div class="mask"></div>
<div class="tanchu">
    <dl>
        <dd id="alert_title"></dd>
        <dd id="alert_ok"><button>确定</button></dd>
    </dl>
</div>
</div>

<script type="text/javascript">
    
    //调用这个方法的前提是，引入了jquery
    function  like_alert(title){
        
        $("#alert_title").html(title);
        $("#like_alert_kuang").css("display","block");
        $("#alert_ok").click(function(){
            $("#like_alert_kuang").css("display","none");
        })
    }
    
    function  re_like_alert(title){
        
        $("#alert_title").html(title);
        $("#like_alert_kuang").css("display","block");
        $("#alert_ok").click(function(){
            $("#like_alert_kuang").css("display","none");
            location.reload();
        })
       
    }
    
    function  lo_like_alert(title,url){
        
        $("#alert_title").html(title);
        $("#like_alert_kuang").css("display","block");
        $("#alert_ok").click(function(){
            $("#like_alert_kuang").css("display","none");
            location.href=url;
        })
       
    }
    
    
</script>     
    <div class="mask1" style='display:none'></div>
    <div class="wx">温馨提示：请在PC端上传附件简历 <i></i></div>
    <div class="set_wrapper" id="re_wrapper" style="padding-top:20px;">
        <div id="scroller">
            <div id="pullDown" style="display:none">
                <span class="pullDownIcon"></span><span class="pullDownLabel">下拉刷新...</span>
            </div>
            <div class="con_modify thelist jl" id="thelist" style="background:#efefef;">
                <ul style="padding-top:10px;background:#ffffff">
                    <h3>基本设置</h3>
                    <form action="/Home/Webchatnew/text" method="post" id="form">
                        <li class="clearfix"><span>姓&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp名：</span><em><?php echo ($data["username"]); ?></em><input type="text" name='username' value="<?php echo ($data["username"]); ?>"></li>
                        <li class="clearfix"><span>性&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp别：</span>

                        <?php if($data["sex"] == 1 ): ?><span style="width:20px;" class="sp">男</span><label class="nan m" id='nan'></label>
                            <span style="width:20px;" class="sp">女</span><label class="nan" id='nv'></label>
                            <input type='hidden' value='1' name='sex' id="sex">
                            <?php else: ?>
                            <span class="sp">男</span><label class="nan" id='nan'></label>
                            <span class="sp">女</span><label class="nan m" id='nv'></label>
                            <input type='hidden' value='0' name='sex' id="sex"><?php endif; ?>
                        </li>
                        <li class="clearfix">
                            <span>在职状态：</span>
                            <!--<em></em>-->
                            <select  name="state"  id="statesel" <!--style="display:none;"-->>
                                     <?php foreach($stateArr as $k => $v){ ?>
                                <?php if($v["datavalue"] == $data["state"] ): ?><option value="<?php echo ($v["datavalue"]); ?>" selected='selected'><?php echo ($v["dataname"]); ?></option>
                                    <?php else: ?>
                                    <option value="<?php echo ($v["datavalue"]); ?>"><?php echo ($v["dataname"]); ?></option><?php endif; ?>
                                <?php } ?>
                            </select>
                        </li>
                        <li class="clearfix"><span>联系电话：</span><em><?php echo ($data["mobile"]); ?></em><input type="text" name='mobile' value='<?php echo ($data["mobile"]); ?>'></li>
                        <li class="clearfix"><span>期望职位：</span><em><?php if($data["keyword"] == ''): ?><label style='color:#909090;'>请填写关键词，如php、java、前端等</label><?php else: echo ($data["keyword"]); endif; ?></em><input type="text" name='keyword' value="<?php echo ($data["keyword"]); ?>"></li>

                </ul>	
                <ul style="margin-top:10px;background:#ffffff">
                    <li id="edu"><span>教育经历：</span><?php echo ($data["edu"]); ?><input type="hidden" name='edu' value='<?php echo ($data["edu"]); ?>'></li>
                    <li id="exper"><span>工作经验：</span><?php echo ($data["exper"]); ?><input type="hidden"  name="exper" value='<?php echo ($data["exper"]); ?>'></li>
                    <li id="because"><span>推荐理由：</span><?php echo ($data["because"]); ?><input type="hidden"  name="because" value='<?php echo ($data["because"]); ?>'></li>


                    <input type="hidden" value="" name="type"/>
                    <input type="hidden" value="" name="desc"/>
                </ul>	
                </form>
                <ul>
                    <li style="padding:0;padding-bottom:10px;border:none;"><button class="modify" id='savebtn'>保存</button></li>
                </ul>
            </div>
            <div id="pullUp" style="display:none;">
                <span class="pullUpIcon"></span><span class="pullUpLabel">上拉加载更多...</span>
            </div>

        </div>
    </div>
    <!--上传成功提示有几个职位与之匹配提示框-->

    <div style="display:none;" id="tip_kuang">
        <div class="tanchu">
            <dl>
                <dd id="success_title">简历上传成功，现有<b style="color:red;" id="jobcount">&nbsp;8&nbsp;</b>个职位跟该候选人匹配</dd>
                <dd>
                    <a href="/Home/Webchatnew/job_list"><button id="go" style="font-size: 14px;width: 100px;">去看看</button></a>
                    <a href="/Home/Webchatnew/upresume_info">
                        <button id="no" style="margin-right:15px;width: 100px;background: #ffffff;color: #2380b8;font-size: 14px;border: none;outline: medium;border-radius: 5px;float: right;border: 2px #2380b8 solid;">返回</button>
                    </a>
                </dd>
            </dl>
        </div>
    </div>

    <script>
        $("#nan").click(function () {

            if (this.className == "nan m") {

                $("#sex").val("0");
                $("#nv")[0].className = "nan m";
                this.className = "nan";
            }
        })
        $("#nv").click(function () {

            if (this.className == "nan m") {

                $("#sex").val("1");
                $("#nan")[0].className = "nan m";
                this.className = "nan";

            }
        })

        $("#savebtn").click(function () {

            $("#savebtn")[0].disabled = true;
            var username = $('[name="username"]').val();
            var sex = $('[name="sex"]').val();
            var state = $('[name="state"]').val();
            var mobile = $('[name="mobile"]').val();
            var keyword = $('[name="keyword"]').val();
            var edu = $('[name="edu"]').val();
            var exper = $('[name="exper"]').val();
            var because = $('[name="because"]').val();

            if (username == "" || mobile == "" || edu == "" || exper == "" || because == "" || keyword == "") {
                like_alert("请完善简历信息");
                $("#savebtn")[0].disabled = false;
                return;
            }

            var has = false;
            var reg = /^1[0-9]{10}$/;
            if (!reg.test(mobile)) {
                like_alert("请输入正确的手机号码");
                $("#savebtn")[0].disabled = false;
                return;
            } else {
                $.ajax({
                    url: "/Home/Webchatnew/judge_resume_mobile",
                    async: false,
                    data: {'mobile': mobile},
                    type: "POST",
                    dataType: "json",
                    success: function (data) {

                        if ($.trim(data.code) != 200) {

                            like_alert("该候选人系统中已经存在");
                            $("#savebtn")[0].disabled = false;
                            has = true;
                        }
                    }
                })
                if (has) {
                    return ;
                }
            }


            $.post("/Home/Webchatnew/add_resume_save", {
                'username': username,
                'sex': sex,
                'state': state,
                'mobile': mobile,
                'keyword': keyword,
                'edu': edu,
                'exper': exper,
                'because': because,
            }, function (data) {

                if (data.code == "200") {
                    $('[name="username"]').val("");
                    $('[name="sex"]').val("");
                    $('[name="state"]').val("");
                    $('[name="mobile"]').val("");
                    $('[name="keyword"]').val("");
                    $('[name="edu"]').val("");
                    $('[name="exper"]').val("");
                    $('[name="because"]').val("");
                    //re_like_alert(data.msg);

                    lo_like_alert("简历添加成功", "/Home/Webchatnew/job_list");
                } else {
                    like_alert(data.msg);
                    $("#savebtn")[0].disabled = false;
                    return;
                }
            }, "json");
        })

        $('.jl ul li em').on('click', function () {
            $(this).hide();
            $(this).nextAll().show();
        })

        $("#edu").click(function () {

            to_text("edu", "教育经历");
        })
        $("#exper").click(function () {

            to_text("exper", "工作经验");
        })
        $("#zige").click(function () {

            to_text("zige", "资格证书");
        })
        $("#because").click(function () {

            to_text("because", "推荐理由");
        })


        function  to_text(type, desc) {

            $("[name='type']").val(type);
            $("[name='desc']").val(desc);
            $("#form")[0].submit();

        }


        $(".wx i").click(function () {
            $(this).parent().hide();
            $("#re_wrapper").css({"padding-top": "0px"})
        })

        $("input").click(function () {
            if (document.activeElement.tagName == 'INPUT') {
                $(".wx").css({'position': 'absolute', 'top': '0'});
            } else if (document.activeElement.tagName !== 'INPUT') {
                $(".wx").css('position', 'fixed');
            }
        })
    </script>
</body>
</html>