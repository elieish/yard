<?php
/**
 * Project
 *
 * @author Elie Ishimwe <elieish@gmail.com>
 * @version 1.0
 * @package Project
 */

# ==========================================================================================
# CLASS
# ==========================================================================================

class User extends Model {

	public $membership;

	/**
	 * Constructor
	 *
	 * Set the Table and the UID of the object.
	 *
	 * @param $uid Integer: The Unique Identifier of the object.
	 */
	public function __construct($uid=0) {
		# Set Table
		$this->table													= "users";

		# Initialize UID from Parameter
		$this->uid														= $uid;
		if ($this->uid) {
			$this->load();
			$this->membership											= new UserGroup($this->uid);
			$this->membership->get_groups();
		}
	}

	/**
	 * Displays the user form
	 */
	public function form($cur_page) {
		# Global Variables
		global $_db;

		# Generate Form
		$form			= new Form("?p=admin_users&action=save");
		//			Label				Type			Name				Value
		$form->add(""					, "hidden"		, "uid"				, $this->uid);
		$form->add(""					, "hidden"		, "title"			, 1);
		/*$form->add_select("Select a Province"   , "province_id"     ,$this->province_id     , province_select());

		$form->add_select("Select a District"   , "district_id"     ,$this->district_id     , "");*/
		$form->add("Username"			, "text"		, "username"		, $this->username);
		$form->add("Password"			, "password"	, "password"		, $this->password);
		$form->add_select("Select Gender"       , "gender"      ,$this->gender     , gender_select($this->gender));
		$form->add("Date of birth"		, "datepicker"		, "dob"				, $this->dob ,array('class', 'datepicker'));
		$form->add("First Name"			, "text"		, "first_name"		, $this->first_name);
		$form->add("Last Name"			, "text"		, "last_name"		, $this->last_name);
		$form->add("Email Address"		, "text"		, "email"			, $this->email);
		$form->add("Telephone"			, "text"		, "tel"				, $this->tel);
		$form->add("Mobile"				, "text"		, "mobile"			, $this->mobile);
		$form->add("Fax"				, "text"		, "fax"				, $this->fax);
		$form->add(""					, "submit"		, "submit"			, "Save");


		# Generate HTML
		$html														= $form->generate();

		# Return HTML
		return $html;
	}

	public function login($username, $password) {
		# Global Variables
		global $_db;

		# Sanitize Parameters Parameters
		//$username														= preg_replace('@[^a-zA-Z0-9_]@', '', $username);

		$password														= md5($password);



		# Compare to database
		$query									= "	SELECT
													COUNT(*)
													FROM
														`users`
													WHERE
														`username` = \"$username\"
														AND `password` = \"$password\"";
		$auth															= $_db->fetch_single($query);

		# Handle Comparison Result
		if ($auth){
			# Get User Details
			$query					= "	SELECT
											*
										FROM
											`users`
										WHERE
											`username` = \"$username\"
												AND `password` = \"$password\"";
			$user						= $_db->fetch_one($query);

			# Set SESSION Details
			$_SESSION['user_uid']				= $user->uid;
			$_SESSION['user_username']			= $user->username;
			$_SESSION['user_fullname']			= $user->first_name." ".$user->last_name;
			unset($_SESSION['login_error']);

			# Log Activity
			logg("Login : Login Successful. Username = `$username`.");

			# Return True
			return true;
		}
		else {
			# Destroy SESSION Details
			session_destroy();

			# Display Error Message
			logg ("Login : Authentication FAILED! Username = `$username`.", "ALERT");
			$_SESSION['login_error'] 									= "Login Failed. Please Try Aagain.";

			# Return False
			return false;
		}
	}

	public function check_auth($function) {
		# Check for auth in groups
		foreach ($this->membership->groups as $group) {
			if ($group->check_auth($function)) {
				return true;
			}
		}
		return false;
	}

	public function get_all_users()
	{
		#Global Variables
		global $_db;

		#Query
		$query = " SELECT
						`uid` as '#',
						 CONCAT('<a href=\"{$this->cur_page}&action=profile&id=', `uid`, '\">', `username`, '</a>') as 'Username',
						 (SELECT `title` FROM `titles` WHERE `uid` = u.`title`) as 'Title',
						`first_name` as 'First Name',
						`last_name` as 'Last Name',
						CONCAT('<a href=\"{$this->cur_page}&action=profile&id=', `uid`, '\"><i class=\"icon-edit\"></i></a>\t<a href=\"{$this->cur_page}&action=delete&id=', `uid`, '\"><i class=\"icon-trash\"></i></a>') as 'Actions'
					FROM
						`users` u
					WHERE
						`active` = 1
					";
		$listing = paginated_listing($query);

		return $listing;

		}


	 // Clear out Allowed Functions for this user

	function clear_auths() {
		# Global Variables
		global $_db;

		# Clear out Allowed Functions
		$_db->delete("functions_users", "user", $this->uid);
	}

	/**
	 * Add Allowed Function
	 * @param String $function The function that this user is allowed to perform
	 */
	function add_allowed_function($function) {
		# Global Variables
		global $_db;

		# Add Function
		$_db->insert(
			"functions_users",
			array(
				"user"												=> $this->uid,
				"function"											=> $function
			)
		);
	}

	public function formp($cur_page) {
		# Global Variables
		global $_db;

		# Generate Form
		$form			= new Form("?p=admin_users&action=savep");
		//			Label				Type			Name				Value
		$form->add(""					, "hidden"		, "uid"				, $this->uid);
		$form->add(""					, "hidden"		, "title"			, 4);
		$form->add_select("Select a Province"   , "province_id"     ,$this->province_id     , province_select());
		$form->add_select("Select Gender"       , "gender"      ,$this->gender     , gender_select($this->gender));
		$form->add("Date of birth"		, "datepicker"		, "dob"				, $this->dob ,array('class', 'datepicker'));
		$form->add("Username"			, "text"		, "username"		, $this->username);
		$form->add("Password"			, "password"	, "password"		, $this->password);
		$form->add("First Name"			, "text"		, "first_name"		, $this->first_name);
		$form->add("Last Name"			, "text"		, "last_name"		, $this->last_name);
		$form->add("Email Address"		, "text"		, "email"			, $this->email);
		$form->add("Telephone"			, "text"		, "tel"				, $this->tel);
		$form->add("Mobile"				, "text"		, "mobile"			, $this->mobile);
		$form->add("Fax"				, "text"		, "fax"				, $this->fax);
		$form->add(""					, "submit"		, "submit"			, "Save");


		# Generate HTML
		$html														= $form->generate();

		# Return HTML
		return $html;
	}


	public function formDistrict($cur_page) {
		# Global Variables
		global $_db;

		# Generate Form
		$form			= new Form("?p=admin_users&action=saveDistrict");
		//			Label				Type			Name				Value
		$form->add(""					, "hidden"		, "uid"				, $this->uid);
		$form->add(""					, "hidden"		, "title"			, 7);
		$form->add_select("Select a Province"   , "province_id"     ,$this->province    , province_select()							,array('id', 'province_id'));
		$form->add_select("Select a District"   , "district"     ,$this->district     , districtt_select($this->province)		,array('id', 'districts'));
		$form->add_select("Select Gender"       , "gender"      ,$this->gender     , gender_select($this->gender));
		$form->add("Date of birth"		, "datepicker"		, "dob"				, $this->dob ,array('class', 'datepicker'));
		$form->add("Username"			, "text"		, "username"		, $this->username);
		$form->add("Password"			, "password"	, "password"		, $this->password);
		$form->add("First Name"			, "text"		, "first_name"		, $this->first_name);
		$form->add("Last Name"			, "text"		, "last_name"		, $this->last_name);
		$form->add("Email Address"		, "text"		, "email"			, $this->email);
		$form->add("Telephone"			, "text"		, "tel"				, $this->tel);
		$form->add("Mobile"				, "text"		, "mobile"			, $this->mobile);
		$form->add("Fax"				, "text"		, "fax"				, $this->fax);
		$form->add(""					, "submit"		, "submit"			, "Save");


		# Generate HTML
		$html														= $form->generate();

		# Return HTML
		return $html;
	}

	function get_users_uids()
	{
		# Global Variables
		global $_db;

		$query = " SELECT
						`uid`
					FROM
						`users`
					WHERE
						`active` = 1
					";
		$data  = $_db->fetch($query);

		return $data;
	}


}

# ==========================================================================================
# THE END
# ==========================================================================================
