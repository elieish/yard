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
		
		# Get Costcenter ID
		$costcenter_id													= Form::get_int('id');
		
		#Get Data
		$listing														= department::listing_by_costcenter($costcenter_id);
		
		#Create New Object
		$obj															= new Company($company_id);
		
		# Generate HTML
		$file															= dirname(dirname(dirname(__FILE__)))."/frontend/html/department/list.html";
		$vars															= array(
																					"company_name" => $obj->name,
																					"listing"      => $listing,
																					"add_link"     => "?p=costcenter&action=add&id={$company_id}",
																					"error_message"      => getMessage()
																				);
		$template														= new Template($file,$vars);
		$html															= $template->tostring();
		
		// Display HTML
		print $html;			
	}

	function add() {
			
		# Global Variables
		global $_db;
		
		#Get GET Data
		$uid															= Form::get_int('id');
		$co																= Form::get_int('co');
		$dep															= Form::get_int('dep');
		$emp															= Form::get_int('em');
		
		# Create new Department Object
		$objdep															= new department($dep);
	
		# Create new Cost Center Object
		$objCost														= new CostCenter($co);
		
		# Create new Company Object
		$objCo															= new Company($uid);
		
		#create new Employee Object
		$obj															= new employee($emp);
	
		# Generate HTML
		$vars															= array(
																					"form"				=> $obj->item_form($this->cur_page."&action=save&id={$dep}"),
																					"company"			=> $objCo->name,
																					"costcenter"		=> $objCost->name,
																					"department"		=> $objdep->name,
																					"costcenter_link"	=> "?p=costcenter&action=profile&id={$objCost->id}",
																					"department_link"	=> "?p=department&action=profile&id={$objdep->id}"
																				);
		
		$file															= dirname(dirname(dirname(__FILE__)))."/frontend/html/employee/add.html";
		
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
		$department_id													= Form::get_int("id");
		
		# Get POST Data
		$employee_id													= Form::get_int("uid");
		$employee_name													= Form::get_str("employee_name");
		$employee_email													= Form::get_str("employee_email");
		
		#create employee object
		$objdep															= new department($department_id);
		
		# Create new Object
		$obj															= new employee($employee_id);
		$employee_exists                                                = $obj->employeeExists($employee_email);

		if ($employee_id == '' && is_object($employee_exists)) {
			$tmp_company    = new Company($employee_exists->company_id);
			$tmp_costcenter = new CostCenter($employee_exists->cost_center_id);
			$tmp_department = new Department($employee_exists->department_id);

			$message = "{$employee_name} ({$employee_email}) already exists under {$tmp_company->name} / ";
			$message .= "{$tmp_costcenter->name} / {$tmp_department->name}. User has not been added!";

			setMessage($message, 'error');

			redirect("?p=department&action=profile&id={$department_id}");
		} else {
			$obj->user           = get_user_uid();
			$obj->datetime       = now();
			$obj->company_id     = $objdep->company_id;
			$obj->name           = $employee_name;
			$obj->email          = $employee_email;
			$obj->cost_center_id = $objdep->cost_center_id;
			$obj->department_id  = $department_id;
			$obj->active         = 1;
			
			// Save Company
			$obj->save();

			// Redirect
			redirect("?p=department&action=profile&id={$department_id}");
		}
	}

	function delete() {
			
		# Global Variables
		global $_db, $validator;
	
		# Get GET Data
		$uid															= Form::get_int("id");
	
		# Create employee Object
		$employee														= new employee($uid);
	
		# Delete From Database
		$employee->delete();
	
		# Redirect
		redirect("?p=department&action=profile&id={$employee->department_id}");
	}
	
}

# =========================================================================
# THE END
# =========================================================================
