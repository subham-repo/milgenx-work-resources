<?php
/*
* Template Name: Template Contact Page
*/
get_header();

?>
<?php get_template_part( 'parts/section', 'title'  ); ?>

<?php get_template_part( 'parts/section', 'contact'  ); ?>

<section class="section-full contact-map" style="margin-bottom: -20px;">
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3263.6217399428633!2d-89.90029248521714!3d35.11615508032986!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x887f84701c0ec537%3A0x33cb226c40f4dae4!2zNDkxOCBXaWxsaWFtIEFybm9sZCBSZCwgTWVtcGhpcywgVE4gMzgxMTcsIOCouOCpsOCor-CpgeColeCopCDgqLDgqL7gqJw!5e0!3m2!1spa!2sin!4v1590556647887!5m2!1spa!2sin" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</section>

<?php get_footer(); ?>