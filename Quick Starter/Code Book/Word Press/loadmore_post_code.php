
========================AJAX LOAD MORE CODE STARTS=======================

/*******for template default loop starts**********/

<div class="entry-content">
    <?php 
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => '2',
        'paged' => 1,
    );
    $my_posts = new WP_Query( $args );
    if ( $my_posts->have_posts() ) : 
    ?>
        <div class="my-posts">
            <?php while ( $my_posts->have_posts() ) : $my_posts->the_post(); ?>
                <h2><?php the_title(); ?></h2>
                <?php the_excerpt(); ?>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
    <div class="loadmore">Load More...</div>
</div>

/*******for template default loop ends**********/


/*******template js starts**********/


<script type="text/javascript">
var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
var page = 2;
jQuery(function($) {
    $('body').on('click', '.loadmore', function() {
        var data = {
            'action': 'load_posts_by_ajax',
            'page': page,
            'security': '<?php echo wp_create_nonce("load_more_posts"); ?>'
        };
 
        $.post(ajaxurl, data, function(response) {
            if(response != '') {
                $('.my-posts').append(response);
                page++;
            } else {
                $('.loadmore').hide();
            }
        });
    });
});
</script>

/*******template js ends**********/


/*******loop for ajax function for load more posts starts**********/

add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');


function load_posts_by_ajax_callback() {
    check_ajax_referer('load_more_posts', 'security');
    $paged = $_POST['page'];
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => '2',
        'paged' => $paged,
    );
    $my_posts = new WP_Query( $args );
    if ( $my_posts->have_posts() ) :
        ?>
        <?php while ( $my_posts->have_posts() ) : $my_posts->the_post(); ?>
            <h2><?php the_title(); ?></h2>
            <?php the_excerpt(); ?>
        <?php endwhile; ?>
        <?php
    endif;
 
    wp_die();
}

/*******loop for ajax function for load more posts ends**********/

========================AJAX LOAD MORE CODE ENDS=======================