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
	
		# Get Data
		$listing														= Company::listing();
		
		# Generate HTML
		$file															= dirname(dirname(dirname(__FILE__)))."/frontend/html/companies/list.html";
		$vars															= array(
																					"listing"	=> $listing,
																					"add_link"	=> $this->cur_page."&action=add",
																				
																				);
		$template														= new Template($file,$vars);
		$html															= $template->tostring();
		
		# Display HTML
		Print $html;
		
		
	}

	function profile() {
		
		# Global Variables
		global $_db;
		
		# Get Company ID
		$company_id														= Form::get_int('id');
		
		#Get Data
		$listing														= CostCenter::listing_by_company($company_id);
		
		#Create New Object
		$obj															= new Company($company_id);
		
		# Generate HTML
		$file															= dirname(dirname(dirname(__FILE__)))."/frontend/html/cost_center/list.html";
		$vars															= array(
																					"company_name"	=> $obj->name,
																					"listing"		=> $listing,
																					"add_link"		=> "?p=costcenter&action=add&id={$company_id}"
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
	
		# Create new Company Object
		$obj															= new Company($uid);
	
		# Generate HTML
		$vars															= array(
																					"form"	=> $obj->item_form($this->cur_page."&action=save")
																				);
		
		$file															= dirname(dirname(dirname(__FILE__)))."/frontend/html/companies/add.html";
		
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
		$company_id														= Form::get_int("uid");
		$company_name													= Form::get_str("company_name");
		
		
		# Create new Object
		$obj															= new Company($company_id);
		$obj->user														= get_user_uid();
		$obj->datetime													= now();
		$obj->name														= $company_name;
		$obj->active													= 1;
		
		# Save Company
		$obj->save();
	
		# Redirect
		redirect("{$this->cur_page}&action=display");
	}

	function delete() {
		# Global Variables
		global $_db, $validator;
	
		# Get GET Data
		$uid															= Form::get_int("id");
	
		# Create Company Object
		$company														= new Company($uid);
	
		# Delete From Database
		$company->delete();
	
		# Redirect
		redirect($this->cur_page);
	}
	
}

# =========================================================================
# THE END
# =========================================================================
