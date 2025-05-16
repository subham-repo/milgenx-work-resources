add_shortcode('woo_reviews_home','get_woo_reviews_home');
function get_woo_reviews_home()
{
	$p_id = get_the_ID();
	$args           = ['post_type'=>'product','status'=>'approve'];
	$comments_query = new WP_Comment_Query;
	$comments       = $comments_query->query( $args );
	
	$out            = "";
	if (!empty($comments)){
		$out           .= "<div class='fun_talk rev_wrapp owl-carousel' >";
		foreach($comments as $comment) :
		$title       = get_the_title( $comment->comment_post_ID );
		$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );		
		$rev_content = $comment->comment_content;
		$rev_trimmed = wp_trim_words( $rev_content, 80, '...' );
		$meta_info   = $comment->comment_date; 
		$post_author = $comment->comment_author;
		$post_temp = $comment->comment_post_ID;
		$comment_id_7 = $post_temp; 
    	$comment_post_id = $comment_id_7->comment_post_ID ;
    	$featured_img_url = get_the_post_thumbnail_url($comment_id_7,'medium');
    	$prod_permalink = get_the_permalink($comment_id_7);
    	$prod_title = get_the_title($comment_id_7);

		$out        .= '<div class="rev-row with-img">
							<div class="rev-info">
								<span class="rev-auth">'.$post_author.'</span>
								<span class="rat_count">'.wc_get_rating_html( $rating ).'</span>
							</div>
							<div class="rev-content with-img">
								<p class="rev-content">'.$rev_trimmed.'</p>
								<div class="prod_meta">
								<img src="'.$featured_img_url.'" />
								<a href="'.$prod_permalink.'">'.$prod_title.'</a>
								</div>
							</div>
							
						</div>'; 

	endforeach;
	 
	$out           .= "</div>"; 

	
	}else{
	$out = "<span class='no-review'> Be the first to leave a review! </span>"; 
	}
	return $out;
}