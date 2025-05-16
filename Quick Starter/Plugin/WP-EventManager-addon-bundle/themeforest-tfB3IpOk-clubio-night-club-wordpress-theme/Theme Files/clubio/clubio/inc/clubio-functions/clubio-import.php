<?php
add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );

function clubio_import_plugin_intro_text( $default_text ) {
    $default_text .= '<div class="ocdi__intro-text" style="padding-bottom:35px;line-height:25px">The best look on a default WordPress installation.
    <br>Before importing be sure that old installation is reset. For example, by WP Reset plugin: Tools -> WP Reset.<br>
    <a href="tools.php?page=wp-reset">Reset old data</a></div>';
    return $default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'clubio_import_plugin_intro_text' );

function clubio_import_plugin_page_setup( $default_settings ) {
    $default_settings['page_title']  = esc_html__( 'Import Demo Data' , 'clubio' );
    $default_settings['menu_title']  = esc_html__( 'Clubio Import Demo' , 'clubio' );

    return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'clubio_import_plugin_page_setup' );
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );


function clubio_demo_import_files() {
    return array(
        array(
            'import_file_name'             => esc_html__( 'Clubio Layout' , 'clubio' ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/clubio-functions/export01.xml',
            'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/clubio-functions/customizer1.dat'
        )

    );
}
add_filter( 'pt-ocdi/import_files', 'clubio_demo_import_files' );

function clubio_ocdi_after_import( $selected_import ) {
    update_option('woocommerce_catalog_columns', 3);

    $about = get_page_by_title( 'Clubio Home Page' );
    update_option( 'page_on_front', $about->ID );
    update_option( 'show_on_front', 'page' );


    $blog   = get_page_by_title( 'News' );
    update_option( 'page_for_posts', $blog->ID );

    set_theme_mod( 'clubio_blog_type', 'grid' );

}
add_action( 'pt-ocdi/after_import', 'clubio_ocdi_after_import' );
add_action( 'pt-ocdi/before_content_import', 'clubio_ocdi_before_content_import' );




