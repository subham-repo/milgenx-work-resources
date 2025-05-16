<!DOCTYPE html>
<html>
<head>
	<title><?php wp_title(); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&family=Roboto:wght@300;400;500;700;900&display=swap&family=Montserrat:wght@300;400;500;700;900&display=swap" rel="stylesheet">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.0.js"></script>
	<?php wp_head(); ?>
</head>
<?php 
	global $bg_image,$contact_link,$contact_bt_text,$header_logo,$contact_number,$facebook_id,$insta_id,$linkedin_id,$pinterest_id,$twitter_id,$youtube_id;
	$header_logo 		= of_get_option("header_logo");
	$contact_number 	= of_get_option("contact_num_op");
	$facebook_id 		= of_get_option("facebook_id");
	$insta_id 			= of_get_option("insta_id");
	$linkedin_id    	= of_get_option("linkedin_id");
	$pinterest_id 		= of_get_option("pinterest_id");
	$twitter_id 		= of_get_option("twitter_id");
	$youtube_id 		= of_get_option("youtube_id");



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
<body>
<header>
	<div class="sub_header mobile full-width" style="display: none;">
  		<div class="row get-help-wrapper full-width">
	
			<?php
			$contact_link 		= of_get_option('contact_link');
			if(!empty($contact_link)){ ?>
			<div class="get-help-block col-4 col-sm-4 col-md-4 col-lg-4">

				<div class="get-help-inner full-width">
					<div class="get-help-icon">
						<a href="<?php echo $contact_link ; ?>">
							<i class="fa fa-comments-o"></i>
						</a>
					</div>
					<div class="get-help-heading">
						<h5><a href="<?php echo $contact_link ; ?>">Message Us</a></h5>
					</div>
				</div>

			</div>	
			<?php } ?>

			<?php
			$contact_num_op 		= of_get_option('contact_num_op');
			if(!empty($contact_link)){ ?>
			<div class="get-help-block col-4 col-sm-4 col-md-4 col-lg-4">

				<div class="get-help-inner full-width">
					<div class="get-help-icon">
						<a href="tel:<?php echo $contact_num_op; ?>">
							<i class="fa fa-phone"></i>
						</a>
					</div>
					<div class="get-help-heading">
						<h5><a href="tel:<?php echo $contact_num_op; ?>">Call us</a></h5>
					</div>
				</div>

			</div>	
			<?php } ?>

			<?php
			$email_id 		= of_get_option('email_id');
			if(!empty($email_id)){ ?>
			<div class="get-help-block col-4 col-sm-4 col-md-4 col-lg-4">

				<div class="get-help-inner full-width">
					<div class="get-help-icon">
						<a href="mailto:<?php echo $email_id; ?>">
							<i class="fa fa-envelope-o"></i>
						</a>
					</div>
					<div class="get-help-heading">
						<h5><a href="mailto:<?php echo $email_id; ?>">Email us</a></h5>
					</div>
				</div>

			</div>	
			<?php } ?>


		</div>
	</div>	
	<nav class="navbar navbar-expand-lg navbar-light ">
		<div class="container">
			 
		  <a class="navbar-brand" href="/">
		  	<img src="<?php echo $header_logo; ?>">
		  </a>
		  
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse nav-parent" id="navbarTogglerDemo03">

		  	<div class="sub_header full-width" style="display: none;">
		  		<div class="row get-help-wrapper full-width">
			
					<?php
					$contact_link 		= of_get_option('contact_link');
					if(!empty($contact_link)){ ?>
					<div class="get-help-block col-12 col-sm-4 col-md-4 col-lg-4">

						<div class="get-help-inner full-width">
							<div class="get-help-icon">
								<a href="<?php echo $contact_link ; ?>">
									<i class="fa fa-comments-o"></i>
								</a>
							</div>
							<div class="get-help-heading">
								<h5><a href="<?php echo $contact_link ; ?>">Send Us a Message</a></h5>
							</div>
						</div>

					</div>	
					<?php } ?>

					<?php
					$contact_num_op 		= of_get_option('contact_num_op');
					if(!empty($contact_link)){ ?>
					<div class="get-help-block col-12 col-sm-4 col-md-4 col-lg-4">

						<div class="get-help-inner full-width">
							<div class="get-help-icon">
								<a href="tel:<?php echo $contact_num_op; ?>">
									<i class="fa fa-phone"></i>
								</a>
							</div>
							<div class="get-help-heading">
								<h5><a href="tel:<?php echo $contact_num_op; ?>">Call us</a></h5>
							</div>
						</div>

					</div>	
					<?php } ?>

					<?php
					$email_id 		= of_get_option('email_id');
					if(!empty($email_id)){ ?>
					<div class="get-help-block col-12 col-sm-4 col-md-4 col-lg-4">

						<div class="get-help-inner full-width">
							<div class="get-help-icon">
								<a href="mailto:<?php echo $email_id; ?>">
									<i class="fa fa-envelope-o"></i>
								</a>
							</div>
							<div class="get-help-heading">
								<h5><a href="mailto:<?php echo $email_id; ?>">Email us</a></h5>
							</div>
						</div>

					</div>	
					<?php } ?>


				</div>
		  	</div>	

		  	<div class="nav_header full-width">
		    <?php wp_nav_menu( array( 
		    	'theme_location' => 'header-menu',
				'menu'            => 'nav-item',
				'container' => 'ul',
				'menu_class'      => 'navbar-nav',
				'wp_nav_menu_class' => 'nav-item', 
				// 'menu_id'         => ,
				// 'echo'            => true,
				// 'fallback_cb'     => 'wp_page_menu',
				// 'before'          => ,
				// 'after'           => ,
				// 'link_before'     => ,
				// 'link_after'      => ,
				// 'depth'           => 0,
				// 'walker'          =>
		     ) ); ?>
		     <span class="ribbon"></span>
		 	</div>
		  </div>
		  <div class="header_cta" style="display: none;">
		  	 <a href="tel:<?php echo $contact_number ?>"><i class="fa fa-mobile"></i> <?php echo $contact_number; ?></a> 
		  	 <span id="et-info-phone">Start Healing Today!</span>
		  </div>	
		</div>
	</nav>
</header>
