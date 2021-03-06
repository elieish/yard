<?php
/**
 * YARDDevelopment: AJAX Script
 *
 * @author Elie ishimwe <elieish@gmail.com>
 * @version 1.0
 * @package YARDDevelopment
 */

# ===================================================
# SCRIPT SETTINGS
# ===================================================

# Start Session
session_start();
# Include Required Scripts
include_once(dirname(__FILE__). "/backend/framework/include.php");
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


function check_user_duplicate() {

    global $_db;
    $query_value = strtolower($_GET['query_value']);
    $query_field = strtolower($_GET['query_field']);
    $user        = Member::check_field_duplicate($query_field,$query_value);


    $result      = ($user > 0)? 'found':'not found';
    print $result;
 }


function local_select()
{
  $district     = Form::get_str("district");
  $localsdrop   = locals_select($district,"");
  print $localsdrop;
}



//-----------------------------------------------------------------------
// Action Handler
//-----------------------------------------------------------------------

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if (function_exists($action)) {
        $action();
    } else {
        print "ERROR: Invalid Action `{$action}`.";
    }
} else {
    print "ERROR: Please supply an action.";
}
