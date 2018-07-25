<?php

namespace App\Modules\Product\Transformers;

use App\Modules\Scaffold\Transformer;
use App\Modules\Product\Models\AttributeGroup;

class AttributeGroupTransformer extends Transformer
{
    protected $availableIncludes = [  ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(AttributeGroup $attributeGroup)
    {
        $this->hidden && $attributeGroup->addHidden($this->hidden);
        return $attributeGroup->attributesToArray();
    }


}
