<?php get_header(); ?>
<?php require get_template_directory() . '/inc/vc/svg_icons.php';
$category = get_queried_object();
$catID = $category->term_id;
?>
<div class="content">
	<div class="container">
		<h1 class="heading_category"><?php single_cat_title(); ?></h1>
		<?php
		// Check if there are any posts to display
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
		'orderby' => 'title',
		'order'   => 'ASC',
		'cat' => $catID,
		'paged'=> $paged
		);

	$the_query = new WP_Query( $args ); 
	if ( $the_query->have_posts() ) : ?>

			<!--The Loop-->
			<div class="category_section">
			
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<div class="post-wrap category_list">
					<h4><?php the_title(); ?> <i class="fa fa-chevron-up" aria-hidden="true"></i></h4>
					<p><a href="<?php the_permalink() ?>"><?= excerpt( 20 ); ?></a></p>
				</div>
			<?php endwhile; ?>
			<div class="custom-pagination">

					<?php

						if($the_query->max_num_pages>1){

						if(function_exists('wp_pagenavi'))

						wp_pagenavi(array(

							'query' =>$the_query   

							));	

						}

	              		wp_reset_postdata();

					?>

				</div>						

			<?php
			echo "</div>";
		else: ?>
			<p>Sorry, no posts matched your criteria.</p>
		<?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>
<script>
jQuery('.category_list').click(function() {
	if(jQuery(this).hasClass('open'))
    {
	   jQuery(this).removeClass('open');
    }
    else
    {
		 jQuery(this).addClass('open');
    }
  });
</script>