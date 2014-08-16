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
		
		# Generate HTML
		$file															= dirname(dirname(dirname(__FILE__))) . "/frontend/html/home.html";
		
		$companies   = new Company();
		$costCenter  = new CostCenter();
		$departments = new Department();
		$employees   = new Employee();

		$vars = array(
			'companiesCount'  => "<a href='?p=export_all&action=exportlist&type=company'>". $companies->getTotalCompanies() ."</a>",
			'costCenterCount' => "<a href='?p=export_all&action=exportlist&type=cost'>". $costCenter->getTotalCostCenters() ."</a>",
			'departmentCount' => "<a href='?p=export_all&action=exportlist&type=department'>". $departments->getTotalDepartments() ."</a>",
			'employeeCount'   => "<a href='?p=export_all&action=exportlist&type=employee'>". $employees->getTotalEmployees() ."</a>"
		);
		$template														= new Template($file, $vars);
		$html															= $template->toString();
		
		# Display HTML
		print $html;
	}
	
	function table() {
		# Global Variables
		global $_db;
		
		# Generate HTML
		$file															= dirname(dirname(dirname(__FILE__))) . "/frontend/html/table.html";
		$vars															= array(
																					
																				);
		$template														= new Template($file, $vars);
		$html															= $template->toString();
		
		# Display HTML
		print $html;
	}
	
	function form() {
		# Global Variables
		global $_db;
		
		# Generate HTML
		$file															= dirname(dirname(dirname(__FILE__))) . "/frontend/html/form.html";
		$vars															= array(
																					
																				);
		$template														= new Template($file, $vars);
		$html															= $template->toString();
		
		# Display HTML
		print $html;
	}
	
	function calendar() {
		# Global Variables
		global $_db;
		
		# Generate HTML
		$file															= dirname(dirname(dirname(__FILE__))) . "/frontend/html/calendar.html";
		$vars															= array(
																					
																				);
		$template														= new Template($file, $vars);
		$html															= $template->toString();
		
		# Display HTML
		print $html;
	}
	
	function colour_picker() {
		# Global Variables
		global $_db;
		
		# Generate HTML
		$file															= dirname(dirname(dirname(__FILE__))) . "/frontend/html/colour_picker.html";
		$vars															= array(
																					
																				);
		$template														= new Template($file, $vars);
		$html															= $template->toString();
		
		# Display HTML
		print $html;
	}
	
	# =========================================================================
	# PROCESSING FUNCTIONS
	# =========================================================================
	
}

# =========================================================================
# THE END
# =========================================================================
