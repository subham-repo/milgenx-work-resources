<?

/* 
Source-url: https://benrabicoff.com/adding-secure-http-response-headers-wordpress/
*/

add_action('send_headers', function(){
    // Enforce the use of HTTPS
	header("Strict-Transport-Security: max-age=31536000; includeSubDomains");
	// Prevent Clickjacking
	header("X-Frame-Options: SAMEORIGIN");
	// Prevent XSS Attack
	header("Content-Security-Policy: default-src 'self';"); // FF 23+ Chrome 25+ Safari 7+ Opera 19+
	header("X-Content-Security-Policy: default-src 'self';"); // IE 10+
	// Block Access If XSS Attack Is Suspected
	header("X-XSS-Protection: 1; mode=block");
	// Prevent MIME-Type Sniffing
	header("X-Content-Type-Options: nosniff");
	// Referrer Policy
	header("Referrer-Policy: no-referrer-when-downgrade");
	header("Feature-Policy: autoplay deny; camera deny; encrypted-media deny; fullscreen deny; microphone deny; vr deny;");
}, 1);

