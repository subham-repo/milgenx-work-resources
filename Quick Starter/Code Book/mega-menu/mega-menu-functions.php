<?php

function add_mega_menu_script() {
    wp_enqueue_script('mega-menu-script', get_template_directory_uri() . '/mega-menu/mega-menu-script.js', [], false, true);
}
add_action('wp_enqueue_scripts', 'add_mega_menu_script');

wp_enqueue_style('mega-menu-style', get_template_directory_uri('template_directory').'/mega-menu/mega-menu-styles.css');

?>