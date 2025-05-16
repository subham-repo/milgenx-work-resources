<?php 
	/*
		Template Name: Admission
	*/
	get_header();
?>

<section id="about_body"> 
	<div class="all_about">
		<?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		<!--Featured Image section goes here-->
		<div class="uk-grid-collapse uk-grid">
			<div class="uk-width-1-1">
				<div class="blog_featured"  style="background-image: url('<?php echo $feat_image ; ?>');">
					<h1><?php the_title(); ?></h1>
				</div>		
			</div>
		</div>
		<!--Featured Image section ends here-->

		<!--About Posts section goes here-->
		<div class="about_inner_sec">
			<div class="container">
				<div class="uk-grid-collapse uk-grid">
					<!--Admission First Section goes here-->
					<div class="admission_sec">
						<div class="uk-grid uk-grid-collapse">
							<div class="uk-width-1-2@l uk-width-1-2@m uk-width-1-1@s">
								<div class="adm_inn">
									<h1><?php the_field('admission_process_heading'); ?></h1>
									<?php the_field('admission_process_content'); ?>
								</div>
							</div>
							<div class="uk-width-1-2@l uk-width-1-2@m uk-width-1-1@s adm_inn_bg" style="background-image: url('<?php the_field('admission_process_image'); ?>');"></div>
						</div>
					</div>
					<!--Admission First Section ends here-->
					
					<!--Admission Brief goes here-->
					<div class="adm_brief">
						<div class="uk-grid uk-grid-collapse">
							<div class="uk-width-1-1">
								<div class="adm_br_inn">
									<h2><?php the_field('process_brief_heading'); ?></h2>
									<?php the_field('process_brief_content'); ?>
								</div>
							</div>
						</div>
					</div>
					<!--Admission Brief ends here-->

					<!--Admission Social Section goes here-->
					<div class="adm_social">
						<div class="uk-grid uk-grid-collapse">
							<div class="uk-width-1-3@l uk-width-1-3@m uk-width-1-2@s th_bl">
								<div class="adm_sco">
									<div class="fa_icon">
										<i class="fa fa-phone"></i>
									</div>
									<div class="sco_con">
										<h2>Contact Us</h2>
										<a href="tel:<?php echo $contact_number; ?>"><?php echo $contact_number; ?></a>
									</div>
								</div>
							</div>
							<div class="uk-width-1-3@l uk-width-1-3@m uk-width-1-2@s th_bl">
								<div class="adm_sco">
									<div class="fa_icon">
										<i class="fa fa-envelope"></i>
									</div>
									<div class="sco_con">
										<h2>Email</h2>
										<a href="mailto:info@agapetc.com">info@agapetc.com</a>
									</div>
								</div>
							</div>
							<div class="uk-width-1-3@l uk-width-1-3@m uk-width-1-2@s th_bl">
								<div class="adm_sco">
									<div class="fa_icon">
										<i class="fa fa-home"></i>
									</div>
									<div class="sco_con">
										<h2>Address</h2>
										<p>4837 N Dixie Highway <br> Oakland Park, FL, 33334</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--Admission Social Section ends here-->
					
					<!--Contact Form section goes here-->
					<div class="adm_form">
						<div class="uk-grid uk-grid-collapse">
							<div class="uk-width-1-1">
								<div class="adform_sec">
									<h2><?php the_field('verify_insurance_heading'); ?></h2>
									<?php the_field('verify_insurance_content'); ?>
									<div class="verify_form">
										<?php echo do_shortcode('[contact-form-7 id="496" title="Admission Form"]');?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--Contact Form section ends here-->
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
