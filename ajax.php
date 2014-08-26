<?php
/**
 * Yard Development: AJAX Script
 *
 * @author Elie ishimwe <elieish@gmail.com>
 * @version 1.0
 * @package Yard Development
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
