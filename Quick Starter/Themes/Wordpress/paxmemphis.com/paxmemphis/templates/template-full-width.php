<?php
/*
* Template Name: Template Full Width Page
*/
get_header();

?>
<?php get_template_part( 'parts/section', 'title'  ); ?>

<section class="section-full sec-spacing full_content">
	<div class="container">
		<?php the_content(); ?>
	</div>
</section>

<?php get_template_part( 'parts/section', 'get-help'  ); ?>
<?php // get_template_part( 'parts/section', 'faq'  ); ?>
<?php // get_template_part( 'parts/section', 'contact'  ); ?>

<?php get_footer(); ?>