<?php
// Unique ID for search form fields
$qodef_unique_id = uniqid( 'qodef-search-form-' );
?>
<form role="search" method="get" class="qodef-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $qodef_unique_id ); ?>" class="screen-reader-text"><?php esc_html_e( 'Search for:', 'boldlab' ); ?></label>
	<div class="qodef-search-form-inner clear">
		<input type="search" id="<?php echo esc_attr( $qodef_unique_id ); ?>" class="qodef-search-form-field" value="" name="s" placeholder="<?php esc_attr_e( 'Search', 'boldlab' ); ?>" title="<?php esc_attr_e( 'Search for:', 'boldlab' ); ?>"/>
		<button type="submit" class="qodef-search-form-button"><?php boldlab_render_icon( 'fas fa-search', 'font-awesome', esc_html__( 'GO', 'boldlab' ) ); ?></button>
	</div>
</form>