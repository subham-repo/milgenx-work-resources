<?php if ( ! post_password_required() ) { ?>
    <div class="qodef-e-read-more">
		<?php
		if ( boldlab_post_has_read_more() ) {
			$button_params = array(
				'link'          => get_permalink() . '#more-' . get_the_ID(),
				'text'          => esc_html__( 'Continue Reading _', 'boldlab' ),
				'button_layout' => 'textual'
			);
		} else {
			$button_params = array(
				'link'          => get_the_permalink(),
				'text'          => esc_html__( 'Read More _', 'boldlab' ),
				'button_layout' => 'textual'
			);
		}

		boldlab_render_button_element( $button_params ); ?>
    </div>
<?php } ?>