<style type="text/css">
	.wp-block-image.pinit_enabled figure, .pinit_enabled figure{
	    position: relative;
	}
	.wp-block-image.pinit_enabled .pinIt_button, .pinit_enabled .pinIt_button {
	    display: inline-flex;
	    position: absolute;
	    right: 0;
	    top: 0;
	    width: 44px;
	    height: 44px;
	    background-color: rgba(0,0,0,.6);
	    justify-content: center;
	    align-items: center;
	    border: none;
	    text-decoration: none;
	    box-shadow: unset;
	    z-index: 1;
	}
	.wp-block-image.pinit_enabled .pinIt_button svg, .pinit_enabled .pinIt_button svg {
	    width: 44px;
	    height: 44px;
	    cursor: pointer;
	}
</style>
<script>
	function pinIt_story(target){
		let pinIt_Icon = '<svg width="32" height="32" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><g fill="none" fill-rule="evenodd"><path d="M32 16c0 8.837-7.163 16-16 16S0 24.837 0 16 7.163 0 16 0s16 7.163 16 16" fill="rgba(0,0,0,0)"></path><path d="M15.164 18.532c-.011.039-.022.072-.03.106-.503 1.97-.56 2.408-1.076 3.322-.246.436-.524.847-.832 1.242-.034.044-.067.102-.136.088-.076-.016-.082-.084-.09-.145-.083-.599-.128-1.2-.108-1.803.026-.788.123-1.058 1.139-5.327a.295.295 0 0 0-.024-.178c-.244-.656-.291-1.32-.079-1.995.459-1.456 2.11-1.567 2.398-.366.178.743-.292 1.716-.653 3.152-.299 1.186 1.097 2.03 2.29 1.163 1.1-.798 1.527-2.71 1.446-4.067-.16-2.703-3.125-3.287-5.005-2.417-2.157.997-2.647 3.67-1.673 4.891.123.156.219.25.177.408-.062.245-.117.49-.185.734-.05.182-.202.247-.385.173a2.212 2.212 0 0 1-.9-.675c-.827-1.024-1.064-3.049.03-4.763 1.21-1.9 3.463-2.668 5.52-2.435 2.457.28 4.01 1.958 4.3 3.863.133.867.038 3.006-1.18 4.518-1.402 1.737-3.672 1.852-4.72.786-.08-.082-.145-.178-.224-.275" fill="#FFF"></path></g></svg>';

		let wp_block_images = document.querySelectorAll(target);
		if(wp_block_images){
			let pinIt_button_ele = '<span title="(opens new window)" aria-describedby="external-disclaimer" aria-label="Pin this Exterior facade of Gleneagles image" class="pinIt_button">'+pinIt_Icon+'</span>';
			wp_block_images.forEach(function(wp_block_image){
			    if(!wp_block_image.classList.contains('pinit_enabled')){
			    	let wp_block_image_loc = wp_block_image.querySelector('figure');
			    	wp_block_image_loc.insertAdjacentHTML('beforeend', pinIt_button_ele);
			    	let pinIt_button = wp_block_image.querySelector('.pinIt_button');
			        wp_block_image.classList.add('pinit_enabled');
			        wp_block_image.addEventListener("mouseover", function(){
			        	let wp_block_image_ele = wp_block_image.querySelector('img');
			        	let wp_block_image_src = wp_block_image_ele.getAttribute('src');
			        	let wp_block_image_alt = wp_block_image_ele.getAttribute('alt');
				        let post_title = document.title;
				        let post_url = document.URL;
				        // console.log({wp_block_image_alt});
				        // console.log({wp_block_image_src, post_title, post_url});
				        let aria_describedby = 'Pin This '+wp_block_image_alt+' Image';
				        pinIt_button.setAttribute('aria-describedby', aria_describedby);
				        pinIt_button.setAttribute('aria-label', aria_describedby);
				        let pinIt_url = 'https://www.pinterest.com/pin/create/link/?url='+post_url+'&media='+wp_block_image_src+'&description='+post_title;
				        let pinIt_trigger = wp_block_image.querySelector('.pinIt_button');
				        pinIt_trigger.addEventListener('click', function(){
				        	window.open(pinIt_url, 'Pin It', width=100,height=50);
				        })
			        });
			    }
			})
		}
	}
	pinIt_story('div.wp-block-image');
	pinIt_story('.kadence-blocks-gallery-item');
</script>