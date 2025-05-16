<?php
/*
* Template Name: Home Page Template
*/
get_header();
?>

<section id="home_body" class="section-full">

	<!--Banner Section goes here-->
	<div class="home_banner">
			<div class="hero-photo sec-spacing" style="background-image: url('<?php the_field('home_banner_image'); ?>');">
				<div class="container">
					<div class="hero_posi">
						<div class="hero_content">
							<div class="align_hero-con text-center">
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
				<?php /*
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
			</div> */?>
			
			</div>
	</div>

<!-- Banner section end  -->

<!--Why Recovery Section starts here-->

	<section class="intro_section full-width sec-spacing">
		<div class="container">
			<?php
			
			// Title Section Contact CTA Button Link and Text

			$contact_link 		= of_get_option('contact_link');
			$contact_bt_text	= of_get_option('contact_bt_text');
			$intro_heading		= get_field('why_agape_title');

			$intro_cta_text 	= get_field('why_button_text');
			$intro_cta_link 	= get_field('why_button_link');


			?>
			<div class="row text-center">
				<div class="col-lg-6 col-md-12 col-sm-12 col-12 intro_section_wrapper text-center">
					<?php if(!empty($intro_heading)){?>
						<h2><?php echo $intro_heading; ?></h2>
					<?php } ?>

					<div class="intro_content full-width">
						<?php the_field('why_agape_content'); ?>
					</div>	

					<div class="btn-row full-width text-center">
						<?php if(!empty($intro_cta_text)){ ?>
							<a class="btn-cta large orange" href="<?php echo $intro_cta_link; ?>" >
								<?php echo $intro_cta_text; ?>
							</a>
						<?php } ?>
					</div> 
				</div>
			</div>
		</div>
	</section>


<!-- Why Recovery section starts here  -->

<!-- addictions section start here -->

<div class="addictions full-width section-spacing" style="background-image: url(<?php the_field('services_section_bg');?>) ">
		<div class="container">
			<div class="row">

				<?php

				// check if the repeater field has rows of data
				if( have_rows('services_catalog') ):

				 	// loop through the rows of data
				    while ( have_rows('services_catalog') ) : the_row();

				    $services_catalog_title 	  = get_sub_field('title');
				    $services_catalog_description = get_sub_field('description');	
				    $services_catalog_button_text = get_sub_field('button_text');	
				    $services_catalog_button_link = get_sub_field('button_link');	
				?>

				 <div class="col-lg-4 col-md-12 col-sm-6 col-xs-12 add_blocks">
					<div class="drugs_addict full-width">
						<div class="block_content full-width">
							<h2><?php echo $services_catalog_title; ?></h2>
							<p class="description"><?php echo $services_catalog_description; ?></p>
						</div>
						<div class="btn-row" style="padding-top: 0;">
							<a class="btn-theme" href="<?php echo $services_catalog_button_link; ?>">
								<span><?php echo $services_catalog_button_text; ?></span>
							</a>
						</div>
					</div>
				</div>   

				<?php    
				endwhile;

				else :

				    // no rows found

				endif;

				?>
				
				
			</div>
		</div>
	</div>	
	<!-- addictions  end  -->

<!-- Right for me section -->
	<div class="intro_up text-center full-width section-spacing">
		<div class="container">
			<div class="row heading-half">
				<div class="col-12">
					<h2><?php the_field('program_heading'); ?></h2>
				</div>
			</div>
			<div class="row">
				<div class="col-12 description_intro">
					<?php the_field('program_description'); ?>
				</div>
			</div>
			<div class="btn-row full-width text-center">
				<?php
			
				// Title Section Contact CTA Button Link and Text

				$program_cta_text 	= get_field('program_cta_text_');
				$program_cta_link 	= get_field('program_cta_link');

				?>
				<?php if(!empty($program_cta_text)){ ?>
					<a class="btn-cta large orange" href="<?php echo $intro_cta_link; ?>" >
						<?php echo $program_cta_text; ?>
					</a>
				<?php } ?>
			</div> 
		</div>
	</div>

<!-- Right for me section end  -->
<!-- Services section-->
	<div class="intro_down text-left full-width section-spacing">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 col-sm-12 col-md-12 col-xs-12 block-main">
				<h2><?php the_field('services_heading'); ?></h2>
				<ul class="row">
					<?php

					// check if the repeater field has rows of data
					if( have_rows('services_included') ):

					 	// loop through the rows of data
					    while ( have_rows('services_included') ) : the_row();
					    	echo '<li class="col-lg-6 col-md-6 col-sm-12 col-12">';
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
			<div class="col-lg-5 col-sm-12 col-md-12 col-xs-12 cta-main">
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
<!-- Services section end-->
	
	<div class="we_offer section-full sec-spacing">
		<?php 
		$three_column_links 		= get_field('three_column_links');
		$three_column_links_heading = $three_column_links['heading'];
		$three_column_links_certificate_icon = $three_column_links['certificate_icon'];

		?>
		<div class="container">
			<div class="row heading heading-half">
				<div class="col-12 text-center">
					<h2><?php echo $three_column_links_heading; ?></h2>
					<?php if(!empty($three_column_links_certificate_icon)){?>
						<img src="<?php echo $three_column_links_certificate_icon; ?>" alt="certificate_icon" />
					<?php } ?>
				</div>
			</div>
			
			<?php 	

					// check if the repeater field has rows of data
			while ( have_rows( 'three_column_links' ) ) : the_row(); ?>

			<div class="row three_column_catalogue ">	

			<?php if( have_rows('catalog_blocks') ):

			 	// loop through the rows of data
			    while ( have_rows('catalog_blocks') ) : the_row();

			    $image 		= get_sub_field( 'image' );
		        $title 		= get_sub_field( 'heading' );
		        $content 	= get_sub_field( 'exerpt' );
		        $button_text = get_sub_field('button_text');
		        $button_link = get_sub_field('button_link'); ?>
			       
			    <div class="three_catalog_blocks col-12 col-lg-4 col-md-12 col-sm-12 ">
			    	<div class="three_catalog_blocks_inner text-center full-width">
			    		<img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" />
			    		<h4><?php echo $title; ?></h4>
			    		<p><?php echo $content; ?></p>
			    		<?php if(!empty($button_link)){?>
			    			<div class="btn-row text-center full-width">
				    			<a href="<?php echo $button_link; ?>" class="btn-cta white small">
				    				<?php echo $button_text; ?>
				    			</a>
				    		</div>
			    		<?php } ?>
			    	</div>
			    </div>    

			   <?php endwhile;

			else :

			    // no rows found

			endif; ?>

			</div>

			<?php endwhile; ?>

			<div class="btn-row full-width text-center">
				<?php
			
				// Title Section Contact CTA Button Link and Text

				$we_offer_cta_text 	= get_field('we_offer_cta_text');
				$we_offer_cta_link 	= get_field('we_offer_cta_link');

				?>
				<?php if(!empty($we_offer_cta_text)){ ?>
					<a class="btn-cta large orange" href="<?php echo $we_offer_cta_link; ?>" >
						<?php echo $we_offer_cta_text; ?>
					</a>
				<?php } ?>
			</div>
		</div>
	</div>

	<div class="why_us full-width sec-spacing">
		<div class="container">
			<div class="row heading">
				<div class="col-12 text-center">
					<h2><?php the_field('why_us_heading'); ?></h2>
				</div>	
			</div>
			<div class="row">
				<?php

				// check if the repeater field has rows of data
				if( have_rows('why_us_reasons') ):

				 	// loop through the rows of data
				    while ( have_rows('why_us_reasons') ) : the_row();
					$why_us_reasons_heading		= get_sub_field('heading');
					$why_us_reasons_description = get_sub_field('description');				    	

				?>

				<div class="col-md-6 col-lg-6 col-sm-12 col-12 why_us_blocks">
					<h6><strong><?php echo $why_us_reasons_heading; ?></strong></h6>
					<p><?php echo $why_us_reasons_description; ?></p>
				</div>
				<?php
				        // display a sub field value
				        the_sub_field('sub_field_name');

				    endwhile;

				else :

				    // no rows found

				endif;

				?>
			</div>
			<div class="btn-row full-width text-center">
				<?php
			
				// Title Section Contact CTA Button Link and Text

				$why_us_cta_text 	= get_field('why_us_cta_text');
				$why_us_cta_link 	= get_field('why_us_cta_link');

				?>
				<?php if(!empty($why_us_cta_text)){ ?>
					<a class="btn-cta large white" href="<?php echo $why_us_cta_link; ?>" >
						<?php echo $why_us_cta_text; ?>
					</a>
				<?php } ?>
			</div> 
		</div>
	</div>

<!-- Recent Blog Post -->
	<div class="home_blog_posts">
		<div class="container">	
			<h2 class="latestblogs"> OUR MOST RECENT BLOGS</h2>
			<div class="row">
			<?php
			$args = array( 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 3,'category__not_in' => array( 3 ), 'orderby' =>'date','order' => 'DESC' );		
			$additional_loop = new WP_Query($args);
			while ($additional_loop->have_posts()) : $additional_loop->the_post(); 
			$post_id = get_the_ID();
			$getBgUrl = '';
			?>
				<div class="single_posts_section_small col-lg-4 col-md-12 col-sm-12 col-xs-12">
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
	<div class="get_help_sec full-width">
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

<?php // get_template_part( 'parts/section', 'get-help'  ); ?>
<?php // get_template_part( 'parts/section', 'faq'  ); ?>
<?php get_template_part( 'parts/section', 'contact'  ); ?>
<?php get_footer(); ?>