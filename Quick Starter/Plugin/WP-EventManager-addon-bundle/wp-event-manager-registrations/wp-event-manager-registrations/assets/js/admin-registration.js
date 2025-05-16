var AdminRegistration = function () {
    return {
        init: function () {
            jQuery(".tickets_checkin").on("click", AdminRegistration.actions.updateCheckin), jQuery(".tickets_uncheckin").on("click", AdminRegistration.actions.updateCheckin);

            /* jQuery('body').on('click', '.user_export_button', AdminRegistration.actions.checkEventSelect); */
        },
        actions: {
            updateCheckin: function (t) {
                jQuery(this).closest("span").add(jQuery(this).closest("td").find(".hidden")).toggleClass("hidden");
                var e = jQuery(this).data("value"),
                    i = jQuery(this).data("post-id"),
                    n = jQuery("input[name=event_id]").val(),
                    s = jQuery(this).data("source");
                jQuery.ajax({
                    type: "POST",
                    url: event_manager_registrations_registration_admin.ajaxUrl.toString().replace("%%endpoint%%", "update_event_registration_checkin_data"),
                    data: { check_in_value: e, registration_id: i, event_id: n, source: s },
                    beforeSend: function (t, e) {},
                    success: function (t) {
                        jQuery(".check_in_total").html(t);
                    },
                    error: function (t, e, i) {},
                    complete: function (t, e) {},
                }),
                    t.preventDefault();
            },

            checkEventSelect: function (t) {
                
                var event_id = jQuery('select#dropdown_event_listings').val();

                if(event_id == '')
                {
                    t.preventDefault();
                    jQuery('select#dropdown_event_listings').focus();
                    jQuery('select#dropdown_event_listings').css('border-color', 'red');
                    jQuery('select#dropdown_event_listings').css('box-shadow', '0 0 0 1px red');
                }
            },
        },
    };
};

(AdminRegistration = AdminRegistration()),
    jQuery(document).ready(function (t) {
        AdminRegistration.init();
    });
