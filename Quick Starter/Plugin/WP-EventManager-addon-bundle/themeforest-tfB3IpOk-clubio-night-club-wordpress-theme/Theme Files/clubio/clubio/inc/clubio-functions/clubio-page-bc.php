<?php
/**
 * create Breadcrumbs to additional pages
 *
 * @package Clubio
 */
function clubio_theme_breadcrumbs() {
    $showOnHome = 1;
    $showCurrent = 1;
    $delimiter = '';
    global $post;
    $clubio_link_home = home_url();

    echo '<div class="subtitle__label">';
    if (!is_single() ) :
        if (is_home() || is_single()) :
            if (single_post_title('', false) != '') :
                echo '<a href="'.esc_url($clubio_link_home).'">'.esc_html__('Home', 'clubio').'</a>';
                echo '<span class="bc-current-item item1 single_post_title">'.single_post_title('', false).'</span>';
            endif;
        endif;
    endif;
    if (is_home() || is_front_page()) {
        if (!clubio_plugin_detect('shortcodes')) :
            echo '<a class="tt_home_link_single" href="'.esc_url($clubio_link_home).'">' . esc_html__('Home', 'clubio'). '</a>';
        endif;
    } else {
        echo '<a class="home-link" href="' . esc_url($clubio_link_home) . '">' .esc_html__('Home', 'clubio'). '</a> ';
        if ( is_category() ) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) : echo get_category_parents($thisCat->parent, TRUE, ''); endif;
            echo '<span class="bc-current-item item2">'. single_cat_title('', false) .'</span>';
        } elseif ( is_search() ) {
            echo '<span class="bc-current-item item3">'. esc_html__('Search results for', 'clubio').'&nbsp; "' . get_search_query() . '"' .'</span>';
        } elseif ( is_day() ) {
            echo '<a class="tt-link-day" href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_attr(get_the_time('Y')) . '</a>';
            echo '<a class="tt-link-day" href="' . esc_url(get_month_link(get_the_time('Y'),get_the_time('m'))) . '">' . esc_attr(get_the_time('F')) . '</a>';
            echo '<span class="bc-current-item item4">'. esc_attr(get_the_time('d')) .'</span>';
        } elseif ( is_month() ) {
            echo '<a class="tt-link-month" href="' . esc_url(get_year_link(get_the_time('Y'))). '">' .esc_attr( get_the_time('Y')) . '</a>';
            echo '<span class="bc-current-item item5">'. esc_attr(get_the_time('F')) .'</span>';
        } elseif ( is_year() ) {
            echo '<span class="bc-current-item item6">'. esc_attr(get_the_time('Y')) .'</span>';
        } elseif ( is_single() && !is_attachment() ) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                if (!clubio_plugin_detect('woo')) :
                    echo '<a class="tt-link01" href="' . esc_url($clubio_link_home) . '/' . esc_attr($slug['slug']) . '/">' . $post_type->labels->singular_name . '</a>';
                endif;
                //if ($showCurrent == 1) : echo '<span class="bc-current-item item7">'. get_the_title() .'</span>'; endif;
                if ($showCurrent == 1) : echo '<a href="'.get_permalink( woocommerce_get_page_id( 'shop' ) ).'">'.woocommerce_page_title(false).'</a><span class="bc-current-item item7">'. get_the_title() .'</span>'; endif;
            } else {
                $cat = get_the_category();
                if (isset($cat) && isset($cat[0])) {
                    $cat = $cat[0];
                    $cats = get_category_parents($cat, TRUE, '');
                    if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                    echo '<span class="after-label"></span>'.wp_kses($cats, clubio_tags()).'';
                }
                if ($showCurrent == 1) : echo '<span class="bc-current-item item8">' . get_the_title() .'</span>'; endif;
            }
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            if (isset($post_type) && $post_type->labels->singular_name != '') {
                //echo '<span class="bc-current-item item9">' . $post_type->labels->singular_name .'</span>';
                echo '<span class="bc-current-item item9">' . woocommerce_page_title(false) .'</span>';

            }
        } elseif ( is_attachment() ) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID);
            echo (isset($cat[0]) ? get_category_parents($cat[0], TRUE, '') : '');
            echo '<a class="tt-link02" href="' . esc_url(get_permalink($parent)) . '">' . $parent->post_title . '</a>';
            if ($showCurrent == 1) : echo '<span class="bc-current-item item10">' . get_the_title() .'</span>'; endif;
        } elseif ( is_page() && !$post->post_parent ) {
            if ($showCurrent == 1) : echo '<span class="bc-current-item item11">' . get_the_title() .'</span>'; endif;
        } elseif ( is_page() && $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a class="tt-link03" href="' . esc_url(get_permalink($page->ID)) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo wp_kses($breadcrumbs[$i], clubio_tags());
            }
            if ($showCurrent == 1) : echo '<span class="bc-current-item item12">'. get_the_title() .'</span>'; endif;
        } elseif ( is_tag() ) {
            echo '<span class="bc-current-item item13 bc-title-tag">'.esc_html__('Tag: ', 'clubio'). ' "' . single_tag_title('', false) . '"' .'</span>';
        } elseif ( is_author() ) {
            global $author;
            $userdata = get_userdata($author);
            echo '<span class="bc-current-item item14">'. '' . $userdata->display_name .'</span>';
        } elseif ( is_404() ) {
            echo '<span class="bc-current-item item15">'.esc_html__('Error 404', 'clubio').'</span>';
        }
        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
            echo esc_html__('Page','clubio') . ' ' . get_query_var('paged');
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }

    }
    echo '</div>';
}