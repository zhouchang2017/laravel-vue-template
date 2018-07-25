<?php

namespace App\Modules\Product\Observers;


use App\Modules\Product\Models\ProductType;

class ProductTypeObserver
{
    public function created(ProductType $productType)
    {
        $this->relationAttributeGroup($productType);
    }

    public function afterUpdate(ProductType $productType)
    {
        $this->relationAttributeGroup($productType);
    }


    private function relationAttributeGroup(ProductType $productType)
    {
        request()->has('group_ids') && $productType->attributeGroups()->sync(request('group_ids'));
    }
}