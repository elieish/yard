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

class Company extends Model {
	
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
		$this->table													= "companies";
		
		# Initialize UID from Parameter
		$this->id														= $uid;
		if ($uid) {
			$this->load();
		}
	}
	
	function item_form($action) {
		# Create Form Object
		$form															= new Form($action, "POST", "company_form");
		
		# Generate Form - Lead
		$form->add(""							, "hidden"			, "uid"					, $this->id);
		$form->add("Name"						, "text"			, "company_name"		, $this->name);
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
																				`uid` as '#',
																				CONCAT('<a href=\"{$this->cur_page}&action=profile&id=', `uid`, '\">', `name`, '</a>') as 'Company name',
																				CONCAT('<a href=\"{$this->cur_page}&action=add&id=', `uid`, '\"><i class=\"icon-edit\"></i></a>\t<a href=\"{$this->cur_page}&action=delete&id=', `uid`, '\"><i class=\"icon-trash\"></i></a>') as 'Actions'
																			FROM
																				`companies`
																			WHERE
																				`active` = 1
																			ORDER BY
																				`name`																			
																			";
																			
		$listing														= paginated_listing($query);
		
		
		return $listing;
	}

	public function getTotalCompanies() {
		global $_db;

		$query = "SELECT COUNT(*) FROM `companies` WHERE `active` = 1";

		return $_db->fetch_single($query);
	}
	
	public function getAllCompanies($mode) {
		global $_db;
		
		$query	= "SELECT 
						`uid` as '#',
						`datetime` as 'Date Created',
						`name` as 'Companies'
					FROM
						`companies`
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

