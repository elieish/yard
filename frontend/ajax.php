<?php
/**
 * Project: AJAX Script
 *
 * @author Elie Ishimwe <elieish@gmail.com>
 * @version 1.0
 * @package Project
 */

# ===================================================
# SCRIPT SETTINGS
# ===================================================

# Start Session
session_start();

# Include Required Scripts
include_once(dirname(dirname(__FILE__)) . "/backend/framework/include.php");
Application::include_models();
Application::include_helpers();
Application::db_connect();

# ===================================================
# FUNCTIONS
# ===================================================


function district_select()
{
  $province     = Form::get_str("province");
  $districtdrop = districts_select($province,"");
  print $districtdrop;
}

function get_user_email_addresses_multi() {
    global $_db;

    $searchString = Form::get_str('q');
    $query = "SELECT
                    *
                FROM
                    `users`
                WHERE
                    CONCAT(`first_name`, ' ', `last_name`, ' ', `email`) LIKE '%{$searchString}%' AND
                    `email` != '' AND
                    `active` = 1
    ";
    $result  = $_db->fetch($query);
    if(count($result) > 0) {
        foreach($result as $user) {
            $sToken = md5(uniqid(mt_rand(), true));
            $data[]= array("name"=>"{$user->first_name} {$user->last_name} <{$user->email}","id" =>"{$user->uid}");
        }


        $data = json_encode($data);
    } else {
        $data = json_encode(array());
    }


    print $data;

}

function getEmailContent() {

    $EmailUid     = Form::get_str("uid");
    $Email        = new Email($EmailUid);

    //Mark Email as Read
    $Email->read  = 1;

    // Save Changes
    $Email->save();
    print json_encode($Email);
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
	print "No Action was specified.";
}

# ===================================================
# THE END
# ===================================================
