<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();
?>

	<section id="primary" class="error_template full-width">
		<main id="main" class="site-main full-width">

			<div class="container error-404 not-found text-center">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'twentynineteen' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentynineteen' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .page-content -->

				<div class="btn-row full-width text-center">
					<a href="<?php echo site_url(); ?>" class="btn-theme"><span><i class="fa fa-angle-left"></i> Back To Home Page</span></a>
				</div>
			</div><!-- .error-404 -->

		</main><!-- #main -->
	</section><!-- #primary -->


<style type="text/css">
	.global_cta {
	    display: none;
	}
</style>
<?php
get_footer();
