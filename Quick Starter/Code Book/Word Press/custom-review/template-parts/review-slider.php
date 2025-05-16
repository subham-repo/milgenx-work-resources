<?php 
// Review Slider Snippet
$review_title = $args['title'];
$review_link = $args['review_link'];
$background_image = $args['background-image'];
$column_count = $args['column_count'];
$style = $args['style'];


$args = array(
  'post_type'   => 'review',
  'post_status' => 'publish'
 );

?>
<section class="full-width review-slider <?php echo $style; ?> section-spacing <?php if($background_image == 'yes' ){?> bg-cover <?php } ?> " style="<?php if($background_image == 'yes' ){?>background-image: url(<?php echo site_url(); ?>/wp-content/uploads/2021/10/review_bg.png);<?php } ?>">
	<div class="container">
		<?php if($review_title == 'yes' ){?>
			<div class="row header_row text-center">
				<div class="col-lg-12">
					<h3 class="heading"><img width="26.72" height="27.56" class="review_star-icon" 
						<?php if($background_image == 'yes' ){?>
							src="<?php echo get_template_directory_uri(); ?>/images/bewertun-star.svg" 
						<?php } else{ ?>
							src="<?php echo get_template_directory_uri(); ?>/images/review_star_darkblue-svg.svg" 
						<?php } ?>	
						alt="Bewertungen"> 
						<?php if (ICL_LANGUAGE_CODE == 'en') { ?>
    					Reviews
						<?php }else{ ?>
							Bewertungen
						<?php } ?>
					</h3>
				</div>
			</div>
		<?php } ?>

		<div class="row review-slider_wrapper" 
		data-flickity='{ 
			"wrapAround": true, 
			<?php if($style == 'compact' ){?> "pageDots": true, <?php }else{ ?> "pageDots": false,  <?php } ?> 
			<?php if($style == 'compact' ){?> "prevNextButtons": false, <?php }else{ ?> "prevNextButtons": true, <?php } ?> 
			"autoPlay": true, 
			"autoPlay": 10000, 
			"selectedAttraction": 0.01, 
			"friction": 0.15
		}'>
			<?php $reviews = new WP_Query( $args );
			if( $reviews->have_posts() ) :
			?>
		    <?php
		      while( $reviews->have_posts() ) :
		        $reviews->the_post();

		        $author_name = get_field('author_name');
		        $review_star = get_field('review_star');
		        $review_date = get_field('review_date');
		        ?>
				<div class="<?php if($column_count  == '1'){ ?>col-lg-12 col-md-12 col-sm-10 col-10 <?php } else{ ?> col-lg-4 col-md-6 col-sm-10 col-10 <?php } ?>">
					<div class="review-slides full-width">
						<div class="review-information full-width">
							<?php if(!empty($review_star)){ ?>
								<div class="review-stars">
									<div class="Stars" style="--rating: <?php echo $review_star; ?>;" aria-label="Rating of this product is 2.3 out of 5."></div>
								</div>
							<?php } ?>
							<strong><?php echo get_the_title(); ?></strong>
							<p><?php echo get_the_content(); ?></p>
						</div>
						<div class="review-meta full-width">
							<?php if(!empty($author_name)){ ?>
								<strong class="author_name">- <?php echo $author_name; ?></strong>
							<?php } ?>
							<?php if(!empty($review_date)){ ?>
								<span class="review_date"><?php echo $review_date; ?></span>
							<?php } ?>
						</div>
					</div>
				</div>
		        <?php
		      endwhile;
		      wp_reset_postdata();
		    ?>
			<?php
			else :
			  esc_html_e( 'No reviews', 'text-domain' );
			endif;
			?>
		</div>

		<?php if($review_link == 'yes' ){?>
		<div class="row btn_row text-center">
			<div class="col-lg-12">
				<a class="btn-theme" href="<?php echo site_url(); ?>/bewertungen/"><?php the_field('bewertung_schreiben', 'option'); ?></a>
			</div>
		</div>
		<?php } ?>
	</div>
</section>