<div class="qodef-page-title qodef-m <?php echo esc_attr( boldlab_get_page_title_classes() ); ?>">
	<?php
	// Hook to include additional content before page title inner
	do_action( 'boldlab_action_before_page_title_inner' );
	?>
	<div class="qodef-m-inner">
		<?php
		// Include module content template
		echo apply_filters( 'boldlab_filter_title_content_template', boldlab_get_template_part( 'title', 'templates/title-content' ) ); ?>
	</div>
	<?php
	// Hook to include additional content after page title inner
	do_action( 'boldlab_action_after_page_title_inner' );
	?>
</div>