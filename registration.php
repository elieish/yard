<?php

/**
 * YARDDevelopment: AJAX Script
 *
 * @author Elie ishimwe <elieish@gmail.com>
 * @version 1.0
 * @package YARDDevelopment
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
    global $_db,$_GLOBALS;

$name               = $_POST['name'];
$surname            = $_POST['surname'];
$gender             = $_POST['gender'];
$dob                = $_POST['date_year']."-".$_POST['date_month']."-".$_POST['date_day'];
$cellphone          = $_POST['cellphone'];
$telephone          = $_POST['telephone'];
$email              = $_POST['email'];
$prov               = $_POST['province'];
$title_id           = $_POST['title'];
$group_id           = $_POST['group_id'];
$provid             = province_id($prov);
$district           = $_POST['district'];
$districtid         = district_id($district);
$localid            = $_POST['locals'];

# Construct Membership Number
$query = " SELECT MAX(`uid`) AS 'max' FROM `members`";
$max_id = $_db->fetch_single($query);

$membership_no      = substr($name, 0,1).substr($surname,0,1);
$membership_no      .= date("dmy", strtotime(now()));
$membership_no      .= $prov.$district.str_pad(($max_id+1), 5, 0, STR_PAD_LEFT);

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
$obj->group_id      = $group_id;
$obj->created_at    = now();
$obj->membership_no = strtoupper($membership_no);
$obj->active        = 1;
$obj->province_id   = $provid;
$obj->district      = $districtid;
$obj->local_area    = $localid;
  # Save Member
$obj->save();

#Sending Email
$receivers           = array('elieish@gmail.com',$obj->email);
foreach ($receivers as $value) {
     $to_email               = $value;
     $email_subject          = "Membership Confirmation ";
     $message                = "Good Day ".$obj->name." \n Thank you for you registration. Please take note of your Membership Number is  ".$obj->membership_no;
     html_email($to_email, $email_subject, $message, $message, $_GLOBALS["from_email"], $fileArray);
  }
redirect('confirmation.php?uid='.$obj->uid);

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
