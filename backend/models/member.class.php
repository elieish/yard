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

	public function listing($province,$district) {

		#Global Variables
		global $_db;

		$province_where_clause = ($province)? "AND `members`.`province_id` = '{$province}'" :"";
		$district_where_clause = ($district)? "AND `members`.`district` = '{$district}'" :"";


		# Get Data
		$query		= "	SELECT
							`created_at` as 'Registration Date',
							CONCAT('<a href=\"{$this->cur_page}&action=add&id=', `members`.`uid`, '\">', `membership_no`, '</a>') as 'Membership No.',
							(SELECT `title` FROM `titles` WHERE `uid` = `members`.`title_id`) as'Title',
							`name` as 'Name',
							`surname` as 'Surname',
							`tel` as 'Tel',
							`cell` as 'Cell',
							`email` as 'Email',
							`provinces`.`province` as 'Province',


						CONCAT('<a href=\"{$this->cur_page}&action=paid&id=', `members`.`uid`, '\">Not Paid<i class=\"icon-edit\"></i></a>\t<a href=\"{$this->cur_page}&action=delete&id=', `members`.`uid`, '\"><i class=\"icon-trash\"></i></a>') as 'Payment',
					CONCAT('<li class=\"dropdown\">
                    <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">
                        <i class=\"fa fa-tasks fa-fw\"></i>  <i class=\"fa fa-caret-down\"></i>
                    </a>
                    <ul class=\"dropdown-menu dropdown-user\">
                        <li><a href=\"{$this->cur_page}&action=add&id=', `members`.`uid`, '\"><i class=\"fa fa-user fa-fw\"></i> Edit</a>
                        </li>
                        <li><a href=\"{$this->cur_page}&action=paid&id=', `members`.`uid`, '\"><i class=\"fa fa-money fa-fw\"></i> Approve  </a>
                        </li>
                        <li><a href=\"{$this->cur_page}&action=delete&id=', `members`.`uid`, '\"><i class=\"fa fa-trash-o fa-fw\"></i> Delete </a>
                        </li>
                    </ul>

           </li>') as'Actions'


						FROM
								`members` JOIN `provinces` ON `provinces`.`uid` = `members`.`province_id`
						WHERE
								`members`.`active` = 1
								AND `members`.`paid` = 0
								{$province_where_clause}
								{$district_where_clause}
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

		$listing							= paginated_listing($query);


		return $listing;
	}


	public function listingpaid() {

		#Global Variables
		global $_db;

		# Get Data
		$query		= "	SELECT
							`created_at` as 'Registration Date',
							CONCAT('<a href=\"{$this->cur_page}&action=add&id=', `members`.`uid`, '\">', `membership_no`, '</a>') as 'Membership No.',
							(SELECT `title` FROM `titles` WHERE `uid` = `members`.`title_id`) as'Title',
							`name` as 'Name',
							`surname` as 'Surname',
							`tel` as 'Tel',
							`cell` as 'Cell',
							`email` as 'Email',
							`provinces`.`province` as 'Province',
						CONCAT('<a href=\"{$this->cur_page}&action=notpaid&id=', `members`.`uid`, '\">Paid<i class=\"icon-edit\"></i></a>\t<a href=\"{$this->cur_page}&action=delete&id=', `members`.`uid`, '\"><i class=\"icon-trash\"></i></a>') as 'Payment',
						CONCAT('<li class=\"dropdown\">
                    <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">
                        <i class=\"fa fa-tasks fa-fw\"></i>  <i class=\"fa fa-caret-down\"></i>
                    </a>
                    <ul class=\"dropdown-menu dropdown-user\">
                        <li><a href=\"{$this->cur_page}&action=add&id=', `members`.`uid`, '\"><i class=\"fa fa-user fa-fw\"></i> Edit</a>
                        </li>
                        <li><a href=\"#\"  onclick=\"printPDF()\"><i class=\"fa fa-print fa-fw\"></i> Print </a>
                        </li>
                        <li><a href=\"{$this->cur_page}&action=delete&id=', `members`.`uid`, '\"><i class=\"fa fa-trash-o fa-fw\"></i> Delete </a>
                        </li>
                    </ul>

           </li>') as'Actions'
						FROM
								`members` JOIN `provinces` ON `provinces`.`uid` = `members`.`province_id`
						WHERE
								`members`.`active` = 1
								AND `members`.`paid` = 1

											";


		if(isset($_GET['v'])){
			if($_GET['v'] == 'paid')
				$query.= 'AND paid = "Y"';
			else
				$query.= 'AND paid = "N"';
		}
		else {
				$query.= 'ORDER BY
																				`name`';
		}

		$listing= paginated_listing($query);


		return $listing;
	}


	public function getTotalMembers($province,$district) {
		global $_db;

		$province_where_clause = ($province)? "AND `members`.`province_id` = '{$province}'" :"";
		$district_where_clause = ($district)? "AND `members`.`district` = '{$district}'" :"";

		$query = " SELECT
						COUNT(*)
				   FROM
				   		`members`
				    WHERE `active` = 1
				    	AND `paid` = 0
						{$province_where_clause}
						{$district_where_clause}
				    	";

		$total = $_db->fetch_single($query);
		return ($total <> 0)?$total : '0';
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

	public function getTotalMemberss() {
		global $_db;

		$query = "SELECT COUNT(*) FROM `members` WHERE `active` = 1 AND `paid` = 1 ";
		$total = $_db->fetch_single($query);
		return ($total <> 0)?$total : '0';
	}


	public function check_field_duplicate ($dbfieldname,$value)
	{
		global $_db;

		if(($value != '')) {

			$query = " SELECT
						COUNT(*)
				   FROM
				   		`members`
				   WHERE
				   		`$dbfieldname` = '{$value}'
				 ";

			$result = $_db->fetch_single($query);
			return $result;
		}
	}


}

# ==========================================================================================
# THE END
# ==========================================================================================

