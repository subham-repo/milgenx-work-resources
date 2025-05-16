<?php 
	/*
		Template Name: Mind
	*/
	get_header();
?>

<section id="about_body">
	<div class="all_about">
		<?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		<!--Featured Image section goes here-->
		<div class="uk-grid-collapse uk-grid">
			<div class="uk-width-1-1">
				<div class="blog_featured" style="background-image: url('<?php echo $feat_image ; ?>');">
					<h1><?php the_title(); ?></h1>
				</div>		
			</div>
		</div>
		<!--Featured Image section ends here-->

		<!--About Posts section goes here-->
		<div class="about_inner_sec">
			<div class="container">
				<div class="uk-grid-collapse uk-grid">
					<!--About Left Side goes here-->
						<div class="uk-width-3-4@l uk-width-3-4@m uk-width-1-1@s about_left">
							<div class="uk-grid-collapse uk-grid substance_card" style="background-image: linear-gradient(0deg,rgba(255,255,255),rgba(255,255,255)), url('<?php echo $feat_image ; ?>');">
								<div class="uk-width-1-1 about_data">

									<div class="uk-grid uk-grid-collapse">
										<!-- <div class="uk-width-1-2 mind_imf fl_wid" style="background-image: linear-gradient(0deg,rgba(255, 255, 255, 0.94),rgb(255, 255, 255)), url('<?php //the_field('mind_image') ; ?>');"></div> -->
										<div class="uk-width-1-1 fl_wid">
											<div class="subs_data">
												<div class="f_img" style="background-image: linear-gradient(0deg,rgba(255,255,255,0.0),rgba(255,255,255,0.0)), url('<?php the_field('mind_image') ; ?>');">
													<div class="bord_1"></div>
													<div class="bord_2"></div>
												</div>
												<?php the_field('image_mind_content');?>
											</div>
										</div>
									</div>
									<div class="substance_con">
										<?php the_field('mind_detail_content');?>
									</div>

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
										<!-- <p>Agape Treatment Center offers the full-spectrum of comprehensive addiction treatment in Orange County, CA. Take that first step on the road to recovery and make better choices, every day.</p> -->
										<?php echo do_shortcode('[agape_desc]');?>
										<div class="blog_num">
											<a href="tel:<?php echo $contact_number ?>" class="dark_pink_clr2"><?php echo $contact_number; ?></a>
										</div>
									</div>
									<div class="uk-width-1-1 about_agape">
										<!-- <h2>Learn More About Agape Treatment Center</h2>
										<div class="ag_btn">
											<a href="<?php //echo site_url();?>/staff">Staff</a>
										</div>
										<div class="ag_btn">
											<a href="#">Facility</a>
										</div>
										<div class="ag_btn">
											<a href="#">Gallery</a>
										</div> -->
										<div class="r-post">
											<?php echo do_shortcode('[recent_posts]');?>
										</div>
									</div>
								</div>
							</div>
						</div>
					<!--About Right Side ends here-->
				</div>		
			</div>
			<!--CALL TO ACTION BUTTON GOES HERE-->
			<div class="uk-grid-collapse uk-grid cta_section">
				<div class="container">
					<div class="uk-width-1-1 cta_inner_sec">
						<div class="uk-grid-collapse uk-grid">
							<div class="uk-width-2-3@l uk-width-1-1@s">
								<h2>Learn More About Agape Treatment Center</h2>
							</div>
							<div class="uk-width-1-3@l uk-width-1-1@s">
								<div class="cta_btn">
									<a href="<?php echo site_url();?>/contact-us">CONTACT US</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--CALL TO ACTION BUTTON ENDS HERE-->
		</div>
		
		<!--About Posts section ends here-->
	</div>
</section>

<?php 
	get_footer();
?>