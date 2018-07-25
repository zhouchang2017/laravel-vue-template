<?php

namespace App\Http\Controllers\Api\V2;

use App\Modules\Product\Models\ProductType;
use App\Modules\Product\Transformers\ProductTypeTransformer;
use App\Http\Controllers\Controller;

class ProductTypeController extends Controller
{
    public function __construct(ProductType $model,ProductTypeTransformer $transformer)
    {
        parent::__construct($model, $transformer);
    }
}
