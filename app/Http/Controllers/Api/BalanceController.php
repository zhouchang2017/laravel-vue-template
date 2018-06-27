<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\BalanceTransformer;
use App\Models\Balance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BalanceController extends Controller
{
    public function __construct(Balance $model, BalanceTransformer $transformer)
    {
        parent::__construct($model, $transformer);
    }
}
