$(document).ready(function() {
    $("#my-account").bind("mouseenter", function() {
        $("#my-account2").addClass("move");
        $(".m-user").addClass("move")
        $(".al-header .wrap .al-right .mydl").show();
        $(".account-jt").addClass("href");
    })
    $("#my-account").bind("mouseleave", function() {
        $("#my-account2").removeClass("move");
        $(".m-user").removeClass("move")
        $(".al-header .wrap .al-right .mydl").hide();
        $(".account-jt").removeClass("href");
    })
    $(".age-father label").bind("click", function() {
        $(this).addClass("m").siblings("label").removeClass("m")
    });
    $(".m2-l .odiv3").on("mouseenter",function(){
       $(this).find(".j").show();
    });
    $(".m2-l .odiv3").on("mouseleave",function(){
        $(this).find(".j").hide();
    });
    $("#my-data a").bind("mouseenter", function() {
        $(this).addClass("m").siblings().removeClass("m");
    });
    var ms3Nav = $(".ms3-r .nav li");
    var remen = $(".ms3-r .con-remen"),
            zuixin = $(".ms3-r .con-zuixin");

    ms3Nav.click(function() {
        $(this).addClass("href").siblings().removeClass("href");
    });

    ms3Nav.eq(0).click(function() {
        remen.show();
        zuixin.hide();
    })
    ms3Nav.eq(1).click(function() {
        remen.hide();
        zuixin.show();
    })

})
$(function() {
    $("#sys_window .close").click(function() {
        $("#sys_window").hide();
        $(".mask").hide();
        if ($("#locationHref").val()) {
            location.href = $("#locationHref").val();
        }
    });
    $("#comWind").click(function() {
        if ($("#locationHref").val()) {
            location.href = $("#locationHref").val();
        }
        $("#sys_window").hide();
        $(".mask").hide();
    });

})

function sys_window(content, url) {
    if (url) {
        $("#locationHref").val(url);
    }
    $("#sys_window").show();
    $(".mask").show();
    $("#sys_content").html(content);

}
$(function() {
    //搜索相关
    $(".btn-search").click(function() {
        var searchKeyword = $("#searchbox").val();
        if (searchKeyword) {
            location.href = "/Home/Index/search/position/" + searchKeyword+".html";
        } else {
            location.href = "/Home/Index/search.html";
        }
    });
})

$(function() {
    $(".dengluBtn,#denglu3").click(function() {
        $(".mask").show();
        $("#conZhuce").hide();
        $(".denglu").show();
    })

    $("#dengluBtn2,#zhuce").click(function() {
        $(".mask").show();
        $(".denglu").hide();
        $("#conZhuce").show();
    })
    $(".Close,.close").click(function() {
        $(".mask").hide();
        $("#conZhuce").hide();
        $(".denglu").hide();
        //location.href = $("#hrefUrl").val();
    })
})