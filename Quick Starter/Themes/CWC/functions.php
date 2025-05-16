<?php
/**
 * Twenty Nineteen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

/**
 * Twenty Nineteen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

if ( ! function_exists( 'twentynineteen_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function twentynineteen_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Nineteen, use a find and replace
		 * to change 'twentynineteen' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'twentynineteen', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'header_menu' => __( 'Header Menu', 'twentynineteen' ),
				'footer' => __( 'Footer Menu', 'twentynineteen' ),
				'social' => __( 'Social Links Menu', 'twentynineteen' ),
				'quick_links' => __( 'Quick Links Menu', 'twentynineteen' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
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

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 190,
				'width'       => 190,
				'flex-width'  => false,
				'flex-height' => false,
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
					'name'      => __( 'Small', 'twentynineteen' ),
					'shortName' => __( 'S', 'twentynineteen' ),
					'size'      => 19.5,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'twentynineteen' ),
					'shortName' => __( 'M', 'twentynineteen' ),
					'size'      => 22,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'twentynineteen' ),
					'shortName' => __( 'L', 'twentynineteen' ),
					'size'      => 36.5,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'twentynineteen' ),
					'shortName' => __( 'XL', 'twentynineteen' ),
					'size'      => 49.5,
					'slug'      => 'huge',
				),
			)
		);

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Primary', 'twentynineteen' ),
					'slug'  => 'primary',
					'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 33 ),
				),
				array(
					'name'  => __( 'Secondary', 'twentynineteen' ),
					'slug'  => 'secondary',
					'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 23 ),
				),
				array(
					'name'  => __( 'Dark Gray', 'twentynineteen' ),
					'slug'  => 'dark-gray',
					'color' => '#111',
				),
				array(
					'name'  => __( 'Light Gray', 'twentynineteen' ),
					'slug'  => 'light-gray',
					'color' => '#767676',
				),
				array(
					'name'  => __( 'White', 'twentynineteen' ),
					'slug'  => 'white',
					'color' => '#FFF',
				),
			)
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'twentynineteen_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentynineteen_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Footer Column 1', 'twentynineteen' ),
			'id'            => 'footer_col_1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'twentynineteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Column 2', 'twentynineteen' ),
			'id'            => 'footer_col_2',
			'description'   => __( 'Add widgets here to appear in your footer.', 'twentynineteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Column 3', 'twentynineteen' ),
			'id'            => 'footer_col_3',
			'description'   => __( 'Add widgets here to appear in your footer.', 'twentynineteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Column 4', 'twentynineteen' ),
			'id'            => 'footer_col_4',
			'description'   => __( 'Add widgets here to appear in your footer.', 'twentynineteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Bottom Menu', 'twentynineteen' ),
			'id'            => 'footer_col_5',
			'description'   => __( 'Add widgets here to appear in your footer bottom.', 'twentynineteen' ),
		)
	);
	

	register_sidebar(
		array(
			'name'          => __( 'Recent Posts ', 'twentynineteen' ),
			'id'            => 'recent_posts',
			'description'   => __( 'Blog page Recent Posts Sidebar', 'twentynineteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Post Sidebar', 'twentynineteen' ),
			'id'            => 'posts_sidebar',
			'description'   => __( 'Blog page posts sidebar', 'twentynineteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'twentynineteen_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function twentynineteen_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'twentynineteen_content_width', 640 );
}
add_action( 'after_setup_theme', 'twentynineteen_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function twentynineteen_scripts() {
	wp_enqueue_style( 'twentynineteen-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

	wp_style_add_data( 'twentynineteen-style', 'rtl', 'replace' );

	if ( has_nav_menu( 'menu-1' ) ) {
		wp_enqueue_script( 'twentynineteen-priority-menu', get_theme_file_uri( '/js/priority-menu.js' ), array(), '1.1', true );
		wp_enqueue_script( 'twentynineteen-touch-navigation', get_theme_file_uri( '/js/touch-keyboard-navigation.js' ), array(), '1.1', true );
	}

	wp_enqueue_style( 'twentynineteen-print-style', get_template_directory_uri() . '/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'twentynineteen_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twentynineteen_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'twentynineteen_skip_link_focus_fix' );

/**
 * Enqueue supplemental block editor styles.
 */
function twentynineteen_editor_customizer_styles() {

	wp_enqueue_style( 'twentynineteen-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.1', 'all' );

	if ( 'custom' === get_theme_mod( 'primary_color' ) ) {
		// Include color patterns.
		require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
		wp_add_inline_style( 'twentynineteen-editor-customizer-styles', twentynineteen_custom_colors_css() );
	}
}
add_action( 'enqueue_block_editor_assets', 'twentynineteen_editor_customizer_styles' );

/**
 * Display custom color CSS in customizer and on frontend.
 */
function twentynineteen_colors_css_wrap() {

	// Only include custom colors in customizer or frontend.
	if ( ( ! is_customize_preview() && 'default' === get_theme_mod( 'primary_color', 'default' ) ) || is_admin() ) {
		return;
	}

	require_once get_parent_theme_file_path( '/inc/color-patterns.php' );

	$primary_color = 199;
	if ( 'default' !== get_theme_mod( 'primary_color', 'default' ) ) {
		$primary_color = get_theme_mod( 'primary_color_hue', 199 );
	}
	?>

	<style type="text/css" id="custom-theme-colors" <?php echo is_customize_preview() ? 'data-hue="' . absint( $primary_color ) . '"' : ''; ?>>
		<?php echo twentynineteen_custom_colors_css(); ?>
	</style>
	<?php
}
add_action( 'wp_head', 'twentynineteen_colors_css_wrap' );

/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-twentynineteen-svg-icons.php';

/**
 * Custom Comment Walker template.
 */
require get_template_directory() . '/classes/class-twentynineteen-walker-comment.php';

/**
 * Enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


function register_cpt_ourteam() {

     $args = array(
	     'labels' => array ( 
		         'name' => __( 'Our Team', 'Our Team' ), 
		         'singular_name' => __( 'Our Team Member', 'Our Team Member' ),
		      ),
	     'description'     => 'Add Our Team Member with their details.',
	     'supports' 	   => array( 'title', 'editor', 'thumbnail', ),
	     'taxonomies'      => array( 'Our Team' ), 
	     'public'          => true,
	     'menu_position'   => 50,
	     'menu_icon' 	   => 'dashicons-groups',  
	     'has_archive'     => false,
	     'capability_type' => 'post',
	     'rewrite' 		   => array('slug' => 'our_staff', ),
    );

    register_post_type( 'team_member', $args );
 } 
add_action( 'init', 'register_cpt_ourteam' );

function register_cpt_testimonial() {

     $args = array(
	     'labels' => array ( 
		         'name' => __( 'Testimonial', 'Testimonial' ), 
		         'singular_name' => __( 'Our Team Member', 'Our Team Member' ),
		      ),
	     'description'     => 'Add client testimonial with their details.',
	     'supports' 	   => array( 'title', 'editor', 'thumbnail', ),
	     'taxonomies'      => array( 'Testimonial Group' ), 
	     'public'          => true,
	     'menu_position'   => 50,
	     'menu_icon' 	   => 'dashicons-format-status',  
	     'has_archive'     => true,
	     'capability_type' => 'post',
	     'rewrite' 		   => array('slug' => 'testimonial', ),
    );

    register_post_type( 'testimonial', $args );
 } 
add_action( 'init', 'register_cpt_testimonial' );




add_shortcode('recent_posts','recent_posts');
function recent_posts()
{   
    ob_start();
?>

<div class="blog_side_posts">
	<h2>Recent Posts</h2>
	<div class="recent_posts_data">
		<?php 
			$args = array(
			'post_type'=> 'post',
			'orderby'    => 'ID',
			'post_status' => 'publish',
			'order'    => 'DESC',
			'posts_per_page' => 5 // this will retrive all the post that is published 
			);
			$result = new WP_Query( $args );
			if ( $result-> have_posts() ) :
			while ( $result->have_posts() ) : $result->the_post(); 
		?>

		<div class="r_posts">
			<?php 
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
				if($image == ""){ 
			?>
				<div class="r_img" style="background-image: url('<?php echo site_url(); ?>/wp-content/uploads/2019/07/no-image-small.jpg');"></div>
			<?php } else { ?>
				<div class="r_img" style="background-image: url('<?php echo $image[0] ; ?>');"></div>
			<?php } ?>
			<div class="r_data">
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				
			</div>
		</div>

		<?php endwhile; endif;  wp_reset_postdata(); ?>
	</div>
</div>

<?php
$cont = ob_get_contents();
ob_get_clean();
return $cont;
}



/* Learn More About Agape sidebar shortcode*/

add_shortcode('Learn_more','Learn_more');
function Learn_more()
{   
    ob_start();
?>

<h2>Learn More About Agape Treatment Center</h2>
<div class="ag_btn">
	<a href="<?php echo site_url();?>/staff">Staff</a>
</div>
<div class="ag_btn">
	<a href="<?php echo site_url();?>/about-us/facility/">Facility</a>
</div>
<div class="ag_btn">
	<a href="<?php echo site_url();?>/gallery/">Gallery</a>
</div>

<?php
$cont = ob_get_contents();
ob_get_clean();
return $cont;
}

/* Description About Agape sidebar shortcode*/
add_shortcode('agape_desc','agape_desc');
function agape_desc()
{   
    ob_start();
?>

<p>Agape Treatment Center for substance abuse embraces a universal, unconditional love that transcends, that serves regardless of circumstances.
We provide individuals all over the country with the opportunity to achieve the gift of lasting sobriety.</p>

<?php
$cont = ob_get_contents();
ob_get_clean();
return $cont;
}



/*add_filter( 'wp_nav_menu_items', 'your_custom_menu_item', 10, 2 );
function your_custom_menu_item ( $items, $args ) {
    if ($args->menu == 'menu-1') {
    	$x = explode('<li id="menu-item-465"', $items);
    	$li = '<li class="menu-item">
			<div class="logo text-center">
				<a title="Responsive Slide Menus" href="index.html">
					<img alt="" src="/wp-content/uploads/2020/03/logo_new.png" class="img-responsive">
				</a>
			</div>
		</li>';
		$html = $x[0].$li.'<li id="menu-item-465"'.$x[1];
		return $html;
    }
}*/


function global_cta(){
	$gcta_heading =  of_get_option('gcta_heading');
	$ins_bttext  =  of_get_option('ins_bttext');
	$ins_btlink  =  of_get_option('ins_btlink');
	$cont_number =  of_get_option('contact_num_op');
	$output = '<section class="full-width global_cta">
		<div class="container global_cta_wrapper">
			<h2>'.$gcta_heading.'</h2>
			<div class="theme_cta-wrapper">
				<a class="cta_in" href="tel:'.$cont_number.'">
					<span>'.$cont_number.'</span>
				</a>
				<span class="cta_or"><span>or</span></span>
				<a class="cta_in" href="'.$ins_btlink.'">
					<span>'.$ins_bttext.'</span>
				</a>
			</div>
		</div>
	</section>';	
	echo $output;
}
add_shortcode('global-cta', 'global_cta');

function verify_insurance(){ 
	$ins_heading =  of_get_option('ins_heading');
	$ins_banner  = 	of_get_option('ins_banner');
	$ins_bttext  =  of_get_option('ins_bttext');
	$ins_btlink  =  of_get_option('ins_btlink');
	$cont_number =  of_get_option('contact_num_op');
	$output ='<section class="full-width verify_insurance">
		<div class="container">
			<div class="verify_wrapper">
				<h2>'.$ins_heading.'</h2>
				<img src="'.$ins_banner.'" alt="accept_insurance" />
				<div class="theme_cta-wrapper">
					<a class="cta_in" href="tel:'.$cont_number.'">
						<span>'.$cont_number.'</span>
					</a>
					<span class="cta_or"><span>or</span></span>
					<a class="cta_in" href="'.$ins_btlink.'">
						<span>'.$ins_bttext.'</span>
					</a>
				</div>
			</div>
		</div>
	</section>';
	echo $output;
 }
add_shortcode('verify-insurance', 'verify_insurance');


function mini_social(){
    ob_start();

    $facebook_id  = of_get_option('facebook_id');
	$twitter_id   = of_get_option('twitter_id');
	$youtube_id   = of_get_option('youtube_id');
	$insta_id     = of_get_option('insta_id');
	$linkedin_id  = of_get_option('linkedin_id');
	$pinterest_id = of_get_option('pinterest_id');
	?>
	<div class="mini_social">
		<ul>
			<?php if(!empty($facebook_id)){ ?>
				<li><a href="<?php echo $facebook_id ; ?>" target="_blank" class="dark_pink_bg wt_clr"><i class="fa fa-facebook"></i></a></li>
			<?php } ?>
			<?php if(!empty($twitter_id)){ ?>
				<li><a href="<?php echo $twitter_id ; ?>" target="_blank" class="dark_pink_bg wt_clr"><i class="fa fa-twitter"></i></a></li>
			<?php } ?>
			<?php if(!empty($youtube_id)){ ?>
				<li><a href="<?php echo $youtube_id ; ?>" target="_blank" class="dark_pink_bg wt_clr"><i class="fa fa-youtube"></i></a></li>
			<?php } ?>
			<?php if(!empty($insta_id)){ ?>
				<li><a href="<?php echo $insta_id ; ?>" target="_blank" class="dark_pink_bg wt_clr"><i class="fa fa-instagram"></i></a></li>
			<?php } ?>
			<?php if(!empty($linkedin_id)){ ?>
				<li><a href="<?php echo $linkedin_id ; ?>" target="_blank" class="dark_pink_bg wt_clr"><i class="fa fa-linkedin"></i></a></li>
			<?php } ?>
			<?php if(!empty($pinterest_id)){ ?>
				<li><a href="<?php echo $pinterest_id ; ?>" target="_blank" class="dark_pink_bg wt_clr"><i class="fa fa-pinterest"></i></a></li>
			<?php } ?>
				
		</ul>
	</div>
	<?php
	$cont = ob_get_contents();
	ob_get_clean();
	return $cont;
}
add_shortcode('mini-social', 'mini_social');


function inner_title(){ 
$ins_btlink  =  of_get_option('ins_btlink');
?>
<div class="title-area full-width" >
	<div class="container">
		<div class="row">
			<div class="col-md-7 col-sm-7 col-xs-12 blog_content_top_bar corner-spacing">
				<div class="blog_breadcrumb">
					<?php
						if ( function_exists('yoast_breadcrumb') ) {
							yoast_breadcrumb('
							<p id="breadcrumbs">','</p>
						');
						}
					?>
				</div>
				<div class="blog_main_heading">
					<h1><?php echo wp_title(); ?></h1>
				</div>
				<div class="post_meta full-width">
					<span class="date">Last updated: <?php echo get_the_date(); ?></span>
					<!-- <span class="reviewed">Reviewed by Dr. Ashley</span> -->
				</div>
				
			</div>
			
			<div class="col-md-5 col-sm-5 col-xs-12 corner-spacing">
				<div class="cta-box full-width" style="background-image:url(<?php echo get_the_post_thumbnail_url();?>) ">
					<span class="tag-line">Get started on your road to recovery.</span>
					<a class="cta-link btn-theme rounded style-rev" href="<?php echo $ins_btlink; ?>">
						<span>Verify your insurance</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php }
add_shortcode('inner-title', 'inner_title');

/*** Add post prefix to post detail permalink ***/
add_filter( 'post_link', 'ticketing_append_query_string', 10, 3 );
function ticketing_append_query_string( $url, $post, $leavename ) 
{
	if ( $post->post_type == 'post' ) 
	{
		if ( $post->post_type == 'post' ) 
		{		
			if ( false !== strpos( $url, '%postname%' ) ) 
			{
				$slug = '%postname%';
			} 
			elseif ( $post->post_name ) 
			{
				$slug = $post->post_name;
			} 
			else 
			{
				$slug = sanitize_title( $post->post_title );
			}
			
			$date = DateTime::createFromFormat( 'Y-m-d H:i:s', $post->post_date )->format( 'Y/m/d' );
			$date = '';
			$url  = home_url( user_trailingslashit( 'blog/'. $slug ) );
			
			//$url  = home_url( user_trailingslashit( 'post/' . $post->post_name . '/' . $slug ) );
		}
	}
	return $url;
}

/*** Function to add post prefix for posts ***/
add_action('init', 'ticketing_create_new_url_querystring', 999 );
function ticketing_create_new_url_querystring() 
{
    add_rewrite_rule(
        'blog/([^/]*)$',
        'index.php?name=$matches[1]',
        'top'
    );
    add_rewrite_tag('%post%','([^/]*)');
}

/*** Function to redirect blogs related to pagination ***/
add_filter( 'template_redirect', 'ticketing_redirect_old_urls' );
function ticketing_redirect_old_urls() 
{
	if ( is_singular('post') ) 
	{
		global $post;
		if ( strpos( $_SERVER['REQUEST_URI'], '/blog/') === false) 
		{
		   wp_redirect( home_url( user_trailingslashit( "blog/$post->post_name" ) ), 301 );
		   exit();
		}
	}
}