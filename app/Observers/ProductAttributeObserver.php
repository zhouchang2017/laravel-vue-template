<?php

namespace App\Observers;


use App\Models\ProductAttribute;

class ProductAttributeObserver
{

    public function deleted(ProductAttribute $attribute)
    {
//        $attribute->detachVariant();
    }

}