
$(function () {
    $(".mydm").attr("disabled", false);
    var element = "my-div1";
    $.fn.fullpage({
        slidesColor: ['#f0f0f0', '#f0f0f0', '#f0f0f0', '#f0f0f0', '#f0f0f0'],
        anchors: ['page1', 'page2', 'page3', 'page4', 'page5'],
        navigation: true,
        navigationPosition: 'right',
        scrollingSpeed: 500,
        easing: 'easeInQuart',
        //loopBottom:true,
        afterLoad: function (anchorLink, index) {
            if (index == 1) {
                $(".scrol-top").hide()
            } else {
                $(".scrol-top").show()
            }
            if (index == 2) {
                //$('#iphone3, #iphone2, #iphone4').addClass('active');
                $("#section1 .sec2").animate({'top': '41'}, 700);
                $("#section1 .sec2").css({'opacity': '1'});
            } else {
                $("#section1 .sec2").animate({'top': '-136'}, 100);
                $("#section1 .sec2").css({'opacity': '0'});
            }
            ;
            //$('#infoMenu').toggleClass('whiteLinks', index ==4);
            if (index == 3) {
                $("#section2 .jian2").animate({'top': '0'}, 700);
                $("#section2 .jian2").animate({'opacity': '1'}, 700);
                $("#section2 .sec3-text").animate({'opacity': '1'}, 700)
            } else {
                $("#section2 .jian2").animate({'top': '-170'}, 100)
                $("#section2 .jian2").animate({'opacity': '0'}, 1);
                $("#section2 .sec3-text").css({'opacity': '0'});
            }
            ;

            if (index == 4) {
                $("#section3 .sec3-text2").animate({'top': '-543'})
                $("#section3 .sec3-text2").animate({'opacity': '1'})
                $(".sec4-right .jingzhun").animate({'top': '0', 'left': '1'}, 700);
                $(".sec4-right .dichenbeng").animate({'top': '1', 'left': '343'}, 700);
                $(".sec4-right .kuaisu").animate({'top': '197', 'left': '1'}, 700);
                $(".sec4-right .zhijie").animate({'top': '293', 'left': '172'}, 700);
                $(".sec4-right .youxiao").animate({'top': '196', 'left': '343'}, 700);
            } else {
                $(".sec4-right .jingzhun").animate({'top': '97', 'left': '127'}, 700);
                $(".sec4-right .dichenbeng").animate({'top': '97', 'left': '127'}, 700);
                $(".sec4-right .kuaisu").animate({'top': '97', 'left': '127'}, 700);
                $(".sec4-right .zhijie").animate({'top': '97', 'left': '127'}, 700);
                $(".sec4-right .youxiao").animate({'top': '97', 'left': '127'}, 700);
                $("#section3 .sec3-text2").css({'opacity': '0'});
            }
            ;

            if (index == 5) {
                $("#section4 .cgal-img").animate({'opacity': '1'}, 700);
            } else {
                $("#section4 .cgal-img").animate({'opacity': '0'}, 1);
            }

        },
        menu: '#menu'
    });
    $("#section3 .sec4-left .qiye").bind("mouseenter", function () {
        $("#section3 .con .sec4-right").show();
        $("#section3 .con .sec4-right2").hide();
        // alert(23)
    })

    $("#section3 .sec4-left .tuijianren").bind("mouseenter", function () {
        $("#section3 .con .sec4-right").hide();
        $("#section3 .con .sec4-right2").show();
        // alert(28)
    })

    $("#rwm-btn").bind("mouseenter", function () {
        $("#index-ewm").show();
    });
    $("#rwm-btn").bind("mouseleave", function () {
        $("#index-ewm").hide();
    });

    $(".sec-btm .rcmd-btn").bind("mouseenter", function () {
        $("#section1 .tjr").slideDown();
        $("#section1 .text-pic").slideUp();
        $("#section1 .qiye").slideUp();
    });

    /*$(".sec-btm .rcmd-btn").on("click",function(){
     var sec1Height = $("#section0").height();
     $("#superContainer").animate({"top" : -sec1Height},700);
     $("#section1 .sec2").animate({'top':'41'},700);
     $("#section1 .sec2").css({'opacity':'1'});
     });*/
    $(".sec-btm .ent-btn").bind("mouseenter", function () {
        $("#section1 .tjr").slideUp();
        $("#section1 .text-pic").slideUp();
        $("#section1 .qiye").slideDown();
        //alert(23)
    });

    $("#section1 .rrl-logo").bind("mouseenter", function () {
        $("#section1 .tjr").slideUp();
        $("#section1 .text-pic").slideDown();
        $("#section1 .qiye").slideUp();
        //alert(23)
    });
    $("#section0 nav li").bind("mouseenter", function () {
        $(this).find("a").addClass('m');
        $(this).siblings().find('a').removeClass('m');
    })
    $(".regtd .recom .nv #rec-btn").click(function () {
        element = "my-div1";
        $(".regtd .recom #my-div1").show();
        $(".regtd .recom #my-div2").hide();
        $(this).removeClass("m").siblings().addClass("m");
        $(".mar-top2").hide();
        $(".mar-top1").show();
        $("#xieyi").attr("href", "/Home/Index/tjrxy.html");
    })
    $(".regtd .recom .nv #company").click(function () {
        element = "my-div2";
        $(".regtd .recom #my-div1").hide();
        $(".regtd .recom #my-div2").show();
        $(this).removeClass("m").siblings().addClass("m");
        $(".mar-top1").hide();
        $(".mar-top2").show();
        $("#xieyi").attr("href", "/Home/Index/zpfxy.html");
    })
    $(".dlu").click(function () {
        $(".regtd2").show();
        $(".regtd1").hide();
    })
    $(".zce").click(function () {
        $(".regtd1").show();
        $(".regtd2").hide();
    });

    $(".regtd .recom li input").focus(function () {
        $(this).css({"color": "#000"})
    })
    $(".regtd div.im p.p1 #d").click(function () {
        $(".regtd2").show();
        $(".regtd1").hide();
    })

    $(".regtd div.im p.p1 #dd").click(function () {
        $(".regtd2").hide();
        $(".regtd1").show();
    })
    //搜索相关
    $(".btn-search").click(function () {
        
        var searchKeyword = $("#search-keyword").val();
        if (searchKeyword) {
            location.href = "/Home/Index/search/position/" + searchKeyword+".html";
        } else {
            location.href = "/Home/Index/search.html";
        }
    });
    $(".recom input").focus(function () {
        var defoultVlue = $(this).attr("default");
        if ($(this).val() == defoultVlue) {
            $(this).val("");
        }
    });
    $(".recom input").blur(function () {
        var defoultVlue = $(this).attr("default");
        if ($(this).val() == "") {
            $(this).val(defoultVlue);
            $(this).css("color", "#bcbcbc");
        }
    });
    $('.DLpassword').focus(function (event) {
        $(this).nextAll().hide();
    });


    $("#regbtn").click(function () {
        var username = $("#" + element + " input[name='username']").val();
        var mobile = $("#" + element + " input[name='mobile']").val();
        var vfition = $("#" + element + " input[name='vfition']").val();
        var password = $("#" + element + " input[name='possword']").val();
        var dd = document.getElementById("radio-recom").checked;
        if ($("#company").hasClass("m")) {
            var usertype = 0;
        } else {
            var usertype = 1;
        }

        //   var usertype = $("#" + element + " input[name='usertype']").val();

        if (!username || username === "请输入用户名") {
            $("#" + element + " input[name='username']").focus();
            $("#" + element + " .ero").html("请输入用户名称！");
            $("#" + element + " .ero").show();
            return false;
        }
        if (/^[\@A-Za-z\!\#\$\%\^\&\*\.\~]{2,}[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{2,16}$/.test(username)) {
            $("#" + element + " .ero").hide();
        } else {
            $("#" + element + " input[name='username']").focus();
            $("#" + element + " .ero").html("请输入4-16位的英文字母，数字，下划线");
            $("#" + element + " .ero").show();
            return false;
        }
        var reg = /^1[3|4|5|8][0-9]\d{4,8}$/;
        if (mobile == "请输入手机号") {
            $("#" + element + " input[name='mobile']").focus();
            $("#" + element + " .ero").html("请输入手机号码");
            $("#" + element + " .ero").show();
            return false;
        }
        /*
        if (!reg.test($.trim(mobile)))
        {
            $("#" + element + " input[name='mobile']").focus();
            $("#" + element + " .ero").html("请正确输入手机号码");
            $("#" + element + " .ero").show();
            return false;
        }
        */
        if (!vfition || vfition == "请输入验证码") {
            $("#" + element + " input[name='vfition']").focus();
            $("#" + element + " .ero").html("请输入验证码");
            $("#" + element + " .ero").show();
            return false;
        }
        if (!password || password == "请输入密码") {
            $("#" + element + " input[name='possword']").focus();
            $("#" + element + " .ero").html("密码不能为空");
            $("#" + element + " .ero").show();
            return false;
        }

        if (password.length == 0)
        {
            $("#" + element + " input[name='possword']").focus();
            $("#" + element + " .ero").html("密码不能为空");
            $("#" + element + " .ero").show();
            //focus_input("regpassword");
            return false;
        }
        else if (password.length < 6 || password.length > 16)
        {

            $("#" + element + " input[name='possword']").focus();
            $("#" + element + " .ero").html("密码应为6-16个字符之间");
            $("#" + element + " .ero").show();
            return false;
        }
        else
        {
            var preg = /[`,，。;；'"‘’“” \u4e00-\u9fa5　]+/;
            if (preg.test(password))
            {

                $("#" + element + " input[name='possword']").focus();
                $("#" + element + " .ero").html("密码不能含有特殊字符");
                $("#" + element + " .ero").show();

                return false;
            }


        }
        if (dd == false) {
            $("#" + element + " .ero").html("请接受人人猎《用户协议和隐私条款》！");
            $("#" + element + " .ero").show();
            return false;
        }
        $(".mydm").attr("disabled", "disabled");
        $.post("/Home/Index/addUser", {
            'username': username,
            'mobile': mobile,
            'code': vfition,
            'password': password,
            'usertype': usertype
        }, function (data) {

            if (data.code != "200") {
                $(".mydm").attr("disabled", false);
                $("#" + element + " .ero").html(data.msg);
                $("#" + element + " .ero").show();
            } else {
                location.href = data.msg;
            }
        }, "json");
    });




});
var wait = 60;
function time(o) {
    if (wait == 0) {

        o[0].disabled = false;
        o.html("获取验证码");
        wait = 60;
    } else {
        o[0].disabled = true;
        o.html(wait + "s后重新获取");
        wait--;
        setTimeout(function () {
            time(o)
        },
                1000)
    }

}
//手机获取验证码
function getcode(element) {
    //time($("#" + element + " .vft-btn"));return;
    var usertype = $("#" + element + " input[name='usertype']").val();
    var mobile = $("#" + element + " input[name='mobile']").val();
    var reg = /^1[3|4|5|8][0-9]\d{4,8}$/;
    if (mobile == "请输入手机号") {
        $("#" + element + " input[name='mobile']").focus();
        $("#" + element + " .ero").html("请输入手机号码");
        $("#" + element + " .ero").show();
        return false;
    }
    /*
    if (!reg.test(mobile))
    {
        $("#" + element + " input[name='mobile']").focus();
        $("#" + element + " .ero").html("请正确输入手机号码");
        $("#" + element + " .ero").show();
        return false;
    }
    */
    $("#" + element + " .vft-btn").attr("disabled", "disabled");
    $.post("/Home/Index/getRegCode", {
        'mobile': mobile,
        'usertype': usertype
    }, function (data) {
        if (data.code != 200) {

            $("#" + element + " .vft-btn").attr("disabled", false);
            $("#" + element + " .ero").html(data.msg);
            $("#" + element + " .ero").show();
            return false;
        } else {
            time($("#" + element + " .vft-btn"));
            $("#" + element + " .ero").hide();

        }
    }, "json");
}
function passwordBlur(element) {

    var inputval = $("#" + element + " .DLpassword").val(); //这是value值

    if (inputval == '') {

        $("#" + element + " .ero").html("密码不能为空");
        $("#" + element + " .DLpassword").nextAll().show();

    }

}

function changePassword(element) {

    $("#" + element + " .pwd").hide();
    $("#" + element + " input[name='possword']").show();
    $("#" + element + " input[name='possword']").focus();
}
function blurPassword(element) {

    if ($("#" + element + " input[name='possword']").val() == "") {
        $("#" + element + " input[name='possword']").hide();
        $("#" + element + " .pwd").show();
    }
}
function loginbtn(element) {
    var username = $("#" + element + " input[name='usernamees']").val();
    var password = $("#" + element + " input[name='possword']").val();
    var remembeme = document.getElementById("remembeme").checked;
//    alert($("#my-div3 input[name='possword']").val());
//    alert("#" + element + " input[name='possword']");
//    alert(username);
//    alert(password);
//    alert(remembeme);
    if (!username || username == "请输入用户名/手机号") {
        $("#" + element + " .ero").html('用户名不能为空')
        $("#" + element + " .ero").show();
        return false;
    } else if (!password) {
        $("#" + element + " .ero").html('密码不能为空')
        $("#" + element + " .ero").show();
        return false;
    }
    var currentAction = $("#currentAction").val();

    if (currentAction) {

        var enterIndexComId = $("#enterIndexComId").val();
        var enterIndexJobId = $("#enterIndexJobId").val();
    } else {
        currentAction = "";
        enterIndexComId = 0;
        enterIndexJobId = 0;
    }
    
    var url = "/Home/Index/userlogin"; //定义一个登陆地址，分别为用户名登陆地址和手机号登陆地址
    if (/^((13[0-9])|147|(15[0-35-9])|180|182|(18[5-9]))[0-9]{8}$/.test(username)) {
        url = "/Home/Index/mobilelogin";
    }

    $.post(url, {
        'username': username,
        'password': password,
        'currentAction': currentAction,
        'enterIndexComId': enterIndexComId,
        'enterIndexJobId': enterIndexJobId,
        'remembeme': remembeme
    }, function (data) {
       
        if (data.code == 200) {
            location.href = data.msg;
            return false;
        } else if (data.code == 201) {
            $("#helloname").html(username + "您好！");
            $("#updatename").html("hr" + username);
            $("#hrefUrl").val(data.msg);
            $(".mask1").show();
            $(".cfid").show();
        } else {

            $("#" + element + " .ero").html(data.msg)
            $("#" + element + " .ero").show();
            return false;
        }
    }, "json")
}
