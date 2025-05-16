<?php 
	/*
		Template Name: Template Verify Insuranse
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
						<div class="uk-width-3-4@l uk-width-3-4@m uk-width-1-1@s inner_page_left">
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

					<!--inner_page Right Side goes here-->
						<div class="uk-width-1-4@l uk-width-1-4@m uk-width-1-1@s inner_page_right">
							<div class="uk-grid-collapse uk-grid">
								<div class="uk-width-1-1">
									<div class="blog_logo">
										<img src="<?php echo $header_logo; ?>">
										
										<div id="inner_pageus-contact">
											<div class="blog_num">
												<?php echo do_shortcode('[contact-form-7 id="288" title="Contact Us"]'); ?>
											</div>
										</div>
									</div>
									<div class="uk-width-1-1 inner_page_agape">
										<div id="related-articles">
											<h4>Recent Articles</h4>
											<ul class='related posts'>
												<?php
													$recent_posts = wp_get_recent_posts(array(
												        'numberposts' => 4, // Number of recent posts thumbnails to display
												        'post_status' => 'publish' // Show only the published posts
												    ));
												    foreach($recent_posts as $post){
												    	?>
												    	<li><a href="<?php echo get_permalink($post['ID']) ?>"><?php echo $post['post_title'] ?></a></li>
												    	<?php
												    }
												?>
											</ul>
										</div>
										<!-- <h2>Carolina Center for Recovery</h2>
										<div class="ag_btn">
											<a href="<?php echo site_url();?>/staff">Staff</a>
										</div>
										<div class="ag_btn">
											<a href="#">Facility</a>
										</div>
										<div class="ag_btn">
											<a href="#">Gallery</a>
										</div> -->
									</div>
								</div>
							</div>
						</div>
					<!--inner_page Right Side ends here-->
				</div>		
			</div>
		</div>
		
		<!--inner_page Posts section ends here-->
	</div>
</section>

<?php 
	get_footer();
?>