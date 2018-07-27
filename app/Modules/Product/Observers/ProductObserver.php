<?php

namespace App\Modules\Product\Observers;


use App\Modules\Product\Models\Product;

class ProductObserver
{
    public function created(Product $product)
    {
        // relation product_attributes
        if(request()->has('attributes')){
            $product->createAttributes(request()->input('attributes'));
        }
        if(request()->has('variants')){
            $product->createVariant(request()->input('variants'));
        }

    }

    public function afterUpdate(Product $product)
    {
    }

}