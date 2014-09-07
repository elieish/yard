<?php
$membershipno = $_GET['membership_no'];;
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
  <meta charset="utf-8">
    <title>Members Page</title>
    <meta name="description" content="">
    <meta name="keywords" content="" />
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/templatemo_misc.css">
    <link rel="stylesheet" href="css/templatemo_style.css">
    <link rel="stylesheet" href="js/datepicker/css/datepicker.css">
    <link rel="stylesheet" href="css/main.css">

    <!-- JavaScripts -->
    <script src="js/vendor/jquery-1.11.0.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
    <script src="js/jquery.singlePageNav.js"></script>
    <script src="js/jquery.flexslider.js"></script>
    <script src="js/custom.js"></script>
    <script src="js/jquery.lightbox.js"></script>
    <script src="js/templatemo_custom.js"></script>
    <script src="js/jquery-git2.js"></script><!-- previous next script -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/bootstrapvalidator/dist/js/bootstrapValidator.min.js"></script>
    <script src="js/datepicker/js/bootstrap-datepicker.js"></script>
    <script src="js/main.js"></script>
    <script src="js/filter.js"></script>
    <script src="js/php.js"></script>
    <script src="js/forms.js"></script>
    <script type="text/javascript">
      $(window).load(function(){
        $('#myModalMessage').modal('show');
      });
</script>
  </head>
<body>
 <!--Confirmation Modal -->
      <div class="modal fade" id="myModalMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">YARD MEMBERSHIP CONFIRMATION</h4>
            </div>
            <div class="modal-body">
              <div id="text">Thank you for your registration,your membership number is <?php print $membershipno ?> </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" id='closemodal'>Close</button>
          </div>
        </div>
      </div>
</body>
</html>




