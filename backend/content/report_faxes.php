<?php
/**
 * Project
 *
 * @author Ralfe Poisson <ralfepoisson@gmail.com>
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
    function display() {
        global $_db;

        $start_date     = (Form::get_str("start_date"))?        Form::get_str("start_date")         : date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 7, date("Y")));
        $end_date       = (Form::get_str("end_date"))?          Form::get_str("end_date")           : date("Y-m-d");
        $company_id     = Form::get_int("company_id");
        $company        = ($company_id)?                        " AND c.`uid` = {$company_id}"      : "";
        $cost_center_id = Form::get_int("cost_center_id");
        $cost_center    = ($cost_center_id)?                    " AND cc.`uid` = {$cost_center_id}" : "";
        $department_id  = Form::get_int("department_id");
        $department     = ($department_id)?                     " AND d.`uid` = {$department_id}"   : "";

        # Generate Listing
        $query = "SELECT
                        l.`date`            as 'Date/Time',
                        c.`name`            as 'Company',
                        cc.`name`           as 'Cost Center',
                        d.`name`            as 'Department',
                        l.`sender`          as 'From',
                        l.`fax_no`          as 'To',
                        l.`pages`           as 'Pages',
                        l.`retries`         as 'Retries',
                        l.`fax_reference`   AS 'Ref. No.',
                        SEC_TO_TIME(l.`transmit_time`)  as 'Transmit Time',
                        l.`status`          as 'Status',
                        l.`cost`            as 'Cost'
                    FROM
                        `exim_logs`     l,
                        `companies`     c,
                        `cost_centers`  cc,
                        `departments`   d,
                        `employees`     e
                    WHERE
                        e.`email`       = l.`sender` AND
                        d.`uid`         = l.`department` AND
                        cc.`uid`        = l.`cost_center` AND
                        c.`uid`         = l.`company` AND
                        l.`date` BETWEEN '{$start_date} 00:00:00' AND '{$end_date} 23:59:59' AND
                        e.`active` = 1
                        {$company}
                        {$cost_center}
                        {$department}
                        GROUP BY l.`uid`
                    ORDER BY
                        l.`date` DESC
        ";

        $num_records = get_query_count($query);
        $listing     = ($num_records == 0)
            ? "No records found matching criteria selected"
            : paginated_listing($query, "?p=report_faxes");

        // Generate HTML
        $file = dirname(dirname(dirname(__FILE__))) . "/frontend/html/report.html";
        $vars = array(
            "listing"            => $listing,
            "start_date"         => $start_date,
            "end_date"           => $end_date,
            "company_id"         => $company_id,
            "cost_center_id"     => $cost_center_id,
            "department_id"      => $department,
            "company_select"     => generate_select("company_id", company_select(), $company_id),
            "cost_center_select" => generate_select("cost_center_id", cost_center_select($company_id), $cost_center_id),
            "department_select"  => generate_select("department_id", department_select($company_id, $cost_center_id), $department_id)
        );

        $template = new Template($file, $vars);
        $html     = $template->toString();

        print $html;
    }

    function export() {
        global $_db;

        // Get Filters
        $start_date = (Form::get_str("start_date"))
            ? Form::get_str("start_date")
            : date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 7, date("Y")));

        $end_date       = (Form::get_str("end_date")) ? Form::get_str("end_date") : date("Y-m-d");
        $company_id     = Form::get_int("company_id");
        $company        = ($company_id) ? " AND c.`uid` = {$company_id}" : "";
        $cost_center_id = Form::get_int("cost_center_id");
        $cost_center    = ($cost_center_id) ? " AND cc.`uid` = {$cost_center_id}" : "";
        $department_id  = Form::get_int("department_id");
        $department     = ($department_id) ? " AND d.`uid` = {$department_id}" : "";

        // Generate Listing
        $query = "SELECT
                        l.`date`            as 'Date/Time',
                        c.`name`            as 'Company',
                        cc.`name`           as 'Cost Center',
                        d.`name`            as 'Department',
                        l.`sender`          as 'From',
                        l.`fax_no`          as 'To',
                        l.`pages`           as 'Pages',
                        l.`retries`         as 'Retries',
                        l.`transmit_time`   as 'Transmit Time',
                        l.`status`          as 'Status',
                        l.`cost`            as 'Cost'
                    FROM
                        `exim_logs`     l,
                        `companies`     c,
                        `cost_centers`  cc,
                        `departments`   d,
                        `employees`     e
                    WHERE
                        e.`email`       = l.`sender` AND
                        d.`uid`         = l.`department` AND
                        cc.`uid`        = l.`cost_center` AND
                        c.`uid`         = l.`company` AND
                        `date` BETWEEN '{$start_date} 00:00:00' AND '{$end_date} 23:59:59' AND
                        e.`active` = 1
                        {$company}
                        {$cost_center}
                        {$department}
                    GROUP BY l.`uid`
        ";

        $data = $_db->fetch($query);

        # Export to File
        $dir      = dirname(dirname(dirname(__FILE__))) . "/frontend/files/";
        $url_base = "files/";
        $filename = "fax_export_" . date("Ymd") . ".csv";

        $f = fopen($dir . $filename, "w") or die("Could not write to {$dir}{$filename}.");

        foreach ($data as $item) {
            $vars = get_object_vars($item);
            $line = "";

            foreach ($vars as $key => $val) {
                $line .= (strlen($line))? "," : "";
                $line .= "\"{$val}\"";
            }

            fputs($f, $line . "\n");
        }

        fclose($f);

        $breadcrumb = "?p=report_faxes&start_date={$start_date}&end_date={$end_date}&company_id={$company_id}";
        $breadcrumb .= "&cost_center_id={$cost_center_id}&department_id={$department_id}";

        # Generate HTML
        $file                                                           = dirname(dirname(dirname(__FILE__))) . "/frontend/html/report_export.html";
        $vars                                                           = array(
                                                                                    "link" => $url_base . $filename,
                                                                                    "breadcrumb" => $breadcrumb
                                                                                );
        $template                                                       = new Template($file, $vars);
        $html                                                           = $template->toString();

        # Display HTML
        print $html;
    }

    # =========================================================================
    # PROCESSING FUNCTIONS
    # =========================================================================

}