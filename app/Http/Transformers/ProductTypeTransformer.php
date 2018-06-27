<?php

namespace App\Http\Transformers;

use App\Models\ProductType;

class ProductTypeTransformer extends Transformer
{
    protected $availableIncludes = [ 'products', 'attributes' ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(ProductType $type)
    {
        $this->hidden && $type->addHidden($this->hidden);
        return $type->attributesToArray();
    }

    public function includeProducts(ProductType $type)
    {
        return $this->collection($type->products, new ProductTransformer());
    }

    public function includeAttributes(ProductType $type)
    {
        return $this->collection($type->attributes, new AttributeGroupTransformer());
    }

}