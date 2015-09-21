$.post("create_session", {}, function (data) {
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