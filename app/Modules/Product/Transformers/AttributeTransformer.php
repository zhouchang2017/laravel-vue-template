<?php

namespace App\Modules\Product\Transformers;

use App\Modules\Scaffold\Transformer;
use App\Modules\Product\Models\Attribute;

class AttributeTransformer extends Transformer
{
    protected $availableIncludes = [ 'group' ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(Attribute $attribute)
    {
        $this->hidden && $attribute->addHidden($this->hidden);
        return $attribute->attributesToArray();
    }

    public function includeGroup(Attribute $attribute)
    {
        return $this->item($attribute->group, new AttributeGroupTransformer());
    }

}
