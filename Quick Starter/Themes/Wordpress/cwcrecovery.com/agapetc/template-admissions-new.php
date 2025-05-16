<?php 
	/*
		Template Name: Admissions Page
	*/
	get_header();
?>

<section id="about_body">
	<div class="all_about">
		<!--About Us Admissions Section -->
			<?php
				$bg_img = get_field('section_background');
				//print_r($bg_img);
			?>
			<div class="admissions-form-section" id="admissions-form" style="background: url('<?php echo $bg_img['url']; ?>')">
				<div class="admissions-form-section-top">
					<div class="container">
						<div class="start-admission" id="admission-section">
							<h4><?php the_field('start_addmissions_heading'); ?></h4>
							<p><?php the_field('start_addmissions_description'); ?></p>
							<span class="privacy-policy-link"><a href="<?php the_field('privacy_policy_link'); ?>"><?php the_field('privacy_policy_link_text'); ?></a></span>
							<div class="admissions-form">
								<?php 
								//$admission_form = ;
									echo do_shortcode(get_field('addmissions_form_shortcode'));
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="admissions-form-section-bottom">
					<div class="container">
						<div class="link-left">
							<span class="verify-insurance-link">
								<a href="<?php the_field('verify_insurance_link'); ?>">
									<span>
										<?php the_field('verify_insurance_text'); ?>
									</span>
									<span><?php $img = get_field('verify_insurance_icon'); ?>
										<img src="<?php echo $img['url']; ?>">
									</span>
								</a>
							</span>
						</div>
						<div class="link-right">
							<div class="urgent-attention">
								<div class="urgent-attention-link">
									<span><?php the_field('need_attention_text'); ?></span>
									<span class="call-button"><a href="<?php the_field('need_attention_phone'); ?>"><img src="<?php $call_img = get_field('need_attention_button_icon'); echo $call_img['url']; ?>"><span><?php the_field('need_attention_button_text'); ?></span></a></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		<!--About Us Admissions Section -->
		<!--Featured Image section ends here-->
		
		

		<!--About Posts section goes here-->
		<div class="full-width section-spacing">
			<div class="container">
				<!--About Left Side goes here-->
					<div class="full-width wrapper">
						<?php if ( have_posts() ) : ?>
							<?php while ( have_posts() ) : the_post(); ?>    
							
							<?php echo the_content(); ?>

							<?php endwhile; ?>
						<?php endif; ?>
					</div>
				<!--About Left Side ends here-->


				<!--About Right Side goes here-->
					<div style="display: none" class="uk-width-1-4@l uk-width-1-4@m uk-width-1-1@s about_right">
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
		
		<!--About Posts section ends here-->
	</div>
</section>

<?php 
	get_footer();
?>