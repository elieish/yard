<?php
/**
 * Project
 * 
 * @author Ralfe Poisson <ralfepoisson@gmail.com>
 * @version 1.0
 * @package Project
 */

# ==========================================================================================
# CLASS
# ==========================================================================================

class employee extends Model {
	
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
		$this->table													= "employees";
		
		# Initialize UID from Parameter
		$this->uid														= $uid;
		if ($uid) {
			$this->load();
		}
	}
	
	function item_form($action) {
		# Create Form Object
		$form															= new Form($action, "POST", "employee_form");
		
		# Generate Form - Lead
		$form->add(""							, "hidden"			, "uid"					, $this->uid);
		$form->add("Name"						, "text"			, "employee_name"		, $this->name);
		$form->add("Email"						, "text"			, "employee_email"		, $this->email);
		$form->add(""							, "submit"			, ""					, "Save");
		
		# Generate HTML
		$html															= $form->generate();
		
		# Return HTML
		return $html;
	}
	
	public function listing_by_department($department_id) {
			
		# Global Variables	
		global $_db;
		
		# Get Data
		$query															= "	SELECT
																				`uid` as '#',
																				CONCAT('<a href=\"?p=employee&action=add&id=', `company_id`,'&co=',`cost_center_id`,'&dep=',`department_id`,'&em=',`uid`,'\">', `name`, '</a>') as 'Employee name',
																				`email` as 'Employee Email',
																				CONCAT('<a href=\"?p=employee&action=add&id=', `company_id`,'&co=',`cost_center_id`,'&dep=',`department_id`,'&em=',`uid`,'\"><i class=\"icon-edit\"></i></a>\t<a href=\"?p=employee&action=delete&id=', `uid`, '\"><i class=\"icon-trash\"></i></a>') as 'Actions'
																			FROM
																				`employees`
																			WHERE
																				`active` = 1
																				AND `department_id`={$department_id}
																			ORDER BY
																				`name`																			
																			";
																			
		$listing														= paginated_listing($query);
		
		return $listing;
	}
	
		public function listing_by_department_employee($department_id,$employee_id) {
			
		# Global Variables	
		global $_db;
		
		# Get Data
		$query															= "	SELECT
																				`uid` as '#',
																				`email` as 'Employee Email',
																				CONCAT('<a href=\"?p=employee&action=add&id=', `company_id`,'&co=',`cost_center_id`,'&dep=',`department_id`,'&em=',`uid`,'\"><i class=\"icon-edit\"></i></a><a href=\"?p=employee&action=delete&id=', `uid`, '\"><i class=\"icon-trash\"></i></a>'') as 'Actions'
																			FROM
																				`employees`
																			WHERE
																				`active` = 1
																				AND `department_id`={$department_id}
																				AND `uid`={$employee_id}
																			ORDER BY
																				`name`																			
																			";
																			
		$listing														= paginated_listing($query);
		
		return $listing;
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
}

# ==========================================================================================
# THE END
# ==========================================================================================

