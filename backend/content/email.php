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

        # Generate HTML
        $file   = dirname(dirname(dirname(__FILE__))) . "/frontend/html/home.html";


    }

    function save() {


        # Global Variables
        global $_db, $validator;


        # Get POST Data
        $receiver          = Form::get_str("receiver");

        if ($receiver == 3) {

           # Get all active Users UIDs
           $users = User::get_users_uids();

           foreach ($users as $value) {

            $subject           = Form::get_str("subject");
            $message           = Form::get_str("message");
            $obj               = new Email();
            $obj->created_at   = now();
            $obj->user_id      = get_user_uid();
            $obj->message      = $message;
            $obj->subject      = $subject;
            $obj->receiver     = $value->uid;
            $obj->active       = 1;

            //Save Email
            $obj->save();
           }

        }
        else {
            $subject           = Form::get_str("subject");
            $message           = Form::get_str("message");

            $obj               = new Email();
            $obj->created_at   = now();
            $obj->user_id      = get_user_uid();
            $obj->message      = $message;
            $obj->subject      = $subject;
            $obj->receiver     = $receiver;
            $obj->active       = 1;

            //Save Email
            $obj->save();


        }


            // Redirect
            redirect("?p=home");

    }

    function read_email(){

        # Global Variables
        global $_db, $validator;

        $listing    = Email::getEmailListing(get_user_uid());

        $file       = dirname(dirname(dirname(__FILE__)))."/frontend/html/emails/list.html";
        $vars       = array(
                            "listing"       => $listing,

                        );

        $template     = new Template($file,$vars);
        $html         = $template->tostring();

        # Display HTML
        Print $html;

    }


    # =========================================================================
    # PROCESSING FUNCTIONS
    # =========================================================================

}

# =========================================================================
# THE END
# =========================================================================
