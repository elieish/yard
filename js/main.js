jQuery(document).ready(function($) {

	'use strict';

		$(".our-listing").owlCarousel({
			items: 4,
			navigation: true,
			navigationText: ["&larr;","&rarr;"],
		});

        $('.datepicker').datepicker();


		$('.flexslider').flexslider({
		    animation: "fade",
		    controlNav: false,
		    prevText: "&larr;",
		    nextText: "&rarr;"
		});


		$('.toggle-menu').click(function(){
	        $('.menu-responsive').slideToggle();
	        return false;
	    });

    $('#province').change(function(){
    	var url = 'ajax.php?action=district_select';
     	url     += '&province=' + this.value;
     	var result = ajax_get_data(url);
     	$('#district').html(result);
    });

    //Generate Membership Registration Number
   /* $( "#registration" ).submit( function(event) {

		var name          = $("#name").val().toString().substr(0,1).toUpperCase();
		var surname       = $("#surname").val().toString().substr(0,1).toUpperCase();
		var fullDate      = new Date();console.log(fullDate);
		var twoDigitMonth = fullDate.getMonth()+"";if(twoDigitMonth.length==1)  twoDigitMonth="0" +twoDigitMonth;
		var twoDigitDate  = fullDate.getDate()+"";if(twoDigitDate.length==1) twoDigitDate="0" +twoDigitDate;
		var currentDate   = twoDigitDate  + twoDigitMonth + fullDate.getFullYear().toString().substr(2,2);
		var province      = $("#province").val();
		var membershipno  = name + surname + currentDate + province;
		var text          = "Thank you for your registration,your membership number is "+ membershipno;
        $("#registrationnumber").val(membershipno);
        alert(text);
    });*/
      // Datepicker for single fields
/*    $('.date').datepicker({
        dateFormat: 'yy-mm-dd'
    });
*/


});

function ajax_get_data(this_url) {
    // Get Response
    var new_html = $.ajax({
        url: this_url,
        async: false,
        dataType: "html"
    }).responseText;

    // Return Response
    return new_html;
}

function form_validate() {

    // Boolean to hold the overall error state of the form
    var form_has_errors     = false;

    // Get the form object
    var form                = $('form');

    // Iterate over each input element and validate its value
    $('.input input, .input select, .input textarea', form).each(function() {

        // Make sure not to try validating the submit button
        if ($(this).prop('type') != "submit") {

            // String to hold the error message for this field
            var field_error     = false;

            // Get the current value of this field
            var value           = jQuery.trim($(this).val());
            $(this).val(value);

            // VALIDATE: Must be a non-empty string
            if ($(this).hasClass('validate_nonempty')) {
                field_error      = (isset(Filter.nonEmpty(value)))? field_error : "This field must be filled out";
            }

            // VALIDATE: Must be a valid integer
            if ($(this).hasClass('validate_integer')) {
                field_error      = (isset(Filter.integer(value)) || (Filter.isBlank(value)))? field_error : "This value must be a number";
            }

            // VALIDATE: Must be a valid natural number
            if ($(this).hasClass('validate_natural')) {
                field_error      = (isset(Filter.natural(value)) || (Filter.isBlank(value)))? field_error : "This value must be a number, 0 or more";
            }

            // VALIDATE: Must be a South African ID number
            if ($(this).hasClass('validate_idnum')) {
                field_error      = (isset(Filter.idNum(value)) || (Filter.isBlank(value)))? field_error : "This must be a valid South African ID number";
            }

            // VALIDATE: No Duplicate Business Name
            var isReadonlyBus = $("#business_name").prop('readonly');
            if (($("#business_name").length > 0) && ($(this).hasClass('validate_dublicate_name'))&& (!isReadonlyBus)) {
                var url = "ajax.php?";
                url += "action=check_business_duplicate&query_field=name&query_value=" + $("#business_name").val();
                var result = ajax_get_data(url);
                field_error     = (result == 'found')? "The Business with the same name has been already registered" :field_error;

            }
            // VALIDATE: No Duplicate Registration Number
            var oldregnumber = $("#old_registration_number").val();
            var regnumber    = $("#registration_number").val();
            if (($("#registration_number").length > 0) && ($(this).hasClass('validate_dublicate_registration')) && (oldregnumber != regnumber) && (regnumber != '')) {
                var url = "ajax.php?";
                url += "action=check_business_duplicate&query_field=registration_number&query_value=" + regnumber;
                var result = ajax_get_data(url);
                field_error     = (result == 'found')? "The Business with the same registration number has been already registered" :field_error;
            }

            // VALIDATE: No Duplicate VAT Number
            var oldvatnumber = $("#old_vat_number").val();
            var vatnumber    = $("#vat_number").val();
            if (($("#vat_number").length > 0) && ($(this).hasClass('validate_dublicate_vat')) && (oldvatnumber != vatnumber) && (vatnumber != '')) {
                var url = "ajax.php?";
                url += "action=check_business_duplicate&query_field=vat_number&query_value=" + vatnumber;
                var result = ajax_get_data(url);
                field_error     = (result == 'found')? "The Business with the same VAT number has been already registered" :field_error;
            }

            // VALIDATE: No Duplicate Username
            var isReadonlyUser = $("#username").prop('readonly');
            if (($("#username").length > 0) && ($(this).hasClass('validate_dublicate_username')) && (!isReadonlyUser)) {
                var url = "ajax.php?";
                url += "action=check_user_duplicate&query_field=username&query_value=" + $("#username").val();
                var result = ajax_get_data(url);
                field_error     = (result == 'found')? "User with with same username already exist" :field_error;
            }

            // VALIDATE: No Duplicate Email Address
            var oldemail = $("#old_email").val();
            var email    = $("#email").val();
            if (($("#email").length > 0) && ($(this).hasClass('validate_dublicate_email')) && (email != oldemail)  && (email != '')) {
                var url = "ajax.php?";
                url += "action=check_user_duplicate&query_field=email&query_value=" + email;
                var result = ajax_get_data(url);
                field_error     = (result == 'found')? "User with with same email already exist" :field_error;
            }

            // VALIDATE: No Duplicate Service Provider
            var old_service_provider = $("#old_name").val();
            var service_provider     = $("#name").val();
            if (($("#name").length > 0) && ($(this).hasClass('validate_dublicate_service_provider')) && (service_provider != old_service_provider)  && (service_provider != '')) {
                var url = "ajax.php?";
                url += "action=check_service_provider_duplicate&query_field=name&query_value=" + service_provider;
                var result = ajax_get_data(url);
                field_error     = (result == 'found')? "Service Provider with with same name already exist" :field_error;
            }

            // VALIDATE: No Duplicate VAT Number Service Provider
            var old_vat_number_sp = $("#old_vat_number").val();
            var vat_number_sp     = $("#vat_number").val();
            if (($("#vat_number").length > 0) && ($(this).hasClass('validate_duplicate_vat_number')) && (old_vat_number_sp != vat_number_sp) && (vat_number_sp != '')) {
                var url = "ajax.php?";
                url += "action=check_service_provider_duplicate&query_field=vat_number&query_value=" + vat_number_sp;
                var result = ajax_get_data(url);
                field_error     = (result == 'found')? "The Service Provider with the same VAT number has been already registered" :field_error;
            }

            // VALIDATE: No Duplicate Registration Number Service Provider
            var old_registration_number_sp = $("#old_registration_number").val();
            var registration_number_sp     = $("#registration_number").val();
            if (($("#registration_number").length > 0) && ($(this).hasClass('validate_duplicate_registration_number')) && (old_registration_number_sp != registration_number_sp) && (registration_number_sp != '')) {
                var url = "ajax.php?";
                url += "action=check_service_provider_duplicate&query_field=registration_number&query_value=" + registration_number_sp;
                var result = ajax_get_data(url);
                field_error     = (result == 'found')? "The Service Provider with the same Registration Number has been already registered" :field_error;
            }

            // VALIDATE: No Duplicate Networking Event
            var old_name_ne = $("#old_name").val();
            var name_ne     = $("#name").val();
            var date_ne     = $('#date_year').val() + "-" + $('#date_month').val() + "-" + $('#date_day').val();
            if (($("#name").length > 0) && ($(this).hasClass('validate_duplicate_name_NE'))&& (old_name_ne != name_ne) && (name_ne != '')) {
                var url = "ajax.php?";
                url += "action=check_network_event_duplicate&query_field=name&query_value=" + name_ne;
                url += "&date="+date_ne;
                var result = ajax_get_data(url);
                field_error     = (result == 'found')? "The Networking Event with the same name has been already registered on the same date" :field_error;

            }

            // VALIDATE: No Duplicate SMME
            var old_name_smme = $("#old_name").val();
            var name_smme     = $("#name").val();
            if (($("#name").length > 0) && ($(this).hasClass('validate_duplicate_smme'))&& (old_name_ne != name_ne) && (name_ne != '')) {
                var url = "ajax.php?";
                url += "action=check_smme_duplicate&query_field=name&query_value=" + name_ne;
                var result = ajax_get_data(url);
                field_error     = (result == 'found')? "The SMME with the same name has been already registered" :field_error;

            }

            // VALIDATE: No Duplicate Training Session
            var programme     = $("#programme").val();
            var uid           = $("#uid").val();
            var date_training = $('#date_year').val() + "-" + $('#date_month').val() + "-" + $('#date_day').val();
            if (($("#programme").length > 0) && ($(this).hasClass('validate_duplicate_training'))&&(!uid)&&(programme != '')) {
                var url = "ajax.php?";
                url += "action=check_training_session_duplicate&query_field=training_programme&query_value=" + programme;
                url += "&date="+date_training;
                var result = ajax_get_data(url);
                field_error     = (result == 'found')? "The Training Programme with the same name has been already registered on the same date" :field_error;

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

$(document).ready(function(){

   /* var form_validated       = false;
    $('form').on('submit',function(e) {

    if (!form_validated) {
            alert('ishimwe');

            e.preventDefault();
            var form               = this;
            var validation_errors  = form_validate();
            if (!validation_errors) {
                form_validated      = true;
                $(this).submit();
            }
        }
    });*/

    $('#registration').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            title: {
                validators: {
                    notEmpty: {
                        message: 'The Title is required'
                    }
                }
            },
            name: {
                validators: {
                    notEmpty: {
                        message: 'The Name is required'
                    }
                }
            },
            surname: {
                validators: {
                    notEmpty: {
                        message: 'The Surname is required'
                    }
                }
            },
            gender: {
                validators: {
                    notEmpty: {
                        message: 'The Gender is required'
                    }
                }
            },
        }
    });

});








