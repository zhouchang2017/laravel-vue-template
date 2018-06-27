<?php

namespace App\Observers;


use App\Models\ProductVariant;

class ProductVariantObserver
{

    public function created()
    {

    }

    public function saved(ProductVariant $productVariant)
    {
    }

    public function deleted(ProductVariant $productVariant)
    {
        $productVariant->info->delete();

        $productVariant->attributes()->detach();

        $productVariant->providers()->detach();
    }

}