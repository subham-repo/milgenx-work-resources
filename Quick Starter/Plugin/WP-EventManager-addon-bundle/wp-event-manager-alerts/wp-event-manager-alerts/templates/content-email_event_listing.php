<?php 
global $post;

$title    = $post->post_title;
$type     = get_event_type();
$location = get_event_location();
$organizer = get_organizer_name();
$link     = get_event_permalink();

echo "\n";


// Event title
echo esc_html( $title ) . "\n";

// Location and company
if ( $location ) {
    printf( __( 'Location: %s', 'wp-event-manager-alerts' ) . "\n", esc_html( strip_tags( $location ) ) );
}
if ( $organizer ) {
    printf( __( 'Organizer: %s', 'wp-event-manager-alerts' ) . "\n", esc_html( strip_tags( $organizer ) ) );
}

// Permalink
printf( __( 'View Details: %s', 'wp-event-manager-alerts' ) . "\n", $link  );
