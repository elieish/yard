<?php
/**
 * Project
 * 
 * @author Elie Ishimwe <elieish@gmail.com>
 * @version 2.0
 * @package Project
 */

# ==========================================================================================
# FUNCTIONS
# ==========================================================================================

/*
	To simplify the creation of Drop-down boxes (select tags), use the generate_select_values()
	function. The syntax is as follows:
	
	generate_select_values($table_name, $id_field, $label_field);
*/

function company_select() {
	return generate_select_values("companies", "uid", "name", "", "name");
}

function cost_center_select($company=0) {
	$where = ($company)? "company_id = {$company}" : "";

	return generate_select_values("cost_centers", "uid", "name", $where, "name");
}

function department_select($cost_center=0, $company=0) {
	$where = ($cost_center)? "cost_center_id = {$cost_center}" : $where;

	return generate_select_values("departments", "uid", "name", $where, "name");
}

function title_select($flag,$selected_value) {
	# Global Variables
	global $_db;
	
	# Get Data
	$query			= "	SELECT
							`uid`,
							`title`
						FROM
							`titles`
							";
	$data			= $_db->fetch($query);


		foreach ($data as $item) {

			if($selected_value == $item->uid)
			{
				
				$array			.= "<option selected value={$item->uid}>{$item->title}</option>";
			}
			else
			{
				$array 			.= "<option  value={$item->uid}>{$item->title}</option>";
			}

			
		}

		return "<select class='form-control' name='title' id='title'><option value=0>Select One</option>{$array}</select>";
	
}

function province_select($flag,$selected_value) {
	# Global Variables
	global $_db;
	
	# Get Data
	$query			= "	SELECT
							`uid`,
							`province`
						FROM
							`provinces`
							";
	$data			= $_db->fetch($query);


		foreach ($data as $item) {

			if($selected_value == $item->id)
			{
				
				$array			.= "<option selected value={$item->uid}>{$item->province}</option>";
			}
			else
			{
				$array 			.= "<option  value={$item->uid}>{$item->province}</option>";
			}

			
		}

		return "<select class='form-control' name='province' id='province'><option value=0>Select One</option>{$array}</select>";
	
}



