<?php


namespace App\Modules\Scaffold\Traits;


use App\Modules\Scaffold\Contracts\AssetRelation;
use App\Modules\Scaffold\Services\AssetService;

trait AssetTrait
{
    public function storeAsset(AssetRelation $model,string $key)
    {
        if (request($key) && count(request($key)) > 0) {
            return app(AssetService::class)->store($model,request($key));
        }
    }

    public function updateAsset(AssetRelation $model,string $key)
    {
        if (request($key) && count(request($key)) > 0) {
            return app(AssetService::class)->update($model,request($key));
        }
    }


}