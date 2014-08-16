<?php
/**
 * Project: AJAX Script
 * 
 * @author Ralfe Poisson <ralfepoisson@gmail.cm>
 * @version 2.0
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

function getdropdownlist() {
	# Global Variables
    global $_db;
	
	# Get Data
	$id																= Form::get_str("id");
	$type															= Form::get_str("type");
	if ($type == "costcenter") {
			
		$listing													= generate_select("cost_center_id", cost_center_select($id));
	
	}
	else {
		$listing													= generate_select("department_id", department_select($id));
	}
	
	print $listing;
}
# ===================================================
# ACTION HANDLER
# ===================================================

if (isset($_GET["action"])) {
	$action																= Form::get_str("action");
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
