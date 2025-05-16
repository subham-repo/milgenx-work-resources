<div id="ajax-posts" class="row">
       <?php
           $ppp = 1;
           $args = array(
                   'post_type' => 'post',
                   'posts_per_page' => $ppp,
                   'cat' => 1
           );

           $loop = new WP_Query($args);
           while ($loop->have_posts()) : $loop->the_post();
       ?>

            <div class="col-12 col-md-4 col-sm-6 col-lg-4 grid-view">
                <div class="border">
                    <img src="<?php echo $feat_image_url; ?>">
                    <h2><?php the_title(); ?> </h2>
                    <p><?php the_content(); ?> </p>
                    <a href="<?php the_permalink() ?>" class="btn btn-info">Read More </a>
                </div>
            </div>

        <?php
               endwhile;
       wp_reset_postdata();
        ?>
   </div>
   <div id="more_posts">Load More</div>



   <script type="text/javascript">
       


var ppp = 1; // Post per page
var cat = 8;
var pageNumber = 1;


function load_posts(){
   pageNumber++;
   var str = '&cat=' + cat + '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&action=more_post_ajax';
   jQuery.ajax({
       type: "POST",
       dataType: "html",
       url: "<?php echo admin_url('admin-ajax.php'); ?>",
       data: str,
       success: function(data){
           var $data = jQuery(data);
           if($data.length){
               jQuery("#ajax-posts").append($data);
               jQuery("#more_posts").attr("disabled",false);
           } else{
               jQuery("#more_posts").attr("disabled",true);
           }
       },
       error : function(jqXHR, textStatus, errorThrown) {
           $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
       }

   });
   return false;
}

jQuery("#more_posts").on("click",function(){ // When btn is pressed.
   jQuery("#more_posts").attr("disabled",true); // Disable the button, temp.
   load_posts();
});

   </script>
  <?php 
wp_localize_script( 'twentyfifteen-script', 'ajax_posts', array(
   'ajaxurl' => admin_url( 'admin-ajax.php' ),
   'noposts' => __('No older posts found', 'twentyfifteen'),
));



function more_post_ajax(){

   $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 2;
   $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;

   header("Content-Type: text/html");

   $args = array(
       'suppress_filters' => true,
       'post_type' => 'post',
       'posts_per_page' => $ppp,
       'cat' => 1,
       'paged'    => $page,
   );

   $loop = new WP_Query($args);

   $out = '';

   if ($loop -> have_posts()) :  while ($loop -> have_posts()) : $loop -> the_post();
       $out .= '<div class="col-12 col-md-4 col-sm-6 col-lg-4 grid-view">
                   <img src="<?php echo $feat_image_url; ?>">
               <h2>'.get_the_title().'</h2>
               <p>'.get_the_content().'</p>
        </div>';

     endwhile;
   endif;
   wp_reset_postdata();
   die($out);
}

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');