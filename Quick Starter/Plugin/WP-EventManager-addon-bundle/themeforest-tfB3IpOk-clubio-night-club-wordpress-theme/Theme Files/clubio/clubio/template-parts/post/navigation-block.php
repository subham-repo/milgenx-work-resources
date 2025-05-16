<?php
/**
 * The template for displaying Post navigation links
 *
 * @package Clubio
 */



$prevPost = get_previous_post();
$prevThumbnail = isset($prevPost->ID) ? get_the_post_thumbnail( $prevPost->ID ) : '';
$prevPostThumbnailState = isset($prevPost->ID) ? esc_attr(get_post_meta($prevPost->ID, 'tt_post_s_fstate', true )) : false;
$prevPostThumbnailState = 'false';


$nextPost = get_next_post();
$nextThumbnail = isset($nextPost->ID) ? get_the_post_thumbnail( $nextPost->ID ) : '';
$nextPostThumbnailState = isset($nextPost->ID) ? esc_attr(get_post_meta($nextPost->ID, 'tt_post_s_fstate', true )) : false;
$nextPostThumbnailState = 'false';

$prev_post_title = (isset($prevPost->ID) && get_the_title($prevPost->ID ) != '' ? get_the_title($prevPost->ID ) : '');
$next_post_title = (isset($nextPost->ID) && get_the_title($nextPost->ID ) != '' ? get_the_title($nextPost->ID ) : '');

the_post_navigation( array(
    'prev_text' =>
    (isset($prevPost->ID) && $prevPostThumbnailState != 'true' ? get_the_post_thumbnail($prevPost->ID,'full', array( 'class' => 'ch_nav_thumb' )) : '') .
    '<span class="ch_nav_descr '.($prevThumbnail ? '' : 'ml-0').'">
    <span class="nav-tip"><svg class="icon icon-right-arrow2" version="1.1" width="32" height="32" viewBox="0 0 32 32"><title>right-arrow2</title><path d="M10.452 5.088c0.436-0.451 1.162-0.451 1.613 0 0.436 0.436 0.436 1.162 0 1.596l-8.177 8.177h26.984c0.629 0.001 1.129 0.501 1.129 1.13s-0.5 1.145-1.129 1.145h-26.984l8.177 8.162c0.436 0.451 0.436 1.178 0 1.613-0.451 0.451-1.178 0.451-1.613 0l-10.113-10.113c-0.451-0.436-0.451-1.162 0-1.596l10.113-10.114z"></path></svg>' . esc_html__( 'Previous Post', 'clubio' ) . '</span>
    <span class="nav-title">'.($prev_post_title != '' ? esc_attr( $prev_post_title ) : '(no title)') .'</span>
    </span>',
    'next_text' =>  (isset($nextPost->ID) && $nextPostThumbnailState != 'true'  ? get_the_post_thumbnail($nextPost->ID, 'full', array( 'class' => 'ch_nav_thumb' )) : '').'
     <span class="ch_nav_descr '.($nextThumbnail ? '' : 'image-none').'">
     <span class="nav-tip">' . esc_html__( 'Next Post', 'clubio' ) . '<svg class="icon icon-right-arrow" version="1.1" width="32" height="32" viewBox="0 0 32 32"><title>right-arrow</title><path d="M21.548 5.088c-0.436-0.451-1.162-0.451-1.613 0-0.436 0.436-0.436 1.162 0 1.596l8.177 8.177h-26.984c-0.629 0.001-1.129 0.501-1.129 1.13s0.5 1.145 1.129 1.145h26.984l-8.177 8.162c-0.436 0.451-0.436 1.178 0 1.613 0.451 0.451 1.178 0.451 1.613 0l10.113-10.113c0.451-0.436 0.451-1.162 0-1.596l-10.113-10.114z"></path></svg></span>
     <span class="nav-title">'.($next_post_title != '' ? esc_attr( $next_post_title ) : '(no title)') .'</span>
     </span>
     ',
) );
