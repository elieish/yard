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

class Enterprise extends Model {
	
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
		$this->table													= "enterprises";
		
		# Initialize UID from Parameter
		$this->id														= $uid;
		if ($uid) {
			$this->load();
		}
	}
	
	function item_form($action) {
		# Create Form Object
		$form															= new Form($action, "POST", "enterprise_form");
		
		# Generate Form - Lead
		$form->add(""							, "hidden"			, "uid"					, $this->id);
		$form->add("Name"						, "text"			, "name"				, $this->name);
		$form->add_select("Select a Group"      , "group_id"       	,$this->group_id         , group_select());
		$form->add_select("Select a Member"      , "member_id"       ,$this->member_id        , member_select());
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
		$query															= "	SELECT
																				`enterprises`.`uid` as '#',
																				CONCAT('<a href=\"{$this->cur_page}&action=profile&id=', `enterprises`.`uid`, '\">', `enterprises`.`name`, '</a>') as 'Name',
																				`enterprise_groups`.`group`,
																				CONCAT(`members`.`name`,' ',`members`.`surname`) AS 'Owner',
																				CONCAT('<a href=\"{$this->cur_page}&action=add&id=', `enterprises`.`uid`, '\"><i class=\"icon-edit\"></i></a>\t<a href=\"{$this->cur_page}&action=delete&id=', `enterprises`.`uid`, '\"><i class=\"icon-trash\"></i></a>') as 'Actions'
																			FROM
																				`enterprises` 
																			JOIN 
																				`enterprise_groups` ON `enterprise_groups`.`uid` = `enterprises`.`group_id`
																			JOIN 
																				`members` ON `members`.`uid` = `enterprises`.`member_id`
																			WHERE
																				`enterprises`.`active` = 1
																			ORDER BY
																				`enterprises`.`name`																			
																			";
																			
		$listing														= paginated_listing($query);
		
		
		return $listing;
	}

	public function getTotalEnterprises() {
		global $_db;

		$query = "SELECT COUNT(*) FROM `enterprises` WHERE `active` = 1";

		return $_db->fetch_single($query);
	}
	
	public function getAllEnterprises($mode) {
		global $_db;
		
		$query	= "SELECT 
						`uid` as '#',
						`datetime` as 'Date Created',
						`name` as 'Enterprises'
					FROM
						`enterprises`
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

