$(function() {
    //搜索相关
    $(".btn-search").click(function() {
        var searchKeyword = $("#searchbox").val();
        if (searchKeyword) {
            location.href = "/Home/Login/JobSearch/position/" + searchKeyword + ".html";
        } else {
            location.href = "/Home/Login/JobSearch.html";
        }
    });
    //基本信息点击修改
    $("#baseInfoUpdate").click(function() {
        $("#baseInfo").hide();
        $("#baseInfoInput").show();
    });
    //基本信息点击保存操作
    $("#baseInfoConfirm").click(function() {
        var cnname = $("input[name='cnname']").val();
        var mobile = $("input[name='mobile']").val();
        var email = $("input[name='email']").val();
        var age = $("input[name='age']").val();
        if (!cnname) {
            $("input[name='cnname']").focus();
            $('#baseError span span').html('请输入您的真实姓名');
            $('#baseError').show();
            return false;
        }
        if (!mobile) {
            $("input[name='mobile']").focus();
            $('#baseError span span').html('请填写手机号码');
            $('#baseError').show();
            return false;
        }
        if (!email) {
            $("input[name='email']").focus();
            $('#baseError span span').html('请填写邮箱');
            $('#baseError').show();
            return false;
        }
        if (!age || parseInt(age) == 0) {
            $("input[name='age']").focus();
            $('#baseError span span').html('请填写年龄');
            $('#baseError').show();
            return false;
        }
        $("input[name='sex']").val($(".sex-label .m").attr("flag"));
        $.ajax({
            type: "post",
            dataType: "json",
            data: {},
            url: "/Home/Login/checkMobileType.html",
            success: function(data) {
                if (data.code == "200") {
                    $("input[name='mobile']").focus();
                    $('#baseError span span').html('请填写手机并验证');
                    $('#baseError').show();
                } else {
                    $("#submitBaseInfo").submit();
                }
            }
        });
        return false;
    });
    $(".Close").click(function() {
        $(".openWind").hide();
        $(".mask").hide();
    });
    $("#changeMobile").click(function() {
        $("#baseError").hide();
      
        var mobile = $("input[name='mobile']").val();
        var reg = /^1[3|4|5|8][0-9]\d{4,8}$/;
        if (!mobile) {
            $("input[name='mobile']").focus();
            $('#baseError span span').html("请输入手机号码");
            $("#baseError").show();
            return false;
        }
          /*
        if (!reg.test(mobile))
        {
            $("input[name='mobile']").focus();
            $("#baseError").html("手机号格式错误");
            $("#baseError").show();
            return false;
        }
        */
        $.ajax({
            type: "post",
            dataType: "json",
            data: {},
            url: "/Home/Login/checkMobileType.html",
            success: function(data) {
                if (data.code == "500") {
                    sys_window(data.msg);
                } else {
                    //之前有过手机号
                    if (data.code == "201") {
                        $("#change_telehone_step1").show();
                        $(".mask").show();
                        $("#changeMobileTmp").html(data.mobile);
                    } else {
                        $("#regtelephone").show();
                        $(".mask").show();
                        $("#telephoneCheck").html("您的手机号码是：" + mobile);
                    }
                }
            }
        });
    })

    $("#getcheckCode").click(function() {
        var mobile = $("input[name='mobile']").val();
        $("#getcheckCode").attr("disabled", "disabled");
        var hash = $("#hash").val();
        $.post("/Home/Login/checktelephonecode.html", {"mobile": mobile,'hash':hash}, function(data) {
            if (data.code != "500") {
                time($("#getcheckCode"), $("#codetimes"));
            } else {
                $(".error3").html(data.msg);
                $(".error3").show();
            }
        }, "json")
    })
    $("#checkbtn").click(function() {
        var code = $("#code").val();
        var mobile = $("input[name='mobile']").val();
        if (!code) {
            $(".error3").html("请输入校验码！");
            $(".error3").show();
            return false;
        }
        if (code.length != 6) {
            $(".error3").html("验证码错误，请重新输入！");
            $(".error3").show();
            return false;
        }
        $.post("/Home/Login/changeTelephoneCheckStep3.html", {
            'code': code,
            'mobile': mobile
        }, function(data) {
            if (data.code != "500") {
                $("#regtelephone").hide();
                $(".mask").hide();
                $("input[name='mobile']").val(mobile);
            } else {

                $(".error3").html(data.msg);
                $(".error3").show();
            }
        }, "json")

    });
    $("#getcheckCode").attr("disabled", false);
    $("#change_telehone_code_step2").attr("disabled", false);
    $("#change_telehone_code_step1").attr("disabled", false);
    $("#change_telehone_ccode_step1").val("");
    $("#change_telehone_ccode_step2").val("");
    $("#change_telehone_telephone_step2").val("");
    $("#change_telehone_step3 .end").click(function() {
        $("#mobile").val($("#change_telehone_telephone_step2").val());
        $("#change_telehone_step3").hide();
        $(".mask").hide();

    })
    //第一步获取验证码
    $("#change_telehone_code_step1").click(function() {
        $("#change_telehone_code_step1").attr("disabled", "disabled");
        var hash = $("#hash").val();
        $.post("/Home/Login/changeTelephoneStep1.html", {'hash':hash}, function(data) {
            if (data.code != "500") {
                time($("#change_telehone_code_step1"), $("#change_telehone_time_step1"));

            } else {
                $("#change_telehone_code_step1").attr("disabled", false);
                $("#change_telehone_step1 #change_error p").html(data.msg);
                $("#change_telehone_step1 #change_error").show();
            }
        }, "json")
    });
    //第二步获取验证码
    $("#change_telehone_code_step2").click(function() {
        var telephone = $("#change_telehone_telephone_step2").val();
        var retelephone = $("#mobile").val();
        var reg = /^1[3|4|5|8][0-9]\d{4,8}$/;
        if (retelephone == telephone) {
            $("#change_telehone_step2 #change_error2 p").html("新旧号码一致");
            $("#change_telehone_step2 #change_error2").show();
            $("#change_telehone_telephone_step2").focus();
            return false;
        }
        if (!telephone) {
            $("#change_telehone_step2 #change_error2 p").html("请输入手机号码");
            $("#change_telehone_step2 #change_error2").show();
            $("#change_telehone_telephone_step2").focus();
            return false;
        }
        /*
        if (!reg.test(telephone))
        {
            $("#change_telehone_step2 #change_error2 p").html("请正确输入手机号码");
            $("#change_telehone_step2 #change_error2").show();
            $("#change_telehone_telephone_step2").focus();
            return false;
        }
        */
        var hash = $("#hash").val();
        $.post("/Home/Login/changeTelephoneStep2.html", {'telephone': telephone,'hash':hash}, function(data) {
            if (data.code != "500") {
                time($("#change_telehone_code_step2"), $("#change_telehone_time_step2"));

            } else {
                $("#change_telehone_code_step2").attr("disabled", false);
                $("#change_telehone_step2 #change_error2 p").html(data.msg);
                $("#change_telehone_step2 #change_error2").show();
            }
        }, "json")
    });
    //第一步提交验证验证码
    $("#change_telehone_btn_step1").click(function() {
        var change_telehone_ccode_step1 = $("#change_telehone_ccode_step1").val();
        if (change_telehone_ccode_step1.length != 6) {
            $("#change_telehone_step1 #change_error p").html("验证码不正确，请重新输入");
            $("#change_telehone_ccode_step1").focus();
            $("#change_telehone_step1 #change_error").show();
        } else {
            $.post("/Home/Login/changeTelephoneCheckStep1.html", {
                'change_telehone_ccode_step1': change_telehone_ccode_step1
            }, function(data) {
                if (data.code != "500") {
                    $("#change_telehone_step2").show();
                    $("#change_telehone_step1").hide();
                } else {
                    $("#change_telehone_code_step1").attr("disabled", false);
                    $("#change_telehone_step1 #change_error p").html(data.msg);
                    $("#change_telehone_step1 #change_error").show();
                }
            }, "json")
        }
    });
    //第二步提交验证验证码
    $("#change_telehone_btn_step2").click(function() {
        var change_telehone_ccode_step2 = $("#change_telehone_ccode_step2").val();
        var change_telehone_telephone_step2 = $("#change_telehone_telephone_step2").val();
        if (change_telehone_ccode_step2.length != 6) {
            $("#change_telehone_step2 #change_error2 p").html("验证码不正确，请重新输入");
            $("#change_telehone_ccode_step2").focus();
            $("#change_telehone_step2 #change_error").show();
        } else {
            $.post("/Home/Login/changeTelephoneCheckStep2.html", {
                'change_telehone_ccode_step2': change_telehone_ccode_step2,
                'change_telehone_telephone_step2': change_telehone_telephone_step2
            }, function(data) {
                if (data.code != "500") {
                    $("input[name='mobile']").val(change_telehone_telephone_step2);
                    $("#change_telehone_step3").show();
                    $("#change_telehone_step2").hide();
                } else {
                    $("#change_telehone_code_step2").attr("disabled", false);
                    $("#change_telehone_step2 #change_error2 p").html(data.msg);
                    $("#change_telehone_step2 #change_error2").show();
                }
            }, "json")
        }
    });

    //收款账号
    $("#bankInfoUpdate").click(function() {
        $("#bankInfoInput").show();
        $("#bankInfo").hide();
    });
    
})

var wait = 60;
function time(o, t) {
    if (wait == 0) {

        o.attr("disabled", false);
        t.hide();
        o.show();
        wait = 60;
    } else {
        t.find("i").html(wait);
        o.hide();
        t.show();
        wait--;
        setTimeout(function() {
            time(o, t)
        },
                1000)
    }
}
//图片上传预览    IE是用了滤镜。   
function previewImage(file)
{
    var MAXWIDTH = "100%";
    var MAXHEIGHT = "100%";
    var div = document.getElementById('preview');
    if (file.files && file.files[0])
    {
        div.innerHTML = '<img id=imghead>';
        var img = document.getElementById('imghead');
        img.onload = function() {
            var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
            img.width = rect.width;
            img.height = rect.height;
            //                 img.style.marginLeft = rect.left+'px';   
            img.style.marginTop = rect.top + 'px';
        }
        var reader = new FileReader();
        reader.onload = function(evt) {
            img.src = evt.target.result;
        }

        reader.readAsDataURL(file.files[0]);
    }
    else //兼容IE   
    {
        var sFilter = 'filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="';
        file.select();
        var src = document.selection.createRange().text;
        div.innerHTML = '<img id=imghead>';
        var img = document.getElementById('imghead');
        img.filters.item('DXImageTransform.Microsoft.AlphaImageLoader').src = src;
        var rect = clacImgZoomParam(MAXWIDTH, MAXHEIGHT, img.offsetWidth, img.offsetHeight);
        status = ('rect:' + rect.top + ',' + rect.left + ',' + rect.width + ',' + rect.height);
        div.innerHTML = "<div id=divhead style='width:" + rect.width + "px;height:" + rect.height + "px;margin-top:" + rect.top + "px;" + sFilter + src + "\"'></div>";
    }
    $("#preview").show();
}

function clacImgZoomParam(maxWidth, maxHeight, width, height) {
    var param = {top: 0, left: 0, width: width, height: height};
    if (width > maxWidth || height > maxHeight)
    {
        rateWidth = width / maxWidth;
        rateHeight = height / maxHeight;

        if (rateWidth > rateHeight)
        {
            param.width = maxWidth;
            param.height = Math.round(height / rateWidth);
        } else
        {
            param.width = Math.round(width / rateHeight);
            param.height = maxHeight;
        }
    }

    param.left = Math.round((maxWidth - param.width) / 2);
    param.top = Math.round((maxHeight - param.height) / 2);
    return param;
}
$(function() {

    $('.xuanze,.zw_xuanze,.dq_xuanze').click(function() {
        $('div.libao').hide();
      //  $(this).next('div').show();

    })
    $(".xuanze").click(function(){
        $("#xuanze_window").show();
    });
    $(".zw_xuanze").click(function(){
        $("#zw_xuanze_window").show();
    });
    $(".dq_xuanze").click(function(){
        $("#dq_xuanze_window").show();
    });
//点击行业，显示子类		
    $('.tuanchu1,.tuanchu2,.tuanchu3').children('dl').children('dt').next().css('display', 'none');
    $('.tuanchu1 dl dt,.tuanchu2 dl dt,.tuanchu3 dl dt').click(function() {
        if ($(this).next('dd').css('display') == 'none') {
            $(this).next('dd').show();
            $(this).parent('dl').css('z-index', '55').siblings('dl').css('z-index', '22');
            $(this).parent('dl').siblings().children('dd').hide();
        } else {
            $(this).next('dd').hide();
        }
    })

    $('.libaob dl dt').click(function() {
        $(this).parent().siblings('dl').children('dd').children('div').children('input').attr('checked', false);
    })

    $('.tuanchu1 .xiaoshi,.tuanchu2 .xiaoshi,.tuanchu3 .xiaoshi').click(function() {
        $(this).parent().parent('dd').hide();
    })

    $('.tuanchu1 .qued').click(function() {
        var $val = $('.tuanchu1 dd input:checked').map(function() {
            return this.value;
        }).get().join('+');
        $('.xuanze_val').val($val);

        var $title = $('.tuanchu1 dd input:checked').map(function() {
            return $(this).next('span').text();
        }).get().join('+');
        $('.xuanze').val($title);
    })

    $('.tuanchu2 .qued').click(function() {
        var $val = $('.tuanchu2 dd input:checked').map(function() {
            return this.value;
        }).get().join('+');
        $('.zw_xuanze_val').val($val);

        var $title = $('.tuanchu2 dd input:checked').map(function() {
            return $(this).next('span').text();
        }).get().join('+');
        $('.zw_xuanze').val($title);
    })

    $('.qued,.qux').click(function() {
        $(this).parent().parent('div').hide();
    })

    //地区选择
///****************2014.9.25改**************************///
    $('.tuanchu1 dd input,.tuanchu2 dd input,.tuanchu3 dd input').click(function() {
        if ($(this).parent('div').index() == 0 && $(this).attr('checked') == true) {
            $(this).parent('div').siblings().children('input').attr('checked', false);
        }
        if ($(this).parent('div').index() != 0 && $(this).attr('checked') == true) {
            $(this).parent('div').siblings().eq(0).children('input').attr('checked', false);
        }
    })
///***********************************************************///				
    $('.tuanchu3 .qued').click(function() {
        var $val = $('.tuanchu3 dd input:checked').map(function() {
            return this.value;
        }).get().join('+');
        $('.dq_xuanze_val').val($val);
        var $title = $('.tuanchu3 dd input:checked').map(function() {
            return $(this).next('span').text();
        }).get().join('+');
        $('.dq_xuanze').val($title);
    })

    $('.qued,.qux').click(function() {
        $(this).parent().parent('div').hide();
    })



    ///***********************************************************///
    $('.tuanchu1 .buxian').click(function() {
        $('.xuanze_val').val('');
        $('.xuanze').val('不限');
    })

    $('.tuanchu2 .buxian').click(function() {
        $('.zw_xuanze_val').val('');
        $('.zw_xuanze').val('不限');
    })

    $('.tuanchu3 .buxian').click(function() {
        $('.dq_xuanze_val').val('');
        $('.dq_xuanze').val('不限');
    })

    $('.tuanchu1 .buxian,.tuanchu2 .buxian,.tuanchu3 .buxian').click(function() {
        $(this).parent().parent().hide();

    })

    //推荐设置点击修改
    $("#recordInfoUpdate").click(function() {
        $("#recordInfo").hide();
        $("#recordInfoInput").show();
    });
    //推荐设置保存
    $("#recordInfoConfirm").click(function() {
        var strycate = $("input[name='strycate']").val();
        var Jobcate = $("input[name='Jobcate']").val();
        var area = $("input[name='area']").val();
        var recordSetingMaxdate = $("#recordSetingMaxdate").val();
        var companyList = $("#companyList span");
        var pattern = "X";
        var companyListStr = "";
        var companyListStrHtml = "";
        companyList.each(function() {
            companyListStr += $(this).text().replace(new RegExp(pattern), "|||");
            companyListStrHtml += $(this).text().replace(new RegExp(pattern), "&nbsp;&nbsp;&nbsp;");
        });

        var postionList = $("#postionList span");
        var postionListStr = "";
        var postionListStrHtml = "";
        postionList.each(function() {
            postionListStr += $(this).text().replace(new RegExp(pattern), "|||");
            postionListStrHtml += $(this).text().replace(new RegExp(pattern), "&nbsp;&nbsp;&nbsp;");
        });

        var areaList = $("#areaList span");
        var areaListStr = "";
        var areaListStrHtml = "";
        areaList.each(function() {
            areaListStr += $(this).text().replace(new RegExp(pattern), "|||");
            areaListStrHtml += $(this).text().replace(new RegExp(pattern), "&nbsp;&nbsp;&nbsp;");
        });
        $.post("/Home/Login/setRecordSeting.html", {
            'strycate': strycate, "Jobcate": Jobcate, "area": area, "recordSetingMaxdate": recordSetingMaxdate, "companyListStr": companyListStr, "postionListStr": postionListStr, "areaListStr": areaListStr
        }, function(data) {
            if (data.code != "500") {
                $("#strycate_html").html($("input[name='xuanze_val']").val());
                $("#Jobcate_html").html($("input[name='zw_xuanze_val']").val());
                $("#areas_html").html($("input[name='dq_xuanze_val']").val());
                $("#maxdate_html").html(recordSetingMaxdate);
                $("#companys_html").html(companyListStrHtml);
                $("#postions_html").html(postionListStrHtml);
                $("#area_html").html(areaListStrHtml);
                $("#recordInfo").show();
                $("#recordInfoInput").hide();
            } else {
                /*
                 $("#bankError").html(data.msg);
                 $("#bankError").show();
                 */
            }
        }, "json")
    });
    //搜索候选人
    $("#serarch-resume-btn").click(function() {
        var resume_keyword = $("#resume_name").val();
        if (resume_keyword) {
            location.href = "/Home/Login/Recommended/name/" + resume_keyword + ".html"
        }
    });
    $(".removeResume").click(function() {
        if (confirm("您确实要删除本条信息吗？")) {
            var resume_id = $(this).attr("id");
            $.post("/Home/Login/delResume.html", {
                'resume_id': resume_id
            }, function(data) {
                if (data.code != "500") {
                    sys_window("您成功删除了本条信息！", location.href);
                } else {
                    sys_window(data.msg);
                }
            }, "json");
        }

    });

})

function jlcom() {
    $("#upd11").hide();
    $("#upd12").show();
    $(".Close4").show();
    var updateFile = $("#updateFile").val();
    var updatePath = $("#updatePath").val();
    var title = $("#username1").val();
    $(".scjl_tc").hide();

    $(".mask").hide();
    $(".secord").show();
    $("#file_upload-queue").html("");
    if (title) {
        $(".jianliurl").html('<a class="wk dis-block" style="width:100%;height:100%;"  href=\'' + updatePath + updateFile + '\'>' + title + "--" + updateFile + '</a>');
    } else {
        $(".jianliurl").html('<a class="wk dis-block" style="width:100%;height:100%;"  href=\'' + updatePath + updateFile + '\'>' + updateFile + '</a>');
    }

}