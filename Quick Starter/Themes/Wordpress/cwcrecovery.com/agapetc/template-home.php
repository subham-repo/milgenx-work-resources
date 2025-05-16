<?php 
	/*
		Template Name: CWC Home
	*/
	get_header();
?>

<section id="home_body">


	<!--Banner Section goes here-->
	<div class="home_banner">
			<div class="hero-photo" style="background-image: url('<?php the_field('home_banner_image'); ?>');">
				<div class="container">
					<div class="hero_posi">
						<div class="hero_content">
							<div class="align_hero-con">
								<h1><?php the_field('banner_heading'); ?></h1> 
								<h3><?php the_field('banner_sub_heading'); ?></h3>
								<!-- <div class="hr"></div> -->
								<p><?php the_field('banner_title'); ?></p>
								<!-- <div class="hr1"></div> -->
								<div class="uk-width-1-1 hero_button">
									<!-- <a href="tel:<?php //echo $contact_number; ?>" class="hero_call"><?php //echo $contact_number; ?></a> -->
									<a href="<?php the_field('banner_button_link'); ?>" class="btn-theme hero_insu">
										<span>
											<i class="fa fa-mobile" aria-hidden="true"> </i><?php the_field('banner_button_text'); ?>
										</span>
									</a>
									<a href="<?php the_field('banner_button_link_2'); ?>" class="hero_insu btn-theme">
										<span>
											<i class="fa fa-check" aria-hidden="true"></i> <?php the_field('banner_button_text_2'); ?>
										</span>
									</a>
							
								</div>

								

							</div>
						</div>
						       
					</div>

				</div>
				<div class="accrediations">
					Accrediations & Associations
				</div>
			<div class="accrediation_icons">
				<div class="container">
					<div class="accrediation_slider">
						<div class="accrediation_blocks">
							<img src="<?php echo site_url(); ?>/wp-content/uploads/2020/04/jhaco-seal.png" alt="jhaco-seal" />
						</div>
						<div class="accrediation_blocks">
							<img src="<?php echo site_url(); ?>/wp-content/uploads/2020/04/dcf-gold-seal-of-approval.png" alt="dcf-gold-seal-of-approval" />
						</div>
						<div class="accrediation_blocks">
							<img src="<?php echo site_url(); ?>/wp-content/uploads/2020/04/FARR-Seal-of-Approval.png" alt="FARR-Seal-of-Approval" />
						</div>
						<div class="accrediation_blocks">
							<img src="<?php echo site_url(); ?>/wp-content/uploads/2020/04/imgpsh_fullsize_anim-e1587648601570.png" />
						</div>
						<div class="accrediation_blocks">
							<img src="<?php echo site_url(); ?>/wp-content/uploads/2020/04/logo.png" alt="Connected_warriors" />
						</div>
						<div class="accrediation_blocks">
							<img src="<?php echo site_url(); ?>/wp-content/uploads/2020/04/keiser-university-2.png" alt="keiser-university" />
						</div>
						<div class="accrediation_blocks">
							<img src="<?php echo site_url(); ?>/wp-content/uploads/2020/04/health.png" alt="Nami-seal" />
						</div>
					</div>
				</div>
			</div>
			
			</div>
	</div>
		
	<!--Why Recovery Section starts here-->
	
	<div class="h_why_rec">
		<div class="container">
			<div class="uk-grid-collapse">
				<div class="uk-width-1-1 wr_con uk-text-center">
					<h2 class="dark_pink_clr"><?php the_field('why_agape_title'); ?></h2>
					<?php the_field('why_agape_content'); ?>
					<a href="<?php the_field('why_button_link'); ?>" class="btn-theme">
						<span><?php the_field('why_button_text'); ?></span>
					</a>
				</div>
			</div>
		</div>
	</div>
	
	<!--Banner Section ends here-->
	<div class="addictions full-width section-spacing">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-6 col-xs-12 add_blocks">
					<div class="drugs_addict full-width">
						<h2>Partial Hospitalization (PHP)</h2>
						<p class="description">At Comprehensive Wellness Centers, we believe that each individual patient that walks through our doors requires and deserves their own personalized path to rehabilitation and healing.</p>
						<div class="btn-row" style="padding-top: 0;">
							<a class="btn-theme" href="<?php echo site_url(); ?>/treatment-programs/partial-hospitalization-php/">
								<span>Learn More</span>
							</a>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12 add_blocks">
					<div class="drugs_addict full-width">
						<h2>Residential Treatment</h2>
						<p class="description">Residential drug and alcohol rehab programs offer treatment for people who suffer from severe substance use disorders. This type of rehab provides 24-hour support and supervision from medical and clinical staff. </p>
						<div class="btn-row" style="padding-top: 0;">
							<a class="btn-theme" href="<?php echo site_url(); ?>/treatment-programs/residential-treatment/">
								<span>Learn More</span>
							</a>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-sm-6 col-xs-12 add_blocks">
					<div class="drugs_addict full-width">
						<h2>Intensive Outpatient (IOP)</h2>
						<p class="description">Our Intensive Outpatient Program (IOP) has been designed by our experienced treatment staff to fit each client’s unique and specific needs. With our high staff-to-patient ratios and focus on both the individual and family . . .</p>
						<div class="btn-row" style="padding-top: 0;">
							<a class="btn-theme" href="<?php echo site_url(); ?>/treatment-programs/intensive-outpatient-iop/">
								<span>Learn More</span>
							</a>
						</div>
					</div>
				</div>

				

				<div class="col-md-4 col-sm-6 col-xs-12 add_blocks">
					<div class="drugs_addict full-width">
						<h2>Detox</h2>
						<p class="description">Detox centers are your first step in addressing your substance dependency and abuse. Whether you abused alcohol, opiates, were addicted to Xanax or other drugs, your body will experience physical and psychological withdrawal symptoms. </p>
						<div class="btn-row" style="padding-top: 0;">
							<a class="btn-theme" href="<?php echo site_url(); ?>/treatment-programs/detox/">
								<span>Learn More</span>
							</a>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-sm-6 col-xs-12 add_blocks">
					<div class="drugs_addict full-width">
						<h2>Trauma Program</h2>
						<p class="description">At Comprehensive Wellness Centers, we recognize that individuals with mental health and substance use disorders often have complex histories that have contributed to their ongoing struggles. </p>
						<div class="btn-row" style="padding-top: 0;">
							<a class="btn-theme" href="/trauma-program/">
								<span>Learn More</span>
							</a>
						</div>
					</div>
				</div>

				<div class="col-md-4 col-sm-6 col-xs-12 add_blocks">
					<div class="drugs_addict full-width">
						<h2>Medication-Assisted Treatment (MAT)</h2>
						<p class="description">Medication-Assisted Treatment (MAT) is the use of medications, in combination with counseling and behavioral therapies, to provide a “whole-patient” approach to the treatment of substance use disorders.</p>
						<div class="btn-row" style="padding-top: 0;">
							<a class="btn-theme" href="/medication-assisted-treatment-mat/">
								<span>Learn More</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
	
	<!-- Video Testimonial Section -->
	<div class="video_testimonial home_testimonial full-width section-spacing">
		<div class="container">
			<div class="row heading text-center">
				<h2><?php echo the_field('testimonial_section_heading'); ?></h2>
			</div>
			<div class="row">

				<?php

				// check if the repeater field has rows of data
				if( have_rows('video_testimonial') ):

				 	// loop through the rows of data
				    while ( have_rows('video_testimonial') ) : the_row(); ?>

				        <!-- // display a sub field value -->
				        
				        <div class="col-md-3 col-sm-6 col-xs-12 video_testimonial_catalog">
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
			<div class="full-width btn-row text-center">
				<?php 
				$testimonial_button 	 = get_field('testimonial_button');
				$testimonial_button_link = get_field('testimonial_button_link');
				if(!empty($testimonial_button_link)){ ?>
					<a class="btn-theme large" href="<?php echo $testimonial_button_link; ?>">
						<span><?php echo $testimonial_button; ?></span>
					</a>
				<?php } ?>

				<?php 
				$get_help_button_text 	 = get_field('get_help_button_text');
				$get_help_button_text_link = get_field('get_help_button_text_link');
				if(!empty($get_help_button_text_link)){ ?>
					<a class="btn-theme large" href="<?php echo $get_help_button_text_link; ?>">
						<span><?php echo $get_help_button_text; ?></span>
					</a>
				<?php } ?>
				
			</div>
		</div>
	</div>
	<!-- Video Testimonial Section End -->


	<div class="intro_up text-center full-width section-spacing">
		<div class="container">
			<h2><?php the_field('program_heading'); ?></h2>
			<p class="bold-para"><?php the_field('program_description'); ?></p>
		</div>
	</div>
	<div class="intro_down text-left full-width section-spacing">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-7 col-xs-12 block-main">
				<h2><?php the_field('services_heading'); ?></h2>
				<ul>
					<?php

					// check if the repeater field has rows of data
					if( have_rows('services_included') ):

					 	// loop through the rows of data
					    while ( have_rows('services_included') ) : the_row();
					    	echo "<li>";
					        // display a sub field value
					        the_sub_field('name_of_services');
					        echo "</li>";
					    endwhile;

					else :

					    // no rows found

					endif;

					?>
				</ul>
				<div class="btn-row full-width">
					<?php

					// check if the repeater field has rows of data
					if( have_rows('services_buttons') ):

					 	// loop through the rows of data
					    while ( have_rows('services_buttons') ) : the_row(); ?>
					        <a href="<?php the_sub_field('button_link'); ?>" class="btn-theme rev"><span><?php the_sub_field('button_label'); ?></span></a>
					    <?php endwhile;

					else :

					    // no rows found

					endif;

					?>
					
				</div>

			</div>
			<div class="col-sm-12 col-md-5 col-xs-12 cta-main">
				<div class="cta-wrapper">
					<?php 
					$services_cta_box = get_field('services_cta_box');
					?>
					<p>
						<?php echo $services_cta_box['description']; ?>
					</p>
					<div class="btn-row text-center">
						<a href="<?php echo $services_cta_box['button_link']; ?>" style="margin-right: 0" class="btn-theme"><span><?php echo $services_cta_box['button_label']; ?></span></a>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
	
	<!-- Recent Blog Post -->
	<div class="home_blog_posts">
		<div class="container">	
			<div class="row">
				<h2 class="latestblogs"> OUR MOST RECENT BLOGS</h2>
			<?php
			$args = array( 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 3,'category__not_in' => array( 3 ), 'orderby' =>'date','order' => 'DESC' );		
			$additional_loop = new WP_Query($args);
			while ($additional_loop->have_posts()) : $additional_loop->the_post(); 
			$post_id = get_the_ID();
			$getBgUrl = '';
			?>
				<div class="single_posts_section_small col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="posts_wrapper">
					<div class="post_blocks_thumb cool">
						<?php if(has_post_thumbnail())
						{	
							$getBgUrl = get_the_post_thumbnail_url($post_id,'large'); 
							?>
							<a class="dektopblogbgshow" href="<?php the_permalink(); ?>"><div style="background-image:url(<?php echo $getBgUrl; ?>)"></div></a>
							<?php 
						} 
						else
						{	?>
							<a class="dektopblogbgshow" href="<?php the_permalink(); ?>"><div style="background-image:url(<?php echo $getBgUrl; ?>)"></div></a>
							<?php
						}	?>
					</div>
					<div class="post_blocks_cont">
						<div class="entry-content">
							<div class="title_meta">
								<h3 class="entry-title homeblogsametitle">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								<div class="author">
									<?php 
										$auth_name = get_the_author(); 
										echo "Written By ".ucwords($auth_name); ?> - 
										<?php $pdate = $post->post_date; 
										echo date("F jS, Y",strtotime($pdate));
									?>
								</div>
							</div>
							<div class="post_content">
								<p>
									<?php $cont = get_the_excerpt(); 
										echo wp_trim_words($cont, 15)."...";
									?>
								</p>
							<span class="blg_read_more"><a href="<?php the_permalink(); ?>">Read More</a></span>
							</div>
							<div class="post_cats">
								<?php $terms = get_the_category();
								// echo "<pre>";
								// print_r($terms);
								// echo "</pre>"; 
									foreach ($terms as $terms) {
										$term_name = $terms->name;
										$term_link = get_category_link($terms->term_id);
									?>
										<a href="<?php echo $term_link; ?>">
											<?php echo $term_name; ?>
										</a>
									<?php
									}
								?>
							</div>
						</div>
					</div>
					</div>
				</div>
			<?php 			
			endwhile;
			wp_reset_query();
			wp_reset_postdata();
			?>
			<div style="clear:both;"></div>	
			</div>													
		</div>

	</div>
	<!-- Recent Blog Post End-->


	<!--Get help section goes here-->
	<div class="get_help_sec">
		<div class="uk-grid-collapse uk-grid">
			<div class="uk-width-1-1@l">
				<div class="get_help_bg" style="background-image: url('<?php the_field('how_do_background_image'); ?>');">
					<div class="container">
						<div class="get_help_content">
							<h2><?php the_field('how_do_title'); ?></h2>
							<?php the_field('how_do_sub_title'); ?>
							<div class="btn-row text-center">
								<a href="tel:<?php echo $contact_number; ?>" class="btn-theme">
									<span><?php echo $contact_number; ?></span>
								</a>
								<a href="<?php the_field('how_do_button_link'); ?>" class="hero_insu btn-theme rev">
									<span><?php the_field('how_do_button_text'); ?></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Get help section ends here-->


</section>

<script>
	jQuery(document).ready(function(){
		$('.image_sec').slick({
		  infinite: true,
		  slidesToShow: 3,
		  slidesToScroll: 1,
		  nextArrow: '<i class="fa fa-angle-right"></i>',
		  prevArrow: '<i class="fa fa-angle-left"></i>',
		  autoplay: true,
		  responsive: [
		    {
		      breakpoint: 1024,
		      settings: {
		        slidesToShow: 3,
		        slidesToScroll: 3,
		        infinite: true,
		        dots: true
		      }
		    },
		    {
		      breakpoint: 600,
		      settings: {
		        slidesToShow: 2,
		        slidesToScroll: 2
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    }
		    // You can unslick at a given breakpoint now by adding:
		    // settings: "unslick"
		    // instead of a settings object
		  ]

		});

		$('.testi_ac').slick({
			dots: false,
			arrows: false,
			infinite: true,
			autoplay: true
		});
	});
</script>


<?php 
	get_footer();
?>
