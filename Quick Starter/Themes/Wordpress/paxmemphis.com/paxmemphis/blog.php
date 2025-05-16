<?php
/**
 * Template Name: Blog Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header(); ?>
<section class="all_blog_posts">
	<div class="blog_sec">
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

		<!--Blog Posts section goes here-->
		<div class="blog_inner_sec">
			<div class="container">
				<div class="uk-grid-collapse uk-grid">
					<!--Blog Left Side goes here-->
						<div class="uk-width-3-4@l uk-width-3-4@m uk-width-1-1@s all_posts">
							<?php 
								$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
								$args = array(
								'post_type'=> 'post',
								'orderby'    => 'ID',
								'post_status' => 'publish',
								'order'    => 'DESC',
								'paged'=> $paged,
								'posts_per_page' => 4 // this will retrive all the post that is published 
								);
								$result = new WP_Query( $args );
								if ( $result-> have_posts() ) :
								while ( $result->have_posts() ) : $result->the_post(); ?>

							<div class="uk-grid-collapse uk-grid posts_card">
								<div class="uk-width-1-4@l uk-width-1-4@m uk-width-1-1@s">
									<a href="<?php the_permalink(); ?>">
										<?php 
											$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
											if($image == ""){ 
										?>
											<div class="b_feat" style="background-image: url('<?php echo site_url(); ?>/wp-content/uploads/2019/07/no-image-small.jpg');"></div>
										<?php } else { ?>
											<div class="b_feat" style="background-image: url('<?php echo $image[0] ; ?>');"></div>
										<?php } ?>
									</a>
								</div>
								<div class="uk-width-3-4@l uk-width-3-4@m uk-width-1-1@s">
									<div class="b_cont">
										<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
											<?php 
												 $content_e = get_the_excerpt();
												echo $content_str = substr($content_e, 0, 250).'...';
											?>
										<div class="post_detail">
											<a href="<?php the_permalink(); ?>">Read More</a>
										</div>
									</div>
								</div>
							</div>
							<?php endwhile; endif;  wp_reset_postdata(); ?>
							<div class="navi_post">
								<?php wp_pagenavi(array( 'query' =>  $result )); ?>
							</div>
							
						</div>
					<!--Blog Left Side ends here-->

					<!--Blog Right Side goes here-->
						<div class="uk-width-1-4@l uk-width-1-4@m uk-width-1-1@s b_right">
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
									<div class="blog_side">
										<div class="blog_side_posts">
											<h2>Recent Posts</h2>
											<div class="recent_posts_data">
												<?php 
													$args = array(
													'post_type'=> 'post',
													'orderby'    => 'ID',
													'post_status' => 'publish',
													'order'    => 'DESC',
													'posts_per_page' => 5 // this will retrive all the post that is published 
													);
													$result = new WP_Query( $args );
													if ( $result-> have_posts() ) :
													while ( $result->have_posts() ) : $result->the_post(); 
												?>

												<div class="r_posts">
													<?php 
														$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
														if($image == ""){ 
													?>
														<div class="r_img" style="background-image: url('<?php echo site_url(); ?>/wp-content/uploads/2019/07/no-image-small.jpg');"></div>
													<?php } else { ?>
														<div class="r_img" style="background-image: url('<?php echo $image[0] ; ?>');"></div>
													<?php } ?>
													<div class="r_data">
														<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
														
													</div>
												</div>

												<?php endwhile; endif;  wp_reset_postdata(); ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					<!--Blog Right Side ends here-->
				</div>		
			</div>
		</div>
		
		<!--Blog Posts section ends here-->
	</div>
</section>
<?php get_footer(); ?>