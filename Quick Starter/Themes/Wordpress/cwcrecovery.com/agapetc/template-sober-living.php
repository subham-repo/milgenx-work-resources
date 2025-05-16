<?php 
	/*
		Template Name: Sober Living
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
					<!--Sober living section goes here-->
					<div class="sober_living">
						<div class="uk-grid-collapse uk-grid">
							<div class="uk-width-2-3@l uk-width-2-3@m uk-width-1-1@s">
								<div class="sober_con">
									<h1><?php the_field('sober_heading');?></h1>
									<?php the_field('sober_content');?>
								</div>
							</div>
							<div class="uk-width-1-3@l uk-width-1-3@m uk-width-1-1@s sl_im">
								<div class="sober_img" style="background-image: url('<?php the_field('sober_image'); ?>');"></div>
							</div>
						</div>
					</div>
					<!--Sober living section ends here-->
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
