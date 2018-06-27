<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\ProductVariantTransformer;
use App\Models\ProductVariant;
use App\Http\Controllers\Controller;

class ProductVariantController extends Controller
{
    public function __construct(ProductVariant $model, ProductVariantTransformer $transformer)
    {
        parent::__construct($model, $transformer);
    }
}
