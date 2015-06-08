jQuery( document ).ready( function( $ ) {
	var timeout = false,
		browserWidth = $( window ).width();

	var backgroundURLs = [],
		sizes = ['full', 'medium', 'small'],
		background = $( '.background' ),
		bgUrl = '';

	$.each( sizes, function( i, size ) {
		backgroundURLs[size] = ( background.attr( 'data-bg-' + size ) );
	} );

	var setBackground = function() {
		if ( browserWidth <= 480 ) {
			bgUrl = 'url(' + backgroundURLs.small + ')';
		}
		else if ( browserWidth > 480 && browserWidth <= 780 ) {
			bgUrl = 'url(' + backgroundURLs.medium + ')';
		}
		else if ( browserWidth > 780 ) {
			bgUrl = 'url(' + backgroundURLs.full + ')';
		}

		background.css( 'background-image', bgUrl);
	};

	// run once at the beginning
	setBackground();

	// responsive
	$( window ).resize( function(){
		browserWidth = $( window ).width();

		if ( false !== timeout ) {
			clearTimeout( timeout );
		}
		timeout = setTimeout( function() {
			setBackground();
		}, 200);
	} );


	$( '.fancybox' ).fancybox();
	$( 'article' ).each( function() {
		var id = $( this ).attr( 'id' );
		// add fancybox class to any .jpg, .png, .jpeg and .gif file, as well as a rel attribute to denote that it belongs to a certain post
		$( "a[href$='.jpg'], a[href$='.png'], a[href$='.jpeg'], a[href$='.gif']", this ).attr( 'rel', id ).addClass( "fancybox" );
	} );

	$( '.page-gallery' ).bxSlider( {
		moveSlides: 1,
		minSlides: 1,
		maxSlides: 4,
		slideWidth: 150
	} );

	// Facebook
	$( '.fb-button' ).click( function() {
		$( '.fb-like-box' ).toggle(800);
	} );

} );