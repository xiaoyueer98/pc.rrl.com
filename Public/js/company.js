//验证form表单并且提交
function checkCompanyBaseInfo(){
    var cpname = $("#cpname").val();
    var nature = $("#nature option:selected").val();
    var scale = $("#scale  option:selected").val();
    var stage = $("#stage  option:selected").val();
    var comlogo = $("#comlogo").val();
    var licence = $("#licence").val();
    var username = $("#username").val();
    var isnew = $("#isnew").val();
    var webname = $("#webname").val();
    var lUrl = $("#lUrl").val();
    var contract = $("#contract").val();
    if(!cpname){
        $('.error2').html("请输入公司名称！");
        $('.error2').show();
        return false;
    }
    
    if(cpname.length<5){
        $('.error2').html("公司名称不合法");
        $('.error2').show();
        return false;
    }
    
   
    if(nature == "请选择"){
        $('.error2').html("请选择公司性质！");
        $('.error2').show();
        return false;
    }
    if(scale == "请选择"){
        $('.error2').html("请选择公司规模！");
        $('.error2').show();
        return false;
    }
    if(stage == "请选择"){
        $('.error2').html("请选择公司阶段！");
        $('.error2').show();
        return false;
    }
    if(cpname.length>100 || cpname.length<3){
        $('.error2').html("公司名称不合法");
        $('.error2').show();
        return false;
    }
    /*
    if(!webname){
        $('.error2').html("请填写公司网址");
        $('.error2').show();
        return false;
    }
    */
   /*
    if(!comlogo){
        $('.error2').html("请在右侧上传企业logo");
        $('.error2').show();
        return false;
    }
    
    if(!licence && isnew == "yes"){
        $('.error2').html("请上传营业执照!");
        $('.error2').show();
        return false;
    }
*/
    $("#submitBaseInfo").ajaxSubmit({  
        type: 'post',  
        dataType:"json",
        url: "/Home/Company/saveCompanyBaseInfo.html" ,  
        success: function(data){  
            $.post("/Home/Company/getCompanyBaseInfo.html",{
                'username':username
            },function (data){
                $("#cpnamed").html(data.cpname);
                $("#webnamed").html(data.webname);
                $("#naturedata").html(data.naturedata);
                $("#scaledata").html(data.scaledata);
                $("#stagedata").html(data.stagedata);
                $("#brightregdata").html(data.brightregdata);
                $("#webnamedata").html(data.webname);
                $('#loginfoss').attr("src",data.comlogo);
                //如果上传了营业执照
                if(data.licence){
                    $("#l1 img").attr("src",data.licence);
                    $("#l1").show();
                    $("#l2").hide();
                }else{
                    $("#l2").show();
                    $("#l1").hide();
                }
                if(data.contract){
                    $("#yhetong").html('<a href="'+data.contract+'"> 我的合同</a>');
                  
                }else{
                    $("#yhetong").html('未上传');
                }
                $(".Ent1").hide();
                $(".Ent2").show();
            },"json")
                       
            return false;
        },  
        error: function(XmlHttpRequest, textStatus, errorThrown){  
             $("#cpnamed").html(data.cpname);
                $("#webnamed").html(data.webname);
                $("#naturedata").html(data.naturedata);
                $("#scaledata").html(data.scaledata);
                $("#stagedata").html(data.stagedata);
                $("#brightregdata").html(data.brightregdata);
                $("#webnamedata").html(data.webname);
                $('#loginfoss').attr("src",data.comlogo);
                $(".Ent1").hide();
                $(".Ent2").show();
        }  
    }); 
    return false;
}
function uploadLicence(){
     $('#er').html("已上传营业执照");
     $('#er').show();
}
$(function (){
    //var cpname = $("#cpname").val();
    $(".Enterxg").click(function(){
        $.post("/Home/Company/getCompanyBaseInfo.html",{},function (data){
            $("#cpname").val(data.cpname);
            $("#nature option").each(function(){
                    
                if($(this).val() == data.nature){
                    $(this).attr("selected","selected");
                }
            });
            $("#scale option").each(function(){
                    
                if($(this).val() == data.scale){
                    $(this).attr("selected","selected");
                }
            });
            $("#stage option").each(function(){
                if($(this).val() == data.stage){
                    $(this).attr("selected","selected");
                }
            });
            $("#date").val(data.brightregdata);
            /*
            if(data.licence){
                $(".lasty").hide();
            }
            */
             $("#webname").val(data.webname);
             $("#isnew").val("no");
             if(data.checklogo == 1 && data.comlogo !=""){
                  $("#preview").show();
             }
             
             if(data.checkcontract == 1 && data.contract !=""){
                 $(".hetong").hide();
                $("#fanben").hide();
                $("#ldiv").hide();
                $("#ldiv3").show();
             }
             if(data.checklicence == 1 && data.licence !=""){
                $(".zhizhao").hide();
                $("#ldiv2").show();
             }
             return ;
             
             if(data.checklogo == "1" && data.licence !=""){
                 $("#licence1").show();
                 $("#licence2").hide();
             }
             if(data.checklogo == "1" && data.comlogo !=""){
                 $("#preview").show();
                 $("#licence2").hide();
             }
               
        },"json")
        
        
        $(".Ent1").show();
        $(".Ent2").hide();
    });
})
//公司介绍





