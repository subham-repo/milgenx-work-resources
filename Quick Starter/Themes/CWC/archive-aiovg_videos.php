<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();  ?>

	<section id="primary" class="post-content">
		<div id="content" role="main">
			<div class="container">
				<div class="row">
					<div class="content-part col-md-8 col-sm-12 col-xs-12">
					<div class="blog_content_top_bar">
						<div class="blog_main_heading">
						<?php if(is_archive()){ ?>
							<h1><?php printf( '<span>' . wp_title() . '</span>' ); ?></h1>
							
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
					<div class="post-wrapper row">		
					<?php if ( have_posts() ) : ?>
					<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/* Include the post format-specific template for the content. If you want to
							 * this in a child theme then include a file called called content-___.php
							 * (where ___ is the post format) and that will be used instead.
							 */
							get_template_part( 'content', 'video_testimonial' );

						endwhile;

						// twentytwelve_content_nav( 'nav-below' );
						?>

						<div class="col-md-12">
							<?php wp_pagenavi(); ?>
						</div>

					<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif; ?>
					</div>
				</div>
				<div class="post_sidebar col-md-4 col-sm-12 col-xs-12">
					<?php dynamic_sidebar('posts_sidebar'); ?>
				</div>
				</div>
			</div>
		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>