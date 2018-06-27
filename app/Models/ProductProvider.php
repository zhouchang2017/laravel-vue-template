<?php

namespace App\Models;

use App\Observers\ProductProviderObserver;


/**
 * 产品供应商
 * Class ProductProvider
 * @package App\Models
 */
class ProductProvider extends Model
{
    /**
     * @var array
     */
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
