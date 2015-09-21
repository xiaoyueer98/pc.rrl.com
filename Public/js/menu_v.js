/*
 * JS,JQ代码作者：陆荣涛
 * 详细算法思路与程序编写步骤请详见：http://edu.51cto.com/course/course_id-1138.html
 */
$( document ).ready( function(e){

	var $catCont = $( ".cat-cont" );
	var $catList = $( ".J_Cat" );

	$catList.on( "mouseenter", function(){
		var index = $( this ).index();
		var $curCatList = $( ".cat-cont-bd>li:eq(" + index + ")" );

		$catList.removeClass( "selected selected-prev" );

		$( this ).addClass( "selected" ).prev().addClass( "selected-prev" );

		$catCont.show();

		$curCatList.css( "display", "list-item").siblings().css( "display", "none" );

		var viewHeight = $( window ).height();
		var catOffsetTop = $( this ).offset().top - $( window ).scrollTop();
		var catBottomGap = viewHeight - catOffsetTop;

		var catPositionTop = $( this ).position().top;

		var catContHeight = $catCont.height();

		if( catBottomGap >= catContHeight ) {
			$catCont.css( "top", catPositionTop );
		}
		if( catBottomGap < catContHeight && viewHeight >= catContHeight ) {
			$catCont.css( "top", catPositionTop - ( catContHeight - catBottomGap ) - 20 );
		}
		if( catBottomGap < catContHeight && viewHeight < catContHeight ) {
			$catCont.css( "top", catPositionTop );
		}
		if( catBottomGap <= 66 ) {
			$catCont.css( "top", catPositionTop - catContHeight + 33 );
		}

	}).on( "mouseleave", function( event ){
		if( !$( event.relatedTarget ).hasClass( "cat-cont-bd" ) ){
			$( this ).removeClass( "selected selected-prev" );
			$catCont.hide();
		}
	});

	$catCont.on( "mouseleave", function(){
		$catCont.hide();
		$catList.removeClass( "selected selected-prev" );
	});
});