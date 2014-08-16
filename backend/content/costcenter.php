<?php
/**
 * Project
 * 
 * @author Ralfe Poisson <ralfepoisson@gmail.com>
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
		
		# Get Costcenter ID
		$costcenter_id													= Form::get_int('id');
	
		#Get Data
		$listing														= department::listing_by_costcenter($costcenter_id);
		
		#Create New Object Cost Center
		$objco															= new CostCenter($costcenter_id);
		
		#Create New Object Company
		$obj															= new Company($objco->company_id);
		
		# Generate HTML
		$file															= dirname(dirname(dirname(__FILE__)))."/frontend/html/department/list.html";
		$vars															= array(
																					"company_name"		=> $obj->name,
																					"costcenter_name"	=> $objco->name,
																					"listing"			=> $listing,
																					"add_link"			=> "?p=department&action=add&id={$objco->company_id}&co={$objco->uid}"
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
	
		# Create new Cost Center Object
		$objCost														= new CostCenter($co);
		
		# Create new Company Object
		$objCo															= new Company($uid);
	
		# Generate HTML
		$vars															= array(
																					"form"		=> $objCost->item_form($this->cur_page."&action=save&id={$uid}"),
																					"company"	=> $objCo->name
																				);
		
		$file															= dirname(dirname(dirname(__FILE__)))."/frontend/html/cost_center/add.html";
		
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
	
		# Get GET Dat
		$company_id														= Form::get_int("id");
		
		# Get POST Data
		$costcenter_id													= Form::get_int("uid");
		$costcenter_name												= Form::get_str("costcenter_name");
		
		# Create new Object
		$obj															= new CostCenter($costcenter_id);
		$obj->user														= get_user_uid();
		$obj->datetime													= now();
		$obj->company_id												= $company_id;
		$obj->name														= $costcenter_name;
		$obj->active													= 1;
		
		# Save Company
		$obj->save();
	
		# Redirect
		redirect("?p=companies&action=profile&id={$company_id}");
	}

	function delete() {
			
		# Global Variables
		global $_db, $validator;
	
		# Get GET Data
		$uid															= Form::get_int("id");
	
		# Create Cost Center Object
		$costcenter														= new CostCenter($uid);
	
		# Delete From Database
		$costcenter->delete();
	
		# Redirect
		redirect("?p=companies&action=profile&id={$costcenter->company_id}");
	}
	
}

# =========================================================================
# THE END
# =========================================================================
