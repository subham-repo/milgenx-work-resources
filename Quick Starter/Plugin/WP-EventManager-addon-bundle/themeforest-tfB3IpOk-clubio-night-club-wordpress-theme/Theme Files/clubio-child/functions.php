<?php
add_action( 'wp_enqueue_scripts', 'clubio_child_enqueue_styles' );
function clubio_child_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}