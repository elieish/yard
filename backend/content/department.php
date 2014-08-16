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
	}

	function profile() {
		
		# Global Variables
		global $_db;
		
		# Get GET Data
		$department_id													= Form::get_int('id');
		$emplo_id														= Form::get_int('emp');
 
		#Get Data
		$listing														= (!empty($emplo_id))?employee::listing_by_department_employee($department_id,$emplo_id):employee::listing_by_department($department_id);
		
		
		#Create New Objects
		$objdep															= new department($department_id);
		$objcom															= new Company($objdep->company_id);
		$objcost														= new CostCenter($objdep->cost_center_id);
		
		# Generate HTML
		$file															= dirname(dirname(dirname(__FILE__)))."/frontend/html/employee/list.html";
		$vars															= array(
																					"company_name"		=> $objcom->name,
																					"costcenter_name"	=> $objcost->name,
																					"department_name"	=> $objdep->name,
																					"listing"			=> $listing,
																					"costcenter_link"	=> "?p=costcenter&action=profile&id={$objcost->id}",	
																					"add_link"			=> "?p=employee&action=add&id={$objcom->id}&co={$objcost->id}&dep={$objdep->id}",
																					"message"           => getMessage()
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
		$co																= Form::get_int('co');
		$dep															= Form::get_int('dep');
		
		# Create new Cost Center Object
		$objCost														= new CostCenter($co);
		
		# Create new Company Object
		$objCo															= new Company($uid);
		
		# Create new Department Object
		$obj															= new department($dep);
	
		# Generate HTML
		$vars															= array(
																					"form"				=> $obj->item_form($this->cur_page."&action=save&id={$co}"),
																					"company"			=> $objCo->name,
																					"costcenter"		=> $objCost->name,
																					"costcenter_link"	=> "?p=costcenter&action=profile&id={$uid}",
																				);
		
		$file															= dirname(dirname(dirname(__FILE__)))."/frontend/html/department/add.html";
		
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
	
		# Get GET Data
		$costcenter_id													= Form::get_int("id");
		
		# Get POST Data
		$department_id													= Form::get_int("uid");
		$department_name												= Form::get_str("department_name");
		
		#create cost center object
		$objcost														= new CostCenter($costcenter_id);
		
		# Create new Object
		$obj															= new department($department_id);
		$obj->user														= get_user_uid();
		$obj->datetime													= now();
		$obj->company_id												= $objcost->company_id;
		$obj->name														= $department_name;
		$obj->cost_center_id											= $costcenter_id;
		$obj->active													= 1;
		
		# Save Company
		$obj->save();
	
		# Redirect
		redirect("?p=costcenter&action=profile&id={$costcenter_id}");
	}

	function delete() {
			
		# Global Variables
		global $_db, $validator;
	
		# Get GET Data
		$uid															= Form::get_int("id");
	
		# Create Cost Center Object
		$department														= new department($uid);
	
		# Delete From Database
		$department->delete();
	
		# Redirect
		redirect("?p=costcenter&action=profile&id={$department->company_id}");
	}
	
}

# =========================================================================
# THE END
# =========================================================================
