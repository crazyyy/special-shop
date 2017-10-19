var hwSlideSpeed = 1200; /*animation speed slide transition*/
var hwTimeOut = 5000; /*speed of the slide show*/

( function( $ ){
	$( document ).ready( function( e ) {

		/*Pretreatment slider. Set CSS properties, initialize the variable initial values.*/
		$( '.slide' ).css( {"position" : "absolute", "top":'0', "left": '0'} ).hide().eq( 0 ).show();
		$( '.slide:hidden' ).children( ':not( a.slider_link )' ).fadeOut( hwSlideSpeed );/*fix for ie8; selector ':not( a )' need for ie7*/
		var slideNum = 0;
		var slideTime;
		slideCount = $( "#slider .slide" ).size();

		/*create a box with navigation*/
		var $adderSpan = '';
		$( '.slide' ).each( function( index ){
			$adderSpan += '<span class = "control-slide">' + index + '</span>';
		} );
		$( '<div class ="sli-links">' + $adderSpan +'</div>' ).appendTo( '#slider-wrap' );
		$( ".control-slide:first" ).addClass( "active" );
		$( '.control-slide' ).click( function(){
			var goToNum = parseFloat( $( this ).text() );
			animSlide( goToNum );
		} );

		/*block with the logic of the slide show*/
		var pause = false;
		var kingdom_flag = ( $( '#slider .slide' ).length > 1 ); /*variable for check only one slide exist*/
		var rotator = function(){
			if( !pause && kingdom_flag ){slideTime = setTimeout( function(){animSlide( 'next' )}, hwTimeOut );}
		}
		$( '#slider-wrap' ).hover( 
			function(){clearTimeout( slideTime ); pause = true;},
			function(){pause = false; rotator();}
		 );
		if( kingdom_flag ) rotator();

		/*function slide transition*/
		var animSlide = function( arrow ){
			clearTimeout( slideTime );
			$( '.slide' ).eq( slideNum ).children( ':not( a.slider_link )' ).fadeOut( hwSlideSpeed );/*fix for ie8*/
			$( '.slide' ).eq( slideNum ).fadeOut( hwSlideSpeed );
			/*Check the argument. Expected "next" or the serial number of the slide.*/
			if( arrow == "next" ){
				if( slideNum == ( slideCount-1 ) ){
					slideNum=0;
				} else {
					slideNum++;
				}
			} else {
				slideNum = arrow;
			}
			$( '.slide' ).eq( slideNum ).children( ':not( a.slider_link )' ).fadeIn( hwSlideSpeed );/*fix for ie8*/
			$( '.slide' ).eq( slideNum ).fadeIn( hwSlideSpeed, rotator );
			$( ".control-slide.active" ).removeClass( "active" );
			$( '.control-slide' ).eq( slideNum ).addClass( 'active' );
		}
	} );
} )( jQuery );