<?php

namespace App\Modules\Product\Models;

use App\Modules\Product\Observers\BrandObserver;
use App\Modules\Scaffold\BaseModel as Model;
use App\Modules\Scaffold\Contracts\AssetRelation;
use App\Modules\Scaffold\Models\Asset;

class Brand extends Model implements AssetRelation
{
    protected $fillable=['name','description'];
    /**
     * @return string
     */
    public function getAssetMethod(): string
    {
        return 'avatars';
    }
    /**
     * 数据模型的启动方法
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        self::observe(BrandObserver::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function avatars()
    {
        return $this->morphMany(Asset::class,'assetable');
    }
}
