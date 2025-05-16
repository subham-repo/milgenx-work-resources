<!-- This template contain layout for Inner page contact section -->
<?php 
$contact_section_field = get_field('contact_section_field');
$contact_section_field_heading = $contact_section_field['heading'];
$contact_section_field_sub_heading = $contact_section_field['sub_heading'];


?>
<section class="section-full sec-spacing contact_section">	
	<div class="container">
		<div class="row heading text-center">
			<div class="col-12 col-sm-12 col-lg-12 col-md-12">
				<h2><?php echo $contact_section_field_heading; ?></h2>
				<div class="subheading"><?php echo $contact_section_field_sub_heading; ?></div>
			</div>
		</div>
		<div class="row contact_form">
			<div class="col-md-7 col-sm-12 col-12 col-lg-8 contact_form_wrapper">
				<?php echo do_shortcode('[contact-form-7 id="4970" title="Contact form 1"]'); ?>
			</div>
			<div class="col-md-5 col-sm-12 col-12 col-lg-4 contact_form_detail">
				<?php
				$contact_num_op  = of_get_option('contact_num_op');
				$contact_address = of_get_option('contact_address');
				$email_id		 = of_get_option('email_id'); 
				$map_address     = of_get_option('map_address');
				?>

				<?php if(!empty($contact_num_op)){ ?>

					<div class="contact_info">
						<i class="fa fa-phone"></i>
						<a href="tel:<?php echo $contact_num_op; ?>"><?php echo $contact_num_op; ?></a>
					</div>

				<?php } ?>

				<?php if(!empty($contact_address)){ ?>

					<div class="contact_info">
						<i class="fa fa-map-marker"></i>
						<a class="address" target="_blank" href="<?php echo $map_address; ?>"><?php echo $contact_address; ?></a>
					</div>

				<?php } ?>

				<?php if(!empty($email_id)){ ?>

					<div class="contact_info">
						<i class="fa fa-envelope"></i>
						<a href="mailto:<?php echo $email_id; ?>"><?php echo $email_id; ?></a>
					</div>

				<?php } ?>

				
			</div>
		</div>
	</div>
</section>