/*!
 * jQuery.scrollTo
 * Copyright (c) 2007-2015 Ariel Flesler - aflesler<a>gmail<d>com | //flesler.blogspot.com
 * Licensed under MIT
 * //flesler.blogspot.com/2007/10/jqueryscrollto.html
 * @projectDescription Lightweight, cross-browser and highly customizable animated scrolling with jQuery
 * @author Ariel Flesler
 * @version 2.1.2
 */
;(function(factory) {
	'use strict';
	if (typeof define === 'function' && define.amd) {

		define( ['jquery'], factory );
	} else if (typeof module !== 'undefined' && module.exports) {
		module.exports = factory( require( 'jquery' ) );
	} else {

		factory( jQuery );
	}
})(function($) {
	'use strict';

	var $scrollTo = $.scrollTo = function(target, duration, settings) {
		return $( window ).scrollTo( target, duration, settings );
	};

	$scrollTo.defaults = {
		axis:'xy',
		duration: 0,
		limit:true
	};

	function isWin(elem) {
		return ! elem.nodeName ||
			$.inArray( elem.nodeName.toLowerCase(), ['iframe','#document','html','body'] ) !== -1;
	}

	$.fn.scrollTo = function(target, duration, settings) {
		if (typeof duration === 'object') {
			settings = duration;
			duration = 0;
		}
		if (typeof settings === 'function') {
			settings = { onAfter:settings };
		}
		if (target === 'max') {
			target = 9e9;
		}

		settings = $.extend( {}, $scrollTo.defaults, settings );
		duration = duration || settings.duration;
		var queue = settings.queue && settings.axis.length > 1;
		if (queue) {
			duration /= 2;
		}
		settings.offset = both( settings.offset );
		settings.over = both( settings.over );

		return this.each(function() {
			if (target === null) { return; }

			var win = isWin( this ),
				elem = win ? this.contentWindow || window : this,
				$elem = $( elem ),
				targ = target,
				attr = {},
				toff;

			switch (typeof targ) {
				case 'number':
				case 'string':
					if (/^([+-]=?)?\d+(\.\d+)?(px|%)?$/.test( targ )) {
						targ = both( targ );
						break;
					}
					targ = win ? $( targ ) : $( targ, elem );
				case 'object':
					if (targ.length === 0) { return; }
					if (targ.is || targ.style) {
						toff = (targ = $( targ )).offset();
					}
			}

			var offset = $.isFunction( settings.offset ) && settings.offset( elem, targ ) || settings.offset;

			$.each(settings.axis.split( '' ), function(i, axis) {
				var Pos	= axis === 'x' ? 'Left' : 'Top',
					pos = Pos.toLowerCase(),
					key = 'scroll' + Pos,
					prev = $elem[key](),
					max = $scrollTo.max( elem, axis );

				if (toff) {
					attr[key] = toff[pos] + (win ? 0 : prev - $elem.offset()[pos]);

					if (settings.margin) {
						attr[key] -= parseInt( targ.css( 'margin' + Pos ), 10 ) || 0;
						attr[key] -= parseInt( targ.css( 'border' + Pos + 'Width' ), 10 ) || 0;
					}

					attr[key] += offset[pos] || 0;

					if (settings.over[pos]) {
						attr[key] += targ[axis === 'x'?'width':'height']() * settings.over[pos];
					}
				} else {
					var val = targ[pos];
					attr[key] = val.slice && val.slice( -1 ) === '%' ?
						parseFloat( val ) / 100 * max
						: val;
				}

				if (settings.limit && /^\d+$/.test( attr[key] )) {
					attr[key] = attr[key] <= 0 ? 0 : Math.min( attr[key], max );
				}

				if ( ! i && settings.axis.length > 1) {
					if (prev === attr[key]) {
						attr = {};
					} else if (queue) {
						animate( settings.onAfterFirst );
						attr = {};
					}
				}
			});

			animate( settings.onAfter );

			function animate(callback) {
				var opts = $.extend({}, settings, {
					queue: true,
					duration: duration,
					complete: callback && function() {
						callback.call( elem, targ, settings );
					}
				});
				$elem.animate( attr, opts );
			}
		});
	};

	$scrollTo.max = function(elem, axis) {
		var Dim = axis === 'x' ? 'Width' : 'Height',
			scroll = 'scroll' + Dim;

		if ( ! isWin( elem )) {
			return elem[scroll] - $( elem )[Dim.toLowerCase()](); }

		var size = 'client' + Dim,
			doc = elem.ownerDocument || elem.document,
			html = doc.documentElement,
			body = doc.body;

		return Math.max( html[scroll], body[scroll] ) - Math.min( html[size], body[size] );
	};

	function both(val) {
		return $.isFunction( val ) || $.isPlainObject( val ) ? val : { top:val, left:val };
	}

	$.Tween.propHooks.scrollLeft = $.Tween.propHooks.scrollTop = {
		get: function(t) {
			return $( t.elem )[t.prop]();
		},
		set: function(t) {
			var curr = this.get( t );
			if (t.options.interrupt && t._last && t._last !== curr) {
				return $( t.elem ).stop();
			}
			var next = Math.round( t.now );
			if (curr !== next) {
				$( t.elem )[t.prop](next);
				t._last = this.get( t );
			}
		}
	};
	return $scrollTo;
});