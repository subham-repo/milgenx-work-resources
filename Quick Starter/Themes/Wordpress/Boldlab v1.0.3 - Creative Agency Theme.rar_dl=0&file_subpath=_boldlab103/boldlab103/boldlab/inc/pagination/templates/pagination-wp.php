<div class="qodef-m-pagination qodef--wp">
	<?php
	// Load posts pagination (in order to override template use navigation_markup_template filter hook)
	the_posts_pagination( array(
		'prev_text'          => boldlab_get_icon( 'arrow_carrot-left', 'elegant-icons', esc_html__( '< Prev', 'boldlab' ) ),
		'next_text'          => boldlab_get_icon( 'arrow_carrot-right', 'elegant-icons', esc_html__( 'Next >', 'boldlab' ) ),
		'before_page_number' => '0'
	) ); ?>
</div>