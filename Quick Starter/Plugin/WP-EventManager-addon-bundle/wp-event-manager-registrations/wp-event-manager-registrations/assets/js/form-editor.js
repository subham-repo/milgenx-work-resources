jQuery(document).ready(function($) {

	$('.wp-event-manager-registrations-form-editor')
		.on( 'init', function() {
			$(this).sortable({
				items:'tr',
				cursor:'move',
				axis:'y',
				handle: 'td.sort-column',
				scrollSensitivity:40,
				helper:function(e,ui){
					ui.children().each(function(){
						$(this).width($(this).width());
					});
					return ui;
				},
				start:function(event,ui){
					ui.item.css( 'background-color','#FEFEE6' );
				},
				stop:function(event,ui){
					ui.item.removeAttr('style');
				}
			});
			var from_name = false;
			var from_email = false;
			var name_parent = false;
			var email_parent = false;
			$(this).find( '.field-rules select' ).each(function(){
				 $(this).find('option').each(function(){
				 	if(this.value == 'from_name' && $(this).is(':selected') ){
				 		from_name = true;
				 		name_parent =  $(this).parents('select').attr('name');
				 	}
					if(this.value == 'from_email' && $(this).is(':selected') ){
					 	from_email = true;
					 	email_parent =  $(this).parents('select').attr('name');
					}
				 	
				 });
				if(from_name && name_parent != $(this).attr('name') )
					$(this).find('option[value="from_name"]').attr("disabled",true);
				if(from_email && email_parent != $(this).attr('name') )
					$(this).find('option[value="from_email"]').attr("disabled",true);
			});

			$(this).find( '.field-type select' ).change();
			$(this).find( '.field-rules select:visible' ).chosen();
		})
		.on( 'change', '.field-type select', function() {
			$(this).closest('tr').find('.field-options .placeholder').hide();
			$(this).closest('tr').find('.field-options .options').hide();
			$(this).closest('tr').find('.field-options .na').hide();
			$(this).closest('tr').find('.field-options .file-options').hide();

			if ( 'select' === $(this).val() || 'multiselect' === $(this).val() ) {
				$(this).closest('tr').find('.field-options .options').show();
			} else if ( 'resumes' === $(this).val() || 'output-content' === $(this).val() ) {
				$(this).closest('tr').find('.field-options .na').show();
			} else if ( 'file' === $(this).val() ) {
				$(this).closest('tr').find('.field-options .file-options').show();
			} else {
				$(this).closest('tr').find('.field-options .placeholder').show();
			}

			$(this).closest('tr').find('.field-rules .rules').hide();
			$(this).closest('tr').find('.field-rules .na').hide();

			if ( 'output-content' === $(this).val() ) {
				$(this).closest('tr').find('.field-rules .na').show();
			} else {
				$(this).closest('tr').find( '.field-rules .rules' ).show();
				$(this).closest('tr').find( '.field-rules select:visible' ).chosen();
			}
		})
		.on( 'click', '.delete-field', function() {
			if ( window.confirm( wp_event_manager_registrations_form_editor.cofirm_delete_i18n ) ) {
				$(this).closest('tr').remove();
			}
		})
		.on( 'click', '.reset', function() {
			if ( window.confirm( wp_event_manager_registrations_form_editor.cofirm_reset_i18n ) ) {
				return true;
			}
			return false;
		})
		.on( 'click', '.add-field', function() {
			var $tbody = $(this).closest('table').find('tbody');
			var row    = $tbody.data( 'field' );
			row = row.replace( /\[-1\]/g, "[" + $tbody.find('tr').size() + "]");
			$tbody.append( row );
			$('.wp-event-manager-registrations-form-editor').trigger( 'init' );
			return false;
		});

	$('.wp-event-manager-registrations-form-editor').trigger( 'init' );

});
