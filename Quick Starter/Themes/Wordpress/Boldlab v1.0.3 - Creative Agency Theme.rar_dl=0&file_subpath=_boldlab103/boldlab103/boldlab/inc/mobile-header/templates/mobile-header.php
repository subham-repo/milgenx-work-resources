<header id="qodef-page-mobile-header">
	<?php
	// Hook to include additional content before page mobile header inner
	do_action( 'boldlab_action_before_page_mobile_header_inner' );
	?>
	<div id="qodef-page-mobile-header-inner">
		<?php
		// Include module content template
		echo apply_filters( 'boldlab_filter_mobile_header_content_template', boldlab_get_template_part( 'mobile-header', 'templates/mobile-header-content' ) ); ?>
	</div>
	<?php
	// Hook to include additional content after page mobile header inner
	do_action( 'boldlab_action_after_page_mobile_header_inner' );
	?>
</header>