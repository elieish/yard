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

class Member extends Model {
	
	# --------------------------------------------------------------------------------------
	# ATTRIBUTES
	# --------------------------------------------------------------------------------------
	
	var $y;
	
	# --------------------------------------------------------------------------------------
	# METHODS
	# --------------------------------------------------------------------------------------
	
	/**
	 * Constructor
	 * 
	 * Set the Table and the UID of the object.
	 * 
	 * @param $uid Integer: The Unique Identifier of the object.
	 */
	function __construct($uid=0) {
		# Set Table
		$this->table													= "members";
		
		# Initialize UID from Parameter
		$this->uid														= $uid;
		if ($uid) {
			$this->load();
		}
	}
	
	function item_form($action) {
		# Create Form Object
		$form															= new Form($action, "POST", "member_form");
		
		# Generate Form - Lead
		$form->add(""							, "hidden"			, "uid"					, $this->uid);
		$form->add_select("Select a Title"      , "title_id"       	,$this->title_id        , title_select());
		$form->add("Name"						, "text"			, "name"				, $this->name);
		$form->add("Surname"					, "text"			, "surname"				, $this->surname);
		$form->add("Gender"						, "text"			, "gender"				, $this->gender);
		$form->add("D.O.B"						, "date"			, "dob"					, $this->dob);
		$form->add("Age"						, "text"			, "age"					, $this->age);
		$form->add("Tel"						, "text"			, "tel"					, $this->tel);
		$form->add("Cell"						, "text"			, "cell"				, $this->cell);
		$form->add("Email"						, "text"			, "email"				, $this->email);
		$form->add_select("Select a Province"   , "province_id"     ,$this->province_id     , province_select());
		$form->add("District"					, "text"			, "district"			, $this->district);
		$form->add("Local Area Name"			, "text"			, "local_area"			, $this->local_area);
		$form->add_select("Select a Sector"     , "sector_id"       ,$this->sector_id       , sector_select());
		$form->add(""							, "submit"			, ""					, "Save");
		
		# Generate HTML
		$html															= $form->generate();
		
		# Return HTML
		return $html;
	}
	
	public function listing() {
		
		#Global Variables
		global $_db;
		
		# Get Data
		$query		= "	SELECT
							CONCAT('<a href=\"{$this->cur_page}&action=add&id=', `members`.`uid`, '\">', `membership_no`, '</a>') as 'Membership No.',
							`name` as 'Name',
							`surname` as 'Surname',
							`dob` as 'DOB',
							(SELECT `title` FROM `titles` WHERE `uid` = `members`.`title_id`) as'Title',
							`tel` as 'Tel',
							`cell` as 'Cell',
							`email` as 'Email',
							`provinces`.`province` as 'Province',
							CONCAT('<a href=\"{$this->cur_page}&action=add&id=', `members`.`uid`, '\">Edit<i class=\"icon-edit\"></i></a>\t<a href=\"{$this->cur_page}&action=delete&id=', `members`.`uid`, '\"><i class=\"icon-trash\"></i></a>') as 'Actions',
						CONCAT('<a href=\"{$this->cur_page}&action=paid&id=', `members`.`uid`, '\">Not Paid<i class=\"icon-edit\"></i></a>\t<a href=\"{$this->cur_page}&action=delete&id=', `members`.`uid`, '\"><i class=\"icon-trash\"></i></a>') as 'Payment'
						FROM
								`members` JOIN `provinces` ON `provinces`.`uid` = `members`.`province_id` 
						WHERE
								`members`.`active` = 1
								AND `members`.`paid` = 0																			
											";
																			
		if(isset($_GET['v'])){
			if($_GET['v'] == 'paid')
				$query												.= 'AND paid = "Y"';
			else 
				$query												.= 'AND paid = "N"';
		}
		else {
				$query												.= 'ORDER BY
																				`name`';
		}
																			
		$listing														= paginated_listing($query);
		
		
		return $listing;
	}


	public function listingpaid() {
		
		#Global Variables
		global $_db;
		
		# Get Data
		$query		= "	SELECT
							CONCAT('<a href=\"{$this->cur_page}&action=add&id=', `members`.`uid`, '\">', `membership_no`, '</a>') as 'Membership No.',
							`name` as 'Name',
							`surname` as 'Surname',
							`dob` as 'DOB',
							(SELECT `title` FROM `titles` WHERE `uid` = `members`.`title_id`) as'Title',
							`tel` as 'Tel',
							`cell` as 'Cell',
							`email` as 'Email',
							`provinces`.`province` as 'Province',
							CONCAT('<a href=\"{$this->cur_page}&action=add&id=', `members`.`uid`, '\">Edit<i class=\"icon-edit\"></i></a>\t<a href=\"{$this->cur_page}&action=delete&id=', `members`.`uid`, '\"><i class=\"icon-trash\"></i></a>') as 'Actions',
						CONCAT('<a href=\"{$this->cur_page}&action=notpaid&id=', `members`.`uid`, '\">Paid<i class=\"icon-edit\"></i></a>\t<a href=\"{$this->cur_page}&action=delete&id=', `members`.`uid`, '\"><i class=\"icon-trash\"></i></a>') as 'Payment'
						FROM
								`members` JOIN `provinces` ON `provinces`.`uid` = `members`.`province_id` 
						WHERE
								`members`.`active` = 1
								AND `members`.`paid` = 1																			
											";
																			
		if(isset($_GET['v'])){
			if($_GET['v'] == 'paid')
				$query												.= 'AND paid = "Y"';
			else 
				$query												.= 'AND paid = "N"';
		}
		else {
				$query												.= 'ORDER BY
																				`name`';
		}
																			
		$listing														= paginated_listing($query);
		
		
		return $listing;
	}


	public function getTotalMembers() {
		global $_db;

		$query = "SELECT COUNT(*) FROM `members` WHERE `active` = 1";

		return $_db->fetch_single($query);
	}
	
	public function getAllMembers($mode) {
		global $_db;
		
		$query	= "SELECT 
						`uid` as '#',
						`datetime` as 'Date Created',
						`name` as 'Members'
					FROM
						`memebers`
					WHERE
						`active` = 1
					ORDER BY `name` ASC";
		
		$listing													= ($mode=="list")?paginated_listing($query):$_db->fetch($query);
		return $listing;
	}	
	
}

# ==========================================================================================
# THE END
# ==========================================================================================

