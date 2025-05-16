<?php 
	/*
		Template Name: About Us
	*/
	get_header();
?>

<section id="about_body">
	<div class="all_about">
		<!--Featured Image section goes here-->
		<?php echo do_shortcode('[inner-title]'); ?>
		<!--Featured Image section ends here-->

		<!--About Posts section goes here-->
		<div class="about_inner_sec">
			<div class="container">
				<div class="uk-grid-collapse uk-grid row">
					<!--About Left Side goes here-->
						<div class="uk-width-3-4@l uk-width-3-4@m uk-width-1-1@s about_left">
							<div class="content_row full-width">

								<?php
									$about_fields      = get_field('about_fields');
									$intro_video       = $about_fields['intro_video'];
									$intro_right       = $about_fields['intro_right'];
									$about_description = $about_fields['about_description'];
								?>
								<div class="we_offer full-width">
									<?php 

									// check for rows (parent repeater)
									if( have_rows('about_fields') ): ?>
										
										<?php 

										// loop through rows (parent repeater)
										while( have_rows('about_fields') ): the_row(); ?>
												<h3><?php the_sub_field('title'); ?></h3>
												<?php 

												// check for rows (sub repeater)
												if( have_rows('we_offer') ): ?>
													<?php 

													// loop through rows (sub repeater)
													while( have_rows('we_offer') ): the_row();

														// display each item as a list - with a class of completed ( if completed )
														?>
														<div class="col-md-3 col-sm-3 col-xs-6 offer_blocks">

															<div class="offer_icon">
																<?php the_sub_field('icon_code'); ?>
															</div>
															<h2><?php the_sub_field('heading'); ?></h2>
														</div>

													<?php endwhile; ?>
												<?php endif; //if( get_sub_field('items') ): ?>

										<?php endwhile; // while( has_sub_field('to-do_lists') ): ?>
									<?php endif; // if( get_field('to-do_lists') ): ?>
								</div>
								
								<div class="col-md-6 col-sm-6 col-xs-12">
									<?php echo $intro_video; ?>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<p><?php echo $intro_right; ?></p>
								</div>
								<div class="col-md-12 full-width">
									<?php echo $about_description; ?>
								</div>
							</div>
						</div>	
					<!--About Left Side ends here-->

					<!--About Right Side goes here-->
						<div class="uk-width-1-4@l uk-width-1-4@m uk-width-1-1@s about_right">
							<div class="uk-grid-collapse uk-grid">
								<div class="uk-width-1-1">
									<div class="blog_logo">
										<img src="<?php echo $header_logo; ?>">
										
										<div id="aboutus-contact">
											<div class="blog_num">
												<?php echo do_shortcode('[contact-form-7 id="288" title="Contact Us"]'); ?>
											</div>
										</div>
									</div>
									<div class="uk-width-1-1 about_agape">
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
					<!--About Right Side ends here-->
				</div>		
			</div>
		</div>
		
		<!--About Posts section ends here-->
	</div>
</section>

<?php 
	get_footer();
?>