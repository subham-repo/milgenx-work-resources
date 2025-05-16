<?php
/*
* Template Name: Template Inner Page
*/
get_header();

$feat_url = get_the_post_thumbnail_url();

?>
<?php // get_template_part( 'parts/section', 'title'  ); ?>

<section class="inner_page-section section-full sec-spacing">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-12 col-lg-6 col-sm-12 content_part">
				<?php the_content(); ?>
			</div>
			<div class="col-12 col-md-12 col-lg-6 col-sm-12 sidebar_part">
				<div class="sidebar_inner full-width">
					<?php if(!empty($feat_url)){ ?>
					<div class="sidebar_featured full-width">
						<img src="<?php echo $feat_url; ?>" alt="<?php the_title(); ?>" />
					</div>
					<?php }?>

					<div class="contact_form full-width">
						<?php
						$contact_form = get_field('contact_form');
						$contact_form_heading = $contact_form['heading'];
						$contact_forms = $contact_form['contact_form'];
						$contact_form_infographic = $contact_form['infographic'];

						?>

						<?php if(!empty($contact_form_heading)){ ?>
						<div class="sidebar-heading">
							<h2><?php echo $contact_form_heading; ?></h2>
						</div>	
						<?php }?>

						<?php echo $contact_forms; ?>
					</div>

					<?php if(!empty($contact_form_infographic)){ ?>
					<div class="infographic full-width">
						<img src="<?php echo $contact_form_infographic; ?>">
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_template_part( 'parts/section', 'get-help'  ); ?>
<?php // get_template_part( 'parts/section', 'faq'  ); ?>
<?php // get_template_part( 'parts/section', 'contact'  ); ?>

<?php get_footer(); ?>