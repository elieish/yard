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

function province_select() {
	# Global Variables
    global $_db;

    # Get Data
    $query   = "    SELECT
         					`uid`, `province`
                    FROM

         					`provinces`

     				WHERE

         					`active` = 1

     				ORDER BY

         					`province`";
    $data  = $_db->fetch($query);

    # Construct Values
    $values    = array();
    foreach ($data as $item) {
        $values[$item->uid]    = $item->province;
    }

    # Return Values
    return $values;
}

function title_select() {
	# Global Variables
    global $_db;

    # Get Data
    $query   = "    SELECT
         					`uid`, `title`
                    FROM

         					`titles`

     				WHERE

         					`active` = 1

     				ORDER BY

         					`title`";
    $data  = $_db->fetch($query);

    # Construct Values
    $values    = array();
    foreach ($data as $item) {
        $values[$item->uid]    = $item->title;
    }

    # Return Values
    return $values;
}

function sector_select() {
	# Global Variables
    global $_db;

    # Get Data
    $query   = "    SELECT
         					`uid`, `sector`
                    FROM

         					`sectors`

     				WHERE

         					`active` = 1

     				ORDER BY

         					`sector`";
    $data  = $_db->fetch($query);

    # Construct Values
    $values    = array();
    foreach ($data as $item) {
        $values[$item->uid]    = $item->sector;
    }

    # Return Values
    return $values;
}

function cost_center_select($company=0) {
	$where = ($company)? "company_id = {$company}" : "";

	return generate_select_values("cost_centers", "uid", "name", $where, "name");
}

function department_select($cost_center=0, $company=0) {
	$where = ($cost_center)? "cost_center_id = {$cost_center}" : $where;

	return generate_select_values("departments", "uid", "name", $where, "name");
}

function group_select() {
    # Global Variables
    global $_db;

    # Get Data
    $query   = "    SELECT
         					`uid`, `group`
                    FROM

         					`enterprise_groups`

     				WHERE

         					`active` = 1

     				ORDER BY

         					`group`";
    $data  = $_db->fetch($query);

    # Construct Values
    $values    = array();
    foreach ($data as $item) {
        $values[$item->uid]    = $item->group;
    }

    # Return Values
    return $values;
}
function member_select() {
    # Global Variables
    global $_db;

    # Get Data
    $query   = "    SELECT
         					`uid`, CONCAT(`name`,' ',`surname`) AS 'member'
                    FROM

         					`members`

     				WHERE

         					`active` = 1

     				ORDER BY

         					`name`, `surname`";
    $data  = $_db->fetch($query);

    # Construct Values
    $values    = array();
    foreach ($data as $item) {
        $values[$item->uid]    = $item->member;
    }

    # Return Values
    return $values;
}

function titles_select($flag,$selected_value) {
	# Global Variables
	global $_db;

	# Get Data
	$query			= "	SELECT
							`uid`,
							`title`
						FROM
							`titles`
                        WHERE `title` IN ('Mrs','Ms','Mr')
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

		return "<select class='form-control' name='title' id='title'><option value=''>Select One</option>{$array}</select>";

}

function provinces_select($flag,$selected_value) {
	# Global Variables
	global $_db;

	# Get Data
	$query			= "	SELECT
							`abreviation`,
							`province`
						FROM
							`provinces`
							";
	$data			= $_db->fetch($query);


		foreach ($data as $item) {

			if($selected_value == $item->id)
			{

				$array			.= "<option selected value={$item->abreviation}>{$item->province}</option>";
			}
			else
			{
				$array 			.= "<option  value={$item->uid}>{$item->province}</option>";
			}


		}

		return "<select class='form-control' name='province' id='province'><option value=''>Select One</option>{$array}</select>";

}

function province_id($abr) {
    # Global Variables
    global $_db;

    # Get Data
    $query   = "    SELECT
                            `uid`
                    FROM

                            `provinces`

                    WHERE

                            `abreviation` = '{$abr}'";
    $data  = $_db->fetch_single($query);

    # Return Values
    return $data;
}

function districts_select($province_code,$selected_value) {
    # Global Variables
    global $_db;

    $province_id      = Province::get_id($province_code);
    $data             = District::listing($province_id);


        foreach ($data as $item) {

            if($selected_value == $item->id)
            {

                $array          .= "<option selected value={$item->code}>{$item->name}</option>";
            }
            else
            {
                $array          .= "<option  value={$item->code}>{$item->name}</option>";
            }


        }

        return "<select class='form-control' name='district' id='district'><option value=''>Select One</option>{$array}</select>";

        return $data;

}

function district_id($code) {
    # Global Variables
    global $_db;

    # Get Data
    $query   = "    SELECT
                            `uid`
                    FROM

                            `districts`

                    WHERE

                            `code` = '{$code}'";
    $data  = $_db->fetch_single($query);

    # Return Values
    return $data;
}

function district_select() {
    # Global Variables
    global $_db;

    # Get Data
    $query   = "    SELECT
                            `uid`, `name`
                    FROM

                            `districts`

                    WHERE

                            `active` = 1

                    ORDER BY

                            `name`";
    $data  = $_db->fetch($query);

    # Construct Values
    $values    = array();
    foreach ($data as $item) {
        $values[$item->uid]    = $item->name;
    }

    # Return Values
    return $values;
}




