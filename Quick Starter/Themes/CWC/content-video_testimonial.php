<div class="col-md-6 col-sm-6 col-xs-12">
	<div class="blog-box view-row">
		<?php 
		$video_featured_thumb = get_field('video_featured_thumb');
		if(!empty($video_featured_thumb)){ ?>
		<div class="blog-box_thumb">
			<a href="<?php the_permalink(); ?>">
				<img src="<?php echo $video_featured_thumb; ?>" alt="<?php echo the_title(); ?>" />
			</a>
		</div>
		<?php }?>
		<div class="blog-box_cont">
			<div class="vid_title title-meta text-center">
				<h3 class="entry-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
			</div>	

		

			<?php if(has_category()){?>
				<div class="post_cats">
					<?php $terms = get_the_category();
					// echo "<pre>";
					// print_r($terms);
					// echo "</pre>"; 
						foreach ($terms as $terms) {
							$term_name = $terms->name;
							$term_link = get_category_link($terms->term_id);
						?>
							<a href="<?php echo $term_link; ?>">
								<?php echo $term_name; ?>
							</a>
						<?php
						}
					?>
				</div>
			<?php } ?>	
		</div>
	</div>
</div>