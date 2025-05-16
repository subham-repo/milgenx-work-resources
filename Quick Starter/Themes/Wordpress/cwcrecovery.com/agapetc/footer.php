<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
global $header_logo,$contact_number,$facebook_id,$insta_id,$linkedin_id,$pinterest_id,$twitter_id,$youtube_id;
?>

<?php do_shortcode('[global-cta]'); ?>

<!-- ==== CTA Bar Block Start ==== -->

<div class="callnow cta_footer_above_720 custom_js_footer"> 
	<div class="calltext">
		<span class="show_full_add_text">
			<span class="dynamic_change_bill">Speak to a Representative</span> 

			<a class="custombill_style" href="tel:(866)-218-7443"> <i class="fa fa-phone"></i> 
			<?php echo $cont_number =  of_get_option('contact_num_op'); ?></a>

			

		</span>
		<span class="rep_avail_now">Representatives available now. <i class="fa fa-check"></i></span>
	</div>
</div>

<script type="text/javascript">
	var call_height = jQuery('.callnow').height();

	jQuery(window).scroll(function(){
	    if (jQuery(window).scrollTop() >= 300) {
	        jQuery('html').addClass('user-active');
	        jQuery('html').css('margin-bottom', call_height);
	    }
	    else {
	        jQuery('html').removeClass('user-active');
	        jQuery('html').css('margin-bottom', '0');

	    }
	});
</script>

<!-- ==== CTA Bar Block End ==== -->

<footer>
	<div class="footer_sec">
		<div class="container">
			<div class="uk-grid uk-grid-collapse">
				<div class="uk-width-1-4@l uk-width-1-4@m uk-width-1-2@s">
					<?php dynamic_sidebar('footer_col_1'); ?>
				</div>
				<div class="uk-width-1-4@l uk-width-1-4@m uk-width-1-2@s">
					<?php dynamic_sidebar('footer_col_2'); ?>
					
				</div>
				<div class="uk-width-1-4@l uk-width-1-4@m uk-width-1-2@s">
					<?php dynamic_sidebar('footer_col_3'); ?>
				</div>
				<div class="uk-width-1-4@l uk-width-1-4@m uk-width-1-2@s last_col">
					<?php dynamic_sidebar('footer_col_4'); ?>



					</ul>
				</div>
				<div class="uk-width-1-1 foot_copy">
					<div class="priv_pol">
						<?php dynamic_sidebar('footer_col_5'); ?>
					</div>
					<div class="copyright">
						<p>&copy; <?php echo date("Y"); ?>  Comprehensive Wellness Centers - All Rights Reserved</p>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<a id="back2Top" title="Back to top" href="#">&#10148;</a>
	
	<script>
		jQuery(document).ready(function(){
			jQuery(window).scroll(function() {
			    var height = jQuery(window).scrollTop();
			    if (height > 200) {
			        jQuery('#back2Top').fadeIn();
			    } else {
			        jQuery('#back2Top').fadeOut();
			    }
			});
			jQuery(document).ready(function() {
			    jQuery("#back2Top").click(function(event) {
			        event.preventDefault();
			        jQuery("html, body").animate({ scrollTop: 0 }, "slow");
			        return false;
			    });

			});
		});
	</script>

	<script>
		jQuery(document).ready(function($) {
		// clear cf7 error msg on mouseover
		$(".wpcf7-form-control-wrap").click(function(){
		$obj = $("span.wpcf7-not-valid-tip",this);
		$obj.css('display','none');
		});


		jQuery(window).scroll(function(){
		    if (jQuery(window).scrollTop() >= 300) {
		        jQuery('header').addClass('scrolled-body');
		    }
		    else {
		        jQuery('header').removeClass('scrolled-body');
		    }
		});

		}); 
	</script>
	
</footer>

<!--End image popup-->

<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.6/highlight.min.js"></script>
<script type="text/javascript">hljs.initHighlightingOnLoad();</script>

<script>

$(document).ready(function(){
	jQuery(".clickicon").click(function(){
	// jQuery(".sub-menu").removeClass("mainss");	
		$(this).toggleClass('icon-rotate');
		$(this).closest('.menu-item-has-children').find('.sub-menu').toggleClass('mainss');
	}); 
});
</script>
<?php wp_footer(); ?>
<script>
 jQuery(".mobilenav_menu button ").click(function(){
    jQuery("#menu-header-menu").toggleClass("main");
});

</script>

<script>
 $('.menu-item-has-children').each(function(i) {

    var $img = $('2').on('load', function(){
        alert('loaded');
    });

    $(this).append( $('<i class="clickicon fa fa-sort-desc" aria-hidden="true"></i>').append($img) );               
    // you'd need to just use your div example here

    $(document).ready(function(){
	$('#nav-icon1').click(function(){
		$(this).toggleClass('open');
	});
});

$('.our_facility-tour').slick({
  dots: false,
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  adaptiveHeight: true,
	autoplay: true,
	autoplaySpeed: 10000,
	cssEase: 'linear',
});
jQuery('.our_facility-tour button.slick-prev.slick-arrow').html('<i class="fa fa-angle-left"></i>');
jQuery('.our_facility-tour button.slick-next.slick-arrow').html('<i class="fa fa-angle-right"></i>');

$('.accrediation_slider').slick({
  dots: false,
  speed: 300,
  prevArrow: null,
  nextArrow: null,
  slidesToShow: 6,
  slidesToScroll: 6,
  autoplay: true,
	autoplaySpeed: 0,
	speed: 10000,
	cssEase: 'linear',
	infinite: true,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 4
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
});


</script>
</body>
</html>
