<?php
// Hook to include additional content before page header
do_action( 'boldlab_action_before_page_header' );
?>
<header id="qodef-page-header">
	<?php
	// Hook to include additional content before page header inner
	do_action( 'boldlab_action_before_page_header_inner' );
	?>
	<div id="qodef-page-header-inner" <?php boldlab_class_attribute( apply_filters( 'boldlab_filter_header_inner_class', '' ) ); ?>>
		<?php
		// Include module content template
		echo apply_filters( 'boldlab_filter_header_content_template', boldlab_get_template_part( 'header', 'templates/header-content' ) ); ?>
	</div>
	<?php
	// Hook to include additional content after page header inner
	do_action( 'boldlab_action_after_page_header_inner' );
	?>
</header>