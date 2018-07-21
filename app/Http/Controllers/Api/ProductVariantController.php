<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\ProductVariantTransformer;
use App\Models\ProductVariant;
use App\Http\Controllers\Controller;

/**
 * @module 产品变体管理
 * Class ProductVariantController
 * @package App\Http\Controllers\Api
 */
class ProductVariantController extends Controller
{
    /**
     * ProductVariantController constructor.
     * @param ProductVariant $model
     * @param ProductVariantTransformer $transformer
     */
    public function __construct(ProductVariant $model, ProductVariantTransformer $transformer)
    {
        parent::__construct($model, $transformer);
    }
}
