<?php
/**
 * Project
 *
 * @author Elie Ishimwe <elieish@gmail.com>
 * @version 1.0
 * @package Project
 */

# ==========================================================================================
# CLASS
# ==========================================================================================

class Egroup extends Model {

	# --------------------------------------------------------------------------------------
	# ATTRIBUTES
	# --------------------------------------------------------------------------------------

	var $y;

	# --------------------------------------------------------------------------------------
	# METHODS
	# --------------------------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * Set the Table and the UID of the object.
	 *
	 * @param $uid Integer: The Unique Identifier of the object.
	 */
	function __construct($uid=0) {
		# Set Table
		$this->table													= "enterprise_groups";

		# Initialize UID from Parameter
		$this->uid														= $uid;
		if ($uid) {
			$this->load();
		}
	}

	function item_form($action) {
		# Create Form Object
		$form															= new Form($action, "POST", "group_form");

		# Generate Form - Lead
		$form->add(""							, "hidden"			, "uid"					, $this->uid);
		$form->add("Name"						, "text"			, "group"		, $this->name);
		$form->add(""							, "submit"			, ""					, "Save");

		# Generate HTML
		$html															= $form->generate();

		# Return HTML
		return $html;
	}

	public function listing() {

		#Global Variables
		global $_db;

		# Get Data
		$query															= "	SELECT
																				`uid` as '#',
																				CONCAT('<a href=\"{$this->cur_page}&action=profile&id=', `uid`, '\">', `group`, '</a>') as 'Group name',
																				CONCAT('<a href=\"{$this->cur_page}&action=add&id=', `uid`, '\"><i class=\"icon-edit\"></i></a>\t<a href=\"{$this->cur_page}&action=delete&id=', `uid`, '\"><i class=\"icon-trash\"></i></a>') as 'Actions'
																			FROM
																				`enterprise_groups`
																			WHERE
																				`active` = 1
																			ORDER BY
																				`group`
																			";

		$listing														= paginated_listing($query);


		return $listing;
	}

	public function getTotalGroups() {
		global $_db;

		$query = "SELECT COUNT(*) FROM `enterprise_groups` WHERE `active` = 1";

		return $_db->fetch_single($query);
	}

	public function getAllGroups($mode) {
		global $_db;

		$query	= "SELECT
						`uid` as '#',
						`group` as 'Group'
					FROM
						`enterprise_groups`
					WHERE
						`active` = 1
					ORDER BY `group` ASC";

		$listing													= ($mode=="list")?paginated_listing($query):$_db->fetch($query);
		return $listing;
	}
	
	public function get_id($group) {
        global $_db;

        return $_db->fetch_single("SELECT `uid` FROM  `enterprise_groups` WHERE `group` = '{$group}'");
    }

}

# ==========================================================================================
# THE END
# ==========================================================================================

