<?php

# Include Required Scripts
include_once(dirname(__FILE__). "/backend/framework/include.php");
Application::include_models();
Application::include_helpers();
Application::db_connect();

$uid		= $_GET['uid'];;
$member		= new Member($uid);


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
              <div id="text">Thank you for your registration,your membership number is <?php print $member->membership_no ?> </div>
            </div>
          
          <!--<div class="row">
	        <div class="col-md-8">-->
	        	<form action="https://sandbox.payfast.co.za/eng/process" class="form-horizontal" role="form">
	        		<!-- Receiver Details -->
					<input type="hidden" name="merchant_id" value="10001540">
					<input type="hidden" name="merchant_key" value="zm5yxqt7vyraa">
					<input type="hidden" name="return_url" value="http://127.0.0.1/payfast/thankyou.html">
					<input type="hidden" name="cancel_url" value="http://www.widget.co.za/payment_cancelled">
					<input type="hidden" name="notify_url" value="http://www.widget.co.za/payment_notify">
				  <div class="form-group">
				    <label for="name_first" class="col-sm-2 control-label">Name</label>
				    <div class="col-sm-10">
				      <input type="text" required="true" class="form-control" name="name_first" id="inputName_first3" placeholder="Name" value="<?php echo $member->name;?>">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="name_last" class="col-sm-2 control-label">Surname</label>
				    <div class="col-sm-10">
				      <input type="text" required="true" class="form-control" name="name_last" id="inputName_last3" placeholder="Surname" value="<?php echo $member->surname;?>">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
				    <div class="col-sm-10">
				      <input type="email" class="form-control" name="email" id="inputEmail3" placeholder="Email" value="<?php echo $member->email;?>">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="amount" class="col-sm-2 control-label">Amount</label>
				    <div class="col-sm-10">
				      <input type="text" required="true" class="form-control" name="amount" id="inputAmount3" placeholder="Surname" value="20.00">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="item_name" class="col-sm-2 control-label">Item</label>
				    <div class="col-sm-10">
				      <input type="text" required="true" class="form-control" name="item_name" id="inputAmount3" placeholder="item_name" value="Membership Fee">
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-default"><img alt="Pay Now" src="./images/paynow.png" /></button>
				    </div>
				  </div>
				  <!-- Transaction Details -->
					<input type="hidden" name="m_payment_id" value="TRN123456789">
					
					<!-- Transaction Options -->
					<input type="hidden" name="email_confirmation" value="1">
					
					<!-- Security -->
					<input type="hidden" name="signature" value="">
				</form>
	      	<!--</div>
	      </div>-->
          	<div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal" id='closemodal'>Close</button>
          	</div>
        </div>
      </div>
     </div>
     
</body>
</html>




