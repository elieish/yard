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

class CostCenter extends Model {
	
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
		$this->table													= "cost_centers";
		
		# Initialize UID from Parameter
		$this->uid														= $uid;
		if ($uid) {
			$this->load();
		}
	}
	
	function item_form($action) {
		# Create Form Object
		$form															= new Form($action, "POST", "costcenter_form");
		
		# Generate Form - Lead
		$form->add(""							, "hidden"			, "uid"					, $this->uid);
		$form->add("Name"						, "text"			, "costcenter_name"		, $this->name);
		$form->add(""							, "submit"			, ""					, "Save");
		
		# Generate HTML
		$html															= $form->generate();
		
		# Return HTML
		return $html;
	}
	
	public function listing_by_company($company_id) {
			
		# Global Variables	
		global $_db;
		
		# Get Data
		$query															= "	SELECT
																				`id` as '#',
																				CONCAT('<a href=\"?p=costcenter&action=profile&id=', `id`, '\">', `name`, '</a>') as 'Cost Center name',
																				CONCAT('<a href=\"?p=costcenter&action=add&id=', `company_id`,'&co=',`id`,'\"><i class=\"icon-edit\"></i></a>\t<a href=\"?p=costcenter&action=delete&id=', `id`, '\"><i class=\"icon-trash\"</a>') as 'Actions'
																			FROM
																				`cost_centers`
																			WHERE
																				`active` = 1
																				AND `company_id`={$company_id}
																			ORDER BY
																				`name`																			
																			";
																			
		$listing														= paginated_listing($query, "?p=companies&action=profile&id={$company_id}");
		
		return $listing;
	}
	
	public function listing() {
			
		# Get Data
		$query															= "	SELECT
																				`id` as '#',
																				CONCAT('<a href=\"{$this->cur_page}&action=profile&id=', `id`, '\">', `name`, '</a>') as 'Company name',
																				CONCAT('<a href=\"{$this->cur_page}&action=delete&id=', `id`, '\">delete</a>') as 'Delete'
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

	public function getTotalCostCenters() {
		global $_db;

		$query = "SELECT COUNT(*) FROM `cost_centers` WHERE `active` = 1";

		return $_db->fetch_single($query);
	}
	
	public function getAllCostCenters($mode) {
		global $_db;
		
		$query	= "SELECT 
						`id` as '#',
						`datetime` as 'Date Created',
						(SELECT `name` FROM `companies` WHERE `active` = 1 AND `id` = `cost_centers`.`company_id`) as 'Companies',
						`name` as 'Cost Centers'
					FROM
						`cost_centers`
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

