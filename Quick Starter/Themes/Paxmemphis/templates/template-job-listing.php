<?php
/*
* Template Name: Template Job Listing
*/
get_header();

$feat_url = get_the_post_thumbnail_url();

?>
<?php get_template_part( 'parts/section', 'title'  ); ?>

<section class="job_listing-section section-full sec-spacing">
	<div class="container">
		<div class="row">
			<?php echo do_shortcode('[jobpost]'); ?>
		</div>
	</div>
</section>

<?php get_template_part( 'parts/section', 'get-help'  ); ?>
<?php // get_template_part( 'parts/section', 'faq'  ); ?>
<?php // get_template_part( 'parts/section', 'contact'  ); ?>

<?php get_footer(); ?>