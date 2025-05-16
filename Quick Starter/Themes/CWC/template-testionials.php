<?php 
	/*
		Template Name: Template Client Testimonial
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
		<div class="featured_testimonia full-width section-spacing">
			<?php 
			$featured_testimonial = get_field('featured_testimonial');
			$featured_name		  = $featured_testimonial['name'];
			$featured_words		  = $featured_testimonial['client_words'];
			$featured_link		  = $featured_testimonial['video_link'];
			?>
			<div class="container">
				<div class="row">
					<div class="col-md-5 col-sm-12 col-xs-12 featured_testimonial-texts text-center">
						<h2>"<?php echo $featured_words; ?>" - <?php echo $featured_name; ?></h2>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12 featured_testimonial-video">
						<iframe width="100%" height="422" src="https://www.youtube.com/embed/<?php echo $featured_link; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</div>

		<div class="video_testimonial full-width section-spacing">
			<div class="container">
				<div class="row">

					<?php

					// check if the repeater field has rows of data
					if( have_rows('video_testimonial') ):

					 	// loop through the rows of data
					    while ( have_rows('video_testimonial') ) : the_row(); ?>

					        <!-- // display a sub field value -->
					        
					        <div class="col-md-4 col-sm-6 col-xs-12 video_testimonial_catalog">
								<div class="vid_testi_inner full-width">
									<iframe width="100%" height="240" src="https://www.youtube.com/embed/<?php the_sub_field('video_link'); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
									<h2><?php the_sub_field('name'); ?></h2>
								</div>
							</div>
					   <?php endwhile;

					else :

					    echo "No Videos Found";

					endif;

					?>
					
				</div>
			</div>
		</div>

		<div class="inner_page_inner_sec">
			<div class="container">
				<div class="row">
					<?php
					$query = array(
					    'orderby' => 'menu_order',
					    'order' => 'ASC',
					    'post_status' => 'publish',
						'post_type' => 'testimonial',
						'posts_per_page' => -1
					);
					$posts = get_posts( $query );
					// echo "<pre>";
					// print_r($posts);
					// echo "</pre>";
					if( ! empty( $posts ) ) {
					     echo '<div class="testimonial_wrapper full-width section-spacing">';
					     foreach( $posts as $post ) { 
					     $id = get_the_ID();
					     ?>
					      <div class="testimonial_catalog col-md-10 col-sm-6 col-xs-12">
					      	<div class="testimonial_catalog_inner full-width">
					      		<div class="col-md-5 col-sm-12 col-xs-12 testi_image">
					      			<img class="testi_thumb" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?> /">
					      		</div>
					      		<div class="col-md-7 col-sm-12 col-xs-12 testi_content">
					      			<div class="testi_contet-inner">
										<p><?php echo $post->post_content; ?></p>
										<h4><i>- <?php the_title(); ?></i></h4>
					      			</div>
					      		</div>
					      	</div>
					      </div>    
					    <?php }
					    echo '</div>';
					} ?>
				</div>		
			</div>
		</div>
		
		<!--inner_page Posts section ends here-->
	</div>
</section>

<?php 
	get_footer();
?>