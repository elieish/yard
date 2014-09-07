jQuery(document).ready(function($) {

	'use strict';

		$(".our-listing").owlCarousel({
			items: 4,
			navigation: true,
			navigationText: ["&larr;","&rarr;"],
		});

        $('.datepicker').datepicker({
            format: 'yyyy/mm/dd'
        });

        $( "#membershipModal" ).scroll(function() {
            $('.datepicker').datepicker('place',{
                format: 'yyyy/mm/dd'
            })
        });

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

    //Clear all input fields when modal closes
    $('#membershipModal').on('hidden.bs.modal', function (e) {
          $('.form-group input, .form-group select, .form-group textarea', '#registrationform').each(function() {
             $(this).val('');
          });
     });

    // Closes Confirmation Modal and redirect to index
    $("#closemodal").on('click',function(){
         window.location.href = "index.php";
    });

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


$(document).ready(function(){


 /*   $('#registrationform').bootstrapValidator({
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
                        message: 'Title is required'
                    }
                }
            },
            name: {
                validators: {
                    notEmpty: {
                        message: 'Name is required'
                    }
                }
            },
            surname: {
                validators: {
                    notEmpty: {
                        message: 'Surname is required'
                    }
                }
            },
            gender: {
                validators: {
                    notEmpty: {
                        message: 'Gender is required'
                    }
                }
            },
            dob: {
                validators: {
                    notEmpty: {
                        message: 'Date of Birth is required'
                    }
                }
            },
            email: {
                validators: {
                        notEmpty: {
                        message: 'Email Address is required'
                        },
                        emailAddress: {
                        message     : 'Please enter a valid email address'
                        },
                }
            },
            province: {
                validators: {
                        notEmpty: {
                        message: 'Province is required'
                        }
                }
            },

             district: {
                validators: {
                        notEmpty: {
                        message: 'District is required'
                        }
                }
            }
        }
    });*/

});










