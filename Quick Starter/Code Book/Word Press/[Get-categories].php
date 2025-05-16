add_shortcode('get-categories', 'get_product_category');
function get_product_category(){
	
	// product page category navigation
	
	  $taxonomy     = 'product_cat';
	  $orderby      = 'name';  
	  $show_count   = 0;      // 1 for yes, 0 for no
	  $pad_counts   = 0;      // 1 for yes, 0 for no
	  $hierarchical = 1;      // 1 for yes, 0 for no  
	  $title        = '';  
	  $empty        = 0;
			
	  $arg1 = array ('exclude'=>1,'fields'=>'ids');   
	  $exclude_uncategorized = get_terms('category',$arg1);
			
			
	  $args = array(
			 'taxonomy'     => $taxonomy,
			 'orderby'      => $orderby,
			 'show_count'   => $show_count,
			 'pad_counts'   => $pad_counts,
			 'hierarchical' => $hierarchical,
			 'title_li'     => $title,
			 'hide_empty'   => $empty,
			 'category__in' => $exclude_uncategorized,
	  );
	 $all_categories = get_categories( $args );
	 
	 echo '<div class="cat_nav width-100">';
	 foreach ($all_categories as $cat) {
		if($cat->category_parent == 0) {
			$category_id = $cat->term_id;       
			echo '<a id="'. $cat->name .'" class="cat-btn" href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a>';
			
			$args2 = array(
					'taxonomy'     => $taxonomy,
					'child_of'     => 0,
					'parent'       => $category_id,
					'orderby'      => $orderby,
					'show_count'   => $show_count,
					'pad_counts'   => $pad_counts,
					'hierarchical' => $hierarchical,
					'title_li'     => $title,
					'hide_empty'   => $empty,
					'category__in' => $exclude_uncategorized,
			);
			$sub_cats = get_categories( $args2 );
			
			if($sub_cats) {
				foreach($sub_cats as $sub_category) {
					echo  '<a id="'. $cat->name .'" class="cat-btn" href="'. get_term_link($sub_category->slug, 'product_cat') .'">'. $sub_category->name .'</a>';
				}   
			}
		}       
	}
	echo '</div>';
	wp_reset_query();
}

<style>
.cat_nav {
    float: left;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin: 15px 0;
}
.cat_nav a.cat-btn {
    text-decoration: none;
    background-color: #e6e6e6;
    color: #222;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 0 10px 0 rgba(0,0,0,.1);
    padding: 0 25px;
    margin: 5px 5px;
    border-radius: 4px;
    transition: .2s all ease-in-out;
    font-weight: 500;
    letter-spacing: .5px;
}
.cat_nav  a.cat-btn:hover , .cat_nav  a.cat-btn:focus {
    background-color: #e07135;
    color: #fff;
}
.cat_nav a#Uncategorized {
    display: none;
}
@media(max-width:768px){
	.cat_nav a.cat-btn {
		height: 38px;
		padding: 0 12px;
		margin: 5px 3px;
		font-size: 13px;
	}
}
</style>