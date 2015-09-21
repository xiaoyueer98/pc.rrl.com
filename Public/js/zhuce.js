$(function () {

    $(".pc-zhuce .close").click(function () {
        $(".mask").hide();
        $(".pc-zhuce").hide();
    });
    $(".possword").focus(function () {
        if ($(this).attr("default") == $(this).val()) {
            $(this).attr("type", "password");
        }
    });
    $(".possword").blur(function () {
        if (!$(this).val()) {
            $(this).attr("type", "text");
        }

    });
    $("#register").attr("disabled", false);
    $(".nav2").click(function () {
        $(".Grey").show();
        $(".Sign").hide();
        $(".nav1").removeClass("mover3");
        $(this).addClass("mover3");
        $("input[name='usertype']").val(1);

        $("#conZhuce").css("height", "506px");
        $(".pc-zhuce dl .list").css("height", "255px");
        $(".pc-zhuce dl .yanzheng").css("top", "410px");
        $(".pc-zhuce dl button").css("top", "440px");
//            $("#cpnameInput").css("display","block");
        $("#list2").show();
        $("#list1").hide();


    });
    $(".nav1").click(function () {
        $(".Grey").hide();
        $(".Sign").show();
        $(".nav2").removeClass("mover3");
        $(this).addClass("mover3");
        $("input[name='usertype']").val(0);

        $(".pc-zhuce").css("height", "436px");
        $(".pc-zhuce dl .list").css("height", "175px");
        $(".pc-zhuce dl .yanzheng").css("top", "340px");
        $(".pc-zhuce dl button").css("top", "370px");
//            $("#cpnameInput").css("display","none");
        $("#list1").show();
        $("#list2").hide();
    });
    $(".pc-zhuce .list input").focus(function () {
        $(this).css("color", "black");
        if ($(this).val() == $(this).attr("default")) {
            $(this).val("");
        }
    });
    $(".pc-zhuce .list input").blur(function () {
        if (!$(this).val()) {
            $(this).css("color", "");
            $(this).val($(this).attr("default"));
        }
    });

//        //公司名称
//        $("input[name='cpname']").blur(function() {
//            
//            if ($(this).val()!="") {
//                $("#zhuceerror").hide();
//            } else{
//                $(this).focus();
//                $("#zhuceerror").html("请输入公司名称");
//                $("#zhuceerror").show();
//            }
//            if (!$(this).val()) {
//                $(this).css("color", "");
//                $(this).val($(this).attr("default"));
//                //  $(this).next().show();
//                //  $(this).next().text("请输入用户名"); 
//            }
//        });
//        //公司用户名
//        $("input[name='username']").blur(function() {
//            
//            if (/^[\@A-Za-z\!\#\$\%\^\&\*\.\~]{2,}[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{2,16}$/.test($(this).val())) {
//                $("#zhuceerror").hide();
//            } else if($("input[name='usertype']").val()=="0"){
//                $(this).focus();
//                $("#zhuceerror").html("请输入4-16位的英文字母，数字，下划线");
//                $("#zhuceerror").show();
//            }
//            if (!$(this).val()) {
//                $(this).css("color", "");
//                $(this).val($(this).attr("default"));
//                //  $(this).next().show();
//                //  $(this).next().text("请输入用户名"); 
//            }
//        });
        
    //推荐人手机获取验证码
    $("#list1 #get_reg_code").click(function () {
        var hash = $("#hash").val();
        var mobile = $("#list1 input[name='mobile']").val();
        if (mobile == "请输入手机号" || mobile.length!=11) {
            $("#list1 input[name='mobile']").focus();
            $("#list1 #zhuceerror").html("请输入正确的手机号码");
            $("#list1 #zhuceerror").show();
            return false;
        }

        $("#list1 .vfit_btn1").attr("disabled", "disabled");
        $.post("/Home/Index/getRegCode", {
            'mobile': mobile,
            'usertype': 0,
            'hash':hash
        }, function (data) {
            if (data.code != 200) {
                $("#list1 .vfit_btn1").attr("disabled", "");
                $("#list1 #zhuceerror").html(data.msg);
                $("#list1 #zhuceerror").show();
                return false;
            } else {
                time($("#list1 .vfit_btn1"));
                $("#list1 #zhuceerror").hide();
                $("#list1 .vfit_btn1").hide();
                $("#list1 .vfit_btn2").show();
            }
        }, "json")
    });
    
    //企业手机获取验证码
    $("#list2 #get_reg_code").click(function () {
        var hash = $("#hash").val();
        var mobile = $("#list2 input[name='mobile']").val();
        if (mobile == "请输入手机号" || mobile.length!=11) {
            $("#list2 input[name='mobile']").focus();
            $("#list2 #zhuceerror").html("请输入正确的手机号码");
            $("#list2 #zhuceerror").show();
            return false;
        }

        $("#list2 .vfit_btn1").attr("disabled", "disabled");
        $.post("/Home/Index/getRegCode", {
            'mobile': mobile,
            'usertype': 1,
            'hash':hash
        }, function (data) {
            if (data.code != 200) {
                $("#list2 .vfit_btn1").attr("disabled", "");
                $("#list2 #zhuceerror").html(data.msg);
                $("#list2 #zhuceerror").show();
                return false;
            } else {
                time($("#list2 .vfit_btn1"));
                $("#list2 #zhuceerror").hide();
                $("#list2 .vfit_btn1").hide();
                $("#list2 .vfit_btn2").show();
            }
        }, "json")
    });
    $("#zhuce").click(function () {
        $(".Grey").hide();
        $(".Sign").show();
        $(".nav2").removeClass("mover3");
        $(".nav1").addClass("mover3");
        $("input[name='usertype']").val(0);
        $(".mask").show();
        $(".pc-zhuce").show();
    });
    
    //确认按钮
    $("#register").click(function () {

        var usertype = $("input[name='usertype']").val();
        if (usertype == 0) {
            var username = $("#list1 input[name='username']").val();
            var mobile = $("#list1 input[name='mobile']").val();
            var vfition = $("#list1 input[name='vfition']").val();
            var password = $("#list1 input[name='possword']").val();
        } else {
            var username = $("#list2 input[name='username']").val();
            var mobile = $("#list2 input[name='mobile']").val();
            var vfition = $("#list2 input[name='vfition']").val();
            var password = $("#list2 input[name='possword']").val();
            var cpname = $("input[name='cpname']").val();
            var address = $("input[name='address']").val();
        }
        var dd = document.getElementById("xieyaya").checked;

        if (usertype == 1) {
            if (!cpname || cpname === "请输入公司名称") {

                $("#list2 #zhuceerror").html("请输入公司名称！");
                $("#list2 #zhuceerror").show();
                $("#list2 input[name='cpname']").focus();
                return false;
            }
            if (!address || address === "请输入公司地址") {

                $("#list2 #zhuceerror").html("请输入公司地址！");
                $("#list2 #zhuceerror").show();
                $("#list2 input[name='cpname']").focus();
                return false;
            }
            if (mobile == "请输入手机号") {
                $("#list2 input[name='mobile']").focus();
                $("#list2 #zhuceerror").html("请输入手机号码");
                $("#list2 #zhuceerror").show();
                return false;
            }
            if (!vfition || vfition == "请输入验证码") {
                $("#list2 input[name='vfition']").focus();
                $("#list2 #zhuceerror").html("请输入验证码");
                $("#list2 #zhuceerror").show();
                return false;
            }
            if (!username || username === "请输入用户名") {
                $("#list2 input[name='username']").focus();
                $("#list2 #zhuceerror").html("请输入用户名称！");
                $("#list2 #zhuceerror").show();
                return false;
            }
            
            if (/^[a-zA-Z0-9]{1}[a-zA-Z0-9_]{3,16}$/.test(username)) {
                $("#list2 #zhuceerror").hide();
            } else {
                $("#list2 input[name='username']").focus();
                $("#list2 #zhuceerror").html("用户名请输入4-16位的英文字母，数字，下划线");
                $("#list2 #zhuceerror").show();
                return false;
            }
            if (!password || password == "请输入密码") {
                $("#list2 input[name='possword']").focus();
                $("#list2 #zhuceerror").html("密码不能为空");
                $("#list2 #zhuceerror").show();
                return false;
            }
            else if (password.length < 6 || password.length > 16)
            {

                $("#list2 input[name='possword']").focus();
                $("#list2 #zhuceerror").html("密码应为6-16个字符之间");
                $("#list2 #zhuceerror").show();
                return false;
            }
            else
            {
                var preg = /[`,，。;；'"‘’“” \u4e00-\u9fa5　]+/;
                if (preg.test(password))
                {
                    $("#list2 input[name='possword']").focus();
                    $("#list2 #zhuceerror").html("密码不能含有特殊字符");
                    $("#list2 #zhuceerror").show();

                    return false;
                }
                else
                {
                    //验证密码复杂度
                    var preg1 = /^[0-9]{6,}$/;
                    var preg2 = /^[a-zA-Z]{6,}$/;
                    if (preg1.test(password) || preg2.test(password))
                    {
                        $("#list2 input[name='possword']").focus();
                        $("#list2 #zhuceerror").html("密码不能是纯字母或纯数字");
                        $("#list2 #zhuceerror").show();

                        //focus_input("regpassword");
                        return false;
                    }
                    else
                    {
                        $("#list2 #zhuceerror").hide();
                    }
                }

            }
            if (dd == false) {
                $("#list2 #zhuceerror").html("请接受人人猎《用户协议和隐私条款》！");
                $("#list2 #zhuceerror").show();
                return false;
            }
        }else  {
           
           if (!username || username === "请输入用户名") {
                $("#list1 input[name='username']").focus();
                $("#list1 #zhuceerror").html("请输入用户名称！");
                $("#list1 #zhuceerror").show();
                return false;
            }
            if (/^[a-zA-Z0-9]{1}[a-zA-Z0-9_]{3,16}$/.test(username)) {
                $("#list1 #zhuceerror").hide();
            } else {
                $("#list1 input[name='username']").focus();
                $("#list1 #zhuceerror").html("用户名请输入4-16位的英文字母，数字，下划线");
                $("#list1 #zhuceerror").show();
                return false;
            }
            if (mobile == "请输入手机号") {
                $("#list1 input[name='mobile']").focus();
                $("#list1 #zhuceerror").html("请输入手机号码");
                $("#list1 #zhuceerror").show();
                return false;
            }
            if (!vfition || vfition == "请输入验证码") {
                $("#list1 input[name='vfition']").focus();
                $("#list1 #zhuceerror").html("请输入验证码");
                $("#list1 #zhuceerror").show();
                return false;
            }
            
            if (!password || password == "请输入密码") {
                $("#list1 input[name='possword']").focus();
                $("#list1 #zhuceerror").html("密码不能为空");
                $("#list1 #zhuceerror").show();
                return false;
            }
            else if (password.length < 6 || password.length > 16)
            {

                $("#list1 input[name='possword']").focus();
                $("#list1 #zhuceerror").html("密码应为6-16个字符之间");
                $("#list1 #zhuceerror").show();
                return false;
            }
            else
            {
                var preg = /[`,，。;；'"‘’“” \u4e00-\u9fa5　]+/;
                if (preg.test(password))
                {
                    $("#list1 input[name='possword']").focus();
                    $("#list1 #zhuceerror").html("密码不能含有特殊字符");
                    $("#list1 #zhuceerror").show();

                    return false;
                }
                else
                {
                    //验证密码复杂度
                    var preg1 = /^[0-9]{6,}$/;
                    var preg2 = /^[a-zA-Z]{6,}$/;
                    if (preg1.test(password) || preg2.test(password))
                    {
                        $("#list1 input[name='possword']").focus();
                        $("#list1 #zhuceerror").html("密码不能是纯字母或纯数字");
                        $("#list1 #zhuceerror").show();

                        //focus_input("regpassword");
                        return false;
                    }
                    else
                    {
                        $("#list1 #zhuceerror").hide();
                    }
                }

            }
            if (dd == false) {
                $("#list1 #zhuceerror").html("请接受人人猎《用户协议和隐私条款》！");
                $("#list1 #zhuceerror").show();
                return false;
            }
        }

        /*
         if (!reg.test($.trim(mobile)))
         {
         $("input[name='mobile']").focus();
         $("#zhuceerror").html("请正确输入手机号码");
         $("#zhuceerror").show();
         return false;
         }
         */

        $("#register").attr("disabled", "disabled");
        $.post("/Home/Index/addUser", {
            'cpname': cpname,
            'address': address,
            'username': username,
            'mobile': mobile,
            'code': vfition,
            'password': password,
            'usertype': usertype
        }, function (data) {

            if (data.code != "200") {
                $("#register").attr("disabled", false);
                if (usertype == 0) {
                    $("#list1 #zhuceerror").html(data.msg);
                    $("#list1 #zhuceerror").show();
                } else {
                    $("#list2 #zhuceerror").html(data.msg);
                    $("#list2 #zhuceerror").show();
                }
            } else {
                location.href = data.msg;
            }
        }, "json")
    });
})

//计时按钮
var wait = 60;
function time(o) {
    if (wait == 0) {

        o.attr("disabled", "disabled");
        $(".vfit_btn1").show();
        $(".vfit_btn2").hide();
        wait = 60;
    } else {
        o.attr("disabled", "");
        $(".vfit_btn2 i").html(wait);
        wait--;
        setTimeout(function () {
            time(o)
        },
                1000)
    }

}

function ZC_KeyDown(e)
{
    var a=e||window.event;
    if (a.keyCode == 13)
    {
        $("#register").click();
    }
}