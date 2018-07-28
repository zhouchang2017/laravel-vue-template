<?php

namespace App\Modules\Product\Transformers;

use App\Modules\Product\Models\ProductAttribute;
use App\Modules\Scaffold\Transformer;

class ProductAttributeTransformer extends Transformer
{
    protected $availableIncludes = [ 'group', 'value','attributeValue' ];

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
        return $this->item($attribute->group, new AttributeGroupTransformer());
    }

    public function includeAttributeValue(ProductAttribute $attribute)
    {
        if ($attribute->comment) {
            return $this->primitive([ 'data' => [ 'value' => $attribute->getAttribute('comment') ] ]);
        }
        if (is_null($attribute->attributeValue)) {
            return $this->primitive([]);
        }
        return $this->item($attribute->attributeValue, new AttributeTransformer());
    }


    public function includeValue(ProductAttribute $attribute)
    {
        if ($attribute->comment) {
            return $this->primitive([ 'data' => [ 'value' => $attribute->getAttribute('comment') ] ]);
        }
        if (is_null($attribute->attributeValue)) {
            return $this->primitive([]);
        }
        return $this->item($attribute->attributeValue, new AttributeTransformer());
    }

}