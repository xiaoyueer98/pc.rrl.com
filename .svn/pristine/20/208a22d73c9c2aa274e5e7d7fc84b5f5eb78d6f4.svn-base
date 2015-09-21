$(function(){

	$('.xuanze,.zw_xuanze,.dq_xuanze').click(function(){

		$('div.libao').hide();

		$(this).next('div').show();

		})

	

//点击行业，显示子类		



    $('.tuanchu1,.tuanchu2,.tuanchu3').children('dl').children('dt').next().css('display','none');



	$('.tuanchu1 dl dt,.tuanchu2 dl dt,.tuanchu3 dl dt').click(function(){

		if($(this).next('dd').css('display')=='none'){

		$(this).next('dd').show();
		$(this).parent('dl').css('z-index','55').siblings('dl').css('z-index','22');

		$(this).parent('dl').siblings().children('dd').hide();

		}else{

		$(this).next('dd').hide();	

			}

	     })

		 

		$('.libaob dl dt').click(function(){

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

		  $('.dq_xuanze').val($title);

		  

		})			

		$('.qued,.qux').click(function(){

			$(this).parent().parent('div').hide();

		})	




		$("input.anglue").click(function(){

		$(this).siblings(".kongb").show();	

			})


   

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

