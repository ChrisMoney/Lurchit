<?php

use Stripe\Stripe;

require_once('../stripe/lib/Stripe.php');

$env = $_POST['ENV'];

if ($env == 'PROD') {
    $apiKey = '';
}
else {
    $apiKey = 'sk_test_vIPPNnvSWP7yrSn22KcMa43800U1AJE85L';
}

$amount = $_POST['Amount'];
//$currency = $_POST['Currency'];

$ccNumber = $_POST['CCNumber'];
$expMonth = $_POST['ExpMonth'];
$expYear = $_POST['ExpYear'];
$cvc = $_POST['CVC'];

$stripeToken = array("ccNumber"=>$ccNumber, "cvc"=>$cvc, "expMonth"=>$expMonth, "expYear"=>$expYear);

Stripe::setApiKey($apiKey);

try {
        Stripe::create(array("amount" => $amount,
            "currency" => "usd",
            "source" => $stripeToken));
        $status = 200;
}
catch (Exception $e) {
    //$status = $e->getMessage();
    $status = 400;
}

echo http_response_code($status);