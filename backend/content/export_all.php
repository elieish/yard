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
	
	function exportlist() {
		#Global Variables
		global $_db;
		
		$type															= Form::get_str('type');	
		
		$results														= "";
		
		switch($type) {
			case "company":
				$results												= company::getAllCompanies("list");
				break;
			case "cost":
				$results												= CostCenter::getAllCostCenters("list");
				break;
			case "department":
				$results												= department::getAllDepartments("list");
				break;
			case "employee":
				$results												= employee::getAllEmployees("list");
				break;
		
		}											
		# Generate HTML
		$file															= dirname(dirname(dirname(__FILE__))) . "/frontend/html/exportlist.html";
		
		
		$vars															= array(
																				"listing"	=> $results,
																				"link"		=>$this->cur_page."&action=export&type=".$type,
																					
																				);
		$template														= new Template($file, $vars);
		$html															= $template->toString();
		
		# Display HTML
		print $html;														
	}
	
	function export() {
		# Global Variables
		global $_db;
		
		$type															= Form::get_str('type');
			
		switch($type) {
			case "company":
				$data													= company::getAllCompanies();
				$header													= "#,Date Created,Companies\n";
				break;
			case "cost":
				$data													= CostCenter::getAllCostCenters();
				$header													= "#,Date Created,Companies,Cost Centers\n";
				break;
			case "department":
				$data													= department::getAllDepartments();
				$header													= "#,Date Created,Companies,Cost Centers,Departments\n";
				break;
			case "employee":
				$data													= employee::getAllEmployees();
				$header													= "#,Date Created,Companies,Cost Centers,Departments,Employees,Email Addresses\n";
				break;
		
		}	
				
		# Export to File
		$dir															= dirname(dirname(dirname(__FILE__))) . "/frontend/files/";
		$url_base														= "files/";
		$filename														= "export_" . date("Ymd") .rand(). ".csv";
		$f																= fopen($dir . $filename, "w") or die("Could not write to {$dir}{$filename}.");
		fputs($f,$header);
		foreach ($data as $item) {
			$vars														= get_object_vars($item);
			$line														= "";
			foreach ($vars as $key => $val) {
				$line													.= (strlen($line))? "," : "";
				$line													.= $val;
			}
			fputs($f, $line . "\n");
		}
		fclose($f);
		
		# Generate HTML
		$file															= dirname(dirname(dirname(__FILE__))) . "/frontend/html/all_export.html";
		$vars															= array(
																					"link"		=> $url_base . $filename
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
