<?php
require_once "vendor/autoload.php";

// Mapping the notification received from Jokul
$notifyHeaders = getallheaders();
$notifyBody = json_decode(file_get_contents('php://input'), true); // You can use to parse the value from the notification body
$targetPath = '/notify.php'; // Put this value with your payment notification path
$secretKey = 'SK-OLXIhgLepNXegTyy26KB'; // Put this value with your Secret Key

// Prepare Signature to verify the notification authenticity
$signature = \DOKU\Common\Utils::generateSignature($notifyHeaders, $targetPath, file_get_contents('php://input'), $secretKey);

// Verify the notification authenticity
if ($signature == $notifyHeaders['Signature']) {
    http_response_code(200); // Return 200 Success to Jokul if the Signature is match
    // TODO update transaction status on your end to 'SUCCESS'
} else {
    http_response_code(401); // Return 401 Unauthorized to Jokul if the Signature is not match
    // TODO Do Not update transaction status on your end yet
}

header('Content-type:application/json;charset=utf-8');
