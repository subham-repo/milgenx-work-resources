<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<section class="blog-section">
	<div class="container">
	<div class="section-wrapper">
	             <div class="side-left">
	
	<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				$id = $the_query->post->ID;	
							$comment_count = $the_query->post->comment_count;
							$comment_no = ($comment_count)?$comment_count.'&nbsp Comments':"No comments";					
							$post_content = get_the_content();
							$trimmed_content = wp_trim_words( $post_content, 400, NULL ); ?>

             

			<div class="blog-left-sec">
            <div class="blog-date-container">
						 <div class="bottom-post">
							<div class="date"> 
							<span><?php echo get_the_date('M'); ?></span>
							<span><?php echo get_the_date('d'); ?></span>
							 </div>
							<div class="like_wrap">						 
							   <span><?php echo do_shortcode('[likebtn]');?></span>
							</div>
						 </div>
					  </div>
						  <div class="blog-card-content">
					  <div class="blog-img-container">
						 <?php the_post_thumbnail("post_thumb1",array("class"=>"")); ?>
					  </div>
					  <div class="blog-title"><a href="<?php the_permalink();  ?>"><?php the_title(); ?></a> </div>
					  <div class="blog-ul-sec">
						 <ul>
							<li class="tag"><?php
							$categories = get_the_category();
							foreach ($categories as $category) :
							$exclude = get_the_ID();
							$posts = get_posts('posts_per_page=4&category='. $category->term_id);
							?>
							<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" title="View all" class="btn border"><?php echo $category->name; ?></a>
							<?php  endforeach;  ?>
							</li>
							<li class="by-admin">By <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></li>
							<li><?php echo $comment_no; ?></li>
						 </ul>
					  </div>
					  <div class="blog-content">
						 <p><?php echo $trimmed_content ;?></p>
					  </div>
					  <div class="social-icon-sec">
						 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="readmore">
							   <a class="readmore-btn" href="<?php the_permalink() ?>">Read more </a>
							</div>
						 </div>
					  </div>
				   </div>
                  </div>             
      	
			
             <?php 
					  endwhile; ?>
			
	</div><!-- sideleft -->
							<div class="side-right4">
							   <div class="right-sidebar">
									 <?php  get_sidebar(); ?>
							   </div>
                              </div>	
</div>

</div><!-- container -->
</section>
<?php get_footer();?>
