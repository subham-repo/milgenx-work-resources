<?php 
	/*
		Template Name: Contact Page
	*/
	get_header();
?>

<section id="about_body">
	<div class="all_about">
		<?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		<!--Featured Image section goes here-->
		<?php echo do_shortcode('[inner-title]'); ?>
		<!--Featured Image section ends here-->
	</div>
</section>
<section class="contact_description full-width section-spacing">
	<div class="container">
		<div class="contact_desc_wrapper">
			<h1> <?php the_title(); ?></h1>
			<?php the_content(); ?>
		</div>
		<div class="theme_cta-wrapper">
			<a class="cta_in" href="tel:<?php echo of_get_option('contact_num_op'); ?>">
				<span><?php echo of_get_option('contact_num_op'); ?></span>
			</a>
			<span class="cta_or"><span>or</span></span>
			<a class="cta_in" href="<?php echo of_get_option('ins_btlink'); ?>">
				<span><?php echo of_get_option('ins_bttext'); ?></span>
			</a>
		</div>
	</div>
</section>
<section class="full-width section-spacing">
	<div class="container">
		<div class="row contact_infowraper">
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="contact_infowrap">
					<h3 class="block-title">Stay Connected</h3>
					<p>At Comprehensive Wellness Centers, we fully understand the physical, psychological and spiritual impacts of addiction. As recovering addicts or family members of those suffering from substance abuse, the treatment staff at our drug rehab center in Florida has the experience, drive and dedication to help you reach your goal of a successful and lifelong recovery. </p>

					<?php echo do_shortcode('[mini-social]'); ?>
				</div>
			</div><strong><span class="addressTitle">
			<div class="col-md-4 col-sm-6 col-xs-12">
				<div class="contact_infowrap">
					<h3 class="block-title">NEED ASSISTANCE?</h3>
					<ul class="contact_list">
					<li><i class="fa fa-map-marker"></i>720 S. Dixie Hwy. Lantana, FL</li>
					<li><i class="fa fa-envelope"></i><a href="mailto:help@cwcrecovery.com">help@cwcrecovery.com</a></li>
					<li><i class="fa fa-mobile"></i><a href="tel:+18558440592" data-ctm-watch-id="9" data-ctm-tracked="1" data-observe="1" data-observer-id="4">(855) 844-0592</a>
					</li>
					<li><i class="fa fa-phone"></i>
						<a href="tel:+15616195858">(561) 619-5858</a>
					</li>
					</ul>
				</div>
			</div>
			<div class="col-md-4 col-sm-12 col-xs-12">
				<div class="contact_infowrap">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3568.187842870593!2d-80.0550915854657!3d26.578346883272655!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88d8d902a57bacc7%3A0xa2a1218085e88f29!2s720%20S%20Dixie%20Hwy%2C%20Lantana%2C%20FL%2033462!5e0!3m2!1sen!2sus!4v1588326628861!5m2!1sen!2sus" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

				</div>
			</div>
		</div>
	</div>
</section>
<section class="full-width section-spacing contact_form">
	<div class="container">
		<div class="contact_form_wrap">
			<?php echo do_shortcode('[contact-form-7 id="288" title="Contact Us"]'); ?>
		</div>
	</div>
</section>
<?php 
	get_footer();
?>