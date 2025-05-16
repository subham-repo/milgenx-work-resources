Code Reffernce For Header
==========================

Desktop View: https://prnt.sc/sxvvc5
Mobile View : https://prnt.sc/swdhgo


<header class="mountain_view full-width">
	<div class="h_fix1 googli full-width">

		<!--Header Menu-->
		<div class="header_menu full-width">
			<div class="container">
				<div class="header_menu_wrapper">
					<div class="mobilenav_menu full-width">
						<?php 
						if(!empty($mobile_logo)){ ?>
						<a title="Responsive Slide Menus" href="<?php echo site_url(); ?>">
							<img alt="site_logo" src="<?php echo $mobile_logo; ?>" class="img-responsive">
						</a>
						<?php } ?>
						
						<button id="responsive-menu-buttond" class="responsive-menu-button responsive-menu-boring
					         responsive-menu-accessible" type="button" aria-label="Menu">
						    <span class="responsive-menu-box">
						        <span class="responsive-menu-inner"></span>
						    </span>
					    </button>
					</div>
					<div id='main-menu-head' class="inner_header_menu full-width">
						<div class="col-12 col-md-4 col-sm-4 col-lg-4">
							<div class="head_social">
								<?php echo do_shortcode('[mini-social]'); ?>
							</div>
						</div>
						<div class="col-12 col-md-4 col-sm-4 col-lg-4 main-menu-logo text-center">
							<div class='et-info-logo'>
								<a title="Responsive Slide Menus" href="<?php echo site_url(); ?>">
									<img src="<?php echo $header_logo; ?>" alt="site_logo" />
								</a>
							</div>	
						</div>

						<div class="col-12 col-md-4 col-sm-4 col-lg-4 main-menu-items text-right">
							<div class="main-menu-right-cta" style="display: none;">
									<div class="cta-intro" style="display: none;">
										<span class="headeraddictionspan">Speak to a professional about your options</span>
										<span class="headeraddictionspanbottom"><i class="fa fa-info-circle" aria-hidden="true"></i>All calls are confidential</span>
									</div>
									<div id="et-info">
										<span id="et-info-phone">
											- Start Healing Today! -
										</span>
										<a href="tel:<?php echo $contact_number ?>" class="btn-theme">
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
		</div>
		<div class="bottom-header">
			<div class="container">
				<?php wp_nav_menu( array('menu' => 'Header Menu', 'menu_class' => 'uk-navbar-nav ukd-visible@s') );?>
			</div>
		</div>
	</div>
</header>

<script>

	jQuery('.menu-item-has-children').each(function(i) {
	  
	    jQuery(this).append( jQuery('<i class="clickicon fa fa-angle-down" aria-hidden="true"></i>'));               
	    // you'd need to just use your div example here
	});


	// Mobile Navigation Scripts Start

	var site_header 		= jQuery("header.mountain_view");
	var menu_button 		= jQuery(".mobilenav_menu button ");
	var menu_container  	= jQuery(".menu-header-menu-container");
	var site_grand			= jQuery('html');

	function menu_function(){
		var menu_button 		= jQuery(".mobilenav_menu button");
		var menu_button_offset  = jQuery('.header_menu .header_menu_wrapper').position().left;
		var adminBar_height 	= jQuery('div#wpadminbar').height();
		var menu_button_top		= menu_button.position().top;
		if(site_header.hasClass('show-navigation')){
			menu_button.css({'top':menu_button_top, 'right':menu_button_offset});
			site_grand.css({'overflow-y':'hidden'});
		}else{
			menu_button.css({'top':'unset','right':'unset'});
			site_grand.css({'overflow-y':'unset'});
		}

	}

	jQuery(window).resize(function(){	
	  menu_function();
	});

	menu_button.on('click', function(){
		menu_container.toggleClass("main");
		site_header.toggleClass("show-navigation");
		menu_function();
	});

	var header_height = jQuery('header.mountain_view .h_fix1.googli').height();
	site_header.css('height', header_height);	

	jQuery(".clickicon").on('click', function(){
		jQuery(this).parent('li').toggleClass("show-child");	
		jQuery(this).parent('li').siblings('li').removeClass('show-child');
	}); 

	// Mobile Navigation Scripts End

	jQuery(window).scroll(function(){
	    if (jQuery(window).scrollTop() >= header_height) {
	        jQuery('header').addClass('scrolled-body');
	    }
	    else {
	        jQuery('header').removeClass('scrolled-body');
	    }
	});
</script>

<style>
.header_menu {
    padding: 15px 0;
}

@media only screen and (min-width: 1200px) and (max-width: 1300px) {
	.bottom-header .menu-header-menu-container ul#menu-header-menu li.menu-item a {
	    padding: 12px 25px;
	}
}
@media only screen and (min-width: 1200px) {
	ul.sub-menu i.clickicon {
		background: #8eabcb;
		height: 43px;
		margin-top: -12px;
		width: 40px;
		margin-right: -10px !important;
		display: flex;
		justify-content: center;
		align-items: center;
		color: #24346c !important;
		font-weight: bold !important;
		font-size: 20px;
		cursor: pointer;
	}
	i.clickicon:before {
		transition: .2s all ease-in-out;
	}
	ul.sub-menu li:not(.show-child) i.clickicon:before {
	    transform: rotate(90deg) !important;
	}
	ul.sub-menu li.show-child i.clickicon:before{
		transform: rotate(180deg) !important;
	}
	.menu-item-has-children .sub-menu li.menu-item:not(.show-child) > ul.sub-menu {
	    display: none;
	}
	.menu-item-has-children .sub-menu li.menu-item.show-child > ul.sub-menu{
		display: block;
		position: relative;
		top: 0;
		box-shadow: unset;
	}
	div#main-menu-head {
	    width: 100% !important;
	    display: none;
		flex-direction: row;
		align-items: center;
	    justify-content: space-between;
	    position: relative;
	    /* border-bottom: 1px solid #fff; */
	}
	#main-menu-head .main-menu-logo img {
	    max-height: 90px;
	}

	.mobilenav_menu {
	    display: none;
	    padding: 0px;
	    position: relative;
	}

	.bottom-header {
	    background-color: #8eabcb;
	}
	.header_menu div#et-info {
	    display: flex;
	    justify-content: center;
	    flex-flow: column;
	    align-items: center;
	}
	.header_menu #et-info a.btn-theme span .fa {
	    padding-right: 5px;
	    font-size: 28px;
	}
	.header_menu #et-info span#et-info-phone {
	    font-size: 10px;
	    font-weight: bold;
	    text-transform: uppercase;
	    font-family: montserrat;
	    letter-spacing: 2px;
	    color: #24346c;
	}
	div#main-menu-head {
	    display: flex;
	}
	.bottom-header .menu-header-menu-container ul#menu-header-menu {
	    display: flex;
	    justify-content: center;
	    width: 100%;
	    padding-left: 0;
	}
	.bottom-header .menu-header-menu-container ul#menu-header-menu li.menu-item {
	    position: relative;
	    list-style: none;
	}
	.bottom-header .menu-header-menu-container ul.sub-menu li.menu-item:not(:hover) a {
	    color: #24346c !important;
	}
	.bottom-header .menu-header-menu-container ul:not(.sub-menu)#menu-header-menu li.menu-item:hover a, .bottom-header .menu-header-menu-container ul#menu-header-menu li.menu-item:focus a {
		background: rgb(36, 52, 108);
		text-decoration: none;
		color: #fff;
	}
	.bottom-header ul.sub-menu li.menu-item ul.sub-menu:before {
	    display: none;
	}
	.bottom-header ul.sub-menu li.menu-item > ul.sub-menu li.menu-item:not(:hover) a {
	    background: #8eabcb !important;
	}
	.bottom-header .menu-header-menu-container ul#menu-header-menu li.menu-item a {
	    padding: 12px 25px;
	    font-size: 13px;
	    font-style: normal;
	    display: inline-flex;
		align-items: center;
		width: 100%;
	}
	.bottom-header .menu-header-menu-container ul#menu-header-menu li.menu-item a {
	    margin-top: 0 !important;
	    margin-bottom: 0 !important;
	    overflow: hidden;
	    height: auto;
	    margin: 0px 0;
	    position: relative;
	    letter-spacing: 1px;
	    color: #000;
	    font-weight: 500;
	    min-height: unset !important;
	    font-family: montserrat;
	    text-transform: uppercase;
	}
	.bottom-header ul.uk-navbar-nav:not(.sub-menu) li.menu-item:first-child:before {
	    content: '|';
	    left: 0;
	    position: absolute;
	    font-size: 20px;
	    top: -4px;
	    color: #000;
	    bottom: 0;
	    margin: auto;
	    display: flex;
	    align-items: center;
	}
	.bottom-header ul.uk-navbar-nav li.menu-item:after {
	    content: '|';
	    right: 0;
	    position: absolute;
	    font-size: 20px;
	    top: -4px;
	    color: #000;
	    bottom: 0;
	    margin: auto;
	    display: flex;
	    align-items: center;
	}
	header.mountain_view.scrolled-body .header_menu {
	    height: 0;
	    overflow: hidden;
	    padding: 0;
	}
	header.mountain_view .header_menu{transition: .2s all ease-in-out}
	.header_menu .cta-intro {
	    display: flex;
	    flex-flow: column;
	    align-items: flex-end;
	    justify-content: center;
	    padding-right: 15px;
	    margin-right: 15px;
	    border-right: 1px solid #ccc;
	}
	.header_menu .main-menu-right-cta {
	    display: flex !important;
	    flex-wrap: wrap;
		align-items: center;
		justify-content: flex-end;
	}
	.header_menu .cta-intro span.headeraddictionspan {
	    display: block;
	    margin-bottom: .25rem;
	    font-size: 22px;
	    line-height: 1;
	    font-weight: 500;
	    padding-bottom: 6px;
	    color: #1f1f1f;
	}
	.header_menu .cta-intro span.headeraddictionspanbottom .fa {
	    padding-right: 6px;
	}
	.header_menu .cta-intro span.headeraddictionspanbottom {
	    color: #8a8a8a;
	    letter-spacing: .5px;
	    font-weight: 400;
	}
	.header_menu .header_menu .main-menu-right-cta {
		display: flex !important;
		margin-left: 15px;
	}
	.menu-item-has-children .sub-menu {
		max-width: 240px;
		min-width: 240px;
	}
	.menu-item-has-children .sub-menu li:not(:hover) a {
	    background-color: #fff !important;
	}
	.menu-item-has-children .sub-menu li.menu-item a {
	    border-bottom: 1px solid #ddd;
	}
	.bottom-header ul#menu-header-menu li:hover:before,
	.bottom-header ul#menu-header-menu li:focus:before,
	.bottom-header ul#menu-header-menu li.current-menu-item:before,
	.bottom-header ul#menu-header-menu li:hover:after,
	.bottom-header ul#menu-header-menu li:focus:after,
	.bottom-header ul#menu-header-menu li.current-menu-item:after {
		display: none;
	}
	
	.inner_header_menu ul li.menu-item:hover>ul.sub-menu,
	.bottom-header ul li.menu-item:hover>ul.sub-menu {
		display: flex;
	}
	
	.menu-item-has-children .sub-menu li:before, .menu-item-has-children .sub-menu li:after {
	    display: none !important;
	}
	.inner_header_menu ul.uk-navbar-nav:not(sub-menu) li i.clickicon,
	.bottom-header ul.uk-navbar-nav:not(sub-menu) li i.clickicon {
		right: 10px !important;
		color: #24346c;
		position: absolute;
		top: 12px;
		margin-right: 0;
		font-weight: bold;
	}
	
	#menu-header-menu li .sub-menu li {
		background-color: rgb(65, 194, 255);
	}
	.menu-item-has-children .sub-menu {
	    position: absolute;
	    top: 42px;
	    box-shadow: 0 0 10px 0 rgba(0, 0, 0, .2);
	    border-top: 2px solid #f79d1b;
	    z-index: 999;
	    flex-flow: column;
	    padding-left: 0;
		/*max-height: 50vh;*/
		/*overflow-y: auto;*/
	    display: none;
	}
	.menu-item-has-children .sub-menu::before {
		content: '\f0d8';
		font-family: fontawesome;
		font-size: 32px;
		position: absolute;
		top: -32px;
		left: 25%;
		transform: translate(-50%, 0);
		color: #f79d1b;
		z-index: 1;
	}
	.menu-item-has-children .sub-menu li {
	    width: 100%;
	    padding: 0 !important;
	    list-style: none;
	}
	.bottom-header .menu-header-menu-container ul#menu-header-menu li.menu-item:last-child ul.sub-menu {
	    right: 0;
	}
	.bottom-header .menu-header-menu-container ul#menu-header-menu li.menu-item:last-child ul.sub-menu:before {
	    left: unset;
	    right: 15%;
	}
	.bottom-header .menu-header-menu-container ul#menu-header-menu li.menu-item:hover i.clickicon {
	    color: #fff;
	    transform: rotate(180deg);
	}
	.bottom-header ul:not(.sub-menu)#menu-custom-menu li.menu-item:hover a, 
	.bottom-header  ul#menu-custom-menu li.menu-item:focus a {
	    background: rgb(230, 30, 37);
	}
}
@media only screen and (max-width: 1199px) {
	i.clickicon:before {
		transition: .2s all ease-in-out;
	}
	li.menu-item.show-child {
	    display: flex;
	    flex-flow: column;
	}
	li.menu-item.show-child > ul.sub-menu {
	    display: flex;
	    flex-flow: column;
	}
	li.menu-item.show-child ul.sub-menu > li.menu-item-has-children {
	    display: flex;
	    flex-flow: column;
	    background: #35498e;
	}
	li.menu-item.show-child ul.sub-menu li.menu-item-has-children ul.sub-menu a {
	    color: #fff !important;
	    background: #3e4c80;
	}
	.header_menu {
	    box-shadow: 0 0 5px 0 rgba(0,0,0,.1);
	}
	div#main-menu-head {
	    display: none;
	}
	.mobilenav_menu img.img-responsive {
	    max-height: 60px;
	}
	.menu-header-menu-container {
	    flex-wrap: wrap;
	    position: fixed;
	    right: 0;
	    width: 0%;
	    max-width: 100%;
	    background-color: #8eabcbe8;
	    height: 0vh;
	    top: 0;
	    transition: 0.6s;
	    box-shadow: 0 0 10px 0 rgba(0,0,0,.2);
	    z-index: 999;
	    display: flex;
	    justify-content: center;
	    align-items: center;
	    overflow: hidden;
	    opacity: 0;
	}
	.menu-header-menu-container.main {
	    overflow-y: auto;
	    max-height: 100%;
	    width: 100%;
	    height: 100vh;
	    opacity: 1;
	}
	.inner_header_menu li a {
		text-align: left;
		justify-content: space-between;
		padding: 20px 15px 20px 20px;
	}
	
	.inner_header_menu li ul li a {
		text-align: left;
		justify-content: space-between;
		padding: 10px 20px;
	}
	
	.sub-menu::before {
		display: none
	}
	
	.mobilenav_menu {
		display: flex;
		justify-content: space-between;
		width: 100%;
		align-items: center;
	}
	
	#menu-header-menu {
		display: flex;
		flex-flow: column;
		align-items: flex-start;
		justify-content: flex-start;
		width: 100%;
		padding: 100px 15px;
		max-width: 500px;
	}
	.menu-header-menu-container:not(.main) ul#menu-header-menu {
	    opacity: 0;
	}
	.menu-header-menu-container.main ul#menu-header-menu {
	    opacity: 1;
	    transition: 1.5s opacity ease-in-out;
	}
	.menu-header-menu-container ul.uk-navbar-nav li {
	    width: 100%;
	    padding: 0px 0px 0px 0px;
	    border-bottom: 1px solid transparent;
	    position: relative;
	}
	.menu-header-menu-container ul.uk-navbar-nav li .sub-menu {
	    width: 100% !important;
	    z-index: 99;
	    position: unset;
	    border-top: unset;
	}
	.menu-item-has-children i {
	    content: "\f0dd";
	    font: normal normal normal 14px/1 FontAwesome;
	    position: absolute;
	    cursor: pointer;
	    background-color: transparent;
	    color: #000;
	}
	.menu-item-has-children i:before {
	    display: flex;
	    align-items: center;
	    justify-content: center;
	    height: 100%;
	    position: absolute;
	    bottom: 0;
	    top: 0;
	    margin: auto;
	    transition: .2s all ease-in-out;
	    color: #fff;
	}
	.menu-item-has-children i.clickicon {
	    top: 0 !important;
	    width: 42px !important;
	    height: 48px !important;
	    font-size: 30px !important;
	    display: flex;
	    justify-content: center;
	    padding-top: 0px;
	    right: 0px !important;
	    align-items: center;
		transition: .2s all ease-in-out;
		background: #24346c;
	}
	li.show-child > i.clickicon:before {
	    transform: rotate(360deg);
	}
	li:not(.show-child) > i.clickicon:before {
	    transform: rotate(270deg) !important;
	}
	li:not(.show-child) .sub-menu {
	    display: none;
	}
	.menu-header-menu-container ul.uk-navbar-nav li .sub-menu li {
	    width: 100%;
	    margin: 0;
	    display: inline-flex;
	    padding: 0 !important;
	    background: #4e67bd;
		position: relative;
	}
	.menu-header-menu-container ul.uk-navbar-nav li .sub-menu li a {
	    color: #fff !important;
	}
	#menu-header-menu li {
		width: 100%;
		padding: 0px 0px 0px 0px;
		border-bottom: 1px solid #2b2a2a;
		list-style: none;
	}
	.inner_header_menu ul.uk-navbar-nav:not(.sub-menu) li a, 
	.bottom-header ul.uk-navbar-nav:not(.sub-menu) li a {
	    color: #000 !important;
	    width: 100%;
	    display: flex;
	    justify-content: center;
	    padding: 13px 20px;
	    border-top: transparent;
	    text-align: center;
	    font-weight: 500;
	    font-family: montserrat;
	    letter-spacing: 1px;
	    text-transform: uppercase;
	    font-size: 14px;
	}
	.menu-item-has-children::after:active ul.sub-menu {
		height: 123px;
		display: block;
		-webkit-transition-delay: 0s;
	}
	
	#menu-header-menu li .sub-menu {
		position: unset;
		width: 100%;
	}
	
	#menu-header-menu li:nth-child(5),
	#et-info {
		display: none
	}
	
	
	/* 11th mar 2020 */
	
	#main-menu-head .main-menu-logo {
		display: none;
	}
	
	#menu-header-menu li .sub-menu {
		width: 100% !important;
		z-index: 99;
		padding-left: 0;
	}
	/* 11th mar 2020 */
	/* 27th april 2020 */
	
	.main-menu-right-cta span#et-info-phone {
		display: none !important;
		color: black;
	}
	
	#main-menu-head .main-menu-right-cta {
		max-width: 50% !important;
		width: 100% !important;
		position: absolute;
		left: 20px;
		right: 0;
		margin: 0 auto;
		top: 25px;
	}
	
	.main-menu-right-cta div#et-info {
		display: block !important;
	}
	
	#menu-header-menu.main {
		z-index: 9;
	}
	
	.responsive-menu-accessible .responsive-menu-box {
	    display: inline-block;
	    vertical-align: middle;
	}
	.responsive-menu-inner {
	    display: block;
	    top: 50%;
	    margin-top: -1.5px;
	}
	.responsive-menu-inner::before, .responsive-menu-inner::after {
	    content: "";
	    display: block;
	}
	.responsive-menu-inner, .responsive-menu-inner::before, .responsive-menu-inner::after {
	    width: 30px;
	    height: 3px;
	    left: 0;
	    background-color: #000;
	    border-radius: 4px;
	    position: absolute;
	    transition-property: transform;
	    transition-duration: 0.15s;
	    transition-timing-function: ease;
	}
	.responsive-menu-inner::before {
	    top: -8px;
	}
	.responsive-menu-inner::after {
	    bottom: -8px;
	}
	header.show-navigation span.responsive-menu-inner:after {
	    transform: rotate(-45deg);
	    top: 0;
	    /*background-color: #e61e25 !important;*/
	}
	header.show-navigation span.responsive-menu-inner:before {
	    transform: rotate(45deg);
	    top: 0;
	    /*background-color: #e61e25 !important;*/
	}
	header.show-navigation span.responsive-menu-inner {
	    background: transparent !important;
	}
	button#responsive-menu-buttond {
	    width: 42px;
	    height: 25px;
	    position: relative;
	    background: transparent;
	    border: 0;
	    float: right;
	    outline: none;
	}
	header.mountain_view.show-navigation button#responsive-menu-buttond {
	    position: fixed;
	    z-index: 9999;
	}
}

</style>