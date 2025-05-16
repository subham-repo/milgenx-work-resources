<?php
/*
* Template Name: Template Our Team
*/
get_header();

?>
<?php get_template_part( 'parts/section', 'title'  ); ?>

<section class="section-full sec-spacing team_member">
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
			    		<div class="member_intro text-center">
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