/*
 * Custom v1.0
 * ThemeCot.com
 *
 * Copyright (c) 2013-2014 ThemeCot.com
 *
 * License: GNU General Public License v2 or later
 * http://www.gnu.org/licenses/gpl-2.0.html
 *
 */

( function( $ ) {

	var keratin = {

		// Menu
		menuInit: function() {

			// Superfish Menu
			$( 'ul.sf-menu' ).superfish({
				delay: 			1200,
				animation: 		{ opacity : 'show', height : 'show' },
				speed: 			'fast',
				autoArrows: 	false,
				cssArrows: 		true
			});

		},

		// Masonry
		masonryInit: function() {

			var masonry_wrapper = $( '.masonry-wrapper' );

			masonry_wrapper.imagesLoaded( function() {

				masonry_wrapper.masonry( {
					columnWidth: 1,
					itemSelector: '.hentry',
					transitionDuration: 0
				} );

				// Show the blocks
				$( '.masonry-spinner' ).fadeOut( 250, function() {
					$( this ).remove();
				} );
				$( '.masonry-wrapper .hentry' ).delay( 500 ).animate( {
					'opacity' : 1
				}, 250 );

			} );

		},

		// CSS3 Animation
		animationInit: function() {

			// Normal State
			$( '.img-featured' ).addClass( 'img-zoom-out' );

			// On Hover
			$( '.img-featured' ).hover(
				function() {
					$( this ).addClass( 'img-zoom-in' );
				}, function() {
					$( this ).removeClass( 'img-zoom-in' );
				}
			);

		},

		// Fitvids
		fitvidsInit: function() {

			// Fitvids - For responsive videos
			setTimeout( function() {
				$( '.entry-content' ).fitVids();
			}, 500 );

		}

	}

	/** Document Ready */
	$( document ).ready( function() {

		// Menu
		keratin.menuInit();

		// Masonry
		keratin.masonryInit();

		// CSS3 Animation
		keratin.animationInit();

		// Fitvids - For responsive videos
		keratin.fitvidsInit();

	} );

} )( jQuery );