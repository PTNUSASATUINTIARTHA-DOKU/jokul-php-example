<?php
require_once "vendor/autoload.php";
header("Content-Type:application/json");

$arr = json_decode(file_get_contents("php://input"), true);

//Setup Parameter
$params = array(
    'customerEmail' => $arr["email"],
    'customerName' => $arr["customerName"],
    'amount' => $arr["amount"],
    'invoiceNumber' => random_strings(20),
    'expiryTime' => $arr["expiredTime"],
    'info1' => $arr["info1"],
    'info2' => $arr["info2"],
    'info3' => $arr["info3"],
    'reusableStatus' => $arr["reusableStatus"]
);

$dokuClient = new DOKU\Client;

// setup Config
$dokuClient->setClientID($arr["clientId"]);
$dokuClient->setSharedKey($arr["sharedKey"]);
$dokuClient->isProduction(false);

//GenerateVa
if ($arr["channel"] == "dokuva") {
    $obj_response = $dokuClient->generateDokuVa($params);
} else if ($arr["channel"] == "mandiri") {
    $obj_response = $dokuClient->generateMandiriVa($params);
} else if ($arr["channel"] == "mandiri-syariah") {}


if (isset($obj_response) && !isset($obj_response['error'])) {
    echo json_encode($obj_response);
    die;
} else {
    http_response_code(404);
    die;
}


function random_strings($length_of_string)
{
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    return substr(
        str_shuffle($str_result),
        0,
        $length_of_string
    );
}
