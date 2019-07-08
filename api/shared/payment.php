<?php
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Token;

//require_once('../stripe/lib/init.php');

require_once('../stripe/lib/Account.php');
require_once('../stripe/lib/AccountLink.php');
require_once('../stripe/lib/AlipayAccount.php');
require_once('../stripe/lib/ApiRequestor.php');
require_once('../stripe/lib/ApiResource.php');
require_once('../stripe/lib/ApiResponse.php');
require_once('../stripe/lib/ApplePayDomain.php');
require_once('../stripe/lib/ApplicationFee.php');
require_once('../stripe/lib/ApplicationFeeRefund.php');
require_once('../stripe/lib/Balance.php');
require_once('../stripe/lib/BalanceTransaction.php');
require_once('../stripe/lib/BankAccount.php');
require_once('../stripe/lib/BitcoinReceiver.php');
require_once('../stripe/lib/BitcoinTransaction.php');
require_once('../stripe/lib/Capability.php');
require_once('../stripe/lib/Card.php');
require_once('../stripe/lib/Charge.php');
require_once('../stripe/lib/Collection.php');
require_once('../stripe/lib/CountrySpec.php');
require_once('../stripe/lib/Coupon.php');
require_once('../stripe/lib/CreditNote.php');
require_once('../stripe/lib/Customer.php');
require_once('../stripe/lib/Discount.php');
require_once('../stripe/lib/Dispute.php');
require_once('../stripe/lib/EphemeralKey.php');
require_once('../stripe/lib/Event.php');
require_once('../stripe/lib/ExchangeRate.php');
require_once('../stripe/lib/File.php');
require_once('../stripe/lib/FileLink.php');
require_once('../stripe/lib/FileUpload.php');
require_once('../stripe/lib/Invoice.php');
require_once('../stripe/lib/InvoiceItem.php');
require_once('../stripe/lib/InvoiceLineItem.php');
require_once('../stripe/lib/IssuerFraudRecord.php');
require_once('../stripe/lib/LoginLink.php');
require_once('../stripe/lib/OAuth.php');
require_once('../stripe/lib/Order.php');
require_once('../stripe/lib/OrderItem.php');
require_once('../stripe/lib/OrderReturn.php');
require_once('../stripe/lib/PaymentIntent.php');
require_once('../stripe/lib/PaymentMethod.php');
require_once('../stripe/lib/Payout.php');
require_once('../stripe/lib/Person.php');
require_once('../stripe/lib/Plan.php');
require_once('../stripe/lib/Product.php');
require_once('../stripe/lib/Recipient.php');
require_once('../stripe/lib/RecipientTransfer.php');
require_once('../stripe/lib/Refund.php');
require_once('../stripe/lib/RequestTelemetry.php');
require_once('../stripe/lib/Review.php');
require_once('../stripe/lib/SingletonApiResource.php');
require_once('../stripe/lib/SKU.php');
require_once('../stripe/lib/Source.php');
require_once('../stripe/lib/SourceTransaction.php');
require_once('../stripe/lib/Stripe.php');
require_once('../stripe/lib/StripeObject.php');
require_once('../stripe/lib/Subscription.php');
require_once('../stripe/lib/SubscriptionItem.php');
require_once('../stripe/lib/SubscriptionSchedule.php');
require_once('../stripe/lib/SubscriptionScheduleRevision.php');
require_once('../stripe/lib/TaxId.php');
require_once('../stripe/lib/TaxRate.php');
require_once('../stripe/lib/ThreeDSecure.php');
require_once('../stripe/lib/Token.php');
require_once('../stripe/lib/Topup.php');
require_once('../stripe/lib/Transfer.php');
require_once('../stripe/lib/TransferReversal.php');
require_once('../stripe/lib/UsageRecord.php');
require_once('../stripe/lib/Webhook.php');
require_once('../stripe/lib/WebhookEndpoint.php');
require_once('../stripe/lib/WebhookSignature.php');


$env = $_GET['ENV'];

if ($env == 'PROD') {
    $apiKey = 'sk_live_TCtpOjo5JLxcvb4CKtwc2jcZ00gR3a0j3o';
}
else {
    $apiKey = 'sk_test_vIPPNnvSWP7yrSn22KcMa43800U1AJE85L';
}

$amount = $_GET['Amount'];
$currency = 'usd';
$ccNumber = $_GET['CCNumber'];
$expMonth = $_GET['ExpMonth'];
$expYear = $_GET['ExpYear'];
$cvc = $_GET['CVC'];


$ccNumber = 4242424242424242;
$expMonth = 6;
$expYear = 2020;
$cvc = 314;


Stripe::setApiKey($apiKey);

$amount = $amount * 100;

Stripe::setVerifySslCerts(false);

$stripeToken = Token::create([
    'card' => [
        'number' => $ccNumber,
        'exp_month' => $expMonth,
        'exp_year' => $expYear,
        'cvc' => $cvc
    ]
]);

try {
    Charge::create(['amount' => $amount,
            'currency' => $currency,
            'description' => 'Lurchit Service',
            'source' => $stripeToken]);
        $status = 200;
}
catch (Exception $e) {
    $status = 400;
}

echo http_response_code($status); 