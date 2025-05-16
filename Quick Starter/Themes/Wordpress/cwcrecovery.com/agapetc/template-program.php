<?php 
	/*
		Template Name: Program
	*/
	get_header();
?>

<section id="about_body">
	<div class="all_about">
		<?php $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		<!--Featured Image section goes here-->
		<div class="uk-grid-collapse uk-grid">
			<div class="uk-width-1-1">
				<div class="blog_featured" style="background-image: url('<?php echo $feat_image ; ?>');">
					<h1><?php the_title(); ?></h1>
				</div>		
			</div>
		</div>
		<!--Featured Image section ends here-->

		<!--About Posts section goes here-->
		<div class="about_inner_sec">
			<div class="container">
				<div class="uk-grid-collapse uk-grid">
					<!--Programs Link section goes here-->
						<div class="progr_sec">
								<h1><?php the_title(); ?></h1>
							<div class="uk-grid uk-grid-collapse">
									<?php 
										$rows = get_field('pages_links');
										if($rows)
										{
											foreach($rows as $row)
											{
									?>
									<div class="uk-width-1-5@l  uk-width-1-4@m uk-width-1-3@s prog_inner">
										<a href="<?php echo $row['links_page']?>">
											<div class="prog_links" style="background-image: linear-gradient(0deg,rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('<?php echo $row['page_image_prog']?>');">
												<span><?php echo $row['page_title_prog']?></span>
											</div></a>
									</div>
									<?php 
										}
									}
									?>
									<!-- <div class="uk-width-1-5@l  uk-width-1-4@m uk-width-1-3@s prog_inner">
										<a href="#"><div class="prog_links" style="background-image: linear-gradient(0deg,rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('https://wordpress-82723-909910.cloudwaysapps.com/wp-content/uploads/2019/07/meditation_1.jpg');"><span>Mental Health</span></div></a>
									</div>
									<div class="uk-width-1-5@l  uk-width-1-4@m uk-width-1-3@s prog_inner">
										<a href="#"><div class="prog_links" style="background-image: linear-gradient(0deg,rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('https://wordpress-82723-909910.cloudwaysapps.com/wp-content/uploads/2019/07/generic-white-tablets.jpg');"><span>Dual Diagnosis</span></div></a>
									</div>
									<div class="uk-width-1-5@l  uk-width-1-4@m uk-width-1-3@s prog_inner">
										<a href="#"><div class="prog_links" style="background-image: linear-gradient(0deg,rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('https://wordpress-82723-909910.cloudwaysapps.com/wp-content/uploads/2019/07/calm-faith.jpg');"><span>Faith Based</span></div></a>
									</div>
									<div class="uk-width-1-5@l  uk-width-1-4@m uk-width-1-3@s prog_inner">
										<a href="#"><div class="prog_links" style="background-image: linear-gradient(0deg,rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('https://wordpress-82723-909910.cloudwaysapps.com/wp-content/uploads/2019/07/benefits-yoga-fb.jpg');"><span>Rapid Resolution</span></div></a>
									</div>
									<div class="uk-width-1-5@l  uk-width-1-4@m uk-width-1-3@s prog_inner">
										<a href="#"><div class="prog_links" style="background-image: linear-gradient(0deg,rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('https://wordpress-82723-909910.cloudwaysapps.com/wp-content/uploads/2019/07/massage.jpg');"><span>12-Step Addiction</span></div></a>
									</div>
									<div class="uk-width-1-5@l  uk-width-1-4@m uk-width-1-3@s prog_inner">
										<a href="#"><div class="prog_links" style="background-image: linear-gradient(0deg,rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('https://wordpress-82723-909910.cloudwaysapps.com/wp-content/uploads/2019/07/Substance_abuse.jpg');"><span>Family Program</span></div></a>
									</div>
									<div class="uk-width-1-5@l  uk-width-1-4@m uk-width-1-3@s prog_inner">
										<a href="#"><div class="prog_links" style="background-image: linear-gradient(0deg,rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url('https://wordpress-82723-909910.cloudwaysapps.com/wp-content/uploads/2019/07/yoga-can.jpg');"><span>Relapse Prevention</span></div></a>
									</div> -->
								
							</div>
						</div>
					<!--Programs Link section ends here-->

				</div>
			</div>
			<!--CALL TO ACTION BUTTON GOES HERE-->
			<div class="uk-grid-collapse uk-grid cta_section">
				<div class="container">
					<div class="uk-width-1-1 cta_inner_sec">
						<div class="uk-grid-collapse uk-grid">
							<div class="uk-width-2-3@l uk-width-1-1@s">
								<h2>Learn More About Agape Treatment Center</h2>
							</div>
							<div class="uk-width-1-3@l uk-width-1-1@s">
								<div class="cta_btn">
									<a href="<?php echo site_url();?>/contact-us">CONTACT US</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--CALL TO ACTION BUTTON ENDS HERE-->
		</div>
		
		<!--About Posts section ends here-->
	</div>
</section>

<?php 
	get_footer();
?>
