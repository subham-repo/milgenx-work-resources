<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); 

$our_team_details 				   = get_field('our_team_details');
$position		   				   = $our_team_details['position'];
$email		   					   = $our_team_details['email'];
$phone		   					   = $our_team_details['phone'];
$appointment_button_text		   = $our_team_details['appointment_button_text'];
$appointment_button_link		   = $our_team_details['appointment_button_link'];

$our_team_social_links  = get_field('our_team_social_links');
$facebook_link 			= $our_team_social_links['facebook_link'];
$twitter_link 			= $our_team_social_links['twitter_link'];
$linkedin_link 			= $our_team_social_links['linkedin_link'];
$google_link 			= $our_team_social_links['google+_link'];
$instagram_link 		= $our_team_social_links['instagram_link'];
?>

<style type="text/css">
.site-header {
    background: #000 none repeat scroll 0 0;
}
.site-content{
	margin:0px;
}
#tocList li:first-child {
	display: none;
}
#tocList li:nth-child(2) {
	display: none;
}
</style>

<section id="primary" class="post-content">
	<div id="content" role="main">
		<div class="container">
			<div class="row blog-wrapper">
			<div class="blog_breadcrumb col-md-12" style="margin-bottom: 50px;">
				<?php
					if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb('
						<p id="breadcrumbs">','</p>
					');
					}
				?>
			</div>
			<div class="our_staff staff_single_cats col-md-4 col-sm-12 col-xs-12">
		      	<div class="our_staff_inner">
		      		<div class="our_staff-thumbs">
		      			<a class="staff_thumb" href="javascript:void(0)" >
		      				<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?> /">
		      			</a>
		      			<div class="thememount-team-social-links">
		      			<?php if(!empty($our_team_social_links)){ ?>
						<ul>
					    	<?php if(!empty($facebook_link)){ ?>
							<li class="thememount-social-facebook">
					        	<a href="<?php echo $facebook_link ?>" class="hint--top" data-hint="Facebook" target="_blank">
					        		<i class="fa fa-facebook"></i>
					        	</a>
					        </li>
							<?php } ?>
							<?php if(!empty($twitter_link)){ ?>
							<li class="thememount-social-twitter">
					        	<a href="<?php echo $twitter_link ?>" class="hint--top" data-hint="Twitter" target="_blank">
					        		<i class="fa fa-twitter"></i>
					        	</a>
					        </li>
							<?php } ?>
					        <?php if(!empty($linkedin_link)){ ?>
							<li class="thememount-social-linkedin">
					        	<a href="<?php echo $linkedin_link ?>" class="hint--top" data-hint="LinkedIn" target="_blank">
						        	<i class="fa fa-linkedin"></i>
						        </a>
					        </li>
							<?php } ?>
							<?php if(!empty($google_link)){ ?>
							<li class="thememount-social-gplus">
					        	<a href="<?php echo $google_link ?>" class="hint--top" data-hint="Google+" target="_blank">
					        		<i class="fa fa-google-plus"></i>
					        	</a>
					        </li>
							<?php } ?>
					        <?php if(!empty($instagram_link)){ ?>
							<li class="thememount-social-instagram">
					        	<a href="<?php echo $instagram_link ?>" class="hint--top" data-hint="Instagram" target="_blank">
					        		<i class="fa fa-instagram"></i>
					        	</a>
					        </li>
							<?php } ?>
					    </ul>
						<?php } ?>	
					    
					</div>
		      		</div>
		      		<div class="our_staff_info text-center">
		      			<h2>
		      				<a class="staff_name" href="javascript:void(0)">
		      					<?php the_title(); ?>
		      				</a>
						</h2>
						<?php if(!empty($position)){ ?>
						<span class="position"><?php echo $position; ?></span>
						<?php } ?>
						<?php if(!empty($email)){ ?>
						<span class="mail_link">
							<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
						</span>
						<?php } ?>	
						<?php if(!empty($phone)){ ?>
						<span class="phone"><a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></span>
						<?php } ?>	
						<?php if(!empty($appointment_button_link)){ ?>
						<div style="padding-top: 5px" class="btn-row text-center">
							<a class="btn-theme" href="<?php echo $appointment_button_link; ?>">
								<span><?php echo $appointment_button_text; ?></span>
							</a>
						</div>
						<?php } ?>	
						


		      		</div>
		      	</div>
		      </div>    
			<div class="content-part col-md-8 col-sm-12 col-xs-12">
				<div class="blog_content_top_bar">
					<div class="blog_main_heading">
					<?php if(is_archive()){ ?>
						<h1><?php printf( __( 'Category : %s', 'twentytwelve' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>
						
					<?php } else{  ?>
						<h1><?php echo the_title().' - '. $position ?></h1>
					<?php } ?>
					</div>
					
				</div>
				<div class="single_blog_pagepost_content margin_top_15px">
					<?php if ( have_posts() ) : ?>
					<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/* Include the post format-specific template for the content. If you want to
							 * this in a child theme then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */
							// get_template_part( 'content', 'blog' );
							?>

							<div class="single_blog_content">
								<?php the_content(); ?>
							</div>

							<div class="share-section">
								<div class="post_share">
									<span class="ss ss_fb"><a target="_blank" href="http://www.facebook.com/share.php?u=<?php the_permalink();?>&title=<?php the_title();?>"><i class="fa fa-facebook"></i> Share</a></span>									
									<span class="ss ss_tw"><a target="_blank" href="http://twitter.com/intent/tweet?status=<?php the_permalink();?>+<?php the_title();?>"><i class="fa fa-twitter"></i> Tweet</a></span>
									<span class="ss ss_pin"><a target="_blank" href="http://pinterest.com/pin/create/bookmarklet/?url=<?php the_permalink();?>&is_video=false&description=<?php the_title();?>"><i class="fa fa-pinterest"></i> Pin</a></span>
								</div>

							</div>
							
							
							<?php

						endwhile;

						// twentytwelve_content_nav( 'nav-below' );
						?>
					<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif; ?>
					

					
				</div>
			</div>
		</div>
		</div>	
	</div>
</section>
	
<script>
	jQuery(document).ready(function() {                                                                          
    jQuery(tocList).empty();                                                            
    
    var prevH2Item = null;                                                            
    var prevH2List = null;                                                            
    
    var index = 0;                                                                    
    // jQuery("h2, h3").each(function() {                                                     
    jQuery("h2").each(function() {                                                     
    
        //insert an anchor to jump to, from the TOC link.            
        var anchor = "<a  id='"+index+"'  name='" + index + "' value='" + index + "'></a>";                 
        jQuery(this).before(anchor);                                     
        
        var li     = "<li><a class='scolltohead' href='#' value='" + index + "' >" + $(this).text() + "</a></li>"; 
        
        if( jQuery(this).is("h2") ){                                     
            prevH2List = jQuery("<ul></ul>");                
            prevH2Item = jQuery(li);                                     
            prevH2Item.append(prevH2List);                          
            prevH2Item.appendTo("#tocList");                        
        } else {                                                    
            prevH2List.append(li);                                  
        }                                                           
        index++;                                                    
    });         
    
     
     jQuery(".scolltohead").click(function(e){
     	e.preventDefault();
     	var id = jQuery(this).attr("value");
	    jQuery([document.documentElement, document.body]).animate({
	        scrollTop: jQuery("#"+id+"").offset().top - 100
	    }, 2000);
    }); 
});     
	</script>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>