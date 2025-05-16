1. Compare two fields value with validation error
2. Code to add value in field after calculation
3. Remove select field option content of choice
4. Count character of field with validation
5. Get current date in field
6. On load clear the placeholder
7. On change, paste, keyup, click add class to field
8. On blur remove class from field if empty
9. On load add class to field is not empty
10. Open Third Party Links in new tab
11. snippet for Sales conversion page
12. string_replace
 
// Compare two fields value with validation error

jQuery('.phone-box').append('<div style="display:block;" class="phone-confirmation"></div>');
jQuery("#input_55_15").on("change paste keyup", function() {
   var pass1 = jQuery('#input_55_7').val();
	var pass2 = jQuery('#input_55_15').val();
	if(pass1 != '' && pass1 != pass2) {
	    //show error
	    var error = 'Mobile number doesn\'t match.';
	    jQuery(this).parents('.gfield').addClass('gfield_error');
	    jQuery('.phone-confirmation').text(error);
	    jQuery('#gform_next_button_14_2').attr('disabled','disabled');
	} else {
	    jQuery(this).parents('.gfield').removeClass('gfield_error');
		jQuery('.phone-confirmation').text('');
	    jQuery('#gform_next_button_14_2').removeAttr('disabled','disabled');
	}
});

/* --------------------------------------------------- */

// Code to add value in field after calculation

jQuery('#input_57_147').on('change', function(){
	var a = jQuery('#input_57_147').val();
	var b = jQuery('#ginput_base_price_57_24').val().replace("$", "");
	var c = parseInt(a) + parseInt(b);
	jQuery('#input_57_19').val(c);
	jQuery('span.ginput_total_57').text('$' + c.toFixed(2)); // Maket value integer 
	// console.log(a);
	// console.log(b);
	// console.log(c);
});

/* -------------------------------------------------- */

// Remove select field option content of choice

jQuery('#input_57_139').on('change', function(){
	setTimeout(function(){
		jQuery('#input_57_140, #input_57_113').find('option').each(function() {
			jQuery(this).text(jQuery(this).text().replace(jQuery(this).attr('price'),''));
		});
	},500)
});

/* -------------------------------------------------- */

// Count character of field with validation

jQuery('#input_57_136').attr('onKeyup','countChar(this)');
jQuery('#input_57_136').parent().append('<div id="charNum"><span class="count"></span><span class="ch_info"></span></div>');

function countChar(val) {
   var len = val.value.length;
   if (len >= 51) {
     val.value = val.value.substring(0);
     jQuery('#charNum .ch_info').text('Characters left');
   } else {
     jQuery('#charNum .count').text(50 - len);
     jQuery('#charNum .ch_info').text(' Characters left');
   }
 };

/* -------------------------------------------------- */

// Get current date in field

<?php
    $date = 'demo text string';
    $complexArray = array('demo', 'text', array('foo', 'bar'));
    // Return date/time info of a timestamp; then format the output
	$mydate=getdate(date("U"));
	// echo "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";
	$today = "$mydate[month] / $mydate[mday] / $mydate[year]";
?>

    var today_date = '<?php echo $today; ?>';
    console.log(today_date);
    jQuery('#input_55_125').val(today_date);

/* -------------------------------------------------- */



/* Checkout page jQueries */
jQuery(document).ready(function(){
	setTimeout(function(){  
	// On load clear the placeholder
		jQuery('.form-row span.woocommerce-input-wrapper input').attr('placeholder','');
	}, 100);


	jQuery('.form-row span.woocommerce-input-wrapper').on('change paste keyup click', function(){
		// Billing fields: On change, paste, keyup, click add class to field
		jQuery(this).parent().addClass('clicked'); 
	});


	jQuery('.form-row span.woocommerce-input-wrapper input').blur(function(){
		// Billing fields: On blur remove class from field if empty
		if(!jQuery(this).val()){
		jQuery(this).parent('span.woocommerce-input-wrapper').parent('.form-row').removeClass('clicked');
		}
	});

	if(jQuery('.form-row span.woocommerce-input-wrapper').find('input').val()){
		// Billing fields: On load add class to field is not empty
		jQuery('.form-row span.woocommerce-input-wrapper').find('input').parent('span.woocommerce-input-wrapper').parent('.form-row').addClass('clicked');
	}
});

/* Checkout page jQueries end*/

/* Scroll Top Function End */
function MoveToSection(){
	var headerHeight = jQuery('div#wrapper-navbar').outerHeight();
	jQuery('a[href^="#"]').on('click', function() {
	if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
	&& location.hostname == this.hostname) {
		var target = jQuery(this.hash);
		target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
		if (target.length) {
		    jQuery('html,body').animate({
		      scrollTop: target.offset().top - headerHeight //offsets for fixed header
		    }, 1000);
		    return false;
		  }
		}
	});
	  //Executed on page load with URL containing an anchor tag.
  	if(jQuery(location.href.split("#")[1])) {
      var target = jQuery('#'+location.href.split("#")[1]);
      if (target.length) {
        jQuery('html,body').animate({
          scrollTop: target.offset().top - headerHeight //offset height of header here too.
        }, 1000);
        return false;
      }
    }
}
MoveToSection();


var links = document.links;
for (let i = 0, linksLength = links.length ; i < linksLength ; i++) {
	if (links[i].hostname !== window.location.hostname) {
	links[i].target = '_blank';
	links[i].rel = 'noreferrer noopener';
	}
}

// Event snippet for Sales conversion page 

gtag('event', 'conversion', {
'send_to': 'AW-764615130/FiFWCNz_zI8CENqzzOwC',
'value': {{ checkout.total_price | money_without_currency | remove: ',' }},
'currency': '{{ order.currency }}',
'transaction_id': '{{ order.order_number  }}'
});

function string_replace(selector, search_for, replace_with ){
    let selector_target = document.querySelectorAll(selector);
    
    if(selector_target !== null){
	    if(selector && search_for && replace_with){
	    	selector_target.forEach(function(item){
	    		let selector_content =  item.textContent;
		        let after_replace = selector_content.replace(search_for, replace_with);
		        item.textContent = after_replace;
	    	})
    		
    	}
    }
}
string_replace('li.building-size', 'Floor Area is', 'Living space:');
string_replace('.property-feature-icons .page-price', 'Preis auf Anfrage', 'Price on request');
