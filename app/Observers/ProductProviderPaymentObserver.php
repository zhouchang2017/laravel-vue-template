<?php

namespace App\Observers;


use App\Models\ProductProviderPayment;
use Log;

class ProductProviderPaymentObserver
{

    public function created(ProductProviderPayment $payment)
    {
        Log::info('created payment id=' . $payment->id);
    }

}