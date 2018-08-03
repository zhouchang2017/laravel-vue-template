<?php

namespace App\Modules\Product\Observers;


use App\Modules\Product\Models\Brand;
use App\Modules\Scaffold\Traits\AssetTrait;

class BrandObserver
{
    use AssetTrait;

    public function created(Brand $brand)
    {
        $this->storeAsset('avatar', function ($options) use ($brand) {
            $brand->images()->createMany($options);
        });
    }

    public function afterUpdate(Brand $brand)
    {

    }

}