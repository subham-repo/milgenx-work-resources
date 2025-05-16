<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

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
			
			<div class="content-part col-md-12 col-sm-12 col-xs-12">
				<div class="blog_content_top_bar">
					<div class="blog_main_heading">
					<?php if(is_archive()){ ?>
						<h1><?php printf( __( 'Category : %s', 'twentytwelve' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>
						
					<?php } else{  ?>
						<h1><?php echo wp_title(); ?></h1>
					<?php } ?>
					</div>
					<div class="blog_breadcrumb">
						<?php
							if ( function_exists('yoast_breadcrumb') ) {
								yoast_breadcrumb('
								<p id="breadcrumbs">','</p>
							');
							}
						?>
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
								<div class="single_blog_page_posts_thumb right_aligned_single">
									<?php if(has_post_thumbnail())
									{	?>
										<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
									<?php }	?>
								</div>
								<?php the_content(); ?>
							</div>

							<div class="share-section">
								<div class="post_share">
									<span class="ss ss_fb"><a target="_blank" href="http://www.facebook.com/share.php?u=<?php the_permalink();?>&title=<?php the_title();?>"><i class="fa fa-facebook"></i> Share</a></span>									
									<span class="ss ss_tw"><a target="_blank" href="http://twitter.com/intent/tweet?status=<?php the_permalink();?>+<?php the_title();?>"><i class="fa fa-twitter"></i> Tweet</a></span>
									<span class="ss ss_pin"><a target="_blank" href="http://pinterest.com/pin/create/bookmarklet/?url=<?php the_permalink();?>&is_video=false&description=<?php the_title();?>"><i class="fa fa-pinterest"></i> Pin</a></span>
								</div>

							</div>
							
							<nav class="nav-single">
								<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'twentytwelve' ) . '</span> Previous' ); ?></span>
								<span class="nav-next"><?php next_post_link( '%link', 'Next <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'twentytwelve' ) . '</span>' ); ?></span>
							</nav>
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
     	console.log('ping');
     	e.preventDefault();
     	
     	var id = jQuery(this).attr("value");
     	console.log('id: '+id);

	    jQuery('html,body').animate({
        scrollTop: jQuery("#"+id+"").offset().top - 100},
        'slow');
    }); 
});     
	</script>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>