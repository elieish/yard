$(document).ready(function() {

    $('.date').datepicker({
        dateFormat: 'yy-mm-dd'
    });

    $("#company_id").bind("change",function() { 
     
        $( "#cost_center_div" ).empty();
        var list = getDropdownlist($(this).val(), "costcenter");
        
        $("#cost_center_div").html(list);
        $('#cost_center_id').bind("change",function() {
            $("#department_div").empty();
            var list = getDropdownlist($(this).val(),"department");
        
            $( "#department_div" ).html(list);
        });
    });

      "use strict";
            var options = {};
            options.ui = {
                container: "#profile",
                showVerdictsInsideProgressBar: true,
                viewports: {
                    progress: ".pwstrength_viewport_progress"
                }
            };
            options.common = {
                debug: true,
                onLoad: function () {
                    $('#messages').text('Start typing password');
                }
            };
            $('#password').pwstrength(options);

});

function ajax_get_data(this_url) {
    // Get Response
    var new_html = $.ajax({
        url: this_url,
        async: true,
        dataType: "html"
    }).responseText;
    
    // Return Response
    return new_html;
}

function getDropdownlist(company,type) {
    var url = 'ajax.php?action=getdropdownlist';
    url     += '&id='   + company;
    url     += '&type=' + type;
    
    var result = ajax_get_data(url);
    
    return result;
}

var filter_jobs = function() {
    var tblitem = $("#job_filters");
    var item    = $("#job_filters");
    
    item.slideToggle('slow');

    tblitem.removeClass('hidden');
};

function resetform() {
    //$("#filter_form").reset();
    $("#job_filters").removeClass('hidden');
}

function refresh() {
    var companyid       =   $("#company_id").val();
    var costcenterid    =   $("#cost_center_id").val();
    var departmentid    =   $("#department_id").val();
    var startdate       =   $("input[name=start_date]").val();
    var enddate         =   $("input[name=end_date]").val();
    var url             = '?p=report_faxes';
    url                 += '&company_id='       + companyid;
    url                 += '&cost_center_id='   + costcenterid;
    url                 += '&department_id='    + departmentid;
    url                 += '&start_date='       + startdate;
    url                 += '&end_date='         + enddate; 
  
  $("#refresh").attr("href", url);

}