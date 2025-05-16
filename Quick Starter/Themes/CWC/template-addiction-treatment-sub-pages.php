<?php 
	/*
		Template Name: Addiction Treatment Sub pages
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
		<div class="at_inner_sec">
			<div class="container">
				<div class="uk-grid-collapse uk-grid">
					<!--About Left Side goes here-->
						<div class="uk-width-3-4@l uk-width-3-4@m uk-width-1-1@s about_left">
							<div class="uk-grid-collapse uk-grid">
								<div class="uk-width-1-1 treat_sub_p about_data at_data">
									<!--Description Section goes here-->
									<div class="uk-width-1-1 sub_treat">
										<?php the_field('addiction_description');?>
									</div>
									<!--Description Section ends here-->

									<!--Symtoms Section goes here-->
									<div class="uk-width-1-1 sub_symp">
										
										<?php 
											$rows = get_field('symptoms');
											if($rows)
											{
												foreach($rows as $row)
												{
										?>
										<div class="uk-width-1-2@l uk-width-1-2@s symp_dec">
											<div class="sub_symp_con">
												<h2><?php echo $row['symptoms_heading']?></h2>
												<?php echo $row['symptoms_effects']?>
											</div>
										</div>

										<?php 
											}
												}
										?>
									</div>
									<!--Symtoms Section ends here-->
									
									<!--Types Section goes here-->
									<div class="uk-width-1-1 sub_type">
										
									</div>
									<!--Types Section ends here-->

									<!--Side Effects Section goes here-->
									<!--Side Effects Section ends here-->

									<!--Treatment Section goes here-->
									<!--Treatment Section ends here-->

									<!--Rehab Section goes here-->
									<!--Rehab Section ends here-->

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
									<div class="uk-width-1-1 about_ag_reco">
										<h2>Addiction Recovery Services at Agape Recovery</h2>
										<div class="ag_reco_btn">
											<a href="<?php echo site_url();?>/addiction-treatment-center-programs/">Addiction Treatment Center Programs</a>
										</div>
										<div class="ag_reco_btn">
											<a href="#">Alcohol Addiction Treatment</a>
										</div>
										<div class="ag_reco_btn">
											<a href="#">Alcoholism Rehab</a>
										</div>
										<div class="ag_reco_btn">
											<a href="#">Benzodiazepine Addiction</a>
										</div>
										<div class="ag_reco_btn">
											<a href="#">Cocaine Addiction Rehab</a>
										</div>
										<div class="ag_reco_btn">
											<a href="#">Ecstasy Addiction Treatment</a>
										</div>
										<div class="ag_reco_btn">
											<a href="#">Heroin Addiction Treatment</a>
										</div>

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