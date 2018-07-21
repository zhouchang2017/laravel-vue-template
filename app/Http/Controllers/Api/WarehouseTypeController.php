<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Transformers\WarehouseTypeTransformer;
use App\Models\WarehouseType;

/**
 * @module 仓库类型管理
 * Class WarehouseTypeController
 * @package App\Http\Controllers\Api
 */
class WarehouseTypeController extends Controller
{
    /**
     * WarehouseTypeController constructor.
     * @param WarehouseType $model
     * @param WarehouseTypeTransformer $transformer
     */
    public function __construct(WarehouseType $model, WarehouseTypeTransformer $transformer)
    {
        parent::__construct($model, $transformer);
    }
}
