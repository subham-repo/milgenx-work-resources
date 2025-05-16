function sort_deliverable(){
?>
<h4 class="widget-title">Delivery Available</h4>
	<ul id="sort_deliverable">
		<li>
			<label>
				<input data-name="delivery_available" data-value="yes" type="checkbox" id="del_yes" name="del_yes">
				Yes
			</label>
		</li>
		<li>
			<label>
				<input data-name="delivery_unavailable" data-value="yes" type="checkbox" id="del_no" name="del_no">
				No
			</label>
		</li>
	</ul>
	<script type="text/javascript">
		var base_url = location.href.split('?')[0];

		function woof_loading(){
			jQuery('#woof_html_buffer').show();
			jQuery('#woof_html_buffer').append('Loading...');
		}

		jQuery('#sort_deliverable').find('input[type="checkbox"]').on('change', function() {
			var urlParms = (document.location.search).replace(/(^\?)/,'').split("&").map(function(n){return n = n.split("="),this[n[0]] = n[1],this}.bind({}))[0];
			if(urlParms.hasOwnProperty("")) delete urlParms[""];
			jQuery('#sort_deliverable').find('input[type="checkbox"]').each(function(){
				if(jQuery(this).is(':checked')) {
					urlParms[jQuery(this).attr('data-name')] = jQuery(this).attr('data-value');
					woof_loading();
				} else {
					delete urlParms[jQuery(this).attr('data-name')];
				}
			})
			let tempBaseURL = decodeURIComponent(base_url+'?'+jQuery.param(urlParms));
			window.location.href = tempBaseURL;
		});

		

		if (window.location.href.indexOf('delivery_available=yes') > 1) {
			jQuery("input#del_yes"). prop("checked", true);		
			jQuery('li.product_block[delivery="No"]').hide();	
			jQuery("input#del_no").css({"pointer-events":"none", "opacity":".5"});	

		}
		
		if (window.location.href.indexOf('delivery_unavailable=yes') > 1) {
			jQuery("input#del_no"). prop("checked", true);	
			jQuery('li.product_block[delivery="Yes"]').hide();	
			jQuery("input#del_yes").css({"pointer-events":"none", "opacity":".5"});	
		}
	</script>
<?php
}
add_shortcode('sort-deliverable', 'sort_deliverable');