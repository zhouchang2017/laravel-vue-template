<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\AttributeTransformer;
use App\Models\Attribute;
use App\Http\Controllers\Controller;

/**
 * @module 属性管理
 * Class AttributeController
 * @package App\Http\Controllers\Api
 */
class AttributeController extends Controller
{
    /**
     * AttributeController constructor.
     * @param $model
     * @param $transformer
     */
    public function __construct(Attribute $model, AttributeTransformer $transformer)
    {
        parent::__construct($model,$transformer);
    }

}
