<?php

namespace App\Http\Transformers;

use App\Models\Attribute;

class AttributeTransformer extends Transformer
{
    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(Attribute $attribute)
    {
        $this->hidden && $attribute->addHidden($this->hidden);
        return $attribute->attributesToArray();
    }


    /**
     * @param Attribute $attribute
     * @return \League\Fractal\Resource\Item
     */
    public function includeGroup(Attribute $attribute)
    {
        return $this->item($attribute->group, new AttributeGroupTransformer());
    }

}