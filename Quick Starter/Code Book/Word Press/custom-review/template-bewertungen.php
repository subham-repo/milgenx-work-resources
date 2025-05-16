<?php 
/*
* Template Name: Elas Bewertungen
*/

get_header();

?>

<?php get_template_part('custom-review/template-parts/review-form'); ?>
<?php get_template_part('custom-review/template-parts/review', 'slider', $args = array('title' => 'no', 'review_link' => 'no', 'background-image' => 'no')); ?>

<?php get_footer(); ?>