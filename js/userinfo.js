
    function uptel(){
        var tel = $('#tel').val();
        var teltext = $('#teltext');
        var subimg = $('#subimg');
        var userid = $('#userid').val();
        if(!tel){
            teltext.html("<font style='color:#f00'>请输入手机号</font>");
            subimg.attr("disabled",true);
        }else{
            
           var strUrl = "__URL__/telajax/tel/"+tel+"/id/"+userid+"/random/"+Math.random(); 
           
           $.ajax({
			type:"GET",
			url:strUrl,
			dataType:"html",
			success:function(data){
			 if(data == 1){
			    teltext.html("<font style='color:#f00'>手机号已存在</font>");
                subimg.attr("disabled",true); 
			 }else if(data == 2){
                teltext.html("<font style='color:#f00'>正确</font>");
                subimg.attr("disabled",false);  
			 }else{
			     teltext.html("<font style='color:#f00'>错误</font>");
                subimg.attr("disabled",true); 
			 }
               // alert(data);
			//	$("#sonType").val(data);
			}
		}) 
        //-------
        }
        
    }

   function upema(){
        var upemaill = $('#upemaill').val();
        var maltext = $('#maltext');
        var subimg = $('#subimg');
          var userid = $('#userid').val();
        var emaill = "^\\w+((-\\w+)|(\\.\\w+))*\\@[A-Za-z0-9]+((\\.|-)[A-Za-z0-9]+)*\\.[A-Za-z0-9]+$";
        if(!upemaill){
            maltext.html("<font style='color:#f00'>请输入邮箱</font>");
            subimg.attr("disabled",true); 
        }else{
            if(upemaill.match(emaill) == null){
              maltext.html("<font style='color:#f00'>邮箱格式错误</font>");
              subimg.attr("disabled",true);   
            }else{
              var strUrl = "__URL__/telajax/maill/"+upemaill+"/id/"+userid+"/random/"+Math.random();   
               
           $.ajax({
		  	type:"GET",
			url:strUrl,
			dataType:"html",
			success:function(data){
			 if(data == 1){
			    maltext.html("<font style='color:#f00'>邮箱已存在</font>");
                subimg.attr("disabled",true); 
			 }else if(data == 2){
                maltext.html("<font style='color:#f00'>正确</font>");
                subimg.attr("disabled",false);  
			 }else{
			    maltext.html("<font style='color:#f00'>错误</font>");
                subimg.attr("disabled",true);  
			 }
               // alert(data);
			//	$("#sonType").val(data);
			}
		})  
            }
        }
    
   }
   
   function postc(){
       var post = $('#post').val();
       var psottext = $('#psottext');
       var subimg = $('#subimg');
       var postcode = "^\\d{6}$";
        if(post.match(postcode) == null){
            psottext.html("<font style='color:#f00'>邮编错误</font>");
            subimg.attr("disabled",true); 
        }else{
            psottext.html("<font style='color:#f00'>正确</font>");
            subimg.attr("disabled",false);
        }
       
   }
  
  function pass(){
    var pwd = $('#pwd').val();
    var userid = $('#userid').val();
    var pastext = $('#pastext');
    var imsub = $('#imsub');
    if(!pwd){
        pastext.html("<font style='color:#f00'>原密码不能为空</font>");
        imsub.attr("disabled",true); 
    }else{
        var strUrl = "__URL__/telajax/pwd/"+pwd+"/id/"+userid+"/random/"+Math.random();  
         $.ajax({
		  	type:"GET",
			url:strUrl,
			dataType:"html",
			success:function(data){
			
			 if(data == 1){
			    pastext.html("<font style='color:#f00'>正确</font>");
                imsub.attr("disabled",false); 
			 }else if(data == 2){
                pastext.html("<font style='color:#f00'>密码错误请重新输入</font>");
                imsub.attr("disabled",true);  
			 }else{
			    pastext.html("<font style='color:#f00'>错误</font>");
                imsub.attr("disabled",true);  
			 }
               // alert(data);
			//	$("#sonType").val(data);
			}
		})
    }
  } 
 
 function newpss(){
    var newpwd = $('#newpwd').val();
    var newtext = $('#newtext');
    var imsub = $('#imsub');
   
    if(newpwd.length < 6){
       newtext.html("<font style='color:#f00'>密码长度不能少于6个字符</font>");
       imsub.attr("disabled",true);   
    }else{
       newtext.html("<font style='color:#f00'>正确</font>");
       imsub.attr("disabled",false); 
    }
    
 }
 
 function yespss(){
    var yespwd = $('#yespwd').val();
     var newpwd = $('#newpwd').val();
     var imsub = $('#imsub');
     var yestext = $('#yestext');
    if(yespwd == newpwd){
      yestext.html("<font style='color:#f00'>正确</font>");
      imsub.attr("disabled",false);  
    }else{
      yestext.html("<font style='color:#f00'>确认密码和新密码不同</font>");
      imsub.attr("disabled",true); 
    }
 }
 
 function suq(){
    var imsub = $('#imsub');
    var pwd = $('#pwd').val();
    var pastext = $('#pastext');
    
     var newpwd = $('#newpwd').val();
    var newtext = $('#newtext');



    
     var yespwd = $('#yespwd').val();
     var newpwd = $('#newpwd').val();

     var yestext = $('#yestext');
    
      if(!pwd){
        pastext.html("<font style='color:#f00'>原密码不能为空</font>");
        imsub.attr("disabled",true); 
    }else{
        var strUrl = "__URL__/telajax/pwd/"+pwd+"/id/"+userid+"/random/"+Math.random();  
         $.ajax({
		  	type:"GET",
			url:strUrl,
			dataType:"html",
			success:function(data){
			
			 if(data == 1){
			    pastext.html("<font style='color:#f00'>正确</font>");
                imsub.attr("disabled",false); 
			 }else if(data == 2){
                pastext.html("<font style='color:#f00'>密码错误请重新输入</font>");
                imsub.attr("disabled",true);  
			 }else{
			    pastext.html("<font style='color:#f00'>错误</font>");
                imsub.attr("disabled",true);  
			 }
               // alert(data);
			//	$("#sonType").val(data);
			}
		})
    
    }
     
    if(newpwd.length < 6){
       newtext.html("<font style='color:#f00'>密码长度不能少于6个字符</font>");
       imsub.attr("disabled",true);   
    }else{
       newtext.html("<font style='color:#f00'>正确</font>");
       imsub.attr("disabled",false); 
    }
    
    
   
    
    
   
    if(yespwd == newpwd){
        if(newpwd.length < 6){
       newtext.html("<font style='color:#f00'>密码长度不能少于6个字符</font>");
       imsub.attr("disabled",true);   
    }else{
       newtext.html("<font style='color:#f00'>正确</font>");
       imsub.attr("disabled",false); 
    }
       
    }else{
      yestext.html("<font style='color:#f00'>确认密码和新密码不同</font>");
      imsub.attr("disabled",true); 
    }
    
    
 }
 