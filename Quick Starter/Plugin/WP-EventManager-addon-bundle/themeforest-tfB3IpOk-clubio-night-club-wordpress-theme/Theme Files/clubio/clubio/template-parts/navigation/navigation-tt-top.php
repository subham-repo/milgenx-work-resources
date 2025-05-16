<?php
/**
 * Displays top navigation
 *
 * @package Clubio
 */
?>
<nav id="tt-nav" class="main-navigation7" aria-label="<?php esc_html_e( 'Theme Header Navigation', 'clubio' ); ?>">
	<?php
    wp_nav_menu(array(
        'theme_location' => 'clubio_header_navigation',
        'menu_class' => 'menu',
        'walker'         => new Clubio_Walker_Nav_Menu(),
        'container' => ''
    ));
    ?>
</nav>
