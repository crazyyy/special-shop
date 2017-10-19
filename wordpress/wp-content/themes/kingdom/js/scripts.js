( function( $ ){
	$( document ).ready( function(){
		
		/*make menu invisible*/
		$( document ).ready( function(){
			$( '#access' ).css( 'visibility', 'hidden' );
			/*move menu-box on the bottom*/
			if(  $( '#access>div>ul' ).outerHeight( true ) < $( '#masthead' ).height()  ) {
				$( '#access' ).addClass( 'access_bottom' );
			}
			/*make menu visible*/
			$( '#access' ).css( 'visibility', 'visible' );
		} );

		/*footer on the bottom*/
		var page_h = $( '#page' ).height();
		if( screen.height > page_h ) {
			var foot = $( '#site-footer' );
			var foot_h = foot.height();
			kingdom_foot();
			$( window ).resize( function(){ kingdom_foot() } );
		}
		function kingdom_foot() {
			var win_h = $( window ).height();	
			if(  win_h > page_h  ) foot.offset( { top: win_h-foot_h } );
		}

		/*input of search value*/
		$( '.searchform .field' ).focus( function() {
			if ( $( this ).val() == this.defaultValue ){
				$( this ).val( '' )
			}
		} );
		$( '.searchform .field' ).blur( function() {
			if ( $( this ).val() == '' ){
				$( this ).val( this.defaultValue );
			}
		} );

		jQuery( window ).load( function(){
			/*remove indent for img with caption*/
			$( '.wp-caption' ).each( function() {
				$( this ).width( $( this ).find( 'img' ).outerWidth( true ) );
			} );

			/*set width caption for gallery*/
			$( '.gallery-item' ).each( function() {
				$( this ).find( 'dd.wp-caption-text' ).width( $( this ).find( 'img' ).width() ).addClass( 'js_gallery-caption' );
			} );
		} );

		/*reset form*/
		$( 'input:reset' ).click( function() {
			var currentForm = $( this ).closest( 'form' );
			currentForm[0].reset();

			currentForm.find( 'span.jq-checkbox, span.jq-radio' ).removeClass( 'checked' );
			var tmp = currentForm.find( 'input:checkbox:checked' );
			tmp.next( "span.jq-checkbox" ).addClass( 'checked' );

			tmp = currentForm.find( 'input:radio:checked' );
			tmp.next( "span.jq-radio" ).addClass( 'checked' );

			currentForm.find( 'div.jq-file__name' ).text( 'Choose file...' );
			currentForm.find( 'span.jq-file__flag' ).text( 'File is not selected.' );

			var selectbox = currentForm.find( 'span.jq-selectbox' );
			selectbox.find( 'li.option' ).removeClass( 'selected' ).removeClass( 'sel' );
			selectbox.each( function() {
				var def_sel = $( this ).prev( 'select' ).find( 'option:selected' );
				$( this ).find( 'div.jq-selectbox__select-text' ).text( def_sel.text() );
				$( this ).find( 'li.option:contains( '+def_sel.text()+' )' ).addClass( "sel selected" );
			} );
		} );

		/*deep depth menu*/
		$( '#access ul ul ul' ).hover( function() {
			var max_width = $( window ).width();
			var left_position = $( this ).offset().left;
			var left_width = parseInt( $( this ).css( 'left' ), 10 );
			var indicator = left_position+left_width;

			if(  indicator<0  ) $( this ).find( 'ul' ).css( {'left': '100%'} );
			else if( indicator+left_width>max_width ) $( this ).find( 'ul' ).css( {'left': '-100%'} );
		} );

		/*initialization formstyler*/
		$( 'input, select' ).styler( {
			browseText: "Choose file..."
		} );

		/*delete empty <p> and <br> from form*/
		$( 'form' ).find( 'p:empty, label+br' ).remove();
		$( 'form' ).find( 'label' ).filter( function(){
			if( $( this ).children( ':checkbox,:radio' ).length == 1 )
				return this;
		} ).addClass( 'wrap_label' );

		/*to fix bug with input[type="file"]*/
		$( 'form' ).find( '.jq-file' ).find( 'input:file' ).css( {'top':'-20px', 'left':'', 'right':'0'} );

		/*for plugin 'Contact Form' and "Fast Secure Contact Form"*/
		$( 'form[id^=cntctfrm], form[id^=si_contact]' ).find( 'input:text, textarea' ).css( 'margin-bottom', '25px' );
	} );
} )( jQuery );