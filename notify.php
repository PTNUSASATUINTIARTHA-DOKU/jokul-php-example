<?php
require_once "vendor/autoload.php";

// Mapping the notification received from Jokul
$notifyHeaders = getallheaders();
$notifyBody = json_decode(file_get_contents('php://input'), true); // You can use to parse the value from the notification body
$targetPath = '/jokul-php-example/notify.php'; // Put this value with your payment notification path
$secretKey = 'SK-wezfve6CA6t1pVmj6n11'; // Put this value with your Secret Key

doku_log("Notif Header ", 'PHP-Library $notifyBody : ' . file_get_contents('php://input'), 'Notification');

// Prepare Signature to verify the notification authenticity
$signature = \DOKU\Common\Utils::generateSignature($notifyHeaders, $targetPath, file_get_contents('php://input'), $secretKey);

// Verify the notification authenticity
if ($signature == $notifyHeaders['Signature']) {
    http_response_code(200); // Return 200 Success to Jokul if the Signature is match
    
    doku_log("Notif ", 'PHP-Library SIGNATURE MATCH 200', 'Notification');
    //TODO update transaction status on your end to 'SUCCESS'
} else {
   http_response_code(401); // Return 401 Unauthorized to Jokul if the Signature is not match
       doku_log("Notif ", 'PHP-Library SIGNATURE NOT MATCH 401', 'Notification');

    //TODO Do Not update transaction status on your end yetPHP-Library Notification digest
}

header('Content-type:application/json;charset=utf-8');

function doku_log($class, $log_msg, $invoice_number = '')
{
    $log_filename = "doku_log";
    $log_header = date(DATE_ATOM, time()) . ' ' . 'Notif ' . '---> ' . $invoice_number . " : ";
    if (!file_exists($log_filename)) {
        // create directory/folder uploads.
        mkdir($log_filename, 0777, true);
    }
    $log_file_data = $log_filename . '/log_' . date('d-M-Y') . '.log';
    // if you don't add `FILE_APPEND`, the file will be erased each time you add a log
    file_put_contents($log_file_data, $log_header . $log_msg . "\n", FILE_APPEND);
}
