
add_shortcode('getPost', 'post_listing');
function  post_listing($atts) {
	$atts = shortcode_atts(
	
		array(
		// Declare parameter here
			'posttype' => 'no post',
		), $atts, 'getPost' );
		
		// Get parameter value in variable
		$pname = $atts['posttype'];
		
ob_start();
echo '<div class="posts-outer">' ;
    global $post;
     $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $args = array(
                "post_type" => $pname,
                "post_status" => "publish",
                'posts_per_page' => 5,
                'ORDER' => ASC,
                'paged' => $paged
                );
            $myposts = get_posts($args);
            foreach($myposts as $post):
                setup_postdata($post);
            $id = $post->ID;
            $post_content = get_the_content();
            $desc = strip_tags ($post_content);
            $imageId = get_post_thumbnail_id($id);
            $post_img = wp_get_attachment_url($imageId);
            $btn_url= get_post_meta($id,'wpcf-take-test',true);
            $post_title= get_the_title();
			$imageId = get_post_thumbnail_id($id);
		    $imageUrl = wp_get_attachment_url($imageId);
			$link = get_the_permalink();

?>
						
				<div class="post-wrapper">
					<!-- <a href="<?php // echo $link; ?>">
						<div class="post-inner">
							<h2><?php //echo $post_title ; ?></h2>
							<span class="post-link">Read Study</span>
						</div>
					</a> -->

					<a class="post-title" href="<?php echo $link; ?>">
						<h2 ><?php echo $post_title ; ?></h2>
					</a>
					<div class="post-box">
						<div class="post-avtar">
							<img src="<?php echo $post_img ; ?> " />
						</div>
						<div class="post-info">
							<p><?php echo wp_trim_words($desc , 15 , '[...]'  ); ?></p>
							<a href="<?php echo $link; ?>" class="post-btn"> <span class="post-link">CONTINUE READING</span></a>
						</div>
					</div>
				</div>
        
        <?php  
		

            endforeach;	
            // Pagination

            echo '<div class="pagination-control">';
	        $loop = new WP_Query( $args );
			if ( $loop->have_posts() ) {
			   
			    $total_pages = $loop->max_num_pages;

			    if ($total_pages > 1){

			        $current_page = max(1, get_query_var('paged'));

			        echo paginate_links(array(
			            //'base' => get_pagenum_link(1) . '%_%',
			            // 'format' => '/page/%#%',
			            'current' => $current_page,
			            'total' => $total_pages,
			            'prev_text'    => __('« prev'),
			            'next_text'    => __('next »'),
			        ));
			    }    
			} 
            echo '</div>';

            wp_reset_postdata(); 
echo '</div>';	

$cont = ob_get_contents();
ob_get_clean();
return $cont;
}