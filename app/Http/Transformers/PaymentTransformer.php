<?php

namespace App\Http\Transformers;

use App\Models\Payment;

class PaymentTransformer extends Transformer
{
    protected $availableIncludes = [  ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(Payment $payment)
    {
        $this->hidden && $payment->addHidden($this->hidden);
        return $payment->attributesToArray();
    }

    
}
