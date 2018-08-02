<?php


namespace App\Modules\Scaffold\Traits;


use App\Modules\Scaffold\Services\AssetService;

trait AssetTrait
{
    public function createAsset(string $key)
    {
        if(request($key)){
            app(AssetService::class);
        }
    }
}