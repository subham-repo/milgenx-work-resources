<?php
/*
* Template Name: Template Contents Rows
*/
get_header();

?>
<?php get_template_part( 'parts/section', 'title'  ); ?>

<section class="section-full content-rows-parent">
	
	<?php 	

				// check if the repeater field has rows of data
		while ( have_rows( 'content_rows' ) ) : the_row(); ?>


		<?php if( have_rows('content_row') ):

		 	// loop through the rows of data
		    while ( have_rows('content_row') ) : the_row();

	        $title_heading 		= get_sub_field( 'title_heading' );
	        $sub_heading 		= get_sub_field( 'sub_heading' );
	        $exerpt 			= get_sub_field( 'exerpt' );
	        $image 				= get_sub_field( 'image' );

	       ?>
		       
		    <div class="section-full sec-spacing content-rows-child">
				<div class="container">
					<?php if(!empty($title_heading)){?>
					<div class="row text-center heading">
						<div class="col-12">
							<h2><?php echo $title_heading; ?></h2>
						</div>
					</div>
					<?php } ?>

					<?php if(!empty($image)){?>
					<div class="row contents_in with_image">
						<div class="col-md-12 col-lg-6 col-sm-12 col-12 image_in">
							<img src="<?php echo $image; ?>" alt="contne_img" />
						</div>
						<div class="col-md-12 col-lg-6 col-sm-12 col-12 content_in">
							<?php if(!empty($sub_heading)){?>
							<div class="row_heading full-width">
								<h3><?php echo $sub_heading; ?></h3>
							</div>
							<?php } ?>
							<?php if(!empty($exerpt)){?>
							<div class="full-width contents_exerpt">
								<?php echo $exerpt; ?>
							</div>
							<?php } ?>
						</div>
					</div>
					<?php } else{ ?>
					<div class="row contents_in with_image">
						<div class="col-md-12 col-lg-12 col-sm-12 col-12 content_in">
							<?php if(!empty($sub_heading)){?>
							<div class="row_heading full-width">
								<h3><?php echo $sub_heading; ?></h3>
							</div>
							<?php } ?>
							<?php if(!empty($exerpt)){?>
							<div class="full-width contents_exerpt">
								<?php echo $exerpt; ?>
							</div>
							<?php } ?>
						</div>
					</div>
					<?php } ?>

				</div>
			</div>  

		   <?php endwhile;

		else :

		    // no rows found

		endif; ?>

		</div>

		<?php endwhile; ?>
</section>

<section class="section-full sec-spacing team_member" style="display: none;">
	<div class="container">
		<?php 	

				// check if the repeater field has rows of data
		while ( have_rows( 'our_team_members' ) ) : the_row(); ?>

		<div class="row team_member_wrapper">

		<?php if( have_rows('team_member') ):

		 	// loop through the rows of data
		    while ( have_rows('team_member') ) : the_row();

	        $team_member_avtar 		= get_sub_field( 'team_member_avtar' );
	        $team_member_name 		= get_sub_field( 'team_member_name' );
	        $team_member_role 		= get_sub_field( 'team_member_role' );
	        $team_member_intro 		= get_sub_field( 'team_member_intro' );

	       ?>
		       
		    <div class="scene scene--card team_member_blocks col-12 col-lg-4 col-md-6 col-sm-12 ">
		    	<div class="card-box team_member_inner full-width" title="<?php echo $team_member_name.' - '.$team_member_role;   ?>">
		    		<div class="card_face card__face--front">
		    			<img src="<?php echo $team_member_avtar; ?>" alt="<?php echo $team_member_name; ?>" />
			    		<div class="member_intro full-width text-center">
			    			<h5><?php echo $team_member_name; ?></h5>
			    			<span><?php echo ' - '.$team_member_role; ?></span>
			    		</div>
		    		</div>
		    		<div class="card_face card__face--back">
		    			<?php echo $team_member_intro; ?>
		    		</div>
		    	</div>
		    </div>    

		   <?php endwhile;

		else :

		    // no rows found

		endif; ?>

		</div>

		<?php endwhile; ?>

	</div>
</section>
<script type="text/javascript">
	var card = document.querySelector('.card-box');
	jQuery('.card-box').each(function(){
		jQuery(this).on( 'click', function() {
		  jQuery(this).toggleClass('is-flipped');
		});
	})
	
</script>
<?php get_template_part( 'parts/section', 'get-help'  ); ?>
<?php // get_template_part( 'parts/section', 'faq'  ); ?>
<?php // get_template_part( 'parts/section', 'contact'  ); ?>

<?php get_footer(); ?>