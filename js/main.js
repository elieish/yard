$(document).ready(function(){

	$( "#registration" ).submit( function(event) {	
		var name          = $("#name").val().toString().substr(0,1).toUpperCase();
		var surname       = $("#surname").val().toString().substr(0,1).toUpperCase();
		var fullDate      = new Date();console.log(fullDate);
		var twoDigitMonth = fullDate.getMonth()+"";if(twoDigitMonth.length==1)  twoDigitMonth="0" +twoDigitMonth;
		var twoDigitDate  = fullDate.getDate()+"";if(twoDigitDate.length==1) twoDigitDate="0" +twoDigitDate;
		var currentDate   = twoDigitDate  + twoDigitMonth + fullDate.getFullYear().toString().substr(2,2);
		var province	  = $("#province").val();
		var membershipno = name + surname + currentDate + province;
		var text = "Thank you for your registration,your membership number is "+ membershipno;
		$("#registrationnumber").val(membershipno);
		alert(text);
		//$("#confirmationmembership").innerHTML="text";
		//$("#ishimwe").modal('show');
		//event.preventDefault();
	});



	  // Datepicker for single fields
    $('.date').datepicker({
        dateFormat: 'yy-mm-dd'
    });
	
});
