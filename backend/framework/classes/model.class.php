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

class Model {
	
	# --------------------------------------------------------------------------------------
	# ATTRIBUTES
	# --------------------------------------------------------------------------------------
	
	var $table;
	var $fields;
	var $uid;
	var $uid_field;
	
	# --------------------------------------------------------------------------------------
	# METHODS
	# --------------------------------------------------------------------------------------
	
	/**
	 * Constructor
	 * 
	 * Initialise default values for Model attributes 
	 */
	function __construct() {
		# Initialise Variables
		$this->table													= "";
		$this->fields													= array();
		$this->id														= 0;
		$this->id_field												= "uid";
	}
	
	/**
	 * Exists
	 * 
	 * Given the UID, this function checks to see if the object exists in the database
	 */
	function exists() {
		# Global Variables
		global $_db;
		
		# Confirm UID Field
		$this->id_field												= ($this->id_field)? $this->id_field : "uid";
		
		# Check if Object exists in Database
		if ($this->id && $this->table) {
			$query														= "	SELECT
																				COUNT(*)
																			FROM
																				`{$this->table}`
																			WHERE
																				`{$this->id_field}` = '{$this->id}'
																			";
			$exists														= $_db->fetch_single($query);
			
			# Return True if exists
			if ($exists) {
				return true;
			}
		}
		
		# Return False
		return false;
	}
	
	/**
	 * Load
	 * 
	 * Loads the object from a record in a database table
	 */
	function load() {
		# Global Variables
		global $_db;
		
		# Load Attributes
		$this->get_attributes();
		
		# Check if Object exists in Database
		if ($this->exists()) {
			# Get Data
			$query														= "	SELECT
																				*
																			FROM
																				`{$this->table}`
																			WHERE
																				`{$this->id_field}` = '{$this->id}'
																			";
			$data														= $_db->fetch_one($query);
			
			# Load Data
			$data_bits													= get_object_vars($data);
			foreach ($data_bits as $key => $value) {
				$this->$key												= $value;
			}
		}
	}
	
	function get_attributes() {
		# Global Variables
		global $_db;
		
		# Get Attributes from Database Table
		if ($this->table) {
			# Get Data
			$query														= "DESCRIBE `{$this->table}`";
			$data														= $_db->fetch($query);
			
			# Dynamically Create Object Attributes
			$this->fields												= array();
			foreach ($data as $item) {
				$key													= $item->Field;
				$this->$key												= (isset($this->$key))? $this->$key : "";
				$this->fields[]											= $key;
			}
		}
	}
	
	/**
	 * Save
	 * 
	 * Inserts/Updates object in the database
	 */
	function save() {
		# Global Variables
		global $_db;
		
		# Get Attributes
		$this->get_attributes();
		
		# Construct Associative array to pass to database object
		$data															= array();
		foreach ($this->fields as $field) {
			if (!($field == "uid")) {
				$data[$field]											= $this->$field;
			}
		}
		
		# If object exists in database, update it
		if ($this->exists()) {
			$_db->update(
				$this->table,
				$data,
				array(
					"{$this->id_field}" => $this->id
				)
			);
		}
		
		# If the object does not exist, and the table is set, insert it
		else if ($this->table) {
			$this->id													= $_db->insert(
				$this->table,
				$data
			);
		}
	}
	
	/**
	 * Disables the row in the table by setting the active field to 0
	 */
	function delete() {
		# Global Variables
		global $_db;
		
		# Disable
		$_db->disable($this->table, $this->id);
	}
	
	public function get($filters="") {
		# Global Variables
		global $_db;
		
		# Generate Where Conditions from Filters
		$conditions														= $this->filter_clauses($filters);
		
		# Get Data
		$query															= "	SELECT
																				`{$this->id_field}`
																			FROM
																				`{$this->table}`
																			WHERE
																				{$conditions}
																			";

		$data															= $_db->fetch($query);
		
		# Generate array of objects
		$objects														= array();
		$class 															= get_class($this);
		foreach ($data as $item) {
			$obj_class													= new ReflectionClass($class);
			$obj														= $obj_class->newInstanceArgs(array($item->id));
			$objects[]													= $obj;
		}
		
		# Return Objects
		return $objects;
	}
	
	private function filter_clauses($filters) {
		# Local Variables
		$where															= "";
		
		# Generate Where Clause
		if (strlen($filters)) {
			$data														= explode(",", trim($filters));
			foreach ($data as $item) {
				$components												= explode(" ", trim($item));
				$field													= "`{$components[0]}`";
				$operator												= $components[1];
				$value													= "\"{$components[2]}\"";
				$where													.= (strlen($where))? " AND" : "";
				$where													.= " {$field} {$operator} {$value} ";
			}
		}
		
		# Return Where Clause
		return $where;
	}
	
	public function from_sql($sql) {
		# Global Variables
		global $_db;
		
		# Get Data
		$data															= $_db->fetch($sql);
		
		# Compile Array of Objects
		$results														= array();
		$class 															= get_class($this);
		foreach ($data as $item) {
			$obj_class													= new ReflectionClass($class);
			$obj														= $obj_class->newInstanceArgs(array($item->id));
			$results[]													= $obj;
		}
		
		# Return Array of Objects
		return $results;
	}
}

# ==========================================================================================
# THE END
# ==========================================================================================
