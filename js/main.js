$(document).ready(function(){

	$( "#registration" ).submit( function() {
		var membership = $("#registrationnumber").val();
		//$("#registrationnumbers").removeClass('hidden');
		alert(membership);
		//alert("Thank you for your registration,your membership number is " + membership);
	});

	  // Datepicker for single fields
    $('.date').datepicker({
        dateFormat: 'yy-mm-dd'
    });
	
});
