<?php

namespace App\Modules\ProductProvider\Models;

use App\Modules\Product\Models\ProductVariant;
use App\Modules\ProductProvider\Observers\ProductProviderObserver;
use App\Modules\Scaffold\BaseModel as Model;
use App\Modules\Scaffold\Models\Address;

/**
 * @property mixed providerPayment
 * @property mixed addresses
 * @property mixed info
 * @property mixed products
 */
class ProductProvider extends Model
{
    protected $fillable = [
        'name',
        'code',
        'level',
        'description',
    ];

    /**
     * 数据模型的启动方法
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        self::observe(ProductProviderObserver::class);
    }

    public function info()
    {
        return $this->hasOne(ProductProviderInfo::class);
    }

    public function addresses()
    {
        return $this->morphMany(Address::class,'addressable');
    }

    public function providerPayment()
    {
        return $this->hasOne(ProductProviderPayment::class);
    }

    public function products()
    {
        return $this->belongsToMany(ProductVariant::class,'variant_provider')->withPivot('price')->withTimestamps();
    }
}
