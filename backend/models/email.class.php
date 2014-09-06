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

class Email extends Model {

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
        $this->table         = "emails";

        # Initialize UID from Parameter
        $this->uid           = $uid;
        if ($uid) {
            $this->load();
        }
    }

    function item_form($action) {
        # Create Form Object
        $form      = new Form($action, "POST", "email_form");

        # Generate Form - Lead
        $form->add(""   , "hidden", "uid", $this->uid);
        $form->add("To" , "text" , "receiver" , "");
        $form->add("Subject" , "text" , "subject" , "");
        $form->add("Message" , "textarea" , "message" , "");
        $form->add("", "submit" , ""  , "Send Email");

        # Generate HTML
        $html        = $form->generate();

        # Return HTML
        return $html;
    }

    public function getTotalInbox($receiver) {
        global $_db;

        $query = "SELECT COUNT(*) FROM `emails` WHERE `active` = 1 AND `receiver` = '{$receiver}' AND `read` = 0";
        $total = $_db->fetch_single($query);
        return ($total <> 0)?$total : '0';
    }

    public function getEmailListing($uid)
    {
        global $_db;

        $query = " SELECT
                        (SELECT
                                CONCAT(`first_name`, ' ', `last_name`)
                        FROM
                            `users`
                        WHERE
                            `uid` = e.`user_id`
                        ) as 'Sender',

                        `subject` as 'Subject',
                        `created_at`as 'Datetime Sent'
                    FROM
                        `emails` e
                    WHERE
                        `active` = 1
                        AND `receiver` = '{$uid}'
                    ORDER BY `created_at` DESC
                    ";
        return paginated_listing($query);
    }

}

# ==========================================================================================
# THE END
# ==========================================================================================

