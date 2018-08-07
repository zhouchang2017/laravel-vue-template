<?php

namespace App\Modules\Product\Observers;


use App\Modules\Product\Models\Attribute;
use App\Modules\Product\Models\AttributeGroup;

class AttributeGroupObserver
{
    public function created(AttributeGroup $attributeGroup)
    {
        $this->relationAttributes($attributeGroup);
    }

    public function afterUpdate(AttributeGroup $attributeGroup)
    {
        $this->relationAttributes($attributeGroup);
    }


    private function relationAttributes(AttributeGroup $attributeGroup)
    {
        if(request()->has('attributes')){
            $attributes = $attributeGroup->values()->pluck('id')->toArray();
            $willDestroyIds = array_diff($attributes,array_pluck(request()->input('attributes'),'id'));
            Attribute::destroy(array_values($willDestroyIds));
            collect(request()->input('attributes'))->map(function($attribute)use ($attributeGroup){
                $attributeGroup->values()->updateOrCreate(array_except($attribute,['variant']));
            });
        }
    }
}