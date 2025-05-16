add_shortcode('woo_reviews','get_woo_reviews');
function get_woo_reviews()
{
	$p_id = get_the_ID();
	$args           = ['post_type'=>'product','status'=>'approve','post_id'=>$p_id];
	$comments_query = new WP_Comment_Query;
	$comments       = $comments_query->query( $args );
	
	$out            = "";
	
	if (!empty($comments)){
		$out           .= "<div class='rev_wrapp owl-carousel' >";
		foreach($comments as $comment) :
		$title       = get_the_title( $comment->comment_post_ID );
		$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );		
		$rev_content = $comment->comment_content;
		$rev_trimmed = wp_trim_words( $rev_content, 40, '...' );
		$meta_info   = $comment->comment_date; 
		/* if (empty($rating)) 
		{
			$rating = 0; 
			$rev_trimmed = "No review yet."; 
		}   */ 
		//$count = $product->get_review_count();
		$out        .= '<div class="rev-row">
							<div class="rev-info">
								<span class="rev-auth">Customer</span>
								<span>'.$meta_info.'</span>
								<span class="rat_count">'.wc_get_rating_html( $rating ).'</span>
							</div>
							<div class="rev-content">
								<p class="rev-content">'.$rev_trimmed.'</p>
							</div>
						</div>';  
						
	endforeach;
	 
	$out           .= "</div>"; 

	
	}else{
	$out = "<span class='no-review'> No review yet. </span>"; 
	}
	return $out;
}