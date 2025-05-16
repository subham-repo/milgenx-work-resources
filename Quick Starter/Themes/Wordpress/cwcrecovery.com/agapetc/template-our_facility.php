<?php 
	/*
		Template Name: Template Our Facility
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
				<div class="row">
					<div class="our-facility full-width col-md-12">
						<div class="our_facility-heaading full-width text-center">
							<h2>Our Rehab Facility in Lantana</h2>
							<?php the_content(); ?>
						</div>

						<div class="our_facility-tour full-width">
							<?php

							// check if the repeater field has rows of data
							if( have_rows('our_facility_image') ):

							 	// loop through the rows of data
							    while ( have_rows('our_facility_image') ) : the_row();

							        // display a sub field value
							       ?>
							       <div class="facility_images full-width">
								       	<a data-fancybox="gallery" href="<?php  the_sub_field('images'); ?>" class="full-width">
								       		<img src="<?php  the_sub_field('images'); ?>" alt="facility_img" />
								       	</a>
							       </div>
							       <?php

							    endwhile;

							else :

							    // no rows found

							endif;

							?>
						</div>

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