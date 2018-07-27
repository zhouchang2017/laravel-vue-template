<?php

namespace App\Modules\ProductProvider\Transformers;

use App\Modules\ProductProvider\Models\Payment;
use App\Modules\Scaffold\Transformer;

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
