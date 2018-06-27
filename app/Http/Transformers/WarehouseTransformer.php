<?php

namespace App\Http\Transformers;

use App\Models\Warehouse;

class WarehouseTransformer extends Transformer
{
    protected $availableIncludes = [ 'addresses', 'type' ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(Warehouse $warehouse)
    {
        $this->hidden && $warehouse->addHidden($this->hidden);
        return $warehouse->attributesToArray();
    }

    public function includeAddresses(Warehouse $warehouse)
    {
        return $this->collection($warehouse->addresses, new AddressTransformer());
    }

    public function includeType(Warehouse $warehouse)
    {
        return $this->item($warehouse->type, new WarehouseTypeTransformer());
    }


}
