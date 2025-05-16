<?php 
	/*
		Template Name: Staff
	*/
	get_header();
?>

<section id="staff_body">
<!--Staff Section Goes here-->
<div class="all_staff">
	<div class="container">
		<div class="uk-grid uk-grid-collapse">
			<div class="uk-width-1-1">
				<div class="uk-width-1-1 staff_heading">
					<h1 class="dark_pink_clr">OUR STAFF</h1>
				</div>
				<div class="uk-width-1-1 staff_members">
					<div class="uk-grid uk-grid-small">
						<?php 
						$current_category = get_queried_object();
						$args = array(
						"post_type" => "staff",
					 	"post_status" => "publish",
						'posts_per_page' => -1,
						'cat' => $current_category->cat_ID ,  
						);
						$count = 1;
						$myposts = get_posts($args);
						
						foreach($myposts as $post):
							setup_postdata($post);
						$id = $post->ID;
						$post_content = get_the_content();
						$featured_img_url = get_the_post_thumbnail_url($id,'full');
						$title = get_the_title($id) ;
						$service_link = get_permalink($id);

						?> 
						<div class="uk-width-1-4@l uk-width-1-4@m uk-width-1-2@s parent_staff">
							<div class="uk-width-1-1 staff_img" style="background-image: url('<?php echo $featured_img_url; ?>');">
								<h2><?php echo $title; ?></h2>
								<div class="overlay_data">
									<h3><?php the_field('designation');?></h3>
								</div>
								
							</div>
							<!--Pop up section goes here-->
								<div class="staff_detail_popup">
								<div class="member_data">
								<img src="<?php echo $featured_img_url; ?>">
								<h2><?php echo $title; ?></h2>
								<h3>"<?php the_field('designation');?>"</h3>
								<p><?php echo $post_content ?></p>

								</div>
								<i class="fa fa-window-close" aria-hidden="true"></i>
								</div>
								<!--Pop up section ends here-->
						</div>
						
						<?php endforeach; ?>	
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
<!--Staff Section Ends here-->
<script>
	jQuery(document).ready(function(){
		jQuery('.parent_staff').click(function(){
			jQuery('.staff_detail_popup').removeClass('active');
			jQuery(this).children('.staff_detail_popup').addClass('active');
		})
		jQuery('.staff_detail_popup i').click(function(e){
			jQuery(this).parent().removeClass('active');
			e.stopPropagation();
		})
	});
</script>
</section>

<?php 
	get_footer();
?>