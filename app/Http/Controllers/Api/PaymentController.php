<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Transformers\PaymentTransformer;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(Payment $model, PaymentTransformer $transformer)
    {
        parent::__construct($model, $transformer);
    }

}
