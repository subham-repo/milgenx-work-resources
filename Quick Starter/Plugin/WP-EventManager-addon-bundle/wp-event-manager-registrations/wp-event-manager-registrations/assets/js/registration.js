jQuery(document).ready(function (a) {

    if (jQuery('.event-manager-registration-form input[data-picker="datepicker"]').length > 0)
    {
        jQuery('.event-manager-registration-form input[data-picker="datepicker"]').datepicker({
            minDate: 0,
            dateFormat: event_manager_registrations.i18n_datepicker_format,
            firstDay: event_manager_registrations.start_of_week,
        });
    }

    a(".event-manager-registrations-error").size() && a(".registration_button").click(),
            a("body").on("submit", ".event-manager-registration-form", function () {
        var b = a(this),
                c = !0;
        return (
                a(".event-manager-registrations-error").remove(),
                a(this)
                .find(":input[required]")
                .each(function () {
                    if (!a(this).val()) {
                        var d = event_manager_registrations.i18n_required.replace("%s", a(this).closest("fieldset").find("label").text());
                        return b.prepend('<p class="event-manager-error event-manager-registrations-error">' + d + "</p>"), (c = !1), !1;
                    }
                }),
                c
                );
    });

});
