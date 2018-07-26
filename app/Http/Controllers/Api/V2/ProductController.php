<?php

namespace App\Http\Controllers\Api\V2;

use App\Modules\Product\Models\Product;
use App\Modules\Product\Transformers\ProductTransformer;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function __construct(Product $model,ProductTransformer $transformer)
    {
        parent::__construct($model, $transformer);
    }
}
