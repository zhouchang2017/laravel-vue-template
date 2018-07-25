<?php

namespace App\Http\Controllers\Api\V2;

use App\Modules\Product\Models\Attribute;
use App\Modules\Product\Transformers\AttributeTransformer;
use App\Http\Controllers\Controller;

class AttributeController extends Controller
{
    public function __construct(Attribute $model,AttributeTransformer $transformer)
    {
        parent::__construct($model, $transformer);
    }
}
