<?php

namespace App\Http\Controllers\Api\V2;

use App\Modules\Product\Models\AttributeGroup;
use App\Modules\Product\Transformers\AttributeGroupTransformer;
use App\Http\Controllers\Controller;

class AttributeGroupController extends Controller
{
    public function __construct(AttributeGroup $model,AttributeGroupTransformer $transformer)
    {
        parent::__construct($model, $transformer);
    }
}
