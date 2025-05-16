

<?php
   /**
   
    * Template Name: Blog Page Template
   
    *
   
    *
   
    */
   
   get_header();?>
<section class="blog-section">
   <div class="container">
      <div class="section-wrapper">
         <div class="side-left">
            <div class="blog-left-sec">
               <!-- blog-card-container -->
               <?php
                  $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                  $args = array(                  
                  	'post_type'=> 'post',                
                    'post_status'=> 'publish', 
                  	'posts_per_page' => 2,
                  	'paged'=> $paged
                  );
                  
                  $the_query = new WP_query($args);
                  if($the_query->have_posts()){                 
                  	while($the_query->have_posts()):				
                  		$the_query->the_post();                
                  		$id = $the_query->post->ID;	
                  		$comment_count = $the_query->post->comment_count;
						$comment_no = ($comment_count)?$comment_count.'&nbsp Comments':"No comments";					
						$post_content = get_the_content();
						$trimmed_content = wp_trim_words( $post_content, 400, NULL );
                  ?>
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
						<div class="blog-title">
							<a href="<?php the_permalink();  ?>"><?php the_title(); ?></a>
						</div>
						<div class="blog-ul-sec">
							<ul>
								<li class="tag"><?php
								$categories = get_the_category();
								foreach ($categories as $category) :
								$exclude = get_the_ID();
								$posts = get_posts('posts_per_page=4&category='. $category->term_id);
								?>
								<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" title="View all" class="btn border"><?php echo $category->name; ?></a>
								<?php  endforeach;  ?></li>
								<li class="by-admin">By <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></li>
								<li><?php echo $comment_no; ?></li>
							</ul>
						</div>
						<div class="blog-content">
							<p><?php echo $trimmed_content ;?></p>
						</div>
						<div class="social-icon-sec">
								<div class="readmore">
									<a class="readmore-btn" href="<?php the_permalink() ?>">Read more </a>
								</div>
						</div>
					</div>
               <?php 
                  endwhile; ?>
              
               <?php } ?>
            </div>
				<div class="pagination-wrap"> 
					<?php
					wp_pagenavi(array( 'query' =>  $the_query ));
					?>
				</div>
         </div>
         <div class="side-right4">
            <div class="right-sidebar">
               <?php  get_sidebar(); ?>
            </div>
		</div>
      </div>
   </div>
</section>
<?php
   get_footer();
   
   ?>


