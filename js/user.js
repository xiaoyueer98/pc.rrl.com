/** 
 *  @user  用户相关的JS
 *
 */
;(function($){

    $.user={
    
        //注册
         register_form: function(form){
          
            //验证
            $.formValidator.initConfig({formid:'reg_form',autotip:true});
          
            $('#txtsfnum').formValidator({onshow:'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;如有英文字母，需大写,登录和就诊的凭证，证件号码须与姓名一致 ',onfocus: '输入15或18位的身份证',oncorrect:'正确'}).functionValidator({fun:isCardID})
            
            .ajaxValidator({
                type: 'get',
                url: GH.root + '/?m=user&a=ajax_check',
                data: 'type=health',
                datatype: 'json',
                async:'false',
                success: function(result){
                    return result.status == '1' ? !0 : !1;
                },
                buttons: $('#reg_submit'),
                onerror: '身份证已存在',
                onwait : '稍等..'
            });
            $('#txtpassword').formValidator({onshow:'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;密码要求由英文字母 、阿拉伯数字,组成且长度为6-12位字符 ',onfocus:'正在输入', oncorrect: '正确'})
            .inputValidator({min:1,empty:{leftempty:false,rightempty:false,emptyerror:"密码两边不能有空符号"},onerror:"密码不能为空,请确认"});

            $('#txtpasswordre').formValidator({onshow:'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;请与上次密码输入一致',onfocus:'正在输入', oncorrect: '密码一致'})
            .inputValidator({min:6,onerror:'密码最少6个字符'})
            .compareValidator({desid:'txtpassword',operateor:'=',onerror:'两次密码不一致'});
			
             $('#txtname').formValidator({onshow:'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;请输入用户昵称',onfocus:'正在输入……', oncorrect: '正确'})
			.regexValidator({regexp:'ps_username',datatype:'enum',onerror:'用户昵称格式错误'})
            .inputValidator({min:3,onerror:'用户昵称不合法'});
			
            $('#txtrealname').formValidator({onshow:'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;患者姓名需与身份证一致，若有误造成挂号问题，概不负责。 ',onfocus:'正在输入……', oncorrect: '正确'})
			.inputValidator({min:1,onerror:'用户名不合法'})
            .regexValidator({regexp:'ps_username',datatype:'enum',onerror:'用户名格式错误'});
             $("#txtphonenum").formValidator({onshow:"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;务必填写真实手机号，建议使用移动的号码",oncorrect:"正确"})
            .inputValidator({min:11,max:11,onerror:"手机号码必须是11位的,请确认"}).regexValidator({regexp:"mobile",datatype:"enum",onerror:"你输入的手机号码格式不正确"});
              $('#txtemail1').formValidator({onshow:'请留下您的电子邮件地址，我们将把挂号确认信息以及通知提醒发到你邮箱',onfocus:'请输入邮箱', oncorrect: '正确'})
            .inputValidator({min:1,onerror:'邮箱不能为空'})
            .regexValidator({regexp:'email',datatype:'enum',onerror:'邮箱格式错误'})
            .ajaxValidator({
                type: 'get',
                url: GH.root + '/?m=user&a=ajax_check',
                data: 'type=email',
                datatype: 'json',
                async:'false',
                success: function(result){
                    return result.status == '1' ? !0 : !1;
                },
                buttons: $('#reg_submit'),
                onerror: '邮箱已存在',
                onwait : '稍等..'
            });
           
        } ,
        login_validate: function(form){
            //验证
            $.formValidator.initConfig({formid:'log_form',autotip:true});
            form.find('#healthid').formValidator({onshow:' *输入身份证号码*', onfocus:'请输入身份证号', oncorrect: '正确'}).functionValidator({fun:isCardID});
            form.find('#password').formValidator({onshow:' *输入密码*', onfocus:'请输入密码', oncorrect: '完成'}).inputValidator({min:1,onerror:'请输入密码'});
        }
    
    
    
    
    
    };












})(jQuery);
