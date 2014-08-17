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

class Title extends Model {
	
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
		$this->table			= "titles";
		
		# Initialize UID from Parameter
		$this->uid				= $uid;
		if ($uid) {
			$this->load();
		}
	}
	
	function item_form($action) {
		# Create Form Object
	
	}
	
	
	
	public function listing() {
			
		# Get Data
		$query															= "	SELECT
																				`uid` as '#',
																				CONCAT('<a href=\"{$this->cur_page}&action=profile&id=', `uid`, '\">', `name`, '</a>') as 'Company name',
																				CONCAT('<a href=\"{$this->cur_page}&action=delete&id=', `uid`, '\">delete</a>') as 'Delete'
																			FROM
																				`employees`
																			WHERE
																				`active` = 1
																			ORDER BY
																				`name`																			
																			";
																			
		$listing														= paginated_listing($query);
		
		return $listing;	
		
	}
	
	public function getTotalEmployees() {
		global $_db;

		$query = "SELECT COUNT(*) FROM `employees` WHERE `active` = 1 AND `company_id` > 0";

		return $_db->fetch_single($query);
	}

	public function employeeExists($email) {
		global $_db;

		$query  = "SELECT * FROM `employees` WHERE `email` = '{$email}' AND `active` = 1";
		$result = $_db->fetch_one($query);

		if(isset($result->uid) && $result->uid > 0) {
			return $result;
		} else {
			return false;
		}
	}
	
	public function getAllEmployees($mode) {
		global $_db;
		
		$query	= "SELECT 
						`uid` as '#',
						`datetime` as 'Date Created',
						(SELECT `name` FROM `companies` WHERE `active` = 1 AND `uid` = `employees`.`company_id`) as 'Companies',
						(SELECT `name` FROM `cost_centers` WHERE `active` = 1 AND `uid` = `employees`.`cost_center_id`) as 'Cost Centers',
						(SELECT `name` FROM `departments` WHERE `active` = 1 AND `uid` = `employees`.`department_id`) as 'Departments',
						`name` as 'Employees',
						`email` as 'Email Addresses'
					FROM
						`employees`
					WHERE
						`active` = 1
					ORDER BY `name` ASC";
		
		$listing													= ($mode=="list")?paginated_listing($query):$_db->fetch($query);
		return $listing;
	}

	public function getTitleName($uid) {
		global $_db;

		$query =	" SELECT `title` FROM `titles` WHERE `uid` = '{$uid}'";

		$title = 	$_db->fetch_single($query);
		return $title;
	}		
}

# ==========================================================================================
# THE END
# ==========================================================================================

