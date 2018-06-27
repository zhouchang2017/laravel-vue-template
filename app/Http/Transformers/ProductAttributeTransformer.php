<?php

namespace App\Http\Transformers;

use App\Models\ProductAttribute;

class ProductAttributeTransformer extends Transformer
{
    protected $availableIncludes = [ 'group', 'value' ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(ProductAttribute $attribute)
    {
        $this->hidden && $attribute->addHidden($this->hidden);
        return $attribute->attributesToArray();
    }

    public function includeGroup(ProductAttribute $attribute)
    {
        return $this->item($attribute->group, new AttributeGroupTransformer([ 'created_at', 'updated_at' ]));
    }


    public function includeValue(ProductAttribute $attribute)
    {
        if ($attribute->comment) {
            return $this->primitive([ 'data' => [ 'value' => $attribute->getAttribute('comment') ] ]);
        }
        if (is_null($attribute->attributeValue)) {
            return $this->primitive([]);
        }
        return $this->item($attribute->attributeValue, new AttributeTransformer([ 'created_at', 'updated_at' ]));
    }

}