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