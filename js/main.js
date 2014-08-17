$(document).ready(function(){

	$( "#registration" ).submit( function() {
		var membership = $("#registrationnumber").val();
		//$("#registrationnumbers").removeClass('hidden');
		alert("Thank you for your registration,your membership number is " + membership);
	});

	  // Datepicker for single fields
    $('.date').datepicker({
        dateFormat: 'yy-mm-dd'
    });

    $('#legal_fields').modal('hide');
		
});




//More Legal Fields
var legal_fields = function(){
  $('#legal_fields').modal('show');
  
}