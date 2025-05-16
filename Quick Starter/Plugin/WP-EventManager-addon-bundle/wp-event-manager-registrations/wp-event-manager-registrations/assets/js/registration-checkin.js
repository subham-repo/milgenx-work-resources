var RegistrationCheckin = function () {
    return {
        init: function () {
            Common.logInfo("RegistrationCheckin.init"), jQuery(".registration-checkin").on("click", RegistrationCheckin.actions.updateCheckin), jQuery(".registration-uncheckin").on("click", RegistrationCheckin.actions.updateCheckin);
        },
        actions: {
            updateCheckin: function (n) {
                Common.logInfo("RegistrationCheckin.updateCheckin.."), jQuery(this).closest("span").add(jQuery(this).closest("div").find(".hidden")).toggleClass("hidden");
                var e = jQuery(this).data("value"),
                    i = jQuery(this).data("registration-id"),
                    t = jQuery("input[name=event_id]").val();
                    s = jQuery(this).data("source"),
                jQuery.ajax({
                    type: "POST",
                    url: event_manager_registrations_registration_checkin.ajaxUrl.toString().replace("%%endpoint%%", "update_event_registration_checkin_data"),
                    data: { check_in_value: e, registration_id: i, event_id: t, source: s },
                    beforeSend: function (n, e) {
                        Common.logInfo("Before Send...");
                    },
                    success: function (n) {
                        Common.logInfo("Success..."), jQuery(".check_in_total").html(n);
                    },
                    error: function (n, e, i) {
                        Common.logInfo("Error...");
                    },
                    complete: function (n, e) {
                        Common.logInfo("Complete...");
                    },
                }),
                    n.preventDefault();
            },
        },
    };
};
(RegistrationCheckin = RegistrationCheckin()),
    jQuery(document).ready(function (n) {
        RegistrationCheckin.init();
    });
