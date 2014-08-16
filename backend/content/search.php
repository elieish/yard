<?php
/**
 * Intranet
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
		# GLobal Variables
		global $_db;
		
		# Get Search String
		$search_string													= Form::get_str("search_string");
		$_SESSION['search_string']										= $search_string;
		
		# Search Companies
		$factory														= new Company();
		$companies														= $factory->from_sql("SELECT `uid` FROM `companies` WHERE `active` = 1 AND `name` LIKE \"%{$search_string}%\"");
		
		# Generate Results
		$results = "";
		foreach ($companies as $item) {
			# Prepare Result Variables
			$title														= $item->name;
			$link														= "?p=companies&action=profile&id=" . $item->uid;
			$type														= "Company";
			
			# Generate HTML from Template
			$results													.= $this->search_item($title, $link, $type);
		}
		

		# Search Cost Centers
		$cost_factory													= new CostCenter();
		$costcnts														= $cost_factory->from_sql("SELECT `uid` FROM `cost_centers` WHERE `active` = 1 AND `name` LIKE \"%{$search_string}%\"");
		
		# Generate Results
		foreach ($costcnts as $item) {
			# Prepare Result Variables
			$title														= $item->name;
			$link														= "?p=costcenter&action=profile&id=" . $item->uid;
			$type														= "Cost Center";
			
			# Generate HTML from Template
			$results													.= $this->search_item($title, $link, $type);
		}
		
		# Search Departments
		$dep_factory													= new department();
		$departments													= $dep_factory->from_sql("SELECT `uid` FROM `departments` WHERE `active` = 1 AND `name` LIKE \"%{$search_string}%\"");
		
		# Generate Results
		foreach ($departments as $item) {
			# Prepare Result Variables
			$title														= $item->name;
			$link														= "?p=department&action=profile&id=" . $item->uid;
			$type														= "Department";
			
			# Generate HTML from Template
			$results													.= $this->search_item($title, $link, $type);
		}
		
		# Search Employees
		$emp_factory													= new employee();
		$employees														= $emp_factory->from_sql("SELECT `uid` FROM `employees` WHERE `active` = 1 AND `name` LIKE \"%{$search_string}%\"");
		
		# Generate Results
		foreach ($employees as $item) {
			# Prepare Result Variables
			$title														= $item->name;
			$link														= "?p=employee&action=add&id=" . $item->company_id."&co=".$item->cost_center_id."&dep=".$item->department_id."&em=".$item->uid;
			$type														= "Employee";
			
			# Generate HTML from Template
			$results													.= $this->search_item($title, $link, $type);
		}
		# Generate HTML from Template
		$file															= dirname(dirname(dirname(__FILE__))) . "/frontend/html/search/search.html";
		$vars															= array(
																					"results"			=> $results,
																					"search_string"		=> $search_string
																				);
		$template														= new Template($file, $vars);
		$html															= $template->toString();
		
		# Display HTML
		print $html;
	}
	
	function search_item($title, $link, $type) {
		# Generate HTML from Template
		$file															= dirname(dirname(dirname(__FILE__))) . "/frontend/html/search/item.html";
		$vars															= array(
																					"title"				=> $title,
																					"link"				=> $link,
																					"type"				=> $type
																				);
		$template														= new Template($file, $vars);
		
		# Return HTML
		return $template->toString();
	}
	
	# =========================================================================
	# PROCESSING FUNCTIONS
	# =========================================================================
	
}

# =========================================================================
# THE END
# =========================================================================
