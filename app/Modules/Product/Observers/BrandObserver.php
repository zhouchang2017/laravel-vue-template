<?php

namespace App\Modules\Product\Observers;


use App\Modules\Product\Models\Brand;
use App\Modules\Scaffold\Traits\AssetTrait;

class BrandObserver
{
    use AssetTrait;

    public function created(Brand $brand)
    {
        $this->storeAsset($brand,'avatars');
    }

    public function afterUpdate(Brand $brand)
    {
        $this->updateAsset($brand,'avatars');
    }

}