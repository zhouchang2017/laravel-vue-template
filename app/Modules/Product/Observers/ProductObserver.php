<?php

namespace App\Modules\Product\Observers;


use App\Modules\Product\Models\Product;

class ProductObserver
{
    public function created(Product $product)
    {
        $product->storeAsset('avatars');
    }

    public function afterUpdate(Product $product)
    {
        $product->updateAsset('avatars');
    }

}