<?php
// Hook to include additional content before page content holder
do_action( 'boldlab_action_before_page_content_holder' );
?>
<main id="qodef-page-content" class="qodef-grid qodef-layout--template <?php echo esc_attr( boldlab_get_grid_gutter_classes() ); ?>">
	<div class="qodef-grid-inner clear">
		<?php
		// Include blog template
		boldlab_template_part( 'blog', 'templates/blog' );
		
		// Include page content sidebar
		boldlab_template_part( 'sidebar', 'templates/sidebar' );
		?>
	</div>
</main>
<?php
// Hook to include additional content after main page content holder
do_action( 'boldlab_action_after_page_content_holder' );
?>