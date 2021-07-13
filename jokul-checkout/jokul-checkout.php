<?php

$input = json_decode(file_get_contents("php://input"), true);

$requestBody = array (
    'order' => array (
        'amount' => $input["amount"],
        'invoice_number' => 'INV-'.rand(1,10000), // Change to your business logic
        'currency' => 'IDR',
        'callback_url' => 'https://merchant.com/return-url',
        'line_items' => 
        array (
        0 => 
        array (
            'name' => 'DOKU Plate',
            'price' => $input["amount"],
            'quantity' => 1,
        ),
        ),
    ),
    'payment' => array (
        'payment_due_date' => $input["expiredTime"],
    ),
    'customer' => array (
        'id' => 'CUST-'.rand(1,1000), // Change to your customer ID mapping
        'name' => $input["customerName"],
        'email' => $input["email"],
        'phone' => $input["phoneNumber"],
        'address' => $input["address"],
        'country' => $input["country"],
    ),
);

$requestId = rand(1, 100000); // Change to UUID or anything that can generate unique value
$dateTime = gmdate("Y-m-d H:i:s");
$isoDateTime = date(DATE_ISO8601, strtotime($dateTime));
$dateTimeFinal = substr($isoDateTime, 0, 19) . "Z";
$clientId = $input["clientId"]; // Change with your Client ID
$secretKey = $input["sharedKey"]; // Change with your Secret Key

$getUrl = 'https://api-sandbox.doku.com';

$targetPath = '/checkout/v1/payment';
$url = $getUrl . $targetPath;

// Generate digest
$digestValue = base64_encode(hash('sha256', json_encode($requestBody), true));

// Prepare signature component
$componentSignature = "Client-Id:".$clientId ."\n".
                    "Request-Id:".$requestId . "\n".
                    "Request-Timestamp:".$dateTimeFinal ."\n".
                    "Request-Target:".$targetPath ."\n".
                    "Digest:".$digestValue;

// Generate signature
$signature = base64_encode(hash_hmac('sha256', $componentSignature, $secretKey, true));

// Execute request
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestBody));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Client-Id:' . $clientId,
    'Request-Id:' . $requestId,
    'Request-Timestamp:' . $dateTimeFinal,
    'Signature:' . "HMACSHA256=" . $signature,
));

// Set response json
$responseJson = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

// Echo the response
if (is_string($responseJson) && $httpCode == 200) {
    echo $responseJson;
    return json_decode($responseJson, true);
} else {
    echo $responseJson;
    return null;
}