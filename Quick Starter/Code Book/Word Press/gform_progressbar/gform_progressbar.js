jQuery(document).ready(function(){

	console.log('Hi Caption');

	jQuery('.gf_page_steps').prepend('<div class="progress-bar"><span class="progress_bar"><span class="total-progress"></span></span></div>');
	$steps_length = jQuery('.gf_page_steps .gf_step').length;
	$steps_pending = jQuery('.gf_page_steps .gf_step.gf_step_pending').length;
	$steps_completed = $steps_length - $steps_pending;
	$progress =  $steps_completed/ $steps_length * 100;
	$progr_int = parseInt($progress);
	console.log($progress);
	jQuery('.progress-bar').find('.total-progress').css('width', $progress + '%');
	jQuery('.gf_page_steps').find('.progress-bar').prepend('<span class="progress_status">'+$progr_int + '%'+' Completed</span>');
});