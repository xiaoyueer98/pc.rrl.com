
/*
    兼容ie,placeholder;
 * author：赵元瑞
 * e-mail：zyr_9970@163.com
 * 我不希望有人私自改动我的注释以及代码
 * QQ:844969129
 * 版本：v1.0
 * */

$(function(){
    jQuery(function(){

        $('.sfq dt').hide().parent().eq(1).children("dt").show();
        $('.sfq dd').click(function(){

            if($(this).hasClass('high2')){
                $(this).removeClass("high2");
                $(this).addClass("high1");
                $(this).parent().children("dt").slideUp(200);

            }else{
                $(this).removeClass("high1");
                $(this).addClass("high2");
                $('dt').hide();
                $(this).parent().children("dt").slideDown(200);
                /*$(this).parent().siblings().children("dt").slideUp(200);*/
                $(this).parent().siblings().children("dd").removeClass("high2").addClass("high1");
                /*$(this).parent().siblings().children("dd").addClass("high1");*/
            }




        })

        $('.btn').click(function(){


            $('.box .one~a').css({background:"#f60"});


        })


    });


});

