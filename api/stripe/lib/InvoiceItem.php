<?php

namespace Stripe;

/**
 * Class InvoiceItem
 *
 * @property string $id
 * @property string $object
 * @property int $amount
 * @property string $currency
 * @property string $customer
 * @property int $date
 * @property string $description
 * @property bool $discountable
 * @property string $invoice
 * @property bool $livemode
 * @property StripeObject $metadata
 * @property mixed $period
 * @property Plan $plan
 * @property bool $proration
 * @property int $quantity
 * @property string $subscription
 * @property string $subscription_item
 * @property array $tax_rates
 * @property int $unit_amount
 *
 * @package Stripe
 */

include_once('../stripe/lib/ApiResource.php');
include_once('../stripe/lib/ApiOperations/All.php');
include_once('../stripe/lib/ApiOperations/Create.php');
include_once('../stripe/lib/ApiOperations/Delete.php');
include_once('../stripe/lib/ApiOperations/Retrieve.php');
include_once('../stripe/lib/ApiOperations/Update.php');

class InvoiceItem extends ApiResource
{

    const OBJECT_NAME = "invoiceitem";

    use ApiOperations\All;
    use ApiOperations\Create;
    use ApiOperations\Delete;
    use ApiOperations\Retrieve;
    use ApiOperations\Update;
}
