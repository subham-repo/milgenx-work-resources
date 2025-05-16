<?php
/**
 * Clubio functions and definitions
 *
 * @package Clubio
 */

if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
    require get_template_directory() . '/inc/back-compat.php';
    return;
}

if ( ! function_exists( 'clubio_setup' ) ) :
    function clubio_setup() {
        load_theme_textdomain( 'clubio', get_template_directory() . '/languages' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'clubio-featured-image', 2000, 1200, true );
        add_image_size( 'clubio-thumbnail-avatar', 100, 100, true );
        $GLOBALS['content_width'] = 1200;
        set_post_thumbnail_size( 1568, 9999 );
        register_nav_menus(
            array(
                'top' => esc_html__( 'Top Menu', 'clubio' ),
            )
        );
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            )
        );
        add_theme_support(
            'custom-logo',
            array(
                'flex-width'  => true,
                'flex-height' => true
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        // Add support for Block Styles.
        add_theme_support( 'wp-block-styles' );

        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );

        // Add support for editor styles.
        add_theme_support( 'editor-styles' );

        // Enqueue editor styles.
        add_editor_style( 'style-editor.css' );

        // Add custom editor font sizes.
        add_theme_support(
            'editor-font-sizes',
            array(
                array(
                    'name'      => esc_html__( 'Small', 'clubio' ),
                    'shortName' => esc_html__( 'S', 'clubio' ),
                    'size'      => 19.5,
                    'slug'      => 'small',
                ),
                array(
                    'name'      => esc_html__( 'Normal', 'clubio' ),
                    'shortName' => esc_html__( 'M', 'clubio' ),
                    'size'      => 22,
                    'slug'      => 'normal',
                ),
                array(
                    'name'      => esc_html__( 'Large', 'clubio' ),
                    'shortName' => esc_html__( 'L', 'clubio' ),
                    'size'      => 36.5,
                    'slug'      => 'large',
                ),
                array(
                    'name'      => esc_html__( 'Huge', 'clubio' ),
                    'shortName' => esc_html__( 'XL', 'clubio' ),
                    'size'      => 49.5,
                    'slug'      => 'huge',
                ),
            )
        );

        // Editor color palette.
        add_theme_support( 'editor-color-palette', array(
            array(
                'name' => esc_html__( 'Primary', 'clubio' ),
                'slug' => 'primary',
                'color' => '#1e76bd',
            ),
            array(
                'name' => esc_html__( 'Secondary', 'clubio' ),
                'slug' => 'secondary',
                'color' => '#888888',
            )

        ) );

        // Add support for responsive embedded content.
        add_theme_support( 'responsive-embeds' );


        $starter_content = array(
            'widgets'     => array(
                'sidebar-1' => array(
                    'text_business_info',
                    'search',
                    'text_about',
                ),

                'sidebar-2' => array(
                    'text_business_info',
                ),

                'sidebar-3' => array(
                    'text_about',
                    'search',
                ),
            ),

            'nav_menus'   => array(
                'top'    => array(
                    'name'  => esc_html__( 'Top Menu', 'clubio' ),
                    'items' => array(
                        'link_home',
                        'page_about',
                        'page_blog',
                        'page_contact',
                    ),
                )
            ),
        );
        $starter_content = apply_filters( 'clubio_starter_content', $starter_content );

        add_theme_support( 'starter-content', $starter_content );

    }
endif;
add_action( 'after_setup_theme', 'clubio_setup' );

function clubio_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sidebar', 'clubio' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'clubio' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

}
add_action( 'widgets_init', 'clubio_widgets_init' );

if ( ! function_exists( 'clubio_theme_content_more' ) ) :

    add_filter( 'excerpt_more', 'clubio_theme_content_more' );
    add_filter( 'the_content_more_link', 'clubio_theme_content_more' );

    function clubio_theme_content_more($more) {
        if ( is_admin() ) {
            return $more;
        }
        $more = sprintf( ' <div class="btn-more-wrapper wrapper-btn-link-icon-text"><a href="%1$s" class="tt-btn-default"><span>'.wp_kses('', clubio_tags()).'%2$s</span></a></div>',
            esc_url( get_permalink( get_the_ID() ) ),
            sprintf(
                wp_kses(__('read more<span class="screen-reader-text"> "%s"</span>', 'clubio'), clubio_tags() ), esc_html(get_the_title( get_the_ID() ))
            )
        );
        return $more;
    }
endif;


function clubio_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'clubio_content_width', 640 );
}
add_action( 'after_setup_theme', 'clubio_content_width', 0 );


function clubio_scripts() {
    wp_enqueue_style( 'clubio-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

    wp_style_add_data( 'clubio-style', 'rtl', 'replace' );
    wp_enqueue_style( 'clubio-print-style', get_template_directory_uri() . '/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'clubio_scripts' );

function clubio_skip_link_focus_fix() {
    ?>
<script>
    /(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
</script>
<?php
}
add_action( 'wp_print_footer_scripts', 'clubio_skip_link_focus_fix' );

function clubio_editor_customizer_styles() {

    wp_enqueue_style( 'clubio-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.1', 'all' );
}
add_action( 'enqueue_block_editor_assets', 'clubio_editor_customizer_styles' );

require get_template_directory() . '/inc/template-functions.php';

require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/customizer.php';


require get_template_directory() . '/inc/clubio-functions/clubio-enqueue-scripts.php';

require get_template_directory() . '/inc/clubio-functions/clubio-common-settings.php';

require get_template_directory() . '/inc/libs/tgm-plugin-activation/tgm-admin-config.php';
require get_template_directory() . '/inc/clubio-functions/clubio-page-bc.php';


if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) :
    require get_template_directory() . '/inc/clubio-woocommerce/clubio-hooks.php';
    require get_template_directory() . '/inc/clubio-woocommerce/clubio-hooks-functions.php';
endif;

function clubio_add_woocommerce_support() {
    add_theme_support( 'woocommerce', array(
        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 1,
            'max_rows'        => 10,
            'default_columns' => 3,
            'min_columns'     => 3,
            'max_columns'     => 4,
        ),
    ) );
}
add_action( 'after_setup_theme', 'clubio_add_woocommerce_support' );

require get_template_directory() . '/inc/clubio-functions/clubio-import.php';

require get_template_directory() . '/inc/clubio-functions/clubio-customiser-colors.php';


$clubio_blog_type = isset($_GET['grid_blog_layout']) && $_GET['grid_blog_layout'] != '' ? $_GET['grid_blog_layout'] : get_theme_mod('clubio_blog_type');


function change_permalinks() {
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('/%postname%/');
    $wp_rewrite->flush_rules();
}
add_action('init', 'change_permalinks');