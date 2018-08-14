<?php

namespace App\Modules\ProductProvider\Transformers;

use App\Modules\ProductProvider\Models\ProductProviderPayment;
use App\Modules\Scaffold\Transformer;

class ProductProviderPaymentTransformer extends Transformer
{
    protected $availableIncludes = [ 'payment','balance' ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(ProductProviderPayment $payment)
    {
        $this->hidden && $payment->addHidden($this->hidden);
        return $payment->attributesToArray();
    }

    public function includeBalance(ProductProviderPayment $payment)
    {
        return $this->item($payment->balance, new BalanceTransformer());
    }

    public function includePayment(ProductProviderPayment $payment)
    {
        return $this->item($payment->payment, new PaymentTransformer());
    }


}
