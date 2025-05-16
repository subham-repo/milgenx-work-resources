<?php

if ( ! function_exists( 'boldlab_include_comments_in_templates' ) ) {
	/**
	 * Function which includes comments templates on pages/posts
	 */
	function boldlab_include_comments_in_templates() {

		// Include comments template
		comments_template();
	}

	add_action( 'boldlab_action_after_page_content', 'boldlab_include_comments_in_templates', 100 ); // permission 100 is set to comments template be at the last place
	add_action( 'boldlab_action_after_blog_post_item', 'boldlab_include_comments_in_templates', 100 );
}

if ( ! function_exists( 'boldlab_is_page_comments_enabled' ) ) {
	/**
	 * Function that check is module enabled
	 */
	function boldlab_is_page_comments_enabled() {
		$is_enabled = apply_filters( 'boldlab_filter_enable_page_comments', true );

		return $is_enabled;
	}
}

if ( ! function_exists( 'boldlab_load_page_comments' ) ) {
	/**
	 * Function which loads page template module
	 */
	function boldlab_load_page_comments() {

		if ( boldlab_is_page_comments_enabled() ) {
			boldlab_template_part( 'comments', 'templates/comments' );
		}
	}

	add_action( 'boldlab_action_page_comments_template', 'boldlab_load_page_comments' );
}

if ( ! function_exists( 'boldlab_get_comments_list_template' ) ) {
	/**
	 * Function which modify default wordpress comments list template
	 *
	 * @param $comment object
	 * @param $args array
	 * @param $depth int
	 *
	 * @return string that contains comments list html
	 */
	function boldlab_get_comments_list_template( $comment, $args, $depth ) {
		global $post;
		$GLOBALS['comment'] = $comment;

		$classes = array();

		$is_author_comment = $post->post_author == $comment->user_id;
		if ( $is_author_comment ) {
			$classes[] = 'qodef-comment--author';
		}

		$is_specific_comment = $comment->comment_type == 'pingback' || $comment->comment_type == 'trackback';
		if ( $is_specific_comment ) {
			$classes[] = 'qodef-comment--no-avatar';
			$classes[] = 'qodef-comment--' . esc_attr( $comment->comment_type );
		}
		?>
    <li class="qodef-comment-item qodef-e <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
        <div id="comment-<?php comment_ID(); ?>" class="qodef-e-inner">
			<?php if ( ! $is_specific_comment ) { ?>
                <div class="qodef-e-image"><?php echo get_avatar( $comment, 64 ); ?></div>
			<?php } ?>
            <div class="qodef-e-content">
                <h5 class="qodef-e-title vcard"><?php echo sprintf( '<span class="fn">%s%s</span>', $is_specific_comment ? sprintf( '%s: ', esc_attr( ucwords( $comment->comment_type ) ) ) : '', get_comment_author_link() ); ?></h5>
                <div class="qodef-e-date commentmetadata">
                    <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>"><?php comment_time( get_option( 'date_format' ) ); ?></a>
                </div>
				<?php if ( ! $is_specific_comment ) { ?>
                    <p class="qodef-e-text"><?php echo strip_tags( get_comment_text() ); ?></p>
				<?php } ?>
                <div class="qodef-e-links">
					<?php
					comment_reply_link( array_merge( $args, array(
						'reply_text' => esc_html__( 'Reply', 'boldlab' ),
						'depth'      => $depth,
						'max_depth'  => $args['max_depth']
					) ) );

					edit_comment_link( esc_html__( 'Edit', 'boldlab' ) ); ?>
                </div>
            </div>
        </div>
		<?php //li tag will be closed by WordPress after looping through child elements ?>
		<?php
	}
}

if ( ! function_exists( 'boldlab_override_comment_form_args' ) ) {
	/**
	 * Function which loads page template module
	 */
	function boldlab_override_comment_form_args( $args ) {

		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$html_req  = ( $req ? " required='required'" : '' );
		$req_star  = ( $req ? "*" : '' );
		$html5     = current_theme_supports( 'html5', 'comment-form' ) ? true : false;

		$fields           = array();
		$fields['author'] = '<p class="comment-form-author">' . '<input id="author" name="author" type="text" placeholder="' . esc_attr__( 'Name', 'boldlab' ) . $req_star . '" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $html_req . ' /></p>';
		$fields['email']  = '<p class="comment-form-email">' . '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' placeholder="' . esc_attr__( 'Email', 'boldlab' ) . $req_star . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $html_req . ' /></p>';
		$fields['url']    = '<p class="comment-form-url">' . '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' placeholder="' . esc_attr__( 'Website', 'boldlab' ) . '" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /></p>';

		$args['fields'] = $fields;

		$args['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" placeholder="' . esc_attr__( 'Comment', 'boldlab' ) . $req_star . '" required="required"></textarea></p>';
		$args['label_submit']  = esc_html__( 'Post comment _', 'boldlab' );
		$args['submit_button'] = '<button name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s"><span class="qodef-m-text">%4$s</span></button>';
		$args['class_submit']  = 'qodef-button qodef-layout--outlined';

		return $args;
	}

	add_filter( 'boldlab_filter_comment_form_args', 'boldlab_override_comment_form_args' );
}