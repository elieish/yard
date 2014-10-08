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

        // Generate HTML from Template
        $file    = dirname(dirname(dirname(__FILE__))) . "/frontend/html/dashboard/dashboard.html";
        $vars    = array(
            "link"    => "?p=user_controller&action=display",
            "listing" => $listing
        );

        $template = new Template($file, $vars);
        $html     = $template->toString();

        print $html;
    }

}

# =========================================================================
# THE END
# =========================================================================
