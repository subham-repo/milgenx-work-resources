<div id="qodef-page-comments">
	<?php if ( have_comments() ) {
		$comments_number = get_comments_number();
		?>
		<div id="qodef-page-comments-list" class="qodef-m">
            <h4 class="qodef-m-title"><?php echo sprintf( _n( '%s Comment', '%s Comments', $comments_number, 'boldlab' ), $comments_number ); ?></h4>
			<ul class="qodef-m-comments">
				<?php wp_list_comments( array_unique( array_merge( array( 'callback' => 'boldlab_get_comments_list_template' ), apply_filters( 'boldlab_filter_comments_list_template_callback', array() ) ) ) ); ?>
			</ul>
			
			<?php if ( get_comment_pages_count() > 1 ) { ?>
				<div class="qodef-m-pagination qodef--wp">
					<?php the_comments_pagination( array(
						'prev_text'          => boldlab_get_icon( 'arrow_carrot-left', 'elegant-icons', esc_html__( '< Prev', 'boldlab' ) ),
						'next_text'          => boldlab_get_icon( 'arrow_carrot-right', 'elegant-icons', esc_html__( 'Next >', 'boldlab' ) ),
						'before_page_number' => '0'
					) ); ?>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
		<p class="qodef-page-comments-not-found"><?php esc_html_e( 'Comments are closed.', 'boldlab' ); ?></p>
	<?php } ?>
	
	<div id="qodef-page-comments-form">
		<?php
		$args = array(
			'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h3>'
		);
		
		comment_form( apply_filters( 'boldlab_filter_comment_form_args', $args ) ); ?>
	</div>
</div>