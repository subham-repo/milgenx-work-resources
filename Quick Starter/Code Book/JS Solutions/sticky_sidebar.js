// Sticky Side bar on scroll and stop before last section

var header_hight       = jQuery('.newnav').height();
var sidebar_sticky     = jQuery('.sidebar-part');
var sidebar_st_height  = sidebar_sticky.height();
var sidebar_width      = sidebar_sticky.width();
var sidebar_offset_top = sidebar_sticky.offset().top;
var sidebar_space_left = sidebar_sticky.position().left;
var sidebar_stick_at   = parseInt(header_hight+sidebar_offset_top);
console.log(sidebar_stick_at);

var last_section 	   = jQuery('footer#additional-footer');
var last_secoff_top    = last_section.offset().top;
var last_secoff_height = last_section.height();
var stop_sticky        = last_secoff_top - last_secoff_height; 

var window_width	   = jQuery(window).width();



if(window_width => 1100){
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > sidebar_stick_at){  

            if(jQuery(this).scrollTop() > stop_sticky){
              sidebar_sticky.css({'position':'relative', 'bottom':'unset', 'left':'0', 'width':sidebar_width-10});
            }else{
              sidebar_sticky.css({'position':'fixed', 'bottom':'0', 'left':sidebar_space_left, 'width':sidebar_width-10});
            }

        }
        else{
            sidebar_sticky.css({'position':'relative', 'bottom':'unset', 'left':'0', 'width':sidebar_width});
        }
    });
}