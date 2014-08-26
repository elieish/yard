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




