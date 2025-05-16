<?php
/**
 * Template Name: Visual Composer Template
 *
 *
 */
get_header();

?>

<section class="page-content">
	
<?php
       // Start the loop.
       while ( have_posts() ) : the_post();
       the_content();


       // End the loop.
       endwhile;
    ?>    
   
</section>


<?php 
get_footer(); include('New-footer.php');
?>
