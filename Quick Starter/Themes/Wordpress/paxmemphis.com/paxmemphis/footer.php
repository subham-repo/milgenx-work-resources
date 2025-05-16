</body>

<footer class="section-full footer-spacing site-footer">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
				<div class="footerin_col full-width">
					<?php dynamic_sidebar( 'footer_info' ); ?>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
				<div class="footerin_col full-width">
					<?php dynamic_sidebar( 'footer_link' ); ?>
				</div>
			</div>
			<div class="col-lg-4 col-md-12 col-sm-6 col-xs-12">
				<div class="footerin_col full-width">
					<?php dynamic_sidebar( 'footer_form' ); ?>
				</div>
			</div>
		</div>
	</div>
</footer>

<a href="#" class="scrollTop"><i class="fa fa-angle-up"></i></a>
<!-- ==== CTA Bar Block Start ==== -->

<div class="callnow cta_footer_above_720 custom_js_footer"> 
	<div class="calltext">
		<span class="show_full_add_text">
			<span class="dynamic_change_bill">Get Addiction Help Now</span> 

			<a class="custombill_style" href="tel:<?php echo $cont_number =  of_get_option('contact_num_op'); ?>"> <i class="fa fa-phone"></i> 
			<?php echo $cont_number =  of_get_option('contact_num_op'); ?></a>

			
				
	

		</span>
		<span class="rep_avail_now">Call PAX Memphis <i class="fa fa-check"></i></span>
	</div>
</div>

<script type="text/javascript">
	var call_height = jQuery('.callnow').height();

	jQuery(window).scroll(function(){
	    if (jQuery(window).scrollTop() >= 300) {
	        jQuery('html').addClass('user-active');
	        jQuery('html').css('margin-bottom', call_height);
	        jQuery('a.scrollTop').css({'bottom':call_height+30, 'right':'30px', 'opacity':'1'});
	    }
	    else {
	        jQuery('html').removeClass('user-active');
	        jQuery('html').css('margin-bottom', '0');
	        jQuery('a.scrollTop').css({'bottom':call_height+30, 'right':'-50px', 'opacity':'0'});
	    }
	});
</script>

<?php wp_footer();?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">
	jQuery(document).ready(function(){

		// Add arrow to menu item those have child
		jQuery('.navbar-nav .menu-item-has-children').each(function(){
		    jQuery(this).append('<span class="show_child-btn"><i class="fa fa-angle-down"></i></span>');
		})
		jQuery('li.menu-item-has-children').each(function(){
		    jQuery(this).find('.show_child-btn').on('click', function(){
		        jQuery(this).parent('li.menu-item-has-children').addClass('show-child');
		        jQuery(this).parent('li.menu-item-has-children').siblings().removeClass('show-child');
		    })
		    jQuery(this).find('.show_child-btn').on('click', function(){
	             if(jQuery(this).hasClass('show-child')){
			        jQuery(this).removeClass('show-child');
			    }
		    })
		})
	})
</script>

</html>