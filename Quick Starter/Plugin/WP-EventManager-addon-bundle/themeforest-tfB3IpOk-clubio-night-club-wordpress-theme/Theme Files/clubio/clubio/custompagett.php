<?php
/* Template Name: Clubio Template */
get_header(); ?>
		<main id="main" class="page-main tt-page-main">
			<?php
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/page/content', 'tt-page' );
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			endwhile;
			?>
		</main>
<?php get_footer();
