<?php

namespace App\Modules\Scaffold\Traits;


use App\Modules\Scaffold\Contracts\AssetRelation;
use App\Modules\Scaffold\Models\Asset;
use App\Modules\Scaffold\Services\AssetService;
use Dingo\Api\Exception\StoreResourceFailedException;

trait AssetTrait
{

    /**
     * @return string
     */
    public function getAssetMethod(): string
    {
        return 'avatars';
    }

    public function avatars()
    {
        return $this->morphMany(Asset::class, 'assetable');
    }


    public function storeAsset(string $key)
    {
        if ($this instanceof AssetRelation) {
            if (request($key) && count(request($key)) > 0) {
                return app(AssetService::class)->store($this, request($key));
            }
            return false;
        }
        throw new StoreResourceFailedException('model is not instanceof AssetRelation');
    }


    public function updateAsset(string $key)
    {
        if ($this instanceof AssetRelation) {
            if (request($key) && count(request($key)) > 0) {
                return app(AssetService::class)->update($this, request($key));
            }
        }
        throw new StoreResourceFailedException('model is not instanceof AssetRelation');
    }


}