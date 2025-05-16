<?php 

function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'extra-menu' => __( 'Extra Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

/**
 * Register our sidebars and widgetized areas.
 *
 */
function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'Footer Info',
		'id'            => 'footer_info',
		'before_widget' => '<div class="footer_widget_block full-width">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="footer_title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => 'Quick Links',
		'id'            => 'footer_link',
		'before_widget' => '<div class="footer_widget_block full-width">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="footer_title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => 'Footer Form',
		'id'            => 'footer_form',
		'before_widget' => '<div class="footer_widget_block full-width">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="footer_title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => 'Post Sidebar',
		'id'            => 'posts_sidebar',
		'before_widget' => '<div class="widget_block full-width">',
		'after_widget'  => '</div>',
	) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );


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





add_action( 'init', 'faq_init' );

/**
 * Register a book post type.
 *
 */

function faq_init() {
	$labels = array(
		'name'               => _x( 'FAQs', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'FAQ', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'FAQ', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'FAQ', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'FAQ', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New FAQ', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New FAQ', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit FAQ', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View FAQ', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All FAQ', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search FAQ', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent FAQ:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No books found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No books found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'Post type for frequently asked questions' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'faqs' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor' )
	);

	register_post_type( 'FAQS', $args );
}


add_theme_support( 'post-thumbnails' );

?>