$(document).ready(function(){

	$( "#registration" ).on('submit',function(){
		var membership = $("#registrationnumber").val();
		//$("#registrationnumbers").removeClass('hidden');
		alert("Thank you for your registration,your membership number is " + membership);
	});

	  // Datepicker for single fields
    $('.date').datepicker({
        dateFormat: 'yy-mm-dd'
    });
		
});

/* $(".date").datepicker({
        dateFormat: 'yy-mm-dd'
 });*/
