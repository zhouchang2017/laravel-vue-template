<?php

namespace App\Http\Controllers\Api\V2;

use App\Modules\Product\Models\Brand;
use App\Modules\Product\Transformers\BrandTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function __construct(Brand $model,BrandTransformer $transformer)
    {
        parent::__construct($model, $transformer);
    }
}
