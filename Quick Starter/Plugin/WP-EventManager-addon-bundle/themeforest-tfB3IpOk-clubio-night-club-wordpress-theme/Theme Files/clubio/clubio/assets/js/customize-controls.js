/**
 * Scripts within the customizer controls window.
 *
 * Contextually shows the color hue control and informs the preview
 * when users open or close the front page sections section.
 */

(function() {
    "use strict";

    wp.customize.bind( 'ready', function() {

		wp.customize( 'colorscheme', function( setting ) {
			wp.customize.control( 'colorscheme_hue', function( control ) {
				var visibility = function() {
					if ( 'custom' === setting.get() ) {
						control.container.slideDown( 180 );
					} else {
						control.container.slideUp( 180 );
					}
				};

				visibility();
				setting.bind( visibility );
			});
		});

		wp.customize.section( 'theme_options', function( section ) {
            section.expanded.bind( function( isExpanding ) {

                wp.customize.previewer.send( 'section-highlight', { expanded: isExpanding });
			} );
		} );
	});
})( jQuery );
