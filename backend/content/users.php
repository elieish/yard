<?php
/**
 * Intranet
 * 
 * @author Elie Ishimwe <elieish@gmail.com>
 * @version 2.0
 * @package Project
 */

# =========================================================================
# PAGE CLASS
# =========================================================================

class Page extends AbstractPage {
    
    //-----------------------------------------------------------------------
    // View
    //-----------------------------------------------------------------------
    
    function display() {

        //Get Listing
        $listing = user::get_all_users();
        
        // Generate HTML from Template
        $file    = dirname(dirname(dirname(__FILE__))) . "/frontend/html/users/list.html";
        $vars    = array(
            "link"    => $this->cur_page."&action=add", 
            "listing" => $listing
        );

        $template = new Template($file, $vars);
        $html     = $template->toString();

        print $html;
    }
    
    function add() {
      
        # Generate Object
        $obj      = new User();                                                                  
        # Generate HTML from Template
        $file     = dirname(dirname(dirname(__FILE__))) . "/frontend/html/users/add.html";
        $vars     = array(
                        "form"    => $obj->form($this->cur_page)
                    );
        $template = new Template($file, $vars);
        $html     = $template->toString();
                                                                                    
        # Display HTML
        print $html;
    }

   

    
    function profile() {
        $user_id = Form::get_int("id");
        $tab     = Form::get_str('tab');
        
        // Create Object
        $obj = new User($user_id);
        // Generate HTML from Template
        $file = dirname(dirname(dirname(__FILE__))) . "/frontend/html/users/profile.html";
        $vars = array(
            "name"                  => $obj->first_name . " " . $obj->last_name,
            "first_name"            => $obj->first_name,
            "last_name"             => $obj->last_name,
            "form"                  => $obj->form($this->cur_page),
            "js"                    => $js
        );

        $template = new Template($file, $vars);
        $html     = $template->toString();
        
        print $html;
    }
    
    //-----------------------------------------------------------------------
    // Processing Functions
    //-----------------------------------------------------------------------
    
    function save() {
        // Get UID
        $uid = intval($_POST['uid']);
        
        // Create Object
        $obj = new User($uid);
        
        // Update Values
        $obj->username   = Form::get_str('username');
        $obj->password   = md5(Form::get_str('password'));
        $obj->first_name = Form::get_str('first_name');
        $obj->last_name  = Form::get_str('last_name');
        $obj->email      = Form::get_str('email');
        $obj->mobile     = Form::get_str('mobile');
        $obj->tel        = Form::get_str('tel');
        $obj->fax        = Form::get_str('fax');
   
        # Handle Password Update
        if (strlen($_POST['password'])) {
            $obj->password = md5($_POST['password']);
        }
        
        # Handle New Object
        if (!$uid) {
            $obj->datetime = now();
            $obj->user     = get_user_uid();   
            $obj->active   = 1;
        }
        
        # Save
        $obj->save();
        
        # Redirect
        redirect($this->cur_page);
    }
    
    function delete() {
        # Get UID
        $uid                                                            = intval($_POST['id']);
        
        # Create Object
        $obj                                                            = new User($uid);
        
        # Get Redirect URL
        $url                                                            = $this->cur_page;
        
        # Delete Object
        $obj->delete();
        
        # Redirect
        redirect($url);
    }
    
}

# =========================================================================
# THE END
# =========================================================================
