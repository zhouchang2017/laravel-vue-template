<?php

namespace App\Http\Transformers;

use App\Models\WarehouseType;

class WarehouseTypeTransformer extends Transformer
{
    protected $availableIncludes = [ 'warehouses' ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(WarehouseType $type)
    {
        $this->hidden && $type->addHidden($this->hidden);
        return $type->attributesToArray();
    }

    public function includeWarehouses(WarehouseType $type)
    {
        return $this->collection($type->warehouses, new WarehouseTransformer());
    }

}
