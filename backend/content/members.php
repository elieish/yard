
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

		#Get User ID
		$user_id 		= get_user_uid();
		$user			= new User($user_id);

		# Get Data

		$listing 		= Member::listing();
		$listingpaid 	= Member::listingpaid();

		$province		= Province::get_id(Form::get_str("province"));
		$district		= District::get_id(Form::get_str("district"));
		$province		= ($province)? $province : $user->province;
		$province		= ($district)? $district : $user->district;
		$listing 		= Member::listing($province,$district);

		# Generate HTML
		$file			= dirname(dirname(dirname(__FILE__)))."/frontend/html/members/list.html";
		$vars	= array(
							"listing"		=> $listing,
							"add_link"		=> $this->cur_page."&action=add",
							"title"			=> 'Members',
							"province"		=> provinces_select()
						);
		if(isset($_GET['v'])){
			if($_GET['v'] == 'paid')
				$vars['title']			= 'Paid Members';
			else
				$vars['title']			= 'Unpaid Members' ;
		}
		$template						= new Template($file,$vars);
		$html							= $template->tostring();

		# Display HTML
		Print $html;


	}

	function profile() {

		# Global Variables
		global $_db;

		# Get Member ID
		$member_id	= Form::get_int('id');

		#Create New Object
		$obj			= new Member($member_id);

		# Generate HTML
		$file			= dirname(dirname(dirname(__FILE__)))."/frontend/html/members/profile.html";
		$vars			= array(
																					"name"			=> $obj->name,
																					"form"          => $obj->item_form($this->cur_page),
            																		"js"            => $js,
																					"add_link"		=> "?p=members&action=add&id={$member_id}"
																				);
		$template														= new Template($file,$vars);
		$html															= $template->tostring();

		# Display HTML
		Print $html;

	}

	function add() {

		# Global Variables
		global $_db;

		#Get GET Data
		$uid															= Form::get_int('id');

		# Create new Member Object
		$obj							= new Member($uid);

		# Generate HTML
		$vars							= array(
																					"form"	=> $obj->item_form($this->cur_page."&action=save")
																				);

		$file															= dirname(dirname(dirname(__FILE__)))."/frontend/html/members/add.html";

		$template														= new template($file,$vars);

		$html															= $template->tostring();

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
		$member_id			= Form::get_int("uid");
		$name				= Form::get_str("name");


		# Create new Object
		$obj				= new Member($member_id);
		$obj->user			= get_user_uid();
		$obj->created_at	= now();
		$obj->title_id		= Form::get_str("title_id");
		$obj->name			= $name;
		$obj->surname		= Form::get_str("surname");
		$obj->gender		= Form::get_str("gender");
		$obj->dob			= Form::get_str("dob");
		$obj->age			= Form::get_str("age");
		$obj->tel			= Form::get_str("tel");
		$obj->cell			= Form::get_str("cell");
		$obj->email			= Form::get_str("email");
		$obj->province_id	= Form::get_str("province_id");
		$obj->district		= Form::get_str("district");
		$obj->local_area	= Form::get_str("local)_area");
		$obj->sector_id		= Form::get_str("sector_id");
		$obj->paid			= 0;
		$obj->active		= 1;

		# Save Member
		$obj->save();

		# Redirect
		redirect("{$this->cur_page}&action=display");
	}

	function delete() {
		# Global Variables
		global $_db, $validator;

		# Get GET Data
		$uid				= Form::get_int("id");

		# Create Member Object
		$member				= new Member($uid);

		# Delete From Database
		$member->delete();

		# Redirect
		redirect($this->cur_page);
	}
	
	function paid() {
		# Global Variables
		global $_db, $validator;


		# Get GET Data
		$uid			= Form::get_int("id");

		# Create Member Object
		$member		= new Member($uid);

		# Delete From Database
		$member->paid = 1;

		$member->save();

		# Redirect
		redirect($this->cur_page);
	}

	function notpaid() {
		# Global Variables
		global $_db, $validator;


		# Get GET Data
		$uid			= Form::get_int("id");

		# Create Member Object
		$member		= new Member($uid);

		# Delete From Database
		$member->paid = 0;

		$member->save();

		# Redirect
		redirect($this->cur_page);
	}

}

# =========================================================================
# THE END
# =========================================================================
