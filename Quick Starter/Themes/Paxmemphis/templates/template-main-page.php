<?php
/*
* Template Name: Template Main Page
*/
get_header();

?>
<?php get_template_part( 'parts/section', 'title'  ); ?>

<?php 

$three_column_links 		= get_field('three_column_links');
$three_column_links_heading = $three_column_links['heading'];

if(!empty($three_column_links_heading)){ ?>

<section class="section-full sec-spacing three_columns">
	<?php 
	$three_column_links 		= get_field('three_column_links');
	$three_column_links_heading = $three_column_links['heading'];
	?>
	<div class="container">
		<div class="row heading">
			<div class="col-12 text-center">
				<h2><?php echo $three_column_links_heading; ?></h2>
			</div>
		</div>
		
		<?php 	

				// check if the repeater field has rows of data
		while ( have_rows( 'three_column_links' ) ) : the_row(); ?>

		<div class="row three_column_catalogue ">	

		<?php if( have_rows('catalog_blocks') ):

		 	// loop through the rows of data
		    while ( have_rows('catalog_blocks') ) : the_row();

		    $image 		= get_sub_field( 'image' );
	        $title 		= get_sub_field( 'heading' );
	        $content 	= get_sub_field( 'exerpt' );
	        $button_text = get_sub_field('button_text');
	        $button_link = get_sub_field('button_link'); ?>
		       
		    <div class="three_catalog_blocks col-12 col-lg-4 col-md-4 col-sm-12 ">
		    	<div class="three_catalog_blocks_inner text-center full-width">
		    		<img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" />
		    		<h4><?php echo $title; ?></h4>
		    		<p><?php echo $content; ?></p>
		    		<div class="btn-row text-center full-width">
		    			<a href="<?php echo $button_link; ?>" class="btn-cta orange small">
		    				<?php echo $button_text; ?>
		    			</a>
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
<?php } ?>


<?php 
	$we_treat 			  = get_field('we_treat');
	$we_treat_heading 	  = $we_treat['heading'];
	$we_treat_sub_heading = $we_treat['sub_heading'];
if(!empty($we_treat_heading )){
?>
<section class="section-full sec-spacing we_treat">
	
	<div class="container">
		<div class="row text-center heading">
			<div class="col-12">
				<h2><?php echo $we_treat_heading; ?></h2>
				<?php if(!empty($we_treat_sub_heading)){ ?>
					<p class="sub_heading"><?php echo $we_treat_sub_heading; ?></p>
				<?php } ?>
			</div>
		</div>

		
		<?php 	

				// check if the repeater field has rows of data
		while ( have_rows( 'we_treat' ) ) : the_row(); ?>

		<div class="row addiction_issues_treat">

		<?php if( have_rows('we_treat_issues') ):

		 	// loop through the rows of data
		    while ( have_rows('we_treat_issues') ) : the_row();

	        $issues_names 		= get_sub_field( 'issues_names' );
	       ?>
		       
		    <div class="issues_names_wrapper col-12 col-lg-4 col-md-4 col-sm-6 ">
		    	<h6 class="issues_names"><?php echo $issues_names; ?></h6>
		    </div>    

		   <?php endwhile;

		else :

		    // no rows found

		endif; ?>

		</div>

		<?php endwhile; ?>

		<div class="btn-row full-width text-center">

			<?php
			$contact_link 		= of_get_option('contact_link');

			if(!empty($contact_link)){ ?>
				<a class="btn-cta large orange" href="<?php echo $contact_link; ?>" >
					Get Help Now
				</a>
			<?php } ?>
			
		</div> 
	</div>
</section>
<?php } ?>

<section class="section-full content_rows sec-spacing">
	<div class="container">
		<div class="row type_texts">
			<?php 
			$page_intro_row 				= get_field('page_intro_row');
			$page_intro_heading 			= $page_intro_row['heading'];
			$page_intro_description 		= $page_intro_row['content_right'];
			$page_intro_image_under_heading  = $page_intro_row['image_under_heading'];

			?>
			<div class="col-12 col-sm-12 col-md-4 col-lg-4">
				<h4 class="row_heading"><?php echo $page_intro_heading ; ?></h4>

				<?php if(!empty($page_intro_image_under_heading )){?>
					<img src="<?php echo $page_intro_image_under_heading; ?>">
				<?php } ?>
			</div>
			<div class="col-12 col-sm-12 col-md-8 col-lg-8">
				<?php echo $page_intro_description; ?>
			</div>
		</div>

		<div class="row type_texts__images">
			<?php 
			$page_get_help_row 				= get_field('page_get_help_row');
			$page_get_help_row_heading 		= $page_get_help_row['heading'];
			$page_get_help_row_sub_heading  = $page_get_help_row['sub_heading'];
			$page_get_help_row_description  = $page_get_help_row['description'];
			$page_get_help_row_image 		= $page_get_help_row['image'];
			$page_get_help_row_button_text  = $page_get_help_row['button_text'];
			$page_get_help_row_button_link  = $page_get_help_row['button_link'];

			?>
			<div class="col-12 col-sm-12 col-md-6 col-lg-6">
				<div class="row_heading full-width">
					<h4><?php echo $page_get_help_row_heading; ?></h4>
					<h5><?php echo $page_get_help_row_sub_heading; ?></h5>
				</div>
				<div class="exerpt full-width">
					<?php echo $page_get_help_row_description; ?>
				</div>
				<div class="btn-row">
					<a href="<?php echo $page_get_help_row_button_link; ?>" class="btn-cta small orange">
						<?php echo $page_get_help_row_button_text; ?>
					</a>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-6 col-lg-6">
				<img src="<?php echo $page_get_help_row_image; ?>" alt="<?php echo $page_get_help_row_heading; ?>">
			</div>
		</div>
	</div>
</section>

<?php get_template_part( 'parts/section', 'get-help'  ); ?>
<?php get_template_part( 'parts/section', 'faq'  ); ?>
<?php get_template_part( 'parts/section', 'contact'  ); ?>

<?php get_footer(); ?>