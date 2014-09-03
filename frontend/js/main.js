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

 });

function printPDF(){
	var doc = new jsPDF();
	doc.text(20, 20, 'Hello world!');
	doc.text(20, 30, 'This is client-side Javascript, pumping out a PDF.');
	doc.addPage();
	doc.text(20, 20, 'Do you like that?');
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


