$(function(){
	$('.xuanze,.zw_xuanze,.dq_xuanzekk').click(function(){
		$('div.libao').hide();
		$(this).next('div').show();
		})
	
	
//点击行业，显示子类		

    $('.tuanchu1,.tuanchu2,.tuanchu3').children('dl').children('dt').next().css('display','none');

	$('.tuanchu1 dl dt,.tuanchu2 dl dt,.tuanchu3 dl dt').click(function(){
		if($(this).next('dd').css('display')=='none'){
		$(this).next('dd').show();
		$(this).parent('dl').siblings().children('dd').hide();
		}else{
		$(this).next('dd').hide();	
			}
	     })
		 
		$('.libao dl dt').click(function(){
		   $(this).parent().siblings('dl').children('dd').children('div').children('input').prop('checked',false);
	     })
		 
		 
		 
	
	$('.tuanchu1 .xiaoshi,.tuanchu2 .xiaoshi,.tuanchu3 .xiaoshi').click(function(){
		$(this).parent().parent('dd').hide();	
	})
	
	
	
	 $('.tuanchu1 .qued').click(function(){
			  var $val=$('.tuanchu1 dd input:checked').map(function() {
			   return this.value;  
			  }).get().join('+');		
		  $('.xuanze_val').val($val);
		  
		  var $title=$('.tuanchu1 dd input:checked').map(function() {
			   return $(this).next('span').text();  
			  }).get().join('+');		
		  $('.xuanze').val($title);	
				})
				
	 $('.tuanchu2 .qued').click(function(){
			  var $val=$('.tuanchu2 dd input:checked').map(function() {
			   return this.value;  
			  }).get().join('+');		
		  $('.zw_xuanze_val').val($val);
		  
		  var $title=$('.tuanchu2 dd input:checked').map(function() {
			   return $(this).next('span').text();  
			  }).get().join('+');		
		  $('.zw_xuanze').val($title);	
				})			
		$('.qued,.qux').click(function(){
			$(this).parent().parent('div').hide();
		})		
		//地区选择
///****************2014.9.25改**************************///
        	$('.tuanchu1 dd input,.tuanchu2 dd input,.tuanchu3 dd input').click(function(){
				
				if($(this).parent('div').index()==0 && $(this).prop('checked')==true){
				   $(this).parent('div').siblings().children('input').prop('checked',false);
					}
				if($(this).parent('div').index()!=0 && $(this).prop('checked')==true){
					$(this).parent('div').siblings().eq(0).children('input').prop('checked',false);
					}
				})
///***********************************************************///				
		$('.tuanchu3 .qued').click(function(){
			
			 var $val=$('.tuanchu3 dd input:checked').map(function() {
			   return this.value;  
			  }).get().join('+');		
		  $('.dq_xuanze_val').val($val);
		  
		  var $title=$('.tuanchu3 dd input:checked').map(function() {
			   return $(this).next('span').text();  
			  }).get().join('+');		
		  $('.dq_xuanzekk').val($title);
		  
		})			
		$('.qued,.qux').click(function(){
			$(this).parent().parent('div').hide();
		})	

	///***********************************************************///

		$('.tuanchu1 .buxian').click(function(){
			   $('.xuanze_val').val('');
			   $('.xuanze').val('不限');
			})
		$('.tuanchu2 .buxian').click(function(){
			    $('.zw_xuanze_val').val('');
				$('.zw_xuanze').val('不限');
			})
		$('.tuanchu3 .buxian').click(function(){
			   $('.dq_xuanze_val').val('');
			   $('.dq_xuanzekk').val('不限');
			})
	
	    $('.tuanchu1 .buxian,.tuanchu2 .buxian,.tuanchu3 .buxian').click(function(){
			$(this).parent().parent().hide();
			})
	
	
	
	
				
	})


$(function(){
	$(".login div.ffw").click(function(){
		$(this).addClass('hovv').siblings('.ffw').removeClass('hovv');
		$(".login form").eq($(this).index()).show().siblings("form").hide();
		})
	$(".yeji").focus(function(){
		     if($(this).val()=="请详细填写项目描述、职责以及创造的项目业绩。"){
				$(this).val("");
				 }
		})
	$(".yeji").focusout(function(){
			if($(this).val()==""){
			$(this).val("请详细填写项目描述、职责以及创造的项目业绩。")	
				}else{
				$(this).val()=$(this).val();
					 }
			})	
    $(".zhiwei .title span").click(function(){
		$(this).addClass("addd").siblings("span").removeClass("addd");
		$(".zhiwei_con").eq($(this).index()).show().siblings(".zhiwei_con").hide();
		})
	$("input.jiaoyuyu").click(function(){
		$(".tijiaobiaodan").show();
		})
	/*$("input.baocun").click(function(){
		$(".tijiaobiaodan").hide();
		})*/
	$("input.hehe").click(function(){
		$(this).siblings(".yinc").show();	
			})
//	 $("input.baobao").click(function(){
//		$(".yinc").hide();
//		})
		$("input.anglue").click(function(){
		$(this).siblings(".kongb").show();	
			})
//	 $("input.baby").click(function(){
//		$(".kongb").hide();
//		})

//点击修改
   
   
   //被推荐人显示与隐藏
   $("a.laster").click(function(){
	   if($(".yaoyincang").css("display")=="none"){
		   $(".yaoyincang").css("display","block");
		   $(".tijia_s").hide();
		   }else{
			$(".yaoyincang").css("display","none");  
			$(".tijia_s").show(); 
			   }
	   })

})
function xg(){
	$(".tijiaobiaodan").show();
		
}	


/* 删除教育经历 */
function ajaxFunction(d,jid,c){

	var _this=c;
	$.ajax({

		type:"GET",

		url:"resume_do.php?action=del&jid="+jid+"&id="+d,

		success:function(data){

			$(_this).parent().parent().remove();
		}

	})
}

//修改教育经历

function eduedit(id,j_id,idname){
	$.ajax({
		url : "resume_do.php?a=edit&j_id="+j_id+"&id="+id,
		type:'get',
		dataType:'html',
		success:function(data){
			$('#'+idname).html(data);
		}
	});
}

//修改工作经历

function yinc(id,j_id,idname){
	$.ajax({
		url : "resume_do.php?a=yinc&j_id="+j_id+"&id="+id,
		type:'get',
		dataType:'html',
		success:function(data){
			$('#'+idname).html(data);
		}
	});
}

/* 删除工作经历 */
function delyinc(d,jid,c){

	var _this=c;
	$.ajax({

		type:"GET",

		url:"resume_do.php?action=w_del&jid="+jid+"&id="+d,

		success:function(data){

			$(_this).parent().parent().remove();
		}

	})
}

//修改资质证书

function kongb(id,j_id,idname){
	$.ajax({
		url : "resume_do.php?a=kongb&j_id="+j_id+"&id="+id,
		type:'get',
		dataType:'html',
		success:function(data){
			$('#'+idname).html(data);
		}
	});
}

/* 删除资质证书 */
function delkon(d,jid,c){

	var _this=c;
	$.ajax({

		type:"GET",

		url:"resume_do.php?action=ca_del&jid="+jid+"&id="+d,

		success:function(data){

			$(_this).parent().parent().remove();
		}

	})
}

//收藏职位
function AddUserFavorite()
{
	var aid   = $("#aid").val();
	var uname   = $("#uname").val();
	
	$.ajax({
		url : "member.php",
		type: "post",
		data:{"a":"savefavorite","model":"member","aid":aid,"uname":uname},
		dataType:'html',
		success:function(data){
			if(data == 1){
				alert("收藏成功！");
				return;
			}
			else if(data == 2){
				alert("亲，您已经收藏过该文章！");
				return;
			}
			else{
				alert("收藏失败！");
				return;
			}
		}
	});
}
//删除收藏职位
function delFavorite()
{
	var fid   = $("#fid").val();
	var uname   = $("#uname").val();
	$.ajax({
		url : "member.php",
		type: "post",
		data:{"a":"delfavorite","model":"member","fid":fid,"uname":uname},
		dataType:'html',
		success:function(data){
			if(data == 1){
				alert("收藏删除成功！");
				window.location.href="favorite.php";
			}
			else if(data == 2){
				alert("收藏删除失败！");
				window.location.href="favorite.php";
				return;
			}else{
				alert("收藏删除失败！");
				return;
			}
		}
	});
}



function delexper(id,uid){
	
	$.ajax({
		url : "member.php",
		type: "post",
		data:{"a":"delexper","model":"member","id":id,"uid":uid},
		dataType:'html',
		success:function(data){
			if(data == 1){
				alert("删除成功！");
				window.location.href="exper.php";
			}
			else if(data == 2){
				alert("删除失败！");
				window.location.href="exper.php";
				return;
			}else{
				alert("删除失败！");
				return;
			}
		}
	})
}