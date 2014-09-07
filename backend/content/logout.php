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
	function display(){
		# Global Variables
		global $_db;

		# Log Activity
		logg("Logging off.");

		# Log Off
		session_destroy();

		# Redirect
		redirect("../index.php");
	}

	# =========================================================================
	# PROCESSING FUNCTIONS
	# =========================================================================

}

# =========================================================================
# THE END
# =========================================================================
