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

class department extends Model {
	
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
		$this->table													= "departments";
		
		# Initialize UID from Parameter
		$this->id														= $uid;
		if ($uid) {
			$this->load();
		}
	}
	
	function item_form($action) {
		# Create Form Object
		$form															= new Form($action, "POST", "department_form");
		
		# Generate Form - Lead
		$form->add(""							, "hidden"			, "uid"					, $this->id);
		$form->add("Name"						, "text"			, "department_name"		, $this->name);
		$form->add(""							, "submit"			, ""					, "Save");
		
		# Generate HTML
		$html															= $form->generate();
		
		# Return HTML
		return $html;
	}
	
	public function listing_by_costcenter($cost_center_id) {
		global $_db;
		
		// Get Data
		$query = "	SELECT
																				`uid` as '#',
																				CONCAT('<a href=\"?p=department&action=profile&id=', `uid`, '\">', `name`, '</a>') as 'Department name',
																				CONCAT('<a href=\"?p=department&action=add&id=', `company_id`,'&co=',`cost_center_id`,'&dep=',`uid`, '\"><i class=\"icon-edit\"></i></a>\t<a href=\"?p=department&action=delete&id=', `uid`, '\"><i class=\"icon-trash\"</a>') as 'Actions'
																			FROM
																				`departments`
																			WHERE
																				`active` = 1
																				AND `cost_center_id`={$cost_center_id}
																			ORDER BY
																				`name`																			
																			";
																			
		$listing = paginated_listing($query);
		
		return $listing;
	}
	
	public function listing() {
			
		# Get Data
		$query															= "	SELECT
																				`uid` as '#',
																				CONCAT('<a href=\"{$this->cur_page}&action=profile&id=', `uid`, '\">', `name`, '</a>') as 'Company name',
																				CONCAT('<a href=\"{$this->cur_page}&action=delete&id=', `uid`, '\">delete</a>') as 'Delete'
																			FROM
																				`cost_centers`
																			WHERE
																				`active` = 1
																			ORDER BY
																				`name`																			
																			";
																			
		$listing														= paginated_listing($query);
		
		return $listing;	
		
	}


	public function getTotalDepartments() {
		global $_db;

		$query = "SELECT COUNT(*) FROM `departments` WHERE `active` = 1";

		return $_db->fetch_single($query);
	}
	
	
	public function getAllDepartments($mode) {
		global $_db;
		
		$query	= "SELECT 
						`uid` as '#',
						`datetime` as 'Date Created',
						(SELECT `name` FROM `companies` WHERE `active` = 1 AND `uid` = `departments`.`company_id`) as 'Companies',
						(SELECT `name` FROM `cost_centers` WHERE `active` = 1 AND `uid` = `departments`.`cost_center_id`) as 'Cost Centers',
						`name` as 'Departments'
					FROM
						`departments`
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

