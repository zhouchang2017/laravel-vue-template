<?php

namespace App\Http\Transformers;

use App\Models\ProductProviderPayment;

class ProductProviderPaymentTransformer extends Transformer
{
    protected $availableIncludes = [ 'balance', 'payment' ];

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
