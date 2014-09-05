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

class Local extends Model {

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
        $this->table       = "locals";

        # Initialize UID from Parameter
        $this->uid         = $uid;
        if ($uid) {
            $this->load();
        }
    }

    function item_form($action) {
        # Create Form Object
        $form                                                           = new Form($action, "POST", "company_form");

        # Generate Form - Lead
        $form->add(""                           , "hidden"          , "uid"                 , $this->uid);
        $form->add("Name"                       , "text"            , "company_name"        , $this->name);
        $form->add(""                           , "submit"          , ""                    , "Save");

        # Generate HTML
        $html                                                           = $form->generate();

        # Return HTML
        return $html;
    }

    public function getTotalCompanies() {
        global $_db;

        $query = "SELECT COUNT(*) FROM `companies` WHERE `active` = 1";

        return $_db->fetch_single($query);
    }

    public function getAllCompanies($mode) {
        global $_db;

        $query  = "SELECT
                        `uid` as '#',
                        `datetime` as 'Date Created',
                        `name` as 'Companies'
                    FROM
                        `companies`
                    WHERE
                        `active` = 1
                    ORDER BY `name` ASC";

        $listing                                                    = ($mode=="list")?paginated_listing($query):$_db->fetch($query);
        return $listing;
    }

    public function listing($district)
    {
        global $_db;
        # Get Data
        $query          = " SELECT
                            `uid`,
                            `name`
                        FROM
                            `locals`
                        WHERE `district_id` = '{$district}'
                            ";
        $data           = $_db->fetch($query);

        return $data;

    }


    public function get_id($district) {
        global $_db;

        return $_db->fetch_single("SELECT `uid` FROM  `districts` WHERE `code` = '{$district}'");
    }



}

# ==========================================================================================
# THE END
# ==========================================================================================

