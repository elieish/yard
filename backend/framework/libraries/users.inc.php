<?php
/**
 * Project
 *
 * @author Elie Ishimwe <elieish@gmail.com>
 * @version 2.0
 * @package Project
 */

# =========================================================================
# FUNCTIONS
# =========================================================================

function get_user_uid() {
	if (isset($_SESSION['user_uid'])) {
		if ($_SESSION['user_uid'] > 0) {
			return $_SESSION['user_uid'];
		}
	}
	return 0;
}

function is_logged_in() {
	if (get_user_uid() > 0) {
		return true;
	}
	return false;
}

function user_get_name($user_id) {
	# Global Variables
	global $_db;

	# Validation
	$user_id															= intval($user_id);

	# Get Data
	$query																= "	SELECT
																				CONCAT(`first_name`, ' ', `last_name`)
																			FROM
																				`users`
																			WHERE
																				`uid` = '$user_id'";
	$data																= $_db->fetch_single($query);

	# Return Data
	return $data;
}

function has_authority($function, $user_id=0) {
	# Global Variables
	global $_db;

	# Set User UID
	$user_id															= ($user_id)? $user_id : get_user_uid();

	# Get Data
	$query																= "	SELECT
																				COUNT(*)
																			FROM
																				`functions_users`
																			WHERE
																				`function` = \"$function\"
																				AND `user` = \"$user_id\"";
	$data																= $_db->fetch_single($query);

	# Return Data
	return $data;
}

function user_profile($uid=0,$cur_page) {
	# Global Variables
	global $_db, $_GLOBALS;

	# Create User
	$user							= new User($uid);

	# Generate Content For Tabs
	$tab_data				= array(	"Details"			=> "<h3>Details</h3>\n
				                                              ". $user->form(),
										"Authorizations"	=> user_auths($uid,$cur_page),
										"Comments"			=> comments_page("u" . $uid),
										"Attachments"		=> attachments_page("u" . $uid)
																				);

	# Generate Tabs
	$tabs													= tabbed_page($tab_data);

	# Generate HTML
	$html													= "
	<!-- Tabs -->

	{$tabs}

	";

	# Return HTML
	return $html;
}

function user_auths($uid,$cur_page) {
	# Global Variables
	global $_db, $_GLOBALS;


	# Get List of Functions
	$query																= "	SELECT
																				*
																			FROM
																				`functions`
																			ORDER BY
																				`category`,
																				`name`";
	$functions															= $_db->fetch($query);

	# Generate Functions HTML
	$functions_html														= "";
	foreach ($functions as $item) {
		$checked														= ($_db->fetch_single("SELECT COUNT(*) FROM `functions_users` WHERE `user` = '{$uid}' AND `function` = '{$item->function}'"))? " CHECKED" : "";
		$functions_html													.= "
				<div class='checkbox_wrapper'>
					<!-- Check Box -->
					<div class='checkbox_input'>
						<input type='checkbox' name=' f_{$item->uid}' {$checked} />
					</div><!-- END: Checkbox Input -->

					<!-- Label -->
					<div class='checkbox_label'>
						{$item->name}
					</div><!-- END: Checkbox Label -->
				</div><!-- END: Checkbox Wrapper -->
			";
	}

	# Generate HTML
	$html																= "

	<!-- Title -->
	<h3>Authorizations</h3>

	<!-- Form -->
	<form id='auth_form' method='POST' action='$cur_page&action=save_auths'>
		<input type='hidden' name='uid' value=\"{$uid}\" />

		" . select_all_none("auth_form") . "
		{$functions_html}

		<!-- Save Button -->
		" . button("Save", "javascript:document.getElementById(\"auth_form\").submit();", "left") . "

	</form>

	";

	# Return HTML
	return $html;
}


function save_auths() {
		# Global Variables
		global $_db, $validator;

		# Get POST Data
		$uid						= $validator->validate($_POST['uid'], "Integer");

		# Create User
		$user						= new User($uid);

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
# =========================================================================
# THE END
# =========================================================================
