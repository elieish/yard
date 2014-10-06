<?php
/**
 * Project
 *
 * @author Elie Ishimwe <elieish@gmail.com>
 * @version 1.0
 * @package Project
 */

# =========================================================================
# CONFIGURATION
# =========================================================================

# System Settings
$_GLOBALS['title']            = "Yard Development";
$_GLOBALS['max_results']      = 20;
$_GLOBALS['default_page']     = "home";
$_GLOBALS['default_action']   = "display";
$_GLOBALS['log_file']         = "/var/log/yard/" . date("Y-m-d") . ".log";
$_GLOBALS['base_dir']         = dirname(dirname(dirname(dirname(__FILE__)))) . "/";

$_GLOBALS['base_url']         = (php_sapi_name() != 'cli')
    ? $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']) . "/../../"
    : '';

$_GLOBALS['upload_dir']       = $_GLOBALS['base_dir'] . "files/";
$_GLOBALS['upload_url']       = "files/";
$_GLOBALS['admin_email']      = "elieish@gmail.com";
$_GLOBALS['security_email']   = "elieish@gmail.com";
$_GLOBALS['security_subject'] = "SECURITY ALERT FOR " . $_GLOBALS['title'];
$_GLOBALS['from_email']       = "admin@yardweb.co.za";
$_GLOBALS['config_file']      = dirname(__FILE__) . "/config.ini";
$_GLOBALS['requires_login']   = true;

define('DEBUG', false);
