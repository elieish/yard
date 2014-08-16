<?php
/**
 * AME Fax: Billing Import Script
 *
 * @author Ralfe Poisson <ralfepoisson@gmail.cm>
 * @version 2.0
 * @package Project
 */

//-----------------------------------------------------------------------
// Script Settings
//-----------------------------------------------------------------------

// Include Required Scripts
include_once(dirname(dirname(__FILE__)) . "/framework/include.php");
Application::include_models();
Application::include_helpers();
Application::db_connect();

// Paths
if (DEBUG) {
    $spoolDir     = dirname(dirname(dirname(__FILE__))) . '/tests/billing';
    $completedDir = dirname(dirname(dirname(__FILE__))) . '/tests/billing/complete';
    $tmpDir       = dirname(dirname(dirname(__FILE__))) . '/tests/tmp';
    $tmpFile      = $tmpDir . '/itemisedbilling.tmp';
    $csvFile      = '';
} else {
    $spoolDir     = "/var/spool/amefax/Maildir/new";
    $completedDir = "/var/spool/amefax/Maildir/cur";
    $tmpDir       = '/tmp';
    $tmpFile      = $tmpDir . '/itemisedbilling.tmp';
    $csvFile      = '';
}

// Search Directory
$files = readDirectory($spoolDir, array('complete'));

if (count($files) > 0) {
    foreach ($files as $file) {

        $fileContents = readFileContents($spoolDir . '/' . $file);
        $messageId    = 1;

        foreach ($fileContents as $message) {
            // Find the boundary string
            $matches = array();

            if (preg_match('#Content-Type: multipart\/[^;]+;\s*boundary="([^"]+)"#i', $message, $matches) != null) {
                list(, $boundary) = $matches;
            } else {
                logg("Fax Billing: Unable to extract boundaries from message #{$messageId}.");
            }

            // Split e-mail by boundary string
            $emailSegments = explode('--'. $boundary, $message);

            // Drop everything before the first boundary
            array_shift($emailSegments);

            foreach ($emailSegments as $segment) {
                if (
                    stristr($segment, "Content-Type: text/csv") !== false ||
                    stristr($segment, "Content-Type: application/octet-stream") !== false ||
                    stristr($segment, "Content-Type: application/zip") !== false
                ) {
                    $text = trim(
                        preg_replace(
                            '/Content-(Type|ID|Description|Disposition|Transfer-Encoding):.*?\n/is',
                            "",
                            $segment
                        )
                    );

                    break;
                }
            }

            // Testing for creation & modification date (hack)
            // @todo Alter regular expression to remove these two lines
            $text = explode("\n", $text);
            $numLines = 0;

            if (strstr($text[0], 'creation-date') || strstr($text[0], 'name')) {
                $numLines = 1;
            }

            if (strstr($text[0], 'modification-date') || stristr($text[1], 'filename')) {
                $numLines = 2;
            }

            // Slice array, remove whitespace and decode.
            $text       = array_slice($text, $numLines);
            $text       = trim(implode("\n", $text));
            $base64File = base64_decode($text);

            $fh = fopen($tmpFile, 'w');

            if ($fh) {
                fwrite($fh, $base64File);
                fclose($fh);
            } else {
                logg("Fax Billing: Unable to open {$tmpFile} to write decoded file. Exiting...");

                exit;
            }

            // Verifying file type
            $finfo    = finfo_open(FILEINFO_MIME_TYPE);
            $fileType = finfo_file($finfo, $tmpFile);
            finfo_close($finfo);

            logg("Fax Billing: Attachment detected as {$fileType}");

            if ($fileType == 'application/zip') {
                $zip = new ZipArchive;
                $res = $zip->open($tmpFile);

                if ($res === true) {
                    logg("> Attachment opened successfully. Preparing to extract...");

                    $stats       = $zip->statIndex(1);
                    $zipFileName = $stats['name'];
                    $zipFileSize = $stats['size'];

                    logg("> Zip Status: {$zip->status}");
                    logg(" > System Status of Zip: {$zip->statusSys}");
                    logg(" > Number of files in zip: {$zip->numFiles}");
                    logg(" > Name in file system: {$zip->filename}");
                    logg(" > Comment: {$zip->comment}");
                    logg("> File Name: {$zipFileName}");
                    logg("> File Size: {$zipFileSize}");

                    if ($zip->extractTo($tmpDir, $zipFileName)) {
                        logg("> File Extracted Sucessfully.");
                    } else {
                        logg("> Unable to extract file from zip.");
                    }

                    $zip->close();
                } else {
                    logg("> Unable to open attachment. Reason: " . $res . ". Exiting...");
                    exit;
                }
            } else {
                logg("Unable to detect zip file. Moving file out the way...");

                if ($fileType == 'inode/x-empty') {
                    if (!rename($spoolDir . '/' . $file, $completedDir . '/' . $file)) {
                        logg("Fax Billing: Unable to move file. Please move or delete manually");
                    }
                }

                exit;
            }

            $filesize = filesize($tmpDir .'/'. $zipFileName);

            if ($filesize > 0) {
                logg("Fax Billing: Parsing CSV file...");

                $rowNotFound = 0;
                $rowFound    = 0;
                $rows        = 0;
                $columns      = array();

                $fh = fopen($tmpDir .'/'. $zipFileName, 'r');

                if ($fh) {
                    while (($data = fgetcsv($fh, 1000, ",")) !== false) {

                        // Dynamic Column Mapping
                        if ($rows == 0) {
                            $numCols = count($data);

                            for ($c = 0; $c < $numCols; $c++) {
                                $columns[] = trim($data[$c]);
                            }

                            // Switch Key/Value Pairs
                            $columns = array_flip($columns);
                        }

                        // Assign Row Values according to dynamic column mapping
                        $referenceNumber = trim($data[$columns['ISRef']]);
                        $duration        = trim($data[$columns['Duration']]);
                        $pages           = trim($data[$columns['Pages']]);
                        $cost            = trim($data[$columns['Cost']]);
                        $subject         = trim($data[$columns['Subject']]);

                        // Skip first record
                        if ($referenceNumber != 'ISRef') {
                            $cost = number_format($cost / 100, 2);

                            // Find fax record
                            $query  = "SELECT * FROM `exim_logs` WHERE `fax_reference` = '{$referenceNumber}'";
                            $record = $_db->fetch_one($query);

                            if (!empty($record->fax_reference)) {

                                logg("Fax Billing: Updating Fax with Reference number {$referenceNumber}");
                                logg("Fax Billing: > Cost: {$cost}");
                                logg("Fax Billing: > Pages: {$pages}");
                                logg("Fax Billing: > Duration: {$duration}");

                                $_db->update(
                                    'exim_logs',
                                    array(
                                        'cost'          => $cost,
                                        'pages'         => $pages,
                                        'transmit_time' => $duration,
                                        'subject'       => $_db->link->real_escape_string($subject)
                                    ),
                                    array(
                                        'uid' => $record->uid
                                    )
                                );

                                $rowFound++;
                            } else {
                                $rowNotFound++;
                                logg("Fax Billing: No record found for Fax with Reference number {$referenceNumber}");
                            }
                        }

                        $rows++;
                    }

                    // Remove header count
                    $rows--;

                    logg("Fax Billing: Billing Import complete. Cleaning up...");

                    // Remove Temp CSV & File
                    unlink($tmpDir .'/'. $zipFileName);
                    unlink($tmpFile);

                    logg("Fax Billing: \033[0;33mFound {$rows} records to process.\033[0m");
                    logg("Fax Billing > \033[1;32m{$rowFound} were found and updated\033[0m");
                    logg("Fax Billing > \033[1;31m{$rowNotFound} were not found.\033[0m");
                } else {
                    logg("Fax Billing: Unable to read file!");
                    exit;
                }

                logg("Fax Billing: Moving Message {$messageId} to {$completedDir}/{$file}");

                // Move
                if (!rename($spoolDir . '/' . $file, $completedDir . '/' . $file)) {
                    logg("Fax Billing: Unable to move file to {$completedDir}");
                }

                $messageId++;
            } else {
                logg("Fax Billing > Incorrect file size detected: {$zipFileSize}");
            }
        }
    }
} else {
    logg("Fax Billing: No Billing Reports to import.");
}

logg("Fax Billing: Done.");

function readDirectory($path, $ignore)
{
    $data = array();

    if ($handle = opendir($path)) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != ".." && !in_array($entry, $ignore)) {
                $data[] = $entry;
            }
        }

        closedir($handle);
    }

    return $data;
}

function readFileContents($path)
{
    if (file_exists($path)) {

        logg("Fax Billing: Reading file contents...");

        $contents = file_get_contents($path);
        $messages = explode('\n.', $contents);

        foreach ($messages as $message) {
            if (strlen($message) > 500) {
                $data[] = $message;
            }
        }

        $totalMessages = count($data);

        logg("Fax Billing: Found {$totalMessages} messages to process.");

        return $data;
    }
}