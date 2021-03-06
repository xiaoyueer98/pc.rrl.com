
var arrTariff = {"20197": "1000", "20121": "2000", "20122": "3000", "20123": "5000", "20132": "10000", "20134": "20000", "20135": "30000", "20136": "50000"}

function treatmentChange() {
    $("#money").text("(招聘资费不能低于" + arrTariff[$("#treatment  option:selected").attr("tar")] + ")");
}
function clickDefault(obj) {
    var defaults = $("#defaults");
    if (obj == "default") {
        defaults.hide();
    } else {
        defaults.show();
    }
}



function checkSendJob() {

    var reg = /^1[3|4|5|8][0-9]\d{4,8}$/;
    var numreg = /[0-9]*/;
    var id = $("#jobid").val();
    var title = $("input[name='jobtitle']").val();
    var strycate = $(".xuanze_val").val();
    var Jobcate = $(".zw_xuanze_val").val();
    var joblang = $("select[name='jobjoblang']").find("option:selected").val();
    var employ = $("input[name='jobemploy']").val();
    var treatment = $("select[name='jobtreatment']").find("option:selected").attr("tar");
    var jobplace = $(".dq_xuanze_val").val();
    var experience = $("select[name='jobexperience']").find("option:selected").val();
    var education = $("select[name='jobeducation']").find("option:selected").val();
    var endtime = $("input[name='jobendtime']").val();
    var tariff = $("input[name='jobTariffed']").val();
    var meth = $("input[name='jobmeth']:checked").val();
    var email = $("input[name='jobemail']").val();
    var mobile = $("input[name='jobmobile']").val();
    var report_obj = $("input[name='report_obj']").val();
    var report_number = $("input[name='report_number']").val();
    var match_company = $("select[name='match_company']").find("option:selected").val();
    var match_industry = $("input[name='match_industry']").val();
    var workdesc = ue.getContent();
    var content = ue2.getContent();
    var treatment2 = $("select[name='jobtreatment']").find("option:selected").val();
    if (!title) {
        $("input[name='jobtitle']").focus();
        $('.send-job-error').html('职位名称不能为空');
        $('.send-job-error').show();
        return false;
    }
    if (title.length > 50) {
        $("input[name='jobtitle']").focus();
        $('.send-job-error').html('职位名称信息过长');
        $('.send-job-error').show();
        return false;
    }
    if (!strycate) {
        $('.send-job-error').html('请选择您招聘的详细行业');
        $('.send-job-error').show();
        return false;
    } else if (!Jobcate) {
        $('.send-job-error').html('请选择您招聘的详细职位');
        $('.send-job-error').show();
        return false;
    } else if (!jobplace) {
        $('.send-job-error').html('请选择工作地点');
        $('.send-job-error').show();
        return false;
    } else if (!numreg.test(employ) || employ < 1) {
        $('.send-job-error').html('招聘人数格式不正确');
        $('.send-job-error').show();
        return false;
    } else if (treatment == 0) {
        $('.send-job-error').html('请选择月薪待遇');
        $('.send-job-error').show();
        return false;
    } else if (match_industry == "请选择") {
        $('.send-job-error').html("请选择细分行业");
        $('.send-job-error').show();
        return false;
    } else if (match_company == "请选择") {
        $('.send-job-error').html("请选择公司背景");
        $('.send-job-error').show();
        return false;
    } else if (!endtime) {
        $('.send-job-error').html("请选择截止时间");
        $('.send-job-error').show();
        return false;
    } else if (education == 0) {
        $('.send-job-error').html('请选择学历要求');
        $('.send-job-error').show();
        return false;
    } else if (experience == 0) {
        $('.send-job-error').html('请选择工作经验');
        $('.send-job-error').show();
        return false;
    } else if (joblang == 0) {
        $('.send-job-error').html('请选择语言能力');
        $('.send-job-error').show();
        return false;
    } else if (!workdesc) {
        $('.send-job-error').html('工作职责不能为空');
        $('.send-job-error').show();
        return false;
    } else if (!content) {
        $('.send-job-error').html('岗位要求不能为空');
        $('.send-job-error').show();
        return false;
    } else if (!tariff) {
        $('.send-job-error').html('招聘资费不能为空');
        $('.send-job-error').show();
        return false;
    } else if ((tariff * 100) < eval(arrTariff[treatment])) {
        $('.send-job-error').html("招聘资费不能低于" + arrTariff[treatment]);
        $('.send-job-error').show();
        return false;
    }
    
    if (meth == "2") {
        if (!email) {
            $('.send-job-error').html('请填写联系人');
            $('.send-job-error').show();
            return false;
        } else if (!mobile) {
            $('.send-job-error').html('请填写联系人手机');
            $('.send-job-error').show();
            return false;
        }

    }
    if (confirm("您确定发布此职位的招聘费为" + tariff * 100 + "元吗")) {
        $.post("/Home/Company/companySendJobAdd.html", {
            'id':id,
            'title': title,
            'strycate': strycate,
            'employ': employ,
            'treatment': treatment2,
            'jobplace': jobplace,
            'experience': experience,
            'education': education,
            'joblang': joblang,
            'endtime': endtime + " 23:59:59",
            'Tariff': tariff,
            'meth': meth,
            'email': email,
            'mobile': mobile,
            'workdesc': workdesc,
            'content': content,
            'Jobcate': Jobcate,
            'match_company': match_company,
            'match_industry': match_industry,
            'report': report_obj,
            'report_number': report_number
        }, function(data) {
            if (data.code == "200") {
                location.href = "/Home/Company/SendJob/act/joblist.html"
            } else {
                $('.send-job-error').html(data.msg);
                $('.send-job-error').show();
            }
        }, "json")
    }

}
$(function() {
    $(".close").click(function() {
        $("#addTariffWind").hide();
        $(".mask").hide();
    });
    $("#confAddTriff").click(function() {
        var TariffValue = $("#TariffValue").val();
        var jobId = $("#jobid").val();
        if (confirm("您确定修改此招聘的费用为" + TariffValue * 100 + "元吗？")) {
            $.post("/Home/Company/addTariff.html", {
                'jobId': jobId,
                'TariffValue': TariffValue
            }, function(data) {
                $("#addTariffWind").hide();
                if (data.code == "200")
                {
                    sys_window(data.msg);
                    location.href = location.href;
                    //  $(".job"+jobId).hide();
                }
                else
                {

                    sys_window(data.msg);
                }
            }, "json")
        }

    });
})

function deleteJob(jobId) {
    $(".mask").show();
    $("#deleteid").val(jobId);
    $('.Pop-up').slideDown();
}
function goDelete() {
    var jobId = $("#deleteid").val();
    $('.Pop-up').slideUp();
    $.post("/Home/Company/deleteJob.html",
            {'jobId': jobId}, function(data) {
        if (data.code == "200")
        {
            location.href = location.href;
        }
        else
        {
            sys_window(data.msg);
        }
    }, "json")
}

function addTariff(id, Tariff) {
    $("#jobid").val(id);
    $("#addTariffWind").show();
    $(".mask").show();
}