<div class="col-md-6 col-sm-6 col-xs-12">
	<div class="blog-box view-row">
		<?php if(has_post_thumbnail()){?>
		<div class="blog-box_thumb">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('', array('title' => "$getTheTitle",'alt' => "$getTheTitle")); ?>
			</a>
		</div>
		<?php }?>
		<div class="blog-box_cont">
			<div class="title-meta">
				<h3 class="entry-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h3>
				<div class="author">
					<?php 
						$auth_name = get_the_author(); 
						echo "Written By ".ucwords($auth_name); ?> - 
						<?php $pdate = $post->post_date; 
						echo date("F jS, Y",strtotime($pdate));
					?>
				</div>		
			</div>	
			<div class="post_content">
				<p>
					<?php $cont = get_the_excerpt(); 
						echo wp_trim_words($cont, '15');
					?>
				</p>
				<div class="blg_read_more">
					<a class="btn-theme" href="<?php the_permalink(); ?>"><span>Read More</span></a>
				</div>
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