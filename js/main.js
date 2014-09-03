jQuery(document).ready(function($) {

	'use strict';

		$(".our-listing").owlCarousel({
			items: 4,
			navigation: true,
			navigationText: ["&larr;","&rarr;"],
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

    //Generate Membership Registration Number
    $( "#registration" ).submit( function(event) {
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
    });



      // Datepicker for single fields
    $('.date').datepicker({
        dateFormat: 'yy-mm-dd'
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




