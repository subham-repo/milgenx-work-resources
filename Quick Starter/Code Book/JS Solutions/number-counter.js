jQuery.fn.isInViewport = function() {
    var elementTop = jQuery(this).offset().top;
    var elementBottom = elementTop + jQuery(this).outerHeight();

    var viewportTop = jQuery(window).scrollTop();
    var viewportBottom = viewportTop + jQuery(window).height();

	    return elementBottom > viewportTop && elementTop < viewportBottom;
	};

	var target_id = jQuery('.case-study-sec');

	function counter_box(){
		var counter_box = jQuery('.increment_num');
		var counter_target = counter_box.attr('count-target');

		counter_box.each(function() {
			var $this = jQuery(this),
			countTo = $this.attr('count-target');
			jQuery({ countNum: $this.text()}).animate({
			countNum: countTo
		},
		                                    {
		duration: 3000,
		easing:'linear',
		step: function() {
			$this.text(Math.floor(this.countNum));
		},
		complete: function() {
			$this.text(this.countNum+'%');
		}
	});
	});
	}
	jQuery(window).on('scroll', function(){
		if(target_id.length > 0){
			if(target_id.isInViewport()){
				if(!target_id.hasClass('kill-counter')){
					counter_box();
					target_id.addClass('kill-counter');
				}
				// console.log('I am here...');
			}else{
				// console.log('I am away...');
				if(target_id.hasClass('kill-counter')){
					target_id.removeClass('kill-counter');
				}
			}
		}
	})