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

		//Get Listing
        $listing = user::get_all_users();

        // Generate HTML from Template
        $file    = dirname(dirname(dirname(__FILE__))) . "/frontend/html/users/list.html";
        $vars    = array(
            "link"    => $this->cur_page."&action=add",
            "listing" => $listing
        );

        $template = new Template($file, $vars);
        $html     = $template->toString();

        print $html;
    }

	function profile() {
		# Global Variables
		global $_db;

		# Get GET Data
		$uid	= $_GET['id'];

		# Generate HTML
		$html	= "
		<!-- Title -->
		<h2>User Administration</h2>

		<!-- Form -->
		" . user_profile($uid,$this->cur_page) . "
		";

		# Display HTML
		print $html;
	}

	function add() {
		# Global Variables
		global $_db;

		# Create new User Object
		$user																= new User();

		# Generate HTML
		$html																= "
		<!-- Title -->
		<h2>New User</h2>

		<!-- Form -->
		" . $user->form() . "
		";

		# Display HTML
		print $html;
	}

	# =========================================================================
	# PROCESSING FUNCTIONS
	# =========================================================================

	function save() {
		# Global Variables
		global $_db, $validator;

		# Get POST Data
		$uid				= $_POST['uid'];
		$user				= new User($uid);
		$user->username		= $_POST['username'];
		$user->first_name	= $_POST['first_name'];
		$user->last_name	= $_POST['last_name'];
		$user->email		= $_POST['email'];
		$user->tel			= $_POST['tel'];
		$user->mobile		= $_POST['mobile'];
		$user->fax			= $_POST['fax'];
		$password			= $_POST['password'];
		$user->province		= $_POST['province_id'];
		$user->district		= $_POST['district_no'];
		$user->title		= $_POST['title'];
		$user->active		= 1;

		# Update Password
		if (strlen($password)) {
			$user->password	= $password;
		}

		# Save User
		$user->save();

		# Set info message
		set_info("User {$username} has been saved successfully.");

		# Redirect
		redirect("?p=admin_users");
	}

	function delete() {
		# Global Variables
		global $_db, $validator;

		# Get GET Data
		$uid				= $validator->validate($_GET['id'], "Integer");

		# Create User Object
		$user															= new User($uid);

		# Delete From Database
		$user->delete();

		# Set info message
		set_info("User {$user->username} has been deleted successfully.");

		# Redirect
		redirect($this->cur_page);
	}

	function save_auths() {
		# Global Variables
		global $_db, $validator;

		# Get POST Data
		$uid		= $_POST['uid'];

		# Create User
		$user		= new User($uid);

		# Save Auths
		$user->clear_auths();
		foreach ($_POST as $key => $value) {
			if (substr($key, 0, 2) == "f_") {
				# Get Function
				$function_id			= substr($key, 2);
				$function				= $_db->get_data("functions", "function", "uid", $function_id);

				# Add function to user
				$user->add_allowed_function($function);
			}
		}

		# Redirect
		redirect("{$this->cur_page}&action=profile&id={$uid}");
	}


}

# =========================================================================
# THE END
# =========================================================================
