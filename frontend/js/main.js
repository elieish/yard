 $(document).ready(function() {
    $('.table').dataTable();

   $('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-3d'
    });

    $("#province").on("change", function(){
        var url = 'ajax.php?action=district_select';
        url     += '&province=' + this.value;
        var result = ajax_get_data(url);
        $('#district').html(result);
    });


 $("#receiver").tokenInput('ajax.php?action=get_user_email_addresses_multi',{ theme: "facebook"});
 });

function printPDF(uid){

    var url = 'ajax.php?action=getMemberdetails';
    url     += '&uid=' + uid;
    var result = ajax_get_data(url);
    var data = jQuery.parseJSON(result);
	var doc = new jsPDF();
    doc.setProperties({
    title: 'YARD Membership Certificate',
    author: 'Elie ishimwe'
    });
   /* doc.addImage(imgData, 'PNG', 15, 40, 180, 180);*/
    doc.setFontSize(22);
    doc.setFont("times");
    doc.setFontType("normal");
    doc.setTextColor(0,0,0);
    doc.setFontSize(12);
    doc.text(40, 100, 'Membership Number ');
    doc.text(80, 100,  ': ' + data.membership_no);
    doc.text(40, 110, 'Name ');
    doc.text(80, 110,  ': ' + data.name);
    doc.text(40, 120, 'Surname ');
    doc.text(80, 120,  ': ' + data.surname);
    doc.text(40, 130, 'Province Name ');
    doc.text(80, 130,  ': ' + data.provincename);
    doc.text(40, 140, 'District Name ');
    doc.text(80, 140, ': ' + data.districtname);
    doc.text(40, 150, 'Local Name ');
    doc.text(80, 150, ': ' + data.localname);
    doc.text(40, 160, 'Date of Issue ');
    doc.text(80, 160, ': ' + data.issued_date);
    doc.text(40, 170, 'Renewal Date ');
    doc.text(80, 170, ': ' + data.renewal_date);
    doc.text(40, 180, 'Issuing Officer : ');
    doc.text(80, 180, ': ' + data.issued_by);
    doc.save(data.membership_no+'.pdf');
}

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

function refresh() {
    var province    =   $("#province").val();
    var startdate   =   $("input[name=start_date]").val();
    var enddate     =   $("input[name=end_date]").val();
    var url         = '?p=members';
    url             += '&province='  + province;
    $("#refresh").attr("href", url);
}
function modalEmail(uid)
{

    //Get Email Content
    var url = 'ajax.php?action=getEmailContent';
    url     += '&uid=' + uid;
    var result = ajax_get_data(url);
    var data = jQuery.parseJSON(result);
    $('#emailcontent').html(data.message);
    $('#myModalLabelEmail').html("Subject:" + data.subject);
    $('#myModal2').modal('toggle');

    $('#clModal2,#clModal1').click(function() {
        location.reload();
    });
}





