<?php
/**
* Process Fax Email
*
* Processes a single delivery receipt e-mail and rewrites the to fields as well as updates the database
* with relevant information for a fax that has been sent out.
*
* @category   AMEFax
* @package    Email
* @subpackage Process_Single_Fax
* @author     Bruce Pieterse <brucep@implyit.co.za>
* @copyright  2013 Copyright (c) Imply IT CC (http://www.implyit.co.za)
* @since      0.1
*/

include_once(dirname(dirname(__FILE__)) . '/framework/include.php');
// TODO Fix properly instead of supressing output
@Application::include_models();
@Application::db_connect();

global $_GLOBALS, $_db;

// Initiliaze Variables
$originalSender   = "";
$originalSubjcet  = "";
$statusText       = "";
$statusCode       = "";
$pages            = "";
$transmitTime     = "";
$ymdProcessedTime = "";
$retries          = "";
$toLocation       = "";
$subjectLocation  = "";
$messageID        = "";

if (DEBUG) {
    // Testing Paths
    $root = dirname(dirname(dirname(__FILE__)));
    define('ETRN_IN', $root . '/tests/etrn-in');
    define('ETRN_OUT', $root . '/tests/etrn-out');
    define('ETRN_PROCESSED', $root . '/tests/etrn-processed');
    define('TMP_DIR', $root .'/tests/tmp');
} else {
    // Live Paths
    define('ETRN_IN', '/var/spool/mail/etrn-in');
    define('ETRN_OUT', '/var/spool/mail/etrn-out');
    define('ETRN_PROCESSED', '/var/spool/mail/etrn-processed');
    define('TMP_DIR', '/tmp');
}

// Move file
$src    = ETRN_OUT . '/amefax.co.za';
$dst    = TMP_DIR . '/amefax.co.za-' . rand();
$errors = array();
$count  = 1;

if (moveFile($src,$dst)) {
    $mboxFiles = readFileContents($dst);

    if (count($mboxFiles) > 0) {
        foreach ($mboxFiles as $mboxFile) {
            
            $data     = array();
            $errors[] = array(
                'Sender'           => '',
                'Message'          => '',
                'RCPT TO'          => '',
                'To'               => '',
                'Reference Number' => '',
                'Status'           => '',
                'Pages'            => '',
                'Transmit Time'    => '',
                'Processed Time'   => '',
                'Retries'          => '',
            );
            
            logg("Fax Rewrite: Processing message #{$count}");

            $data = explode("\n", $mboxFile);
            
            // Remove blank line
            if ($data[0] == "") {
                $data = array_slice($data, 1);
            }

            //Extract Original Sender and Message ID
            $subjectLocation = loopExtract('Subject: [FAX', $data, 25, false);
            if (is_int($subjectLocation)) {

                // Replace Subject Line with original subject
                $subjectFound = false;
                $subjectLines = 0;
                $subject      = "";

                // Detect number of lines a subject is
                while (!$subjectFound) {
                    $subjectContent = $data[$subjectLocation + $subjectLines];

                    if (empty($subjectContent)) {
                        $subjectFound = true;

                        logg("Fax Rewrite: Subject found over {$subjectLines} lines.");
                    }

                    $subject         .= $subjectContent;
                    $originalSubject = $subject;

                    if (!empty($data[$subjectLocation + $subjectLines])) {
                        // Empty out content of array index to make way for new subject
                        $data[$subjectLocation + $subjectLines] = "";
                    } else {
                        // Remove extra blank line
                        unset($data[$subjectLocation + $subjectLines]); 
                    }

                    $subjectLines++;
                }

                logg("> Found Subject: {$subject}.");

                $subject                = trim(substr(strstr($subject, 'was: '), 4, -1));
                $data[$subjectLocation] = "  Subject: {$subject}";

                logg("> Extracted Subject: {$subject}");
                
                // Extract Original Senders E-Mail Address from the Subject
                if (strstr($subject, '[FAX ')) {
                    preg_match('/<(.*?)>/i', $subject, $originalSenderArray);
                } else {
                    preg_match('/<(.*?)>/i', $originalSubject, $originalSenderArray);
                }

                if (is_array($originalSenderArray)) {
                    $match          = (!empty($originalSenderArray[1])) ? $originalSenderArray[1] : 1;
                    $originalSender = $originalSenderArray[0];
                    $originalSender = trim(substr($originalSender, 1, -1));
                    
                    logg("> Original sender: {$originalSender}");
                    unset($errors[$mboxFile]['Sender']);
                } else {
                    $errorMessage                = 'Unable to extract Original Sender';
                    $errors[$mboxFile]['Sender'] = $errorMessage;

                    logg("Fax Rewrite: {$errorMessage}");
                }

                // Extract Message ID
                if (strstr($subject, '[FAX ')) {
                    $subjectArray = explode(" ", $subject);
                    $subjectPos   = 1;
                } else {
                    $subjectArray = explode(" ", $originalSubject);
                    $subjectPos   = 4;
                }
                
                if (!empty($subjectArray) && strlen($subjectArray[$subjectPos]) > 0) {
                    $messageID = trim($subjectArray[$subjectPos]);

                    logg("> Message ID: {$messageID}");
                    unset($errors[$mboxFile]['Message']);
                } else {
                    $errorMessage                 = 'Unable to extract Message ID';
                    $errors[$mboxFile]['Message'] = $errorMessage;

                    logg("Fax Rewrite: {$errorMessage}");
                }
            } else {
                $errorMessage                = 'Unable to extract Original Sender';
                $errors[$mboxFile]['Sender'] = $errorMessage;

                logg("Fax Rewrite: {$errorMessage}");
            }

            // Replace RCPT TO:
            if (strstr($data[1], 'RCPT TO:')) {
                $data[1] = str_replace('faxmaster@amefax.co.za', $originalSender, $data[1]);
                
                unset($errors[$mboxFile]['RCPT TO']);
            } else {
                $errorMessage                 = 'Unable to replace RCPT TO. Line not found.';
                $errors[$mboxFile]['RCPT TO'] = $errorMessage;

                logg("Fax Rewrite: {$errorMessage}");
            }

            // Replace To:
            $toLocation = loopExtract('To', $data, 14, false);

            if (is_int($toLocation)) {
                $data[$toLocation] = str_replace('faxmaster@amefax.co.za', "{$originalSender}", $data[$toLocation]);
                
                unset($errors[$mboxFile]['To']);
            } else {
                $errorMessage            = 'Unable to replace TO. Line not found.';
                $errors[$mboxFile]['To'] = $errorMessage;

                logg("Fax Rewrite: {$errorMessage}");
            }

            // Extract Fax Reference
            $faxReference = loopExtract('Fax reference', $data, 22);

            if (strlen($faxReference)) {
                $faxReferenceArray = explode(":", $faxReference);
                $faxReference      = trim(substr($faxReferenceArray[1], 0, strpos($faxReferenceArray[1], ']')));

                logg("> Fax Reference Number: {$faxReference}");
                unset($errors[$mboxFile]['Reference Number']);
            } else {
                $errorMessage                          = 'Unable to extract Reference Number. Line not found.';
                $errors[$mboxFile]['Reference Number'] = $errorMessage;

                logg("Fax Rewrite: {$errorMessage}");
            }

            // Extract Status
            $status = loopExtract('Status', $data, 19);
            
            if (strlen($status)) {
                // Extract Status Code
                $statusCode  = substr($status, 8, 5);
                // Extract Status Description
                $statusText  = substr($status, 14);
                
                logg("> Status: [{$statusCode}] [{$statusText}]");
            } else {
                $errorMessage                = "Unable to extract Status. Line not found.";
                $errors[$mboxFile]['Status'] = $errorMessage;

                logg("Fax Rewrite: {$errorMessage}");
            }

            // Pages
            $pages = loopExtract('Pages', $data);
            
            if (strlen($pages)) {
                $pages = substr($pages, 7);

                logg("> Pages: {$pages}");
                unset($errors[$mboxFile]['Pages']);
            } else {
                $errorMessage               = 'Unable to extract Pages. Line not found.';
                $errors[$mboxFile]['Pages'] = $errorMessage;

                logg("Fax Rewrite: {$errorMessage}");
            }

            // Extract Transmit Time
            $transmitTime = loopExtract('Transmit Time', $data);
            if (strlen($transmitTime)) {
                $transmitTime = substr($transmitTime, 22);
                
                logg("> Transmit Time: {$transmitTime}");
                unset($errors[$mboxFile]['Transmit Time']);
            } else {
                $errorMessage                       = 'Unable to extract Transmit Time. Line not found.';
                $errors[$mboxFile]['Transmit Time'] = $errorMessage;

                logg("Fax Rewrite: {$errorMessage}");
            }

            // Extract Processed Time
            $processedTime = loopExtract('Processed Time', $data);
            if (strlen($processedTime)) {
                $processedTime    = substr($processedTime, 16);
                $ymdProcessedTime = date('Y-m-d H:i:s', strtotime($processedTime));
                
                logg("> Processed Time: {$processedTime} => {$ymdProcessedTime}");
                
                unset($errors[$mboxFile]['Processed Time']);
            } else {
                $errorMessage                        = 'Unable to extract Processed Time. Line not found.';
                $errors[$mboxFile]['Processed Time'] = $errorMessage;

                logg("Fax Rewrite: {$errorMessage}");
            }

            // Extract Retries
            $retries = loopExtract('Retries', $data);
            if (strlen($retries)) {
                $retries = substr($retries, -1);

                logg("> Number of Retries: {$retries}");
                unset($errors[$mboxFile]['Retries']);
            } else {
                $errorMessage      = 'Unable to extract Number of Retries. Line not found.';
                $errors[$mboxFile]['Retries'] = $errorMessage;

                logg("Fax Rewrite: {$errorMessage}");
            }

            // Update Database record
            logg("Fax Rewrite: Updating fax record with Message ID {$messageID}");

            $factory = new EximLog();
            $entries = $factory->get("message_id = {$messageID}");

            if (count($entries)) {
                $entry = $entries[0];

                logg("Fax Rewrite: Found Fax Record with UID: {$entry->uid}");

                if ($entry->uid == 0) {
                    logg("Fax Rewrite: Warning, no record found. Possible error during initial forwarding of e-mail.");
                    
                    $message = implode($data, "\n");

                    if (DEBUG) {
                        logg($message);
                    }

                    mail(
                        "brucep@implyit.co.za", 
                        "AME Fax: Process Script Error", 
                        "Unable to find fax with message ID {$messageID}\r\n\r\n{$message}"
                    );
                }

                $entry->subject        = $_db->link->real_escape_string($entry->subject);
                $entry->fax_reference  = $faxReference;
                $entry->status         = $statusText;
                $entry->status_code    = $statusCode;
                $entry->pages          = $pages;
                $entry->transmit_time  = $transmitTime;
                $entry->date_processed = $ymdProcessedTime;
                $entry->retries        = $retries;
                $entry->save();
            } else {
                $message = implode($data, "\n");
                
                if (DEBUG) {
                    logg($message);
                }

                logg("Fax Rewrite: Unable to find a record with a Message ID of {$messageID}.");

                mail("brucep@implyit.co.za", "AME Fax: Process Script Error", $message);
            }
            
            logg("Fax Rewrite: Writing updated message to mbox file");
            writeFile(ETRN_PROCESSED .'/amefax.co.za', $data);

            logg("==========================================");

            $count++;
        }

        logg("Fax Rewrite: Removing temporary file..");
        deleteFile($dst);

        logg("Fax Rewrite: Compiling error report...");

        mailErrors($errors);

        logg("Fax Rewrite: Done");

        logg("==========================================");
    } else {
        logg("Fax Rewrite: File present but nothing to process.");
    }
}

//-----------------------------------------------------------------------
// Processing Functions
//-----------------------------------------------------------------------

function extractInfo($data, $startPos = null, $endPos = null) {
    $data = trim($data);
    $data = substr($data, $startPos);

    return $data;
}

function writeFile($dst, $data) {
    logg("Fax Rewrite: Appending message to processed directory");
    
    $fhandle = fopen($dst, 'a');
    
    foreach($data as $line) {
        fwrite($fhandle, $line ."\n");
    }

    fwrite($fhandle, ".\n");

    fclose($fhandle);
}

function deleteFile($file) {
    if (unlink($file)) {
        logg("Fax Rewrite: Original message deleted successfully.");
    } else {
        logg("Fax Rewrite: Unable to delete original message!", "WARNING");
    }
}

function readDirectory() {
    $data = array();

    if ($handle = opendir(ETRN_OUT)) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                $data[] = $entry;
            }
        }
        
        closedir($handle);
    }

    return $data;
}

function readFileContents($path) {
    if (file_exists($path)) {
        logg("Fax Rewrite: Reading file contents...");
        $contents = file_get_contents($path);

        $messages = explode("\n.", $contents);

        foreach ($messages as $message) {
            if (strlen($message) > 1000) {
                $data[] = $message;
            }
        }

        $totalMessages = count($data);

        logg("Fax Rewrite: Found {$totalMessages} messages to process.");

        return $data;
    }
}

function moveFile($src, $dst) {
    if (file_exists($src)) {
        if (rename($src, $dst)) {
            logg("Fax Rewrite: File moved to {$dst} successfully.");

            return true;
        } else {
            logg("Fax Rewrite: Unable to move file to {$dst}");

            return false;
        }
    } else {
        logg("Fax Rewrite: File does not exist or has already been processed.");

        return false;
    }
}

function mailErrors($errors) {
    $to      = 'brucep@implyit.co.za';
    $subject = 'Fax Rewrite Errors';
    $message = "The following errors occurred while processing certain files:\r\n\r\n";
    
    if (count($errors) > 0) {
        foreach ($errors as $file => $fileErrors) {
            if (is_array($fileErrors) && count($fileErrors) > 0) {
                $message .= "*Message {$file}* \r\n";

                foreach ($fileErrors as $key => $value) {
                    if (!empty($value)) {
                        $message .= "{$key}: {$value}\r\n";
                    }
                }
                
                $message .= "\r\n\r\n";
            }
        }

        if (strlen($message) > 83) {
            logg("Fax Rewrite: Sending e-mail");

            @mail($to, $subject, $message);
        }
    } else {
        logg("Fax Rewrite: No errors to e-mail!");
    }
}

/**
 * Loop Extract
 *
 * Loops over an array looking for a string within the array
 * 
 * @param  string  $needle   String to look for
 * @param  array   $haystack Array to search against
 * @param  integer $spos     Starting position of search
 * @param  boolean $string   Return the string found or line number
 * 
 * @return string|int        The matching string (trimmed), empty string if $haystack is not an array or 
 *                           integer where the string was found.
 */
function loopExtract($needle, $haystack, $spos = 30, $string = true) {
    $i = 0;

    if (is_array($haystack)) {
        foreach ($haystack as $line) {
            if ($i >= $spos && strstr($line, $needle)) {
                $line = trim($line);

                if ($string) {
                    return $line;
                } else {
                    return $i;
                }

            }

            $i++;
        }
    } else {
        return '';
    }
}