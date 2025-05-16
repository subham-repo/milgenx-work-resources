(function ($) {
    "use strict";


    if ($("body").hasClass("rtl")) {
        $('.slick-slider').attr('dir', 'rtl');
        var $rtlActive = true;
    } else {
        var $rtlActive = false;
    }

    var $document = $(document),
		$window = $(window),
		windowWidth = window.innerWidth || $window.width(),
		windowH = $window.height(),

	themeBlocks = {
		productImage: $("#mainImage"),
		prdCarousel: $('.prd-carousel'),
        similarSlider: $(".product-list")

};

	if (themeBlocks.productImage.length) {
		var zoomPos = $('body').hasClass('rtl') ? 11 : 1;
		themeBlocks.productImage.elevateZoom({
			gallery: 'productPreviews',
			cursor: 'pointer',
			galleryActiveClass: 'active',
			zoomWindowPosition: zoomPos,
			zoomWindowFadeIn: 500,
			zoomWindowFadeOut: 500,
			lensFadeIn: 500,
			lensFadeOut: 500
		});
		var ezApi = themeBlocks.productImage.data('elevateZoom');
		if ((window.innerWidth || $window.width()) < 1025) {
			ezApi.changeState('disable');
		}
		$(window).on('resize', function () {
			if ((window.innerWidth || $window.width()) < 1025) {
				ezApi.changeState('disable');
			} else {
				ezApi.changeState('enable');
			}
		});
		$('#productPreviews > a').on('click', function () {
			themeBlocks.productImage.attr({
				src: $(this).attr('data-image'),
				'data-zoom-image': $(this).attr('data-zoom-image')
			});
		});
	}

    if (themeBlocks.similarSlider.length) {
        themeBlocks.similarSlider.slick({
            rtl:$rtlActive,
            slidesToShow: 4,
            slidesToScroll: 1,
            infinite: true,
            dots: true,
            arrows: false,
            responsive: [{
                breakpoint: 991,
                settings: {
                    slidesToShow: 3
                }
            }, {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2
                }
            }, {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1
                }
            }]
        });
    }


    if (themeBlocks.prdCarousel.length) {
		themeBlocks.prdCarousel.slick({
            rtl:$rtlActive,
            slidesToShow: 4,
			slidesToScroll: 1,
			infinite: true,
			dots: true,
			arrows: false,
			responsive: [{
				breakpoint: 991,
				settings: {
					slidesToShow: 3
				}
					}, {
				breakpoint: 767,
				settings: {
					slidesToShow: 2
				}
					}, {
				breakpoint: 480,
				settings: {
					slidesToShow: 1
				}
					}]
		});
	}

	function changeInput() {
		$(document).on('click', '.count-add, .count-reduce', function (e) {
			var $this = $(e.target),
				input = $this.parent().find('.count-input'),
				valString = input.val(),
				valNum = valString.replace(/[^0-9]/g, ''),
				valText = valString.replace(/[0-9]/g, ''),
				v = $this.hasClass('count-reduce') ? valNum - 1 : valNum * 1 + 1,
				min = input.attr('data-min') ? input.attr('data-min') : 0;
			if (v >= min) input.val(v + valText);
			e.preventDefault();
		});
	}
	
	function toggleCart(cart, drop) {
		$('> a', $(cart)).on('click', function (e) {
			e.preventDefault();
			$(cart).toggleClass('opened');
		});
		$(document).on('click', function (e) {
			if (!$(e.target).closest(cart).length) {
				if ($(cart).hasClass("opened")) {
					$(cart).removeClass('opened');
				}
			}
		});
	}
	
	changeInput();
	toggleCart('.header-cart', '.header-cart-dropdown');

})