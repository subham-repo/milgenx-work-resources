<div class="qodef-e-media">
	<?php switch ( get_post_format() ) {
		case 'gallery':
			boldlab_template_part( 'blog', 'templates/parts/post-format/gallery' );
			break;
		case 'video':
			boldlab_template_part( 'blog', 'templates/parts/post-format/video' );
			break;
		case 'audio':
			boldlab_template_part( 'blog', 'templates/parts/post-format/audio' );
			break;
		default:
			boldlab_template_part( 'blog', 'templates/parts/post-info/image' );
			break;
	} ?>
</div>