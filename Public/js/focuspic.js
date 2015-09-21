$( document ).ready( function(e){
	var index = 1;
	var timer = null;

	var $nav = $( ".promo-nav li" );
	var $view = $( ".promo" );
	var $handle = $( ".promo-opt" );
	var $pipe = $( ".promo-bd>div" );

	var $firstPipeItem = $( ".promo-bd>div>div" ).first();
	var $lastPipeItem = $( ".promo-bd>div>div" ).last();
	$firstPipeItem.clone( true ).appendTo( $pipe );
	$lastPipeItem.clone( true ).prependTo( $pipe );



	var $pipeItem = $( ".promo-bd>div>div" );
	var imgWidth = 610;
	$pipe.width( $pipeItem.length * imgWidth );

	function slide( i ){
		if( i === 0 ){
			setNavFocus( $nav.eq( 4 ) );
		}else if( i === $pipeItem.length - 1 ){
			setNavFocus( $nav.eq( 0 ) );
		}else{
			setNavFocus( $nav.eq( i - 1 ) );
		}
		$pipe.animate( {left: -i * imgWidth}, 200, function(){
			if( i === 0 ){
				$pipe.css( "left", ( $pipeItem.length - 2 ) * -imgWidth );
				index = $pipeItem.length - 2;
			}else if( i === $pipeItem.length - 1 ){
				$pipe.css( "left", -imgWidth );
				index = 1;
			}
		});
	}


	function setNavFocus( $obj ){
		$obj.addClass( "selected" ).siblings().removeClass( "selected" );
	}

	$nav.on( "click", function(){
		var i = $( this ).index() + 1;
		slide( i );
		index = i;
	});

	$view.on( "mouseover", function(){
		$handle.show();
		clearInterval( timer );
	})
	.on("mouseout", function(){
		$handle.hide();
		setTimer();
	});

	$( ".prev" ).on( "click", function(){
		if( !$pipe.is( ":animated" ) ){
			slide( --index );
		}
	});

	$( ".next" ).on( "click", function(){
		if( !$pipe.is( ":animated" ) ){
			slide( ++index );
		}
	});

	function setTimer(){
		timer = setInterval( function(){
			$( ".next" ).trigger( "click" );
		}, 3500 );
	}
	setTimer();

});