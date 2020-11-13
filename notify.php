<?php
require_once "vendor/autoload.php";

$headers = getallheaders();
$raw_notification = json_decode(file_get_contents('php://input'), true);

//notify
$dokuNotify = new DOKU\Service\Notification();
$signature = \DOKU\Common\Utils::generateSignature($headers, file_get_contents('php://input'), 'SK-hCJ42G28TA0MKG9LE2E_1');
if ($signature == $headers['Signature']) {
    $response = json_encode($dokuNotify->getNotification($raw_notification));
    //manage the response as you need. ex : 
    //using amount = echo $response['order']['amount'];
    echo $response;
} else {
    //return 400 to DOKU
    http_response_code(400);
    $response = json_encode($dokuNotify->getNotification($raw_notification));
    echo $response;
}
error_log("====== Notify result From Doku =========", 3, "/var/tmp/my-errors.log");
error_log(json_encode($response, JSON_PRETTY_PRINT), 3, "/var/tmp/my-errors.log");


header('Content-type:application/json;charset=utf-8');
