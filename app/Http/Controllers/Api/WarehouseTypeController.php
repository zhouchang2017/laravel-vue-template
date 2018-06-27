<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Transformers\WarehouseTypeTransformer;
use App\Models\WarehouseType;

class WarehouseTypeController extends Controller
{
    public function __construct(WarehouseType $model, WarehouseTypeTransformer $transformer)
    {
        parent::__construct($model, $transformer);
    }
}
