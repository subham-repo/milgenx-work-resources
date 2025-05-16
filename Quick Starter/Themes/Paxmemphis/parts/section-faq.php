<!-- This template contain layout for faq section -->

<section id="faq" class="section-full sec-spacing faq-section">
	<div class="container">
		<?php 
		$frequently_asked_questions = get_field('frequently_asked_questions');
		$frequently_asked_questions_heading = $frequently_asked_questions['heading'];

		?>
		<div class="row heading">
			<div class="col-md-12 col-sm-12 col-12 xol-xs-12 text-center">
				<h2 class="full-width"><?php echo $frequently_asked_questions_heading; ?></h2>
			</div>
		</div>
		<div class="row faq_area">


		<?php 	

				// check if the repeater field has rows of data
		while ( have_rows( 'frequently_asked_questions' ) ) : the_row(); ?>


		<?php if( have_rows('questionsanswer') ):

		 	// loop through the rows of data
		    while ( have_rows('questionsanswer') ) : the_row();

	        $questions 		= get_sub_field( 'question' );
	        $answer 		= get_sub_field( 'answer' );

	       ?>
		       
		    <div class="faq_block hide_answer col-lg-8 col-md-12 col-sm-12 col-12 xol-xs-12">	
	        	<div class="faq_wrapper text-left full-width">
	        		<div class="faq_question full-width">
	        			<h5><strong><?php echo $questions; ?></strong></h5>
	        			<span class="faq_btn faq_closed"></span>
	        		</div>
	        		<div class="faq_answer full-width">
	        			<p><?php echo $answer; ?></p>
					</div>
	        	</div>
	        </div>	  

		   <?php endwhile;

		else :

		    // no rows found

		endif; ?>


		<?php endwhile; ?>
			
		<!-- <?php 
		// $args = array(
  //           'post_type'       => 'faqs',
  //           'posts_per_page'  => -1,
  //           'paged'           => $paged,
  //           'supress_filters' => false,
  //       );

        // Get post type ==> gallery
        // query_posts( $args );
        // Loop through gallery items
       //  while ( have_posts() ) : the_post(); ?>
        
        <div class="faq_block hide_answer col-lg-8 col-md-12 col-sm-12 col-12 xol-xs-12">	
        	<div class="faq_wrapper text-left full-width">
        		<div class="faq_question full-width">
        			<h5><strong><?php // the_title(); ?></strong></h5>
        			<span class="faq_btn faq_closed"></span>
        		</div>
        		<div class="faq_answer full-width">
        			<?php // the_content(); ?>
        		</div>
        	</div>
        </div>	

	    <?php // endwhile; ?> -->

	    <div class="btn-row full-width text-center">

			<?php
			$contact_link 		= of_get_option('contact_link');

			if(!empty($contact_link)){ ?>
				<a class="btn-cta large white" href="<?php echo $contact_link; ?>" >
					Start your recovery today
				</a>
			<?php } ?>
			
		</div> 
		</div>
	</div>
</section>

<script type="text/javascript">
	jQuery('.faq_block').each(function(){

		jQuery(this).children('.faq_wrapper').on('click', function(){
			jQuery(this).children('.faq_question').find('.faq_btn').trigger('click');
		})

	    jQuery(this).children('.faq_wrapper').children('.faq_question').find('.faq_btn').on('click', function(){
	        if(jQuery(this).hasClass('faq_closed')){
	            jQuery(this).addClass('faq_open');
	            jQuery(this).removeClass('faq_closed');

	            jQuery(this).parent('.faq_question').parent('.faq_wrapper').parent('.faq_block').removeClass('hide_answer');

	        }else if(jQuery(this).hasClass('faq_open')){
	            jQuery(this).addClass('faq_closed')
	            jQuery(this).removeClass('faq_open');
	            
	            jQuery(this).parent('.faq_question').parent('.faq_wrapper').parent('.faq_block').addClass('hide_answer');
	            
	        }
	    })
	})
</script>
