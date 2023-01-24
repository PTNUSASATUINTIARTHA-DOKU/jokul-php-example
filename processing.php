<?php
require_once "vendor/autoload.php";
require_once "vendor/autoload.php";
header("Content-Type:application/json");

$arr = json_decode(file_get_contents("php://input"), true);

//Setup Parameter VA
$paramsVa = array(
    'customerEmail' => $arr["email"],
    'customerName' => $arr["customerName"],
    'amount' => $arr["amount"],
    'invoiceNumber' =>  $arr["invoiceNumber"],
    'expiryTime' => $arr["expiredTime"],
    'info1' => $arr["info1"],
    'info2' => $arr["info2"],
    'info3' => $arr["info3"],
    'reusableStatus' => $arr["reusableStatus"]
);

//Setup Parameter CC
$order_data = array();
$order_data[] = array('price' => $arr["amount"], 'quantity' => '1', 'name' => 'item1', 'sku' => '123457890', 'category' => 'php-library', 'url' => 'https://www.doku.com/');
$paramsCc = array(
    'customerId' => 'ID-123456',
    'customerEmail' => $arr["email"],
    'customerName' => $arr["customerName"],
    'phone' => $arr["phoneNumber"],
    'country' => 'ID', //'ID' in english
    'invoiceNumber' => $arr["invoiceNumber"],
    'amount' => $arr["amount"],
    'lineItems' => $order_data,
    'urlFail' => 'https://www.google.com',
    'urlSuccess' => 'https://www.doku.com',
    'language' => "ID", //'ID' in english
    'backgroundColor' => '',
    'fontColor' => '',
    'buttonBackgroundColor' => '',
    'address' => $arr["address"],
    'buttonFontColor' => ''
);

//Setup Parameter Emoney
$invoiceNumber =  $arr["invoiceNumber"];
$ovoId = '081211111111';
$checkSum = hash('sha256', $arr["amount"].$arr["clientId"].$invoiceNumber.$ovoId.$arr["sharedKey"]);
$paramsEmoney = array(
    'customerEmail' => $arr["email"],
    'customerName' => $arr["customerName"],
    'phone' => $arr["phoneNumber"],
    'country' => $arr["country"],
    'invoiceNumber' => $invoiceNumber ,
    'amount' => $arr["amount"],
    'lineItems' => $order_data,
    'urlFail' => 'https://www.google.com',
    'callbackUrl' => 'https://www.doku.com',
    'expiredTime' => $arr["expiredTime"],
    'clientId' => $arr["clientId"],
    'checkSum' => $checkSum,
    'ovoId' => $ovoId,
    'notifyUrl' => 'https://www.doku.com',
    'channel' => $arr["channel"]
);

$dokuClient = new DOKU\Client;

// Setup Config
$dokuClient->setClientID($arr["clientId"]);
$dokuClient->setSharedKey($arr["sharedKey"]);
$dokuClient->isProduction(false); // Sandbox environment. For example project only.

// Generate VA based on channel chosen
if ($arr["channel"] == "dokuva") {
    doku_log("Params Request ", 'PHP-Library Request : ' . json_encode($paramsVa, JSON_PRETTY_PRINT), $arr["channel"]);
    $obj_response = $dokuClient->generateDokuVa($paramsVa);
} else if ($arr["channel"] == "bankmandiriva") {
    doku_log("Params Request ", 'PHP-Library Request : ' . json_encode($paramsVa, JSON_PRETTY_PRINT), $arr["channel"]);
    $obj_response = $dokuClient->generateMandiriVa($paramsVa);
} else if ($arr["channel"] == "bcava") {
    doku_log("Params Request ", 'PHP-Library Request : ' . json_encode($paramsVa, JSON_PRETTY_PRINT), $arr["channel"]);
    $obj_response = $dokuClient->generateBcaVa($paramsVa);
} else if ($arr["channel"] == "bsiva") {
    doku_log("Params Request ", 'PHP-Library Request : ' . json_encode($paramsVa, JSON_PRETTY_PRINT), $arr["channel"]);
    $obj_response = $dokuClient->generateBsiVa($paramsVa);
} else if ($arr["channel"] == "briva") {
    doku_log("Params Request ", 'PHP-Library Request : ' . json_encode($paramsVa, JSON_PRETTY_PRINT), $arr["channel"]);
    $obj_response = $dokuClient->generateBriVa($paramsVa);
} else if ($arr["channel"] == "creditcard") {
    doku_log("Params Request ", 'PHP-Library Request : ' . json_encode($paramsCc, JSON_PRETTY_PRINT), $arr["channel"]);
    $obj_response = $dokuClient->generateCreditCard($paramsCc);
} else if ($arr["channel"] == "shopeepay") {
    doku_log("Params Request ", 'PHP-Library Request : ' . json_encode($paramsEmoney, JSON_PRETTY_PRINT), $arr["channel"]);
    $obj_response = $dokuClient->generateShopeePay($paramsEmoney);
} else if ($arr["channel"] == "ovo") {
    doku_log("Params Request ", 'PHP-Library Request : ' . json_encode($paramsEmoney, JSON_PRETTY_PRINT), $arr["channel"]);
    $obj_response = $dokuClient->generateOvo($paramsEmoney);
} else if ($arr["channel"] == "dw") {
    doku_log("Params Request ", 'PHP-Library Request : ' . json_encode($paramsEmoney, JSON_PRETTY_PRINT), $arr["channel"]);
    $obj_response = $dokuClient->generateDokuWallet($paramsEmoney);
}

doku_log("Data Responses ", 'PHP-Library Response : ' . json_encode($obj_response, JSON_PRETTY_PRINT), $arr["channel"]);

if (isset($obj_response) && !isset($obj_response['error'])) {
    echo json_encode($obj_response);
    die;
} else {
    http_response_code(404);
    die;
}

function doku_log($class, $log_msg, $invoice_number = '')
{
    $log_filename = "doku_log";
    $log_header = date(DATE_ATOM, time()) . ' ' . 'Data ' . '---> ' . $invoice_number . " : ";
    if (!file_exists($log_filename)) {
        // create directory/folder uploads.
        mkdir($log_filename, 0777, true);
    }
    $log_file_data = $log_filename . '/log_' . date('d-M-Y') . '.log';
    // if you don't add `FILE_APPEND`, the file will be erased each time you add a log
    file_put_contents($log_file_data, $log_header . $log_msg . "\n", FILE_APPEND);
}
