

<section class="section-full sec-spacing get-help">
	<div class="container">
		<div class="row heading text-center">
			<div class="col-12">
				<h2>Getting Help is Easy</h2>
			</div>
		</div>
		<div class="row get-help-wrapper">
			
			<?php
			$contact_link 		= of_get_option('contact_link');
			if(!empty($contact_link)){ ?>
			<div class="get-help-block col-12 col-sm-4 col-md-4 col-lg-4">

				<div class="get-help-inner full-width">
					<div class="get-help-icon">
						<i class="fa fa-comments-o"></i>
					</div>
					<div class="get-help-heading">
						<h5><a href="<?php echo $contact_link ; ?>">Send Us a Message</a></h5>
					</div>
				</div>

			</div>	
			<?php } ?>

			<?php
			$contact_num_op 		= of_get_option('contact_num_op');
			if(!empty($contact_link)){ ?>
			<div class="get-help-block col-12 col-sm-4 col-md-4 col-lg-4">

				<div class="get-help-inner full-width">
					<div class="get-help-icon">
						<i class="fa fa-phone"></i>
					</div>
					<div class="get-help-heading">
						<h5><a href="tel:<?php echo $contact_num_op; ?>">Call us</a></h5>
					</div>
				</div>

			</div>	
			<?php } ?>

			<?php
			$email_id 		= of_get_option('email_id');
			if(!empty($email_id)){ ?>
			<div class="get-help-block col-12 col-sm-4 col-md-4 col-lg-4">

				<div class="get-help-inner full-width">
					<div class="get-help-icon">
						<i class="fa fa-envelope-o"></i>
					</div>
					<div class="get-help-heading">
						<h5><a href="mailto:<?php echo $email_id; ?>">Email us</a></h5>
					</div>
				</div>

			</div>	
			<?php } ?>


		</div>
	</div>
	
</section>