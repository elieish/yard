<?php
/**
 * Project
 * 
 * @author Elie Ishimwe <elieish@gmail.com>
 * @version 2.0
 * @package Project
 */

# =========================================================================
# PAGE CLASS
# =========================================================================

class Page extends AbstractPage {
	
	# =========================================================================
	# DISPLAY FUNCTIONS
	# =========================================================================
	
	/**
	 * The default function called when the script loads
	 */
	function display() {
		global $_db;
		
		$file = dirname(dirname(dirname(__FILE__))) . "/frontend/static/exim-logs.html";
		include_once($file);
		
	}

	
	# =========================================================================
	# PROCESSING FUNCTIONS
	# =========================================================================
	
}