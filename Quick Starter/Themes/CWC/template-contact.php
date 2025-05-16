<?php 
	/*
		Template Name: Contact Us
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

		<!--Contact section goes here-->
		<div class="contact_inner_sec">
			<div class="container">
				<div class="uk-grid-collapse uk-grid">
					<!--Contact Left Side goes here-->
						<div class="uk-width-3-4@l uk-width-3-4@m uk-width-1-1@s about_left">
							<div class="uk-grid-collapse uk-grid cn_left">
								<div class="uk-width-1-1 ">
									<?php if ( have_posts() ) : ?>
										<?php while ( have_posts() ) : the_post(); ?>    
										
										<?php echo the_content(); ?>

										<?php endwhile; ?>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<!--Contact Left Side ends here-->

					<!--Contact Right Side goes here-->
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
										<?php echo do_shortcode('[Learn_more]');?>
									</div>
								</div>
							</div>
						</div>
					<!--Contact Right Side ends here-->
				</div>		
			</div>
		</div>
		
		<!--Contact section ends here-->
	</div>
</section>

<?php 
	get_footer();
?>