<?php

require_once "vendor/autoload.php";

$params = array(
    'clientId' => '123-abc',
    'customerEmail' => 'taufik@doku.com',
    'customerName' => 'Taufik Ismail',
    'amount' => 105.00,
    'invoiceNumber' => 'MINV20201123149977',
    'sharedKey' => 'chUnKr1nkZ',
    'environment' => 'development'
);

$dokuClient->setClientID($_POST["clientId"]);
$dokuClient->setSharedKey($_POST["sharedKey"]);
$dokuClient->isProduction();

//GenerateVa
$obj_response = $dokuClient->generateMandiriVa($params);
