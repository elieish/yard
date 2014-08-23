<?php
# Start Session
session_start();

# Include Required Scripts
include_once(dirname(__FILE__). "/backend/framework/include.php");
Application::include_models();
Application::include_helpers();
Application::db_connect();
 
function display()
{
	# Global Variables
    global $_db;

}

$title			= titles_select();
$province		= provinces_select();


if(isset($_POST['submit'])){
	

	$name 			= $_POST['name'];
	$surname		= $_POST['surname'];
	$gender			= $_POST['gender'];
	$dob			= $_POST['dob'];
	$cellphone		= $_POST['cellphone'];
	$telephone		= $_POST['telephone'];
	$email			= $_POST['email'];
	$prov 			= $_POST['province'];
	$title_id 		= $_POST['title'];
	$provid         = province_id($prov);
    $registrationno = $_POST['registrationnumber'];

	# Create new Object
	$obj				= new Member();
	$obj->datetime		= now();
	$obj->name			= $name;
	$obj->surname		= $surname;
	$obj->gender		= $gender;
	$obj->dob			= $dob;
	$obj->email			= $email;
	$obj->cell 			= $cellphone;
	$obj->tel 			= $telephone;
	$obj->province_id	= $provid;
	$obj->title_id		= $title_id;
	$obj->created_at 	= now();
	$obj->membership_no	= $registrationno;
	$obj->active		= 1;
	$email              = $obj->email;
	# Save Member
	$obj->save();

  #Sending Email
  $receivers           = array('mackdolvins@gmail.com',$obj->email);
  foreach ($receivers as $value) {
       $to_email               = $value;
       $email_subject          = "Membership Confirmation ";
       $message                = "Good Day ".$obj->name." \n Thank you for you registration. Please take note of your membership no is  ".$obj->membership_no;
       html_email($to_email, $email_subject, $message, $message, $_GLOBALS["from_email"], $fileArray);
    }
    redirect('index.html');
 
}
# ===================================================
# ACTION HANDLER
# ===================================================

if (isset($_GET["action"])) {
	$action					= Form::get_str("action");
	if (function_exists($action)) {
		$action();
	}
	else {
		print "Invalid action.";
	}
}
else {
	display();
}
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Yard Administation</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="css/jquery-ui.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Custom Theme JavaScript -->
   

</head>

<body>

    <div id="wrapper">

      
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">MEMBERSHIP REGISTRATION FORM</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                      <!-- <div class="panel-heading" id='showmessage'>
                          Thank you for your registration.Please take note of your membership number:
                      </div> -->
                     
                        <div class="panel-body"> 
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action='registration.php' method='POST' id='registration' >
                                  
                                     	<div class="form-group">
                                            <label>Title</label>
                            
                                            <?php print $title;?>
                                        </div>
                                        <div class="form-group">
                                            <label>Name:</label>
                                            <input class="form-control" name="name" id="name" value="<?php echo $_POST['name'] ?>" placeholder="Name">
          
                                        </div>
                                        <div class="form-group">
                                            <label>Surname:</label>
                                            <input class="form-control" value="<?php echo $_POST['surname'] ?>" placeholder="Surname" name="surname" id="surname">
                                        </div>
										<div class="form-group">
                                            <label>Gender</label> 
                                           <select class="form-control" name="gender" id="gender">
                                           		<option value="0">Select One</option>
                                           		<option value="1">Male</option>
                                           		<option value="2">Female</option>
                                           	</select>
                                        </div>
                                    
                                       <div class="form-group">
                                            <label>Date of Birth:</label>
                                            <input class="date form-control" value="<?php echo $_POST['dob'] ?>" placeholder="Date of Birth" name="dob" id="dob">
                                        </div>
                                        <div class="form-group">
                                            <label>Telephone:</label>
                                            <input class="form-control" value="<?php echo $_POST['telephone'] ?>" placeholder="Telephone" name="telephone" id="telephone">
                                        </div>
                                         <div class="form-group">
                                            <label>Cellphone:</label>
                                            <input class="form-control" value="<?php echo $_POST['cellphone'] ?>" placeholder="Cellphone" name="cellphone" id="cellphone">
                                        </div>
                                        <div class="form-group">
                                            <label>Email:</label>
                                            <input class="form-control" value="<?php echo $_POST['email'] ?>" placeholder="email" name="email" id="email" >
                                            <p class="help-block">email@example.com</p>
                                        </div>
										<div class="form-group">
                                            <label>Province:</label>
                                           <?php print $province;?>
                                         </div>
                                        <input type='hidden' id='registrationnumber' name="registrationnumber"/>

                                      
                                     
                                  	 <div class="form-group">     
                                     <button type="submit" name='submit' id='submit' class="btn btn-primary">Submit</button>
                                     </div>
                     
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                   
                                 
                                      
                                           
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>

<div class="modal fade" id="ishimwe">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Membership Information</h4>
      </div>
      <div class="modal-body">
        <p id='confirmationmembership'></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
  
     <!-- Custom Theme JavaScript -->
    
</body>
 <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
     <!-- Bootstrap Core JavaScript -->
    <script src="js/jquery-ui.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>
<script src="js/main.js"></script>
</html>
