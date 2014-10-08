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
    doc.setFontType("bolditalic");
    doc.setTextColor(0,255,0);
	doc.text(60, 20, 'YARD MEMBERSHIP CERTIFICATE');
    doc.setFontType("normal");
    doc.setTextColor(0,0,0);
    doc.setFontSize(12);
	doc.text(80, 30, 'Youth in Agriculture & Rural Development');
    doc.text(20, 40, 'Membership Number ');
    doc.text(60, 40,  ':' + data.membership_no);
    doc.text(20, 50, 'Name ');
    doc.text(60, 50,  ':' + data.name);
    doc.text(20, 60, 'Surname ');
    doc.text(60, 60,  ':' + data.surname);
    doc.text(20, 70, 'Province Name ');
    doc.text(60, 70,  ':' + data.provincename);
    doc.text(20, 80, 'District Name ');
    doc.text(60, 80, ':' + data.districtname);
    doc.text(20, 90, 'Local Name ');
    doc.text(60, 90, ':' + data.local_area);
    doc.text(20, 100, 'Date of Issue ');
    doc.text(60, 100, ': ' + data.created_at);
    doc.text(20, 110, 'Renewal Date ');
    doc.text(60, 110, ': ' + data.created_at);
    doc.text(20, 120, 'Issuing Office : ');
    doc.text(60, 120, ': ' + data.created_at);
    doc.save('Certificate.pdf');
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





