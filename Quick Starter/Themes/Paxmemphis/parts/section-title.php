<!-- This template part contain title section for this theme -->

<?php
// Featured Image Url
$bg_image 			= get_the_post_thumbnail_url();

// Title Section Contact CTA Button Link and Text

$contact_link 		= of_get_option('contact_link');
$contact_bt_text	= of_get_option('contact_bt_text');

$page_sub_heading	= get_field('page_sub_heading');
?>

<section class="section-full page_title" style="background-image: url(<?php echo $bg_image; ?>);">
	<div class="container">
		<div class="row ">
			<h1 class="full-width text-center"><?php the_title(); ?></h1>

			<?php if(!empty($page_sub_heading)){ ?>
			<p class="subheading text-center full-width"><?php echo $page_sub_heading; ?></p>
			<?php } ?>

			<div class="btn-row full-width text-center">

				<?php if(!empty($contact_link)){ ?>
					<a class="btn-cta large orange" href="<?php echo $contact_link; ?>" >
						<?php echo $contact_bt_text; ?>
					</a>
				<?php } ?>
				
			</div> 	
		</div>
	</div>
</section>