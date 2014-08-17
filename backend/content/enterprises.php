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
		$listing				= Enterprise::listing();
		
		# Generate HTML
		$file															= dirname(dirname(dirname(__FILE__)))."/frontend/html/enterprises/list.html";
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
		
		# Get Enterprise ID
		$enterprise_id														= Form::get_int('id');
		
		#Get Data
		//$listing														= Enterprise::listing();
		
		#Create New Object
		$obj															= new Enterprise($enterprise_id);
		
		# Generate HTML
		$file															= dirname(dirname(dirname(__FILE__)))."/frontend/html/enterprises/profile.html";
		$vars															= array(
																					"name"			=> $obj->name,
																					"form"          => $obj->item_form($this->cur_page),
            																		"js"            => $js,
																					"add_link"		=> "?p=enterprises&action=add&id={$enterprise_id}"
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
	
		# Create new Enterprise Object
		$obj															= new Enterprise($uid);
		# Generate HTML
		$vars															= array(
																					"form"	=> $obj->item_form($this->cur_page."&action=save")
																				);	
		
		$file															= dirname(dirname(dirname(__FILE__)))."/frontend/html/enterprises/add.html";
		
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
		$enterprise_id														= Form::get_int("uid");
		$name															= Form::get_str("name");
		
		
		# Create new Object
		$obj															= new Enterprise($enterprise_id);
		$obj->user														= get_user_uid();
		$obj->datetime													= now();
		$obj->name														= $name;
		$obj->group_id													= Form::get_str("group_id");
		$obj->member_id													= Form::get_str("member_id");
		$obj->active													= 1;
		
		# Save Enterprise
		$obj->save();
	
		# Redirect
		redirect("{$this->cur_page}&action=display");
	}

	function delete() {
		# Global Variables
		global $_db, $validator;
	
		# Get GET Data
		$uid															= Form::get_int("id");
	
		# Create Enterprise Object
		$enterprise														= new Enterprise($uid);
	
		# Delete From Database
		$enterprise->delete();
	
		# Redirect
		redirect($this->cur_page);
	}
	
}

# =========================================================================
# THE END
# =========================================================================
