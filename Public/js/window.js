$(function() {

    /*-------------------注册弹出框-----------------*/
    $('.zhuce1').on('click', function() {
        $('#mask').show();
        $('#conZhuce').slideDown();
        $('.mask1').show();
    })

    $('.zhuce2').on('click', function() {
        $('.mask1').show();
        $('.wjmima').slideDown();
    })

    $('.dengluBtn').on('click', function() {
        $('#mask').show();
        $('.mask1').show();
        $('.denglu').slideDown();
    })
    $('#dengluBtn2').on('click', function() {
        $('.denglu').slideUp();
        setTimeout(function() {
            $('#conZhuce').show();
        }, 800)

    })
    $('#denglu3').on('click', function() {
        $('#conZhuce').slideUp();
        setTimeout(function() {
            $('.denglu').show();
        }, 800)
    })

    $('.Close,.close').on('click', function() {
        $('.mask1').hide();
        $('#mask').hide();
        $('.mask').hide();
        $('#conZhuce').slideUp();
        $('.denglu').slideUp();
        $('.wjmima').slideUp();
    })

    $('.nav>li').on('click', function() {
        $(this).addClass('mover3').siblings().removeClass('mover3');
    })
    /*------------------input标签焦点事件------------*/
    $.focusblur = function(focusid) {
        var focusblurid = $(focusid);
        var defval = focusblurid.val();
        focusblurid.focus(function() {
            var thisval = $(this).val();
            if (thisval == defval) {
                $(this).val("");
            }
        });
        focusblurid.blur(function() {
            var thisval = $(this).val();
            if (thisval == "") {
                $(this).val(defval);
            }
        });

    }; /*下面是调用方法*/
    $.focusblur("#user");
    $.focusblur("#email");
    $.focusblur("#pasword1");
    $.focusblur("#pasword2");
    $.focusblur("#dluser");
    $('.DLUser').focus(function(event) {
        $(this).css('color', '#000');
        $(this).nextAll().hide();
    })
    $('.email').focus(function(event) {
        $(this).css('color', '#000')
    })

    $('.password1').focus(function(event) {
        $(this).css('color', '#000')
    })

    $('.password2').focus(function(event) {
        $(this).css('color', '#000')
    })

    $('.DLpassword').focus(function(event) {
        
        $(this).css('color', '#000');
        $(this).nextAll().hide();
    });

    $('.zhuce dl .InputUl input').blur(function() {
        if ($(this).val() == "") {
            $(this).nextAll().show();
        }
    });
})
