<div class="qodef-e-info-item qodef-e-info-author">
	<span class="qodef-e-info-author-label"><?php esc_html_e( 'By', 'boldlab' ); ?></span>
	<a itemprop="author" class="qodef-e-info-author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
		<?php the_author_meta( 'display_name' ); ?>
	</a>
</div>