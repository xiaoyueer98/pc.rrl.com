String.prototype.trim = function() {
    return this.replace(/(^\s*)|(\s*$)/g, "");
}
String.prototype.ltrim = function() {
    return this.replace(/(^\s*)/g, "");
}
String.prototype.rtrim = function() {
    return this.replace(/(\s*$)/g, "");
}

$(document).ready(function(e) {
    $('.mysp').on('click', function() {
        $(this).animate({
            'left': '10px',
            'top': '10px',
            'width': '15px',
            'height': '15px'
        }, 200);
        setTimeout(function() {
            $('.sousuoIpt').css('display', 'block')
            $('.ssBtn').css('display', 'block');
        }, 205)
    });
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


    $('.jlfj span').on('mouseenter', function() {
        $(this).animate({
            opacity: '1'
        }, 200);
    })
    $('.jlfj span').on('mouseleave', function() {
        $(this).animate({
            opacity: '0'
        }, 200);
    })

    /*----------------------------登陆下拉--------------------*/
    $('.xiala .select').on('mouseenter', function() {
        $('.vio').show();
    });
    $('.xiala .vio').on('mouseleave', function() {
        $('.vio').hide();
    });

    $('.xiala2').on('mouseenter', function() {
        $('.vio2').show();
    });

    $('.xiala2').on('mouseleave', function() {
        $('.vio2').hide();
    });



    /*-----------------------回到顶部-----------------*/
    var flixd = $('.myspan');
    $(window).on('scroll', function() {
        var mybody = $('body');
        var scrollTop = $(document).scrollTop();
        /*if( scrollTop >600 ){
         flixd.css('display','block');
         }else if( scrollTop <600 ){
         flixd.css('display','none')
         }*/
    })
    $('.hddb').on('click', function() {
        $('html,body').animate({
            'scrollTop': 0
        }, 200)
    })

    $('.hddb').on('mouseenter', function() {
        flixd.css('display', 'block');
    })

    $('.hddb').on('mouseleave', function() {
        flixd.css('display', 'none');
    })

    $('.dl1>dd>span').on('mouseenter', function() {
        $('.dl1>i').show();
    })
    $('.dl1>dd>span').on('mouseleave', function() {
        $('.dl1>i').hide();
    })


    /*----------------------------------------------------------*/
    $('.zhuce dl .InputUl li span').on('click', function() {
        $(this).hide().prev().focus();
    })
    /*----------------------------------------------------------*/

    var navTop = $('#navTop>li');
    navTop.on('click', function() {
        $(this).addClass('cenTop').siblings().removeClass('cenTop')
    })

    $(window).on('scroll', function() {
        var scrollTop = $(document).scrollTop();
        if (scrollTop > 200) {
            $('.fiexdCenter').animate({
                'top': '0'
            }, 50)
        } else if (scrollTop < 90) {
            $('.fiexdCenter').animate({
                'top': '-37'
            }, 50)
        }
    }); /*-------------------注册弹出框-----------------*/
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

    $('.Close').on('click', function() {
        $('.mask1').hide();
        $('#mask').hide();
        $('#conZhuce').slideUp();
        $('.denglu').slideUp();
        $('.wjmima').slideUp();
    })

    $('.nav>li').on('click', function() {
        $(this).addClass('mover3').siblings().removeClass('mover3');
    })


    /*---------------------验证邮箱格式------------------------------------*/
    $('.error').hide();
    $('.email').blur(function(event) {
        var email = $('.email').val();
        if (email != '') {
            if (valid_email(email)) {
                $('.error').hide();
            } else {
                $(".error").html("请输入正确的邮箱格式！");
                $('.error').show();
                event.preventDefault();

            }
        } else {

            $(".error").html("邮箱非空");

        }
        ;
        $(this).nextAll().hide();
    });

    function valid_email(email) {
        var patten = new RegExp(/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+(com|cn)$/);
        return patten.test(email);
    }
    /*--------------验证密码格式----------------------------*/
    $('.password1').blur(function() {
        var inputval = $('.password1').val(); //这是value值
        if ($(this).val() != '') {
            function email(obj) { //obj这不用管
                if (/^[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{2,16}$/.test(obj)) {
                    $('.error').hide();
                } else {
                    $('.error').html('密码格式不正确')
                    $('.error').show();
                }
            }
            ;
            email(inputval); //这是调用方法把value值传参传进来
        } else {
            $(".error").html("密码不能为空");
        }
        ;
        $(this).nextAll().hide();
    })



    $('.wjmim_email').blur(function() {
        var inputval = $('.wjmim_email').val(); //这是value值
        if ($(this).val() != '') {
            function email(obj) { //obj这不用管
                if (/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+(com|cn)$/.test(obj)) {
                    $('.error').hide();
                } else {
                    $('.InputUl .error2').html('邮箱格式不正确')
                    $('.InputUl .error2').show();
                }
            }
            ;
            email(inputval); //这是调用方法把value值传参传进来
        } else {
            $('.InputUl .error2').html('邮箱不能为空')
            $('.InputUl .error2').show();
        }
        ;
        $(this).nextAll().hide();
    })

    $('.wjmim_email').focus(function(event) {
        $(this).css('color', '#000');
        $(this).nextAll().hide();
    });

   
    $('.password1').focus(function(event) {
        $(this).css('color', '#000')
    });
    /*--------------验证QQ号码格式----------------------------*/
    $('.qq').blur(function() {
        var inputval = $(this).val(); //这是value值
        if ($(this).val() != '') {
            function email(obj) { //obj这不用管
                if (/^[0-9]{5,12}$/.test(obj)) {
                    $('.error2').hide();
                } else {
                    $('.error2').html('QQ号码格式不正确')
                    $('.error2').show();
                }
            }
            ;
            email(inputval); //这是调用方法把value值传参传进来
        }
    })
    $('.password1').focus(function(event) {
        $(this).css('color', '#000')
    });

    /*--------------验证手机号码格式----------------------------*/
    $('.qq').blur(function() {
        var inputval = $(this).val(); //这是value值
        if ($(this).val() != '') {
            function email(obj) { //obj这不用管
                if (/^[0-9]{5,12}$/.test(obj)) {
                    $('.error2').hide();
                } else {
                    $('.error2').html('QQ号码格式不正确')
                    $('.error2').show();
                }
            }
            ;
            email(inputval); //这是调用方法把value值传参传进来
        }
    })
    $('.password1').focus(function(event) {
        $(this).css('color', '#000')
        $(this).nextAll().hide();
    });
    /*-------------验证用户名格式------------------*/
    $('.zhuceUser').focus(function(event) {
        $(this).css('color', '#000');
    })
    $('.password2').blur(function() {
        if ($('.password1').val() != "") {
            if ($('.password1').val() != $(this).val()) {
                $('.error').html('两次输入的密码不一样')
                $('.error').show();
            } else {
                $('.error').hide();
            }

        } else {
            $(".error").html("确认密码不能为空");
        }
        ;
    });

    $('.password2').focus(function(event) {
        $(this).css('color', '#000');
        $(this).nextAll().hide();
    });
    $('.zhuceUser').focus(function(event) {
        $(".error").html("请输入4-16位的英文字母，数字，下划线");
        $(".error").show();
        $(this).nextAll().hide();
    });
    $('.email').focus(function(event) {
        $(".error").html("请输入正确的邮箱格式");
        $(".error").show();
        $(this).nextAll().hide();
    });

    $('.password1').focus(function(event) {
        $(".error").html("请输入6-11位的英文字母，数字，下划线");
        $(".error").show();
        $(this).nextAll().hide();
    });
    $('.password2').focus(function(event) {
        $(".error").html("请输入6-11位的英文字母，数字，下划线");
        $(".error").show();
        $(this).nextAll().hide();
    });

    /*------------------验证阅读条款-------------*/
    $("#form").submit(function() {
        if ($('.password1').val() != $('.password2').val()) {
            return false
        }
        ;
        var zhuceRadio1 = document.getElementsByName("xieyi");
        for (var i = 0; i < zhuceRadio1.length; i++) {
            if (zhuceRadio1[i].checked == false) {
                return false
            }
        }

    });
    /*---------------------验证登录用户名格式-----------------------------*/

    var userZC = $('.DLUser');
    userZC.blur(function() {
        var zhuceUser = userZC.val();
        if (zhuceUser != '') {
            function email(obj) { //obj这不用管
                if (/^[\@A-Za-z\!\#\$\%\^\&\*\.\~]{2,}[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{2,16}$/.test(obj)) {
                    $('.error2').hide();
                } else {
                    //$('.error2').html('用户名格式不正确')
                    //$('.error2').show();
                }
            }
            ;
            email(zhuceUser); //这是调用方法把value值传参传进来
            //alert(23)
        } else {
            $(".error2").html("用户名不能为空");
        }

    })

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







    /*---------------------验证登录密码格式-----------------------------*/
    $('.DLpassword').blur(function() {
        var inputval = $('.DLpassword').val(); //这是value值
        if ($(this).val() != '') {
            function email(obj) { //obj这不用管
                if (/^[\@A-Za-z0-9\!\#\$\%\^\&\*\.\~]{2,16}$/.test(obj)) {
                    $('.error2').hide();
                } else {
                    $('.error2').html('密码格式不正确')
                    $('.error2').show();
                }
                ;

            }
            ;
            email(inputval); //这是调用方法把value值传参传进来
            //alert(23)
        } else {
            $(".error2").html("密码不能为空");
        }
        ;
    })

    $('.denglu dl .InputUl li span').on('click', function() {
        $(this).hide().prev().focus();
    })

    $('.denglu dl .InputUl li input').blur(function() {
        if ($(this).val() == '') {
            $(this).nextAll().show();
        }
    })


    $('.navlastLi').on('click', function() {
        $('.zhuce>dl>dd>.Sign').hide();
        $('.zhuce>dl>dd>.Grey').show();
        $('.zhuce>dl>dd>p').css('color', '#ccc')
    })
    $('.navfirstLi').on('click', function() {
        $('.zhuce>dl>dd>.Grey').hide();
        $('.zhuce>dl>dd>.Sign').show();
        $('.zhuce>dl>dd>p').css('color', '#2284BB')
    });
    window.loclasht
    /*----------推荐人页面-我的资料--------------------*/
    var pd_list = $('.pd>.pd_list>span');
    pd_list.on('click', function() {
        $(this).nextAll().toggle(200);
        $(this).parent('.pd_list').siblings().find('ul').hide();
        $('.pd>.pd_list>ul>li>em').removeClass('hre')
    });

    $('.pd>.pd_list>ul>li>em').on('click', function() {
        $(this).addClass('hre').parent('li').siblings().find('em').removeClass('hre');
    })

    /*----------------个人信息修改-----------------*/
    var Infor_Btn = $('.Infor>.cn_btm>.btn');
    Infor_Btn.on('click', function() {
        $('.Infor').slideUp("");
        $('.Modify').show();
        $('.Self').slideUp("");
    });


    /*-------------个人信息保存--------------*/

    var Modify_Btn2 = $('.Modify .btn2');
    Modify_Btn2.on('click', function() {
        $('.Modify').hide();
        $('.Infor').slideDown();
        $('.Self').slideDown();
    })

    /*
     
     var Modify_Btn1 = $('.Modify .btn1');
     Modify_Btn1.on('click', function() {
     if($('.shoujihao').val()=="" || $('.hanzi').val()==""){
     $('.error2').html('您有未填写项');
     $('.error2').show();
     return false;
     };
     $('.Modify').hide();
     $('.Infor').show();
     $('.Self').show();
     //alert(23)
     })
     */
    /*--------------------------------编辑弹出筐-------------------------*/
    /*
     $('.recom1>.recoml_btm>.btn').on('click', function() {
     $('.PersData>.xg').slideDown().siblings().slideUp();
     });
     $('.xg>.recoml_btm>.bc').on('click', function() {
     $('.PersData>.xg').slideUp().siblings().slideDown();
     });
     $('.xg>.recoml_btm>.qx').on('click', function() {
     $('.PersData>.xg').slideUp().siblings().slideDown();
     });
     
     
     -------------------scrollTop------------------------*/
    /*var height = $( '.PersData>.recom3' ).outerHeight(true);
     $( '.mytj>ul>li' ).on( 'click', function(){
     var Index = $( this ).index();
     $('html,body').animate({'scrollTop':height*Index-210},200)
     })
     */

    /*------------职位高级搜索活的脚垫字体变黑-----------*/
    $('.gr>.tex').focus(function(event) {
        $(this).css('color', '#000')
    })





    /*-----------上传简历模式---------------*/
    $('.mybtnp .sc1').on('click', function() {
        $(this).addClass('mo').siblings().removeClass('mo');
        $('.Self1').show();
        $('.Self2').hide();
    })

    $('.mybtnp .sc2').on('click', function() {
        $(this).addClass('mo').siblings().removeClass('mo');
        $('.Self2').show();
        $('.Self1').hide();
    })



    /*----------------公司基本信息---------------*/

    $('.zwojs1 .btn').on('click', function() {
        $('.zwojs1').hide();
        $('.zwojs2').show();
    })

    $('.zwojs2 .btn').on('click', function() {
        $('.zwojs2').hide();
        $('.zwojs1').show();
    })





    $('.fiexd2 .li_1').on('click', function() {
        $(this).find('ul').show();
        $(this).addClass('me')
        //$( '.fiexd2 .li_2 ul' ).hide();
        $('.fiexd2 .li_2').removeClass('me')
    })

    $('.fiexd2 .li_2').on('click', function() {
        $(this).find('ul').show();
        //$( '.fiexd2 .li_1 ul' ).hide();
        $(this).addClass('me');
        //$( '.fiexd2 .li_1' ).removeClass('me')
    })


   

    /*--------------发送验证码倒计时--------------*/
    var wait = 60;
    $(".time").disabled = false;
    function time(o) {
        if (wait == 0) {
            o.removeAttribute("disabled");
            o.value = "免费获取验证码";
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
        time(this)
    })

    $('.inpu1').blur(function() {
        if ($(this).val() == '') {
            $('.error3').show();
        } else {
            $('.error3').hide();
        }
    })





    $('.inpu1').blur(function() {
        var inputval = $('.inpu1').val(); //这是value值
        if ($(this).val() != '') {
            /*
            function email(obj) { //obj这不用管
                if (/^[0-9]{4}$/.test(obj)) {
                    $('.error3').hide();
                } else {
                    $('.error3').html('验证码格式不正确')
                    $('.error3').show();
                }
            }
            ;
            email(inputval); //这是调用方法把value值传参传进来
            */
        } else {
            $(".error3").html("验证码不能为空");
        }
    })

    /*-----------------验证手机号码--------------*/
    $('.shoujihao').keyup(function() {
        var inputval = $('.shoujihao').val(); //这是value值
        if ($(this).val() != '') {
            function email(obj) { //obj这不用管
                if (/^[0-9]{11}$/.test(obj)) {
                    $('.error2').hide();
                    $('.butondx').show();
                } else {
                    $('.error2').html('手机号码格式不正确')
                    $('.error2').show();
                }
            }
            ;
            email(inputval); //这是调用方法把value值传参传进来
        } else {
            $(".error2").html("手机号码不能为空");

        }
    })

    $('#btn_xg1').on('click', function() {
        $('#content2').slideUp();
        $('#content1').slideDown();
        //alert(23)
    })


    $('.denglu dl .InputUl input').keydown(function(e) {
        if (e.keyCode == 13) {
            $("#denglubutton").click();
        }
    })

    $('.zhuce dl .InputUl input').keydown(function(e) {
        if (e.keyCode == 13) {
            $("#zhucebutton").click();
        }
    })

    $('.weixindl').on('click', function() {
        $('.erweima_dl').css({'display': 'block'})
        $('.erweima_dl').animate({left: '0', width: '357px'}, 400);

    })

    $('.zhuce dl dt .erweima_dl .Close3').on('click', function() {
        $('.erweima_dl').css({'display': 'none'})
        $('.erweima_dl').animate({left: '393px', width: '240px'}, 100);
    })

    $('.denglu dl dd ul .dl_weixin').click(function() {
        $('.weixin_img').css({'display': 'block'})
        $('.weixin_img').animate({left: '27px', width: '300px'}, 400);
    })

    $('.denglu dl .weixin_img .Close3').on('click', function() {
        $('.weixin_img').css({'display': 'none'})
        $('.weixin_img').animate({left: '393px', width: '240px'}, 100);
    })

    $('.scjl_click').on('click', function() {
        $(".jlsc_cg").hide();
        $('.mask').show();
        $('.scjl_tc').slideDown();
    })

    $('.scjl_tc .Close4').on('click', function() {
        $('.mask').hide();
        $('.scjl_tc').slideUp();
    })
    $('.ldbq li span i').on('click', function() {
        $(this).parent('span').remove();
    })
    $('.ldbq li span i').on('mouseenter', function() {
        $(this).css({'color': '#000'})
    })
    $('.ldbq li span i').on('mouseleave', function() {
        $(this).css({'color': '#ffffff'})
    })

    $('.ldbq li .myinput').keydown(function(e) {
        if (e.keyCode == 13) {
            var str = $(this).val();
            if (str.trim().length !== 0) {
                $('.ldbq li p').prepend("<span><b>" + str + "</b><i>" + "X" + "</i>" + "</span>").show();
                //$('.ldbq li p').append("<span>"+str+"<i>"+"X"+"</i>"+"</span>").show();
            }
            $(this).val('');
            $('.ldbq li span i').on('click', function() {
                $(this).parent('span').remove();
            })
            $('.ldbq li span i').on('mouseenter', function() {
                $(this).css({'color': '#000'})
            })
            $('.ldbq li span i').on('mouseleave', function() {
                $(this).css({'color': '#ffffff'})
            })
        }
    })




    /*--------------------------------------------------------------------------------*/



    $('.bqli .myinput2').keydown(function(e) {
        if (e.keyCode == 13) {
            var str = $(this).val();
            if (str.trim().length !== 0) {
                $('.bqli p').append("<span><b>" + str + "</b><i>" + "X" + "</i>" + "</span>").show();
            }
            $(this).val('');
        }
        $('.bqli span i').on('click', function() {
            $(this).parent('span').remove();
        })
        $('.bqli span i').on('mouseenter', function() {
            $(this).css({'color': '#000'})
        })
        $('.bqli span i').on('mouseleave', function() {
            $(this).css({'color': '#ffffff'})
        })
    })

    $('.bqli span i').on('click', function() {
        $(this).parent('span').remove();
    })
    $('.bqli span i').on('mouseenter', function() {
        $(this).css({'color': '#000'})
    })
    $('.bqli span i').on('mouseleave', function() {
        $(this).css({'color': '#ffffff'})
    })




    $('.bqli2 span i').on('click', function() {
        $(this).parent('span').remove();
    })
    $('.bqli2 span i').on('mouseenter', function() {
        $(this).css({'color': '#000'})
    })
    $('.bqli2 span i').on('mouseleave', function() {
        $(this).css({'color': '#ffffff'})
    })

    $('.bqli2 .myinput2').keydown(function(e) {
        if (e.keyCode == 13) {
            var str = $(this).val();
            if (str.trim().length !== 0) {
                $('.bqli2 p').append("<span><b>" + str + "</b><i>" + "X" + "</i>" + "</span>").show();
            }
            $(this).val('');
        }
        ;

        $('.bqli2 span i').on('click', function() {
            $(this).parent('span').remove();
        })
        $('.bqli2 span i').on('mouseenter', function() {
            $(this).css({'color': '#000'})
        })
        $('.bqli2 span i').on('mouseleave', function() {
            $(this).css({'color': '#ffffff'})
        })

    })


    $('.bqli3 span i').on('click', function() {
        $(this).parent('span').remove();
    })
    $('.bqli3 span i').on('mouseenter', function() {
        $(this).css({'color': '#000'})
    })
    $('.bqli3 span i').on('mouseleave', function() {
        $(this).css({'color': '#ffffff'})
    })



    $('.bqli3 .myinput2').keydown(function(e) {
        if (e.keyCode == 13) {
            var str = $(this).val();
            if (str.trim().length !== 0) {
                $('.bqli3 p').append("<span><b>" + str + "</b><i>" + "X" + "</i>" + "</span>").show();
            }
            $(this).val('');
        }
        ;
        if (e.keyCode == 8) {
            $('.bqli3 p span:last-child').hide();
        }
        ;
        $('.bqli3 span i').on('click', function() {
            $(this).parent('span').remove();
        })
        $('.bqli3 span i').on('mouseenter', function() {
            $(this).css({'color': '#000'})
        })
        $('.bqli3 span i').on('mouseleave', function() {
            $(this).css({'color': '#ffffff'})
        })
    })

    $('.bqli3 .myinput2').keydown(function(e) {
        if (e.keyCode == 13) {
            var str = $(this).val();
            if (str.trim().length !== 0) {
                $('.bqli3 p').append("<span><b>" + str + "</b><i>" + "X" + "</i>" + "</span>").show();
            }
            $(this).val('');
        }
        ;
        $('.bqli3 span i').on('click', function() {
            $(this).parent('span').remove();
        })
        $('.bqli3 span i').on('mouseenter', function() {
            $(this).css({'color': '#000'})
        })
        $('.bqli3 span i').on('mouseleave', function() {
            $(this).css({'color': '#ffffff'})
        })
    })



})

$(function(){
    $("#sys_window .close").click(function(){
        $("#sys_window").hide();
        $(".mask").hide();
        if($("#locationHref").val()){
            location.href = $("#locationHref").val();
        }
    });
    $("#comWind").click(function(){
        
        if($("#locationHref").val()){
            location.href = $("#locationHref").val();
        }
        $("#sys_window").hide();
          $(".mask").hide();
    });
    
})

function sys_window(content,url){
    if(url){
        $("#locationHref").val(url);
    }
     $("#sys_window").show();
     $(".mask").show();
     $("#sys_content").html(content);
     
}
/*var _hmt = _hmt || [];
 (function() {
 var hm = document.createElement("script");
 hm.src = "//hm.baidu.com/hm.js?6b5d06d4e83133f76550e3d46b5e4f17";
 var s = document.getElementsByTagName("script")[0];
 s.parentNode.insertBefore(hm, s);
 })();*/