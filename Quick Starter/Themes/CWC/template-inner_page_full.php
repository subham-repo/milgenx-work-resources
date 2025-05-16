<?php 
	/*
		Template Name: Template Inner Full Width
	*/
	get_header();
?>

<section id="inner_page_body">
	<div class="all_inner_page">
		<?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		<!--Featured Image section goes here-->
		
		<?php echo do_shortcode('[inner-title]'); ?>
		
		<!--Featured Image section ends here-->

		<!--inner_page Posts section goes here-->
		<div class="inner_page_inner_sec full-width">
			<div class="container">
				<div class="uk-grid-collapse uk-grid row">
					<!--inner_page Left Side goes here-->
						<div class="full-width inner_page_left">
							<div class="uk-grid-collapse uk-grid inner_page_card">
								<div class="uk-width-1-1 inner_page_data">
									<?php if ( have_posts() ) : ?>
										<?php while ( have_posts() ) : the_post(); ?>    
										
										<?php echo the_content(); ?>

										<?php endwhile; ?>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<!--inner_page Left Side ends here-->

					
				</div>		
			</div>
		</div>
		
		<!--inner_page Posts section ends here-->
	</div>
</section>

<?php 
	get_footer();
?>