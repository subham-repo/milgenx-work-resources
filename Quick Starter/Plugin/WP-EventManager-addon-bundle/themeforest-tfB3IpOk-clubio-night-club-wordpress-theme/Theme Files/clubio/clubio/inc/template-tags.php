<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Clubio
 */

if ( ! function_exists( 'clubio_posted_on' ) ) :
function clubio_posted_on() {
    $clock_svg = '<span class="tt-icon tt-clock"><svg class="icon icon-clock" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 384 384" style="enable-background:new 0 0 384 384;" xml:space="preserve"><path d="M377.8,192C377.4,295.6,294,379.6,188.6,378C86.7,376.4,4.1,293.6,5.7,188.8C7.4,86.9,90.2,4.3,195,6C296.5,7.7,377.3,89.5,377.8,192z M322.6,192.1c0.4-71.7-58.4-130-128.8-131c-73.3-1-132,58.5-132.9,129c-1,73.2,58.6,132,129.1,132.9C263.2,323.9,323,263.8,322.6,192.1z M164.1,200.3c0,3,0.9,5.7,3.2,7.8c0.6,0.5,1.1,1.1,1.7,1.6c7,6.8,13.9,13.6,20.8,20.4c7.6,7.4,15.1,14.8,22.7,22.2c6.2,6.1,12.4,12.2,18.7,18.3c3.6,3.5,8.9,3.4,12.3-0.1c4-4.2,8.1-8.3,12.1-12.4c4.8-4.9,9.7-9.9,14.5-14.8c1.7-1.8,2.6-3.9,2.5-6.3c-0.1-2.3-1.1-4.2-2.8-5.9c-7-6.8-13.9-13.6-20.9-20.4c-9.2-9-18.3-18.1-27.6-27c-1.6-1.5-2.1-3-2.1-5.1c0.1-28.1,0.1-56.3,0-84.4c0-1.7-0.5-3.6-1.3-5.2c-1.5-3-4.4-3.8-7.4-3.8c-12.1-0.1-24.2-0.1-36.3,0c-1.6,0-3.4,0.2-4.9,0.6c-1.2,0.4-2.4,1.2-3.3,2.2c-1.7,1.7-2,4-2,6.2c0,17.7,0,35.4,0,53.1C164.1,165,164.1,182.6,164.1,200.3z"/></svg></span>';
   $clock_svg1 = '<span class="tt-icon tt-clock"><svg class="icon icon-clock-thin" version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32"><title>clock</title><path d="M16 0c-8.822 0-16 7.178-16 16s7.178 16 16 16c8.822 0 16-7.178 16-16s-7.178-16-16-16zM16 30c-7.72 0-14-6.28-14-14s6.28-14 14-14c7.72 0 14 6.28 14 14s-6.28 14-14 14z"></path><path d="M17 6h-2v10.414l6.293 6.293 1.414-1.414-5.707-5.707v-9.586z"></path></svg></span>';
    $clock_svg2 = '<span class="tt-icon tt-clock"><svg class="icon icon-clock-" width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.5 0.9375C6.46484 0.9375 5.49316 1.1377 4.58496 1.53809C3.67676 1.92871 2.88086 2.46582 2.19727 3.14941C1.52344 3.82324 0.986328 4.61426 0.585938 5.52246C0.195313 6.43066 0 7.40234 0 8.4375C0 9.47266 0.195313 10.4443 0.585938 11.3525C0.986328 12.2607 1.52344 13.0566 2.19727 13.7402C2.88086 14.4141 3.67676 14.9463 4.58496 15.3369C5.49316 15.7373 6.46484 15.9375 7.5 15.9375C8.53516 15.9375 9.50684 15.7373 10.415 15.3369C11.3232 14.9463 12.1143 14.4141 12.7881 13.7402C13.4717 13.0566 14.0088 12.2607 14.3994 11.3525C14.7998 10.4443 15 9.47266 15 8.4375C15 7.40234 14.7998 6.43066 14.3994 5.52246C14.0088 4.61426 13.4717 3.82324 12.7881 3.14941C12.1143 2.46582 11.3232 1.92871 10.415 1.53809C9.50684 1.1377 8.53516 0.9375 7.5 0.9375ZM7.5 14.4434C6.67969 14.4434 5.90332 14.2871 5.1709 13.9746C4.43848 13.6523 3.79883 13.2227 3.25195 12.6855C2.71484 12.1387 2.28516 11.499 1.96289 10.7666C1.65039 10.0342 1.49414 9.25781 1.49414 8.4375C1.49414 7.61719 1.65039 6.84082 1.96289 6.1084C2.28516 5.37598 2.71484 4.74121 3.25195 4.2041C3.79883 3.65723 4.43848 3.22754 5.1709 2.91504C5.90332 2.59277 6.67969 2.43164 7.5 2.43164C8.32031 2.43164 9.09668 2.59277 9.8291 2.91504C10.5615 3.22754 11.1963 3.65723 11.7334 4.2041C12.2803 4.74121 12.71 5.37598 13.0225 6.1084C13.3447 6.84082 13.5059 7.61719 13.5059 8.4375C13.5059 9.25781 13.3447 10.0342 13.0225 10.7666C12.71 11.499 12.2803 12.1387 11.7334 12.6855C11.1963 13.2227 10.5615 13.6523 9.8291 13.9746C9.09668 14.2871 8.32031 14.4434 7.5 14.4434ZM7.88086 4.6875H6.75293V9.18457L10.6494 11.5869L11.25 10.6055L7.88086 8.58398V4.6875Z" fill="#FF1A43"/></svg></span>';
    ?>
<div class="news-single__data">
    <div class="tt-col">
        <div class="news-single__comments news-single__link"><?php echo wp_kses($clock_svg2, clubio_tags()).'<span class="ch-icon-text">'.get_the_date(); ?></span></div>
    </div>
    <div class="tt-col">
        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="news-single__link">
            <span class="tt-icon tt-author"><svg class="icon icon-author" width="17" height="13" viewBox="0 0 17 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.93164 7.84082C9.46289 7.45345 9.87793 6.96094 10.1768 6.36328C10.4756 5.75456 10.625 5.11263 10.625 4.4375C10.625 3.85091 10.5143 3.30306 10.293 2.79395C10.0716 2.27376 9.76725 1.81999 9.37988 1.43262C8.99251 1.04525 8.53874 0.740885 8.01855 0.519531C7.50944 0.298177 6.96159 0.1875 6.375 0.1875C5.78841 0.1875 5.23503 0.298177 4.71484 0.519531C4.20573 0.740885 3.75749 1.04525 3.37012 1.43262C2.98275 1.81999 2.67839 2.27376 2.45703 2.79395C2.23568 3.30306 2.125 3.85091 2.125 4.4375C2.125 5.11263 2.27441 5.75456 2.57324 6.36328C2.87207 6.96094 3.28711 7.45345 3.81836 7.84082C3.30924 8.07324 2.83333 8.361 2.39062 8.7041C1.95898 9.0472 1.57715 9.4401 1.24512 9.88281C0.913086 10.3255 0.636393 10.807 0.415039 11.3271C0.204753 11.8363 0.0664062 12.373 0 12.9375H1.41113C1.49967 12.3398 1.69336 11.7809 1.99219 11.2607C2.29102 10.7406 2.66178 10.2923 3.10449 9.91602C3.5472 9.52865 4.04525 9.22982 4.59863 9.01953C5.16309 8.79818 5.75521 8.6875 6.375 8.6875C6.99479 8.6875 7.58138 8.79818 8.13477 9.01953C8.69922 9.22982 9.2028 9.52865 9.64551 9.91602C10.0882 10.2923 10.459 10.7406 10.7578 11.2607C11.0566 11.7809 11.2503 12.3398 11.3389 12.9375H12.75C12.6836 12.373 12.5397 11.8363 12.3184 11.3271C12.1081 10.807 11.8369 10.3255 11.5049 9.88281C11.1729 9.4401 10.7855 9.0472 10.3428 8.7041C9.91113 8.361 9.44076 8.07324 8.93164 7.84082ZM6.375 7.27637C5.60026 7.27637 4.93066 6.99967 4.36621 6.44629C3.81283 5.88184 3.53613 5.21224 3.53613 4.4375C3.53613 3.66276 3.81283 2.9987 4.36621 2.44531C4.93066 1.88086 5.60026 1.59863 6.375 1.59863C7.14974 1.59863 7.8138 1.88086 8.36719 2.44531C8.93164 2.9987 9.21387 3.66276 9.21387 4.4375C9.21387 5.21224 8.93164 5.88184 8.36719 6.44629C7.8138 6.99967 7.14974 7.27637 6.375 7.27637ZM14.6592 7.69141C14.9469 7.33724 15.1738 6.9388 15.3398 6.49609C15.5059 6.05339 15.5889 5.60514 15.5889 5.15137C15.5889 4.50944 15.4561 3.91732 15.1904 3.375C14.9248 2.82161 14.5706 2.35124 14.1279 1.96387C13.6963 1.56543 13.1927 1.27214 12.6172 1.08398C12.0527 0.884766 11.4606 0.823893 10.8408 0.901367C10.9404 1.00098 11.029 1.12272 11.1064 1.2666C11.1839 1.39941 11.2614 1.53776 11.3389 1.68164C11.4053 1.78125 11.4606 1.88639 11.5049 1.99707C11.5492 2.09668 11.5879 2.20182 11.6211 2.3125C12.429 2.45638 13.0544 2.79948 13.4971 3.3418C13.9398 3.87305 14.1611 4.47624 14.1611 5.15137C14.1611 5.60514 14.0505 6.03678 13.8291 6.44629C13.6188 6.84473 13.3532 7.16569 13.0322 7.40918C12.9215 7.48665 12.8441 7.5752 12.7998 7.6748C12.7666 7.77441 12.75 7.87402 12.75 7.97363C12.75 8.15072 12.7998 8.30566 12.8994 8.43848C12.999 8.57129 13.1374 8.6543 13.3145 8.6875C13.9564 8.83138 14.4932 9.16341 14.9248 9.68359C15.3675 10.1927 15.5889 10.7793 15.5889 11.4434H17C17 10.6686 16.7842 9.93815 16.3525 9.25195C15.932 8.56576 15.3675 8.04557 14.6592 7.69141Z" fill="#FF1A43"></path></svg></span>
            <span class="ch-icon-text"><?php echo get_the_author(); ?></span>
        </a>
    </div>
    <div class="tt-col">
        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="news-single__link">
            <span class="tt-icon tt-comments"><svg class="icon icon-testimonials" width="14" height="14" fill="none" viewBox="0 0 14 14"><path d="M12.5331 0H1.62687C1.28312 0 0.98625 0.119792 0.73625 0.359375C0.496667 0.598958 0.376875 0.885417 0.376875 1.21875V10.3438C0.376875 10.6875 0.496667 10.9792 0.73625 11.2188C0.98625 11.4479 1.28312 11.5625 1.62687 11.5625H6.17375L7.81437 13.75C7.86646 13.8333 7.93417 13.8958 8.0175 13.9375C8.11125 13.9792 8.205 14 8.29875 14C8.3925 14 8.48104 13.9792 8.56437 13.9375C8.65812 13.8958 8.73104 13.8333 8.78312 13.75L10.4237 11.5625H12.5331C12.8769 11.5625 13.1685 11.4479 13.4081 11.2188C13.6581 10.9792 13.7831 10.6875 13.7831 10.3438V1.21875C13.7831 0.885417 13.6581 0.598958 13.4081 0.359375C13.1685 0.119792 12.8769 0 12.5331 0ZM12.5331 10.3438H10.1269C10.0331 10.3438 9.93937 10.3646 9.84562 10.4062C9.76229 10.4479 9.69458 10.5104 9.6425 10.5938L8.29875 12.375L6.955 10.5938C6.90292 10.5104 6.83 10.4479 6.73625 10.4062C6.65292 10.3646 6.56437 10.3438 6.47062 10.3438H1.59562L1.62687 1.21875H12.5644L12.5331 10.3438ZM11.3456 2.70312H2.81437V3.92188H11.3456V2.70312ZM11.3456 5.14062H2.81437V6.35938H11.3456V5.14062ZM11.3456 7.57812H2.81437V8.78125H11.3456V7.57812Z"/></svg> </span>
            <span class="ch-icon-text"><?php echo get_comments_number(). esc_html__( ' Comment(s)', 'clubio' ); ?></span>
        </a>
    </div>
</div>
<?php
}
endif;

if ( ! function_exists( 'clubio_time_link' ) ) :
function clubio_time_link() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}
	$time_string = sprintf( $time_string,
		get_the_date( DATE_W3C ),
		get_the_date(),
		get_the_modified_date( DATE_W3C ),
		get_the_modified_date()
	);
    return sprintf(
        wp_kses( __( '<span class="screen-reader-text">Posted on</span> %s', 'clubio' ), clubio_tags() ), '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);}
endif;
if ( ! function_exists( 'clubio_entry_footer' ) ) :
function clubio_entry_footer() {
    global $post;
    $categories_list = get_the_category_list();
	$tags_list = get_the_tag_list('<ul class="tt-list-box"><li>','</li><li>','</li></ul>' );
	if ( ( ( clubio_categorized_blog() && $categories_list ) || $tags_list ) || get_edit_post_link() ) {
		echo '<footer class="news-single__wrapper"><hr>';
			if ( 'post' === get_post_type() ) {
				if ( ( $categories_list && clubio_categorized_blog() ) || $tags_list ) {
                    echo '<div class="news-single__meta">';
                    if ( $tags_list ) {
                        echo '
                        <div class="tt-col">
                        <div class="news-single__meta__label">' . esc_html__( 'Tags:', 'clubio' ) . '</div> <span class="screen-reader-text">' . esc_html__( 'Tags', 'clubio' ) . '</span>' . $tags_list.'
                        </div>

                        <div class="tt-col tt-col-socials">
                        '. do_shortcode(get_post_meta($post->ID, 'tt_post_add_content', true )) .'
                        </div>';
                    }
                    echo '</div>';

                    if ( $categories_list && clubio_categorized_blog() &&  has_category()) {
                        echo '<div class="tt-col tt-col-categories"><div class="news-single__meta__label">' . esc_html__( 'Categories:', 'clubio' ) . '</div> <span class="screen-reader-text">' . esc_html__( 'Categories', 'clubio' ) . '</span>'. $categories_list. '</div>';
                    }

                }
			}
		echo '</footer>';
    }
}
endif;
if ( ! function_exists( 'clubio_edit_link' ) ) :
function clubio_edit_link() {
    edit_post_link(
		sprintf(
            wp_kses( __( 'Edit<span class="screen-reader-text">"%s"</span>', 'clubio' ), clubio_tags() ), get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);}
endif;
function clubio_front_page_section( $partial = null, $id = 0 ) {
	if ( is_a( $partial, 'WP_Customize_Partial' ) ) {
		global $clubiocounter;
		$id = str_replace( 'panel_', '', $partial->id );
		$clubiocounter = $id;
	}
	global $post;
	if ( get_theme_mod( 'panel_' . $id ) ) {
		$post = get_post( get_theme_mod( 'panel_' . $id ) );
		setup_postdata( $post );
		set_query_var( 'panel', $id );

        get_template_part( 'template-parts/page/content', 'front-page-panels' );

		wp_reset_postdata();
	} elseif ( is_customize_preview() ) {
		echo '<article class="panel-placeholder panel clubio-panel clubio-panel' . $id . '" id="panel' . $id . '"><span class="clubio-panel-title">' . sprintf( esc_html__( 'Front Page Section %1$s Placeholder', 'clubio' ), $id ) . '</span></article>';
	}
}
function clubio_categorized_blog() {
	$category_count = get_transient( 'clubio_categories' );
	if ( false === $category_count ) {
		$categories = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			'number'     => 2,
		) );
		$category_count = count( $categories );
		set_transient( 'clubio_categories', $category_count );
	}
	if ( is_preview() ) {
		return true;
	}
	return $category_count > 1;
}

function clubio_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	delete_transient( 'clubio_categories' );
}
add_action( 'edit_category', 'clubio_category_transient_flusher' );
add_action( 'save_post',     'clubio_category_transient_flusher' );