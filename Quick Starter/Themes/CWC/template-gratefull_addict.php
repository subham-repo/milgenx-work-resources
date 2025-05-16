<?php 
	/*
		Template Name: Template For Letter
	*/
	get_header();
?>

<section id="inner_page_body">
	<div class="all_inner_page">
		<?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		<!--Featured Image section goes here-->
		<?php // echo do_shortcode('[inner-title]'); ?>
		<!--Featured Image section ends here-->

		<!--inner_page Posts section goes here-->
		
		<div class="inner_page_inner_sec for_letter full-width" style="background-image: url(<?php echo $feat_image ; ?>);">
			<div class="container">
				<h1 class="letter_title"><?php the_title(); ?></h1>
				<div class="row">
					<div class="for_letter_warpper full-width col-md-12">
							<div class="full-width text-right">
								<span class="letter_date">March 8, 2018</span>
							</div>
							<?php the_content(); ?>
					</div>
				</div>		
			</div>
		</div>
		
		<!--inner_page Posts section ends here-->
	</div>
</section>

<?php 
	get_footer();
?>