<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="google-site-verification" content="_y0a1ya8_msY4zzunQ2d8OOA7ZmC3OKV9_eNLz32CxM" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.1.5/css/uikit.min.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/slick-lightbox.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

	<!-- 1. Add latest jQuery and fancybox files -->

	<script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/slick-lightbox.js"></script>
	<script data-cfasync="false" async src="//142740.tctm.co/t.js"></script>
	<?php wp_head(); ?>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-K94M5M7');</script>
<!-- End Google Tag Manager -->

<script type='application/ld+json'> 
{
  "@context": "http://www.schema.org",
  "@type": "Organization",
  "name": "Comprehensive Wellness Centers",
  "url": "https://www.cwcrecovery.com/",
  "sameAs": [
    "https://www.youtube.com/channel/UCdmic7Fpq7RsAtheg9B68jA",
    "https://www.instagram.com/comprehensivewellnesscenters/",
    "https://www.facebook.com/Comprehensive-Wellness-Centers-1661327924139764/"
  ],
  "logo": "http://www.cwcrecovery.com/wp-content/uploads/2017/07/ComprehensiveWellnessCenters_Logo_Web.png",
  "description": "At Comprehensive Wellness Centers in South Florida, YOU WILL FIND THE SUPPORT YOU NEED to successfully face recovery from drug or alcohol addiction.",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "660 S. Dixie Hwy",
    "addressLocality": "Lantana",
    "addressRegion": "Fl",
    "postalCode": "33462",
    "addressCountry": "United States"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+1(855)844-0371",
    "contactType": "customer service"
  }
}
 </script>


</head>
	
	
<?php 
	global $header_logo,$contact_number,$facebook_id,$insta_id,$linkedin_id,$pinterest_id,$twitter_id,$youtube_id;
	$header_logo = of_get_option("header_logo");
	$contact_number = of_get_option("contact_num_op");
	$facebook_id = of_get_option("facebook_id");
	$insta_id = of_get_option("insta_id");
	$linkedin_id = of_get_option("linkedin_id");
	$pinterest_id = of_get_option("pinterest_id");
	$twitter_id = of_get_option("twitter_id");
	$youtube_id = of_get_option("youtube_id");


	if(empty($header_logo))
	{
		$header_logo = get_template_directory_uri().'/wp-content/uploads/2019/07/logo1.png';
	}
	if(empty($contact_number))
	{
		$contact_number = '(888) 200-0376';
	}
	if(empty($facebook_id))
	{
		$facebook_id = '#';
	}
	if(empty($insta_id))
	{
		$insta_id = '#';
	}
	if(empty($linkedin_id))
	{
		$linkedin_id = '#';
	}
	if(empty($pinterest_id))
	{
		$pinterest_id = '#';
	}
	if(empty($twitter_id))
	{
		$twitter_id = '#';
	}
	if(empty($youtube_id))
	{
		$youtube_id = '#';
	}
?>
<body <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K94M5M7"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?php wp_body_open(); ?>

<header class="mountain_view">
	<div class="h_fix1 googli">

		<!--Header Menu-->
		<div class="header_menu">
			<div class="container">
				<div class="uk-grid-collapse uk-grid">
					<div class="mobilenav_menu">
						<a title="Responsive Slide Menus" href="<?php echo site_url(); ?>">
							<img alt="" src="/wp-content/uploads/2020/04/ComprehensiveWellnessCenters_Web_Logo.png" class="img-responsive">
						</a>
						<button id="responsive-menu-buttond" class="responsive-menu-button responsive-menu-boring
					         responsive-menu-accessible" type="button" aria-label="Menu">
						<div id="nav-icon1">
						  <span></span>
						  <span></span>
						  <span></span>
						</div>
					         
						<!--     <span class="responsive-menu-box">
						        <span class="responsive-menu-inner"></span>
						    </span> -->
					    </button>
					</div>
					<div id='main-menu-head' class="uk-width-1-1 inner_header_menu">
						<div class="main-menu-logo">
							<div style="width: 260px!important;" class='et-info-logo'><img src="/wp-content/uploads/2020/04/ComprehensiveWellnessCenters_Web_Logo.png"/></div>	
						</div>
						<div class="main-menu-items">
							<?php // wp_nav_menu( array('menu' => 'menu-1', 'menu_class' => 'uk-navbar-nav ukd-visible@s') );?>
						</div> 
						<div class="main-menu-right-cta">
							<div id="et-info">
								<span id="et-info-phone">
									- Start Healing Today! -
								</span>
								<a href="tel:<?php echo $contact_number ?>">
									<span>
										<i class="fa fa-mobile" aria-hidden="true"> </i>
										<?php echo $contact_number; ?>
									</span>
								</a> 
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="bottom-header">
		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></button>
			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
			<?php wp_nav_menu( array('menu' => 'header menu', 'menu_class' => 'uk-navbar-nav ukd-visible@s') );?>
		</nav><!-- #site-navigation -->
	</div>
</header>


