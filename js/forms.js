$(document).ready(function(){
    var form_validated                  = false;
    $('#registrationform').submit(function(e) {
        // If the form data has not yet been validated, prevent the default form submission action
        if (!form_validated) {

            e.preventDefault();

            var form                    = this;
            var validation_errors       = form_validate();

            if (!validation_errors) {
                form_validated          = true;
                $(this).submit();
            }
        }
    });
});

function form_field_alert(object, level, message) {

    // Check if an alert div tag already exists
    var sibling   = $(object).parent('div.form-group').children('div.filter');

    if (!($(sibling).hasClass('filter'))) {
        $(object).parent('div.form-group').append("<div class='filter'></div>");
        sibling    = $(object).parent('div.form-group').children('div.filter');
        $(sibling).stop(true, true).css('opacity', 1);
    }
    else {
        $(sibling).stop(true, true).css('opacity', 1);
    }

    alert_image     = "<img src='images/form_icons/" + level + ".png' class='icon_" + level + "' />";

    alert_message   = "<div class='filter_label'>" + message + "</div>";

    $(sibling).html(alert_image + alert_message);

    if (level == "ok") {
        $(sibling).show().fadeTo(7000, 0.5);
    }
    if (level == "warning") {
        $(sibling).show().fadeTo(7000, 0.5);
    }

}


function form_validate() {

    // Boolean to hold the overall error state of the form
    var form_has_errors          = false;

    // Get the form object
    var form                     = $('#registrationform');

    // Iterate over each input element and validate its value
    $('.form-group input, .form-group select, .form-group textarea', form).each(function() {

        // Make sure not to try validating the submit button
        if ($(this).prop('type') != "submit") {

            // String to hold the error message for this field
            var field_error          = false;

            // Get the current value of this field
            var value                = jQuery.trim($(this).val());
            $(this).val(value);
            // VALIDATE: Must be a non-empty string
            if ($(this).hasClass('validate_nonempty')) {
                field_error          = (isset(Filter.nonEmpty(value)))? field_error : "This field must be filled out";
            }

            // VALIDATE: Must be a valid integer
            if ($(this).hasClass('validate_integer')) {
                field_error           = (isset(Filter.integer(value)) || (Filter.isBlank(value)))? field_error : "This value must be a number";
            }

            // VALIDATE: Must be a valid natural number
            if ($(this).hasClass('validate_natural')) {
                field_error           = (isset(Filter.natural(value)) || (Filter.isBlank(value)))? field_error : "This value must be a number, 0 or more";
            }

            // VALIDATE: Must be a South African ID number
            if ($(this).hasClass('validate_idnum')) {
                field_error                                             = (isset(Filter.idNum(value)) || (Filter.isBlank(value)))? field_error : "This must be a valid South African ID number";
            }

            // VALIDATE: No Duplicate Email Address
            var email    = $("#email").val();
            if (($("#email").length > 0) && ($(this).hasClass('validate_dublicate_email'))&& (email != '')) {
                var url = "ajax.php?";
                url += "action=check_user_duplicate&query_field=email&query_value=" + email;
                var result = ajax_get_data(url);
                field_error     = (result == 'found')? "Member with with same email already exist" :field_error;
            }

            // VALIDATE: No Duplicate Cellphone Number
            var cellphone        = $("#cellphone").val();

           if (($("#cellphone").length > 0) && ($(this).hasClass('validate_duplicate_cellphone'))&& (cellphone != '')) {
                var url = "ajax.php?";
                url += "action=check_user_duplicate&query_field=cell&query_value=" + cellphone;
                var result = ajax_get_data(url);
                field_error     = (result == 'found')? "Member with with same Cellphone already exist" :field_error;
            }
            if (field_error !== false) {

                // Set the overall error state of the form to true
                form_has_errors                                         = true;

                // Display the error message and icon
                form_field_alert(this, "error", field_error);
            }
            else {

                if (isset(Filter.nonEmpty(value))) {
                    // Display the OK message and icon
                    form_field_alert(this, "ok", "");
                }
                else {
                    // Display the warning message and icon
                    form_field_alert(this, "warning", "");
                }
            }
        }


    });

    // Return the error state of the form
    return form_has_errors;

}
