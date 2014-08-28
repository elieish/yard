<?php

/**
 * Yard Development: AJAX Script
 *
 * @author Elie ishimwe <elieish@gmail.com>
 * @version 1.0
 * @package YARD Development
 */
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

$name               = $_POST['name'];
$surname            = $_POST['surname'];
$gender             = $_POST['gender'];
$dob                = $_POST['dob'];
$cellphone          = $_POST['cellphone'];
$telephone          = $_POST['telephone'];
$email              = $_POST['email'];
$prov               = $_POST['province'];
$title_id           = $_POST['title'];
$provid             = province_id($prov);
$registrationno     = $_POST['registrationnumber'];

  # Create new Object
$obj                = new Member();
$obj->datetime      = now();
$obj->name          = $name;
$obj->surname       = $surname;
$obj->gender        = $gender;
$obj->dob           = $dob;
$obj->email         = $email;
$obj->cell          = $cellphone;
$obj->tel           = $telephone;
$obj->province_id   = $provid;
$obj->title_id      = $title_id;
$obj->created_at    = now();
$obj->membership_no = $registrationno;
$obj->active        = 1;
$email              = $obj->email;
  # Save Member
$obj->save();

#Sending Email
$receivers           = array('elieish@gmail.com',$obj->email);
foreach ($receivers as $value) {
     $to_email               = $value;
     $email_subject          = "Membership Confirmation ";
     $message                = "Good Day ".$obj->name." \n Thank you for you registration. Please take note of your membership no is  ".$obj->membership_no;
     html_email($to_email, $email_subject, $message, $message, $_GLOBALS["from_email"], $fileArray);
  }
redirect('index.php');

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
