<?php
// Refference: https://petragregorova.com/articles/social-share-buttons-with-custom-icons/

$post_id = get_the_ID();
$post_title = get_the_title($post_id);
$post_link = get_the_permalink($post_id);
$post_media = get_the_post_thumbnail_url($post_id);
$post_host = $_SERVER['HTTP_HOST'];

?>
<div class="cs_social_block">
	<h2 class="cs_social_heading widgettitle">Share Post</h2>
	<div class="cs_social">
		<a target="_blank" href="http://twitter.com/intent/tweet?text=<?php echo $post_title; ?>&url=<?php echo $post_link; ?>" class="cs_social_item twitter">
			<i class="fa fa-twitter"></i>
		</a>
		<a target="_blank" href="http://pinterest.com/pin/create/bookmarklet/?media=<?php echo $post_media; ?>&url=<?php echo $post_link; ?>&is_video=false&description=<?php echo $post_title; ?>" class="cs_social_item pinterest">
			<i class="fa fa-pinterest"></i>
		</a>
		<a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo $post_link; ?>&title=<?php echo $post_title; ?>" class="cs_social_item facebook">
			<i class="fa fa-facebook"></i>
		</a>
	<!-- 	<a target="_blank" href="https://plus.google.com/share?url=<?php // echo $post_link; ?>" class="cs_social_item google+">
			<i class="fa fa-google-plus"></i>
		</a> -->
		<a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $post_link; ?>&title=<?php echo $post_title; ?>&source=<?php echo $post_host; ?>" class="cs_social_item linkedin">
			<i class="fa fa-linkedin"></i>
		</a>
		<a target="_blank" href="mailto:?subject=<?php echo $post_title; ?>&body=Check out this site I came across <?php echo $post_link; ?>" class="cs_social_item facebook">
			<i class="fa fa-envelope"></i>
		</a>
	</div>
</div>
<style type="text/css">
	.blog_bottom_link_bar {
	    padding-top: 0 !important;
	    padding-bottom: 0 !important;
	    display: flex !important;
	    align-items: center;
	    justify-content: flex-end;
	}
	.cs_social a.cs_social_item {
	    display: inline-flex;
	    padding: 5px;
	    border: 1px solid transparent;
	    color: #fff;
	    background-color: #000;
	    transition: .2s all ease-in-out;
	    text-decoration: none;
		width: 48px;
		height: 48px;
		display: inline-flex;
		align-items: center;
		justify-content: center;
	}
	@media(min-width: 768px){
		.cs_social a.cs_social_item {
		    font-size: 24px;
		}
	}
	@media(max-width: 767px){
		.cs_social a.cs_social_item {
		    font-size: 18px;
		}
	}
	.cs_social a.cs_social_item:hover, .cs_social a.cs_social_item:focus {
	    color: #fff;
	    background-color: #000;
	}
	.cs_social {
	    display: flex;
	    justify-content: flex-start;
	    flex-wrap: wrap;
	}
	.blog_page_main .blog_img_social_link .blog_bottom_link_bar .blog_social_link {
	    padding: 0 !important;
	}
	.fa-twitter{
		/*color: #000;*/
	}
	.cs_social_block {
	    padding-left: 15px;
	    margin-top: 20px;
	}
	a.cs_social_item.twitter {
	    background-color: #3ba9e0;
	}
	a.cs_social_item.pinterest {
	    background-color: #d73532;
	}
	a.cs_social_item.facebook {
	    background-color: #4a6ea9;
	}
	a.cs_social_item.linkedin {
	    background-color: #0097bd;
	}
	@media(max-width: 991px){
		.cs_social {
		    position: fixed;
		    bottom: 0;
		    width: 100%;
			left: 0;
			z-index: 9999999;
		}
		.cs_social a.cs_social_item {
		    height: 60px;
		    flex: 1;
		}
		.cs_social_block h2.cs_social_heading.widgettitle {
		    display: none;
		}
	}


</style>