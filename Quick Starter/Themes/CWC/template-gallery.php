<?php 
	/*
		Template Name: Gallery
	*/
	get_header();
?>

<section id="gallery_body">
	<div class="all_gallery">
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

		<!--Gallery section goes here-->
		<div class="gallery_inner_sec">
			<div class="container">
				<div class="uk-grid-collapse uk-grid gl_ins">
					<h1>AGAPE TREATMENT CENTER <span>GALLERY</span></h1>
					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : the_post(); ?>    
						
						<?php echo the_content(); ?>

						<?php endwhile; ?>
					<?php endif; ?>
				</div>		
			</div>
		</div>
		
		<!--Gallery section ends here-->
	</div>
</section>

<?php 
	get_footer();
?>