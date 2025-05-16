(function($) {
    "use strict";
    var $slickBtnPrev =  '<button type="button" data-role="none" class="slick-prev" aria-label="previous"><svg class="icon icon-arrow-left" width="22" height="41" viewBox="0 0 22 41" xmlns="//www.w3.org/2000/svg"><path d="M20.5312 40.5L0.53125 20.5L20.5312 0.5L21.4688 1.4375L2.44531 20.5L21.4688 39.5625L20.5312 40.5Z"/></svg></button>',
        $slickBtnNext =  '<button type="button" data-role="none" class="slick-next" aria-label="next"><svg class="icon icon-arrow-right" width="22" height="41" viewBox="0 0 22 41" xmlns="//www.w3.org/2000/svg"><path d="M1.66875 40.5L21.6688 20.5L1.66875 0.5L0.731251 1.4375L19.7547 20.5L0.731251 39.5625L1.66875 40.5Z"/></svg></button>';

    if ($("body").hasClass("rtl")) {
        $('.slick-slider').attr('dir', 'rtl');
        var $rtlActive = true;
    } else {
        var $rtlActive = false;
    }

    var $j = jQuery.noConflict();
    function postSingleSlider() {
        if ($j(".ini-post-slider").length) {
            $j(".ini-post-slider").slick({
                rtl:$rtlActive,
                prevArrow: $slickBtnPrev,
                nextArrow: $slickBtnNext,

                mobileFirst: false,
                slidesToShow: slider_vars['columns'],
                slidesToScroll: 1,
                infinite: true,
                autoplay: false,
                arrows:slider_vars['arrows'] == 1 ? true : false,
                dots:slider_vars['dots'] == 1 ? true : false,
                speed: 700,
                responsive: [{
                    breakpoint: 480,
                    settings: {
                        arrows: false
                    }
                }]
            });
        }
    }
    postSingleSlider();
})(jQuery);