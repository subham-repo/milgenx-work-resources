<?php 
	/*
		Template Name: Template Our Team
	*/
	get_header();
?>

<section id="inner_page_body">
	<div class="all_inner_page">
		<?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		<!--Featured Image section goes here-->
		<?php echo do_shortcode('[inner-title]'); ?>
		<!--Featured Image section ends here-->

		<!--inner_page Posts section goes here-->
		<div class="inner_page_inner_sec full-width">
			<div class="container">
				<div class="row">
					<?php
					$query = array(
					    'orderby' => 'menu_order',
					    'order' => 'ASC',
					    'post_status' => 'publish',
						'post_type' => 'team_member',
						'posts_per_page' => 50
					);
					$posts = get_posts( $query );
					if( ! empty( $posts ) ) {
					     echo '<div class="our_staff_wrapper full-width">';
					     foreach( $posts as $post ) { 
					     $our_team_details 				   = get_field('our_team_details');
					     $position		   				   = $our_team_details['position'];
					     $email		   					   = $our_team_details['email'];
					     $phone		   					   = $our_team_details['phone'];
					     $appointment_button_text		   = $our_team_details['appointment_button_text'];
					     $appointment_button_link		   = $our_team_details['appointment_button_link'];

					     $our_team_social_links = get_field('our_team_social_links');
					     $facebook_link 		= $our_team_social_links['facebook_link'];
					     $twitter_link 			= $our_team_social_links['twitter_link'];
					     $linkedin_link 		= $our_team_social_links['linkedin_link'];
					     $google_link 			= $our_team_social_links['google+_link'];
					     $instagram_link 		= $our_team_social_links['instagram_link'];

					     ?>
					      <div class="our_staff col-md-3 col-sm-6 col-xs-12">
					      	<div class="our_staff_inner">
					      		<div class="our_staff-thumbs">
					      			<a class="staff_thumb" href="<?php the_permalink(); ?>" >
					      				<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?> /">
					      				<span class="view_more">
					      					<i class="fa fa-plus-circle"></i>
					      				</span>
					      			</a>
					      			<div class="thememount-team-social-links">
					      			<?php if(!empty($our_team_social_links)){ ?>
									<ul>
								    	<?php if(!empty($facebook_link)){ ?>
										<li class="thememount-social-facebook">
								        	<a href="<?php echo $facebook_link ?>" class="hint--top" data-hint="Facebook" target="_blank">
								        		<i class="fa fa-facebook"></i>
								        	</a>
								        </li>
										<?php } ?>
										<?php if(!empty($twitter_link)){ ?>
										<li class="thememount-social-twitter">
								        	<a href="<?php echo $twitter_link ?>" class="hint--top" data-hint="Twitter" target="_blank">
								        		<i class="fa fa-twitter"></i>
								        	</a>
								        </li>
										<?php } ?>
								        <?php if(!empty($linkedin_link)){ ?>
										<li class="thememount-social-linkedin">
								        	<a href="<?php echo $linkedin_link ?>" class="hint--top" data-hint="LinkedIn" target="_blank">
									        	<i class="fa fa-linkedin"></i>
									        </a>
								        </li>
										<?php } ?>
										<?php if(!empty($google_link)){ ?>
										<li class="thememount-social-gplus">
								        	<a href="<?php echo $google_link ?>" class="hint--top" data-hint="Google+" target="_blank">
								        		<i class="fa fa-google-plus"></i>
								        	</a>
								        </li>
										<?php } ?>
								        <?php if(!empty($instagram_link)){ ?>
										<li class="thememount-social-instagram">
								        	<a href="<?php echo $instagram_link ?>" class="hint--top" data-hint="Instagram" target="_blank">
								        		<i class="fa fa-instagram"></i>
								        	</a>
								        </li>
										<?php } ?>
								    </ul>
									<?php } ?>	
								    
								</div>
					      		</div>
					      		<div class="our_staff_info text-center">
					      			<h2>
					      				<a class="staff_name" href="<?php the_permalink(); ?>">
					      					<?php the_title(); ?>
					      				</a>
									</h2>
									<?php if(!empty($position)){ ?>
									<span class="position"><?php echo $position; ?></span>
									<?php } ?>
									<?php if(!empty($email)){ ?>
									<span class="mail_link">
										<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
									</span>
									<?php } ?>	
									<?php if(!empty($phone)){ ?>
									<span class="phone"><a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></span>
									<?php } ?>	
									<?php if(!empty($appointment_button_link)){ ?>
									<div style="padding-top: 5px" class="btn-row text-center">
										<a class="btn-theme" href="<?php echo $appointment_button_link; ?>">
											<span><?php echo $appointment_button_text; ?></span>
										</a>
									</div>
									<?php } ?>	
									


					      		</div>
					      	</div>
					      </div>    
					    <?php }
					    echo '</div>';
					} ?>
				</div>		
			</div>
		</div>
		
		<!--inner_page Posts section ends here-->
	</div>
</section>

<?php 
	get_footer();
?>