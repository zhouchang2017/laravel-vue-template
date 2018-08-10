<?php

namespace App\Modules\Product\Observers;


use App\Modules\Product\Models\Brand;
use App\Modules\Scaffold\Traits\AssetTrait;

class BrandObserver
{
    use AssetTrait;

    public function created(Brand $brand)
    {
        $brand->storeAsset('avatars');
    }

    public function afterUpdate(Brand $brand)
    {
        $brand->updateAsset('avatars');
    }

}