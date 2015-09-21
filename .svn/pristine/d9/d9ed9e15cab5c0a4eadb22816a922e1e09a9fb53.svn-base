$(document).ready(function() {
    /*------------弹出框遮罩效果-----------*/
    $('.mszc_btn').on('click', function() {
        $('.mask').show();
        $('.tanchu').slideDown();
    })
    $('.guanbi').on('mouseenter', function() {
        $(this).css({
            'border': '3px #ccc solid',
            'top': '7px',
            'right': '7px'
        })
    });
    $('.guanbi').on('mouseleave', function() {
        $(this).css({
            'border': 'none',
            'top': '10px',
            'right': '10px'
        })
    })
    $('.guanbi').on('click', function() {
        $('.mask').hide();
        $('.tanchu').slideUp();
        $('.cgzc').slideUp();
    })
    $('.zc').on('click', function() {
        var user = $('.hd_user').val(),
                pasd1 = $('.pasd1').val(),
                pasd2 = $('.pasd2').val(),
                lxrxm = $('.lxrxm').val(),
                //email = $('.email').val(),
                shoujihao = $('.shoujihao').val(),
                sjyzm = $('.sjyzm').val(),
                // shdz = $('.shdz').val(),
                radio = $('#radio:checked').val();
        var code = $("#coded").val();
        if (user == '' ||
                !/^[\@A-Za-z\!\#\$\%\^\&\*\.\~]{2,}[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{2,16}$/.test(user) ||
                pasd1 == '' ||
                !/^[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{6,16}$/.test(pasd1) ||
                pasd2 == '' ||
                pasd1 != pasd2 ||
                lxrxm == '' ||
                !/^([a-z\u4E00-\u9FA5])*$/i.test(lxrxm) ||
                shoujihao == '' ||
                !/^[0-9]{11}$/.test(shoujihao) ||
                sjyzm == '' ||
                !/^[0-9]{6}$/.test(sjyzm) ||
                typeof (radio) == "undefined"
                ) {
            $('.wtx').html('您有未填写项或所填内容格式不正确');
            $('.wtx').show();
        } else if (code != sjyzm) {
            $('.wtx').html('验证码不正确，请重新输入！');
            $('.wtx').show();
        } else {
            $.post("code.php", {
                'act': "reg",
                'username': user,
                'password': pasd1,
                'cname': lxrxm,
                //  'email':email,
                //  'address':shdz,
                'mobile': shoujihao
            }, function(data) {
                if (data.code != "200") {
                    $('.wtx').html(data.msg);
                    $('.wtx').show();
                } else {
                    $('.tanchu').slideUp()
                    setTimeout(function() {
                        $('.mask').show();
                        $('.cgzc').slideDown();
                    }, 600);
                }
            }, "json")


        }
        ;
    })

    $(".btn_hqyzm").click(function() {
        var mobile = $(".shoujihao").val();
        if (mobile) {
            $.post("code.php", {
                'act': "getcode",
                'mobile': mobile
            }, function(data) {
                if (data.code != "200") {
                    $('.wtx').html(data.msg);
                    $('.wtx').show();
                } else {
                    $("#coded").val(data.smg);
                }
            }, "json")
        } else {
            $('.wtx').html("请填写手机号码");
            $('.wtx').show();
        }
    });








    /*-----------验证用户名格式-------------*/
    $('.hd_user').blur(function() {
        var hd_user = $(this).val(); //这是value值
        if ($(this).val() != '') {
            function email(obj) { //obj这不用管
                if (/^[\@A-Za-z\!\#\$\%\^\&\*\.\~]{2,}[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{2,16}$/.test(obj)) {
                    $('.user_span').hide();
                    $('.wtx').hide();

                } else {
                    $('.wtx').html('用户名格式错误');
                    $('.wtx').show();
                }
            }
            ;
            email(hd_user); //这是调用方法把value值传参传进来
        }
    });


    /*-----------验证用密码格式-------------*/
    $('.pasd1').blur(function() {
        var pasd1 = $(this).val(); //这是value值
        if ($(this).val() != '') {
            function email(obj) { //obj这不用管
                if (/^[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{6,16}$/.test(obj)) {
                    $('.pasd1_span1').hide();
                    $('.wtx').hide();

                } else {
                    $('.wtx').html('密码格式错误');
                    $('.wtx').show();
                }
            }
            ;
            email(pasd1); //这是调用方法把value值传参传进来
        }
    });

    $('.pasd2').blur(function() {
        if ($('.pasd2').val() != $('.pasd1').val()) {
            $('.pasd1_span2').html('两次输入的密码不一样');
            $('.pasd1_span2').show();
        } else {
            $('.pasd1_span2').hide();
        }
    });





    /*---------------验证联系人姓名----------*/
    $('.lxrxm').blur(function() {
        var lxrxm = $(this).val(); //这是value值
        if ($(this).val() != '') {
            function email(obj) { //obj这不用管
                if (/^([a-z\u4E00-\u9FA5])*$/i.test(obj)) {
                    $('.lxrxm_span').hide();
                    $('.wtx').hide();
                } else {
                    $('.wtx').html('联系人姓名格式错误');
                    $('.wtx').show();
                }
            }
            ;
            email(lxrxm); //这是调用方法把value值传参传进来
        }
    });


    /*---------------验证邮箱格式----------*/
    $('.email').blur(function() {
        var email_f = $(this).val(); //这是value值
        if ($(this).val() != '') {
            function email(obj) { //obj这不用管
                if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/i.test(obj)) {
                    $('.email_span').hide();
                    $('.wtx').hide();
                } else {
                    $('.wtx').html('邮箱格式错误');
                    $('.wtx').show();
                }
            }
            ;
            email(email_f); //这是调用方法把value值传参传进来
        }
    });


    /*---------------验证手机号----------*/
    $('.shoujihao').blur(function() {
        var shoujihao = $(this).val(); //这是value值
        if ($(this).val() != '') {
            function email(obj) { //obj这不用管
                if (/^[0-9]{11}$/.test(obj)) {
                    $('.sjh_span').hide();
                    $('.wtx').hide();
                } else {
                    $('.wtx').html('手机号格式错误');
                    $('.wtx').show();

                }
            }
            ;
            email(shoujihao); //这是调用方法把value值传参传进来
        }
    });


    /*---------------验证手机验证码----------*/
    $('.sjyzm').blur(function() {
        var sjyzm = $(this).val(); //这是value值
        if ($(this).val() != '') {
            function email(obj) { //obj这不用管
                if (/^[0-9]{6}$/.test(obj)) {
                    $('.sjyzm_span').hide();
                    $('.wtx').hide();
                } else {
                    $('.wtx').html('手机验证码格式错误');
                    $('.wtx').show();
                }
            }
            ;
            email(sjyzm); //这是调用方法把value值传参传进来
        }
    });




    /*------------获取手机验证码倒计时--------*/
    var wait = 60;
    $(".time").disabled = false;
    function time(o) {
        if (wait == 0) {
            o.removeAttribute("disabled");
            o.value = "获取验证码";
            wait = 60;
        } else {
            o.setAttribute("disabled", true);
            o.value = "(" + wait + ")重新发送";
            wait--;
            setTimeout(function() {
                time(o)
            },
                    1000)
        }
    }
    $('.time').on('click', function() {

        if (!/^[0-9]{11}$/.test($('.shoujihao').val()) || $('.shoujihao').val() == '') {
            return;
        } else {
            time(this);
        }

    })
})