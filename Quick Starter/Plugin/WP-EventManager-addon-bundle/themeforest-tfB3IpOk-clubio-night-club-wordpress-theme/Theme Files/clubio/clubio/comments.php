<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Clubio
 */
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area7 comments-wrap tt-comments-layout">
    <div class="comments-block form-single-post">
        <?php
        if ( have_comments() ) :
            function theme_comment($comment, $args, $depth) {
                if ( 'div' === $args['style'] ) {
                    $tag       = 'div';
                    $add_below = 'comment';
                } else {
                    $tag       = 'li';
                    $add_below = 'div-comment';
                }
                ?>
                <<?php echo wp_kses($tag, clubio_tags()); ?> <?php comment_class( empty($args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
                <?php if ( 'div' != $args['style'] ) : ?><div id="div-comment-<?php comment_ID() ?>" class="tt-comments-level-1"><?php endif; ?>


                <?php
                    if ( $args['avatar_size'] != 0 ) {
                        echo '<div class="comment-author7 vcard7 userpic tt-avatar">'.get_avatar($comment, 90).'</div>';
                    }
                    ?>
                <div class="tt-content">
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                    <div class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'clubio' ); ?></div>
                    <?php endif; ?>
                    <div class="tt-comments-title">

                    <?php  if (get_comment_type() == 'comment') { ?>
                        <div class="username">
                            <?php printf( ( '<span class="fn">%s</span>' ), get_comment_author_link() ); ?>
                        </div>
                        <div class="time">
                            <?php
                            echo '<svg class="icon icon-time" width="20" height="21" viewBox="0 0 20 21" xmlns="http://www.w3.org/2000/svg"><path d="M10 0.25C8.61979 0.25 7.32422 0.516927 6.11328 1.05078C4.90234 1.57161 3.84115 2.28776 2.92969 3.19922C2.03125 4.09766 1.3151 5.15234 0.78125 6.36328C0.260417 7.57422 0 8.86979 0 10.25C0 11.6302 0.260417 12.9258 0.78125 14.1367C1.3151 15.3477 2.03125 16.4089 2.92969 17.3203C3.84115 18.2188 4.90234 18.9284 6.11328 19.4492C7.32422 19.9831 8.61979 20.25 10 20.25C11.3802 20.25 12.6758 19.9831 13.8867 19.4492C15.0977 18.9284 16.1523 18.2188 17.0508 17.3203C17.9622 16.4089 18.6784 15.3477 19.1992 14.1367C19.7331 12.9258 20 11.6302 20 10.25C20 8.86979 19.7331 7.57422 19.1992 6.36328C18.6784 5.15234 17.9622 4.09766 17.0508 3.19922C16.1523 2.28776 15.0977 1.57161 13.8867 1.05078C12.6758 0.516927 11.3802 0.25 10 0.25ZM10 18.2578C8.90625 18.2578 7.87109 18.0495 6.89453 17.6328C5.91797 17.2031 5.0651 16.6302 4.33594 15.9141C3.61979 15.1849 3.04688 14.332 2.61719 13.3555C2.20052 12.3789 1.99219 11.3438 1.99219 10.25C1.99219 9.15625 2.20052 8.12109 2.61719 7.14453C3.04688 6.16797 3.61979 5.32161 4.33594 4.60547C5.0651 3.8763 5.91797 3.30339 6.89453 2.88672C7.87109 2.45703 8.90625 2.24219 10 2.24219C11.0938 2.24219 12.1289 2.45703 13.1055 2.88672C14.082 3.30339 14.9284 3.8763 15.6445 4.60547C16.3737 5.32161 16.9466 6.16797 17.3633 7.14453C17.793 8.12109 18.0078 9.15625 18.0078 10.25C18.0078 11.3438 17.793 12.3789 17.3633 13.3555C16.9466 14.332 16.3737 15.1849 15.6445 15.9141C14.9284 16.6302 14.082 17.2031 13.1055 17.6328C12.1289 18.0495 11.0938 18.2578 10 18.2578ZM10.5078 5.25H9.00391V11.2461L14.1992 14.4492L15 13.1406L10.5078 10.4453V5.25Z"/></svg>
                                <a href="'.htmlspecialchars( get_comment_link( $comment->comment_ID ) ) .'">'. get_comment_date().'</a>';  ?>
                            <?php edit_comment_link( esc_attr__( '(Edit)','clubio'), '  ', '' ); ?>
                        </div>
                        <?php } else { ?>
                        <div class="username">
                            <?php printf( ( '<span class="fn">%s</span>' ), get_comment_author_link() ); ?>
                        </div>
                        <div class="time ch-time">
                            <?php  echo '<svg class="icon icon-time" width="20" height="21" viewBox="0 0 20 21" xmlns="http://www.w3.org/2000/svg"><path d="M10 0.25C8.61979 0.25 7.32422 0.516927 6.11328 1.05078C4.90234 1.57161 3.84115 2.28776 2.92969 3.19922C2.03125 4.09766 1.3151 5.15234 0.78125 6.36328C0.260417 7.57422 0 8.86979 0 10.25C0 11.6302 0.260417 12.9258 0.78125 14.1367C1.3151 15.3477 2.03125 16.4089 2.92969 17.3203C3.84115 18.2188 4.90234 18.9284 6.11328 19.4492C7.32422 19.9831 8.61979 20.25 10 20.25C11.3802 20.25 12.6758 19.9831 13.8867 19.4492C15.0977 18.9284 16.1523 18.2188 17.0508 17.3203C17.9622 16.4089 18.6784 15.3477 19.1992 14.1367C19.7331 12.9258 20 11.6302 20 10.25C20 8.86979 19.7331 7.57422 19.1992 6.36328C18.6784 5.15234 17.9622 4.09766 17.0508 3.19922C16.1523 2.28776 15.0977 1.57161 13.8867 1.05078C12.6758 0.516927 11.3802 0.25 10 0.25ZM10 18.2578C8.90625 18.2578 7.87109 18.0495 6.89453 17.6328C5.91797 17.2031 5.0651 16.6302 4.33594 15.9141C3.61979 15.1849 3.04688 14.332 2.61719 13.3555C2.20052 12.3789 1.99219 11.3438 1.99219 10.25C1.99219 9.15625 2.20052 8.12109 2.61719 7.14453C3.04688 6.16797 3.61979 5.32161 4.33594 4.60547C5.0651 3.8763 5.91797 3.30339 6.89453 2.88672C7.87109 2.45703 8.90625 2.24219 10 2.24219C11.0938 2.24219 12.1289 2.45703 13.1055 2.88672C14.082 3.30339 14.9284 3.8763 15.6445 4.60547C16.3737 5.32161 16.9466 6.16797 17.3633 7.14453C17.793 8.12109 18.0078 9.15625 18.0078 10.25C18.0078 11.3438 17.793 12.3789 17.3633 13.3555C16.9466 14.332 16.3737 15.1849 15.6445 15.9141C14.9284 16.6302 14.082 17.2031 13.1055 17.6328C12.1289 18.0495 11.0938 18.2578 10 18.2578ZM10.5078 5.25H9.00391V11.2461L14.1992 14.4492L15 13.1406L10.5078 10.4453V5.25Z"/></svg>'; ?>

                            <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
                                <?php  echo get_comment_date(); ?>
                            </a>
                            <?php edit_comment_link( esc_attr__( '(Edit)','clubio'), '  ', '' ); ?>
                        </div>
                        <?php } ?>

                    </div>
                    <?php comment_text(); ?>
                    <?php
                    comment_reply_link( array_merge( $args, array('before' => '<div class="tt-btn-default tt-btn-default__small">',
                        'after' => '</div>', 'add_below' => esc_attr($add_below), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div>
                <?php if ( 'div' != $args['style'] ) : ?></div><?php endif; ?>
                <?php
            }
            ?>
                <div class="tt-comments-layout__title"><?php esc_html_e('Comments','clubio'); ?> (<span class="tt-base-color"><?php echo get_comments_number(); ?></span>)</div>
                <ul class="tt-item">
                    <?php wp_list_comments('type=all&callback=theme_comment'); ?>
                </ul>
            <?php the_comments_pagination();
        endif;

        if (!comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'clubio' ); ?></p>
            <?php
        endif;
        $commenter = wp_get_current_commenter();
        $req = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );
        $comment_args = array(
            'class_form'           => 'form-default',
            'class_submit'         => 'tt-btn-default tt-btn__wide',
            'label_submit'         => esc_attr__( 'leave comment', 'clubio'),
            'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s"><span>%4$s</span></button>',
            'submit_field'         => '%1$s %2$s',
            'fields' => array(
                'author' => '
            <div class="form-group">
            <input class="form-control" placeholder="'. esc_attr__('First name', 'clubio').( $req ? '*' : '' ).'" id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) .'" ' . $aria_req . ' />
            </div>',
            'email'  => '
            <div class="form-group">
            <input class="form-control" placeholder="'. esc_attr__('Email', 'clubio').( $req ? '*' : '' ).'" id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']).'" ' . $aria_req . ' />
            </div>',
            'url'    => '
            <div class="form-group">
            <input class="form-control" placeholder="'. esc_attr__('Website', 'clubio').'" id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url'] ) . '" />
            </div>',
            ),
            'comment_field' => '<div class="form-group"><textarea placeholder="' . wp_kses(__('Comment', 'clubio'),'post') . '" id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>',
            'comment_notes_after' => '',
            'comment_notes_before' => '',
            'title_reply'          => esc_attr__('Leave a Comment','clubio'),
            'cancel_reply_link'    => esc_attr__('cancel reply','clubio')
        );
        add_filter('comment_form_fields', 'clubio_reorder_comment_fields' );
        function clubio_reorder_comment_fields( $fields ){
            $new_fields = array();
            $myorder = array('author','email','url','comment');
            foreach( $myorder as $key ){
                $new_fields[ $key ] = $fields[ $key ];
                unset( $fields[ $key ] );
            }
            if( $fields )
                foreach( $fields as $key => $val )
                    $new_fields[ $key ] = $val;
            return $new_fields;
        }
        comment_form($comment_args); ?>

    </div>
</div>
