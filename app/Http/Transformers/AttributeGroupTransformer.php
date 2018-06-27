<?php

namespace App\Http\Transformers;

use App\Models\AttributeGroup;

class AttributeGroupTransformer extends Transformer
{
    protected $availableIncludes = [ 'types', 'values' ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(AttributeGroup $group)
    {
        $this->hidden && $group->addHidden($this->hidden);
        return $group->attributesToArray();
    }

    /**
     * @param AttributeGroup $group
     * @return \League\Fractal\Resource\Collection
     */
    public function includeTypes(AttributeGroup $group)
    {
        return $this->collection($group->types, new ProductTypeTransformer());
    }

    public function includeValues(AttributeGroup $group)
    {
        return $this->collection($group->values, new AttributeTransformer());
    }

}