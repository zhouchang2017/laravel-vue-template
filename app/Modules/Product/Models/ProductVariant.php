<?php

namespace App\Modules\Product\Models;


//use App\Observers\ProductVariantObserver;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'sku',
        'options',
        'price',
        'stock',
    ];

    /**
     * 应该被转换成原生类型的属性。
     *
     * @var array
     */
    protected $casts = [
        'options' => 'array',
    ];

    /**
     * 数据模型的启动方法
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

//        self::observe(ProductVariantObserver::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function info()
    {
        return $this->hasOne(ProductVariantInfo::class, 'product_variant_id', 'id');
    }

    public function attributes()
    {
        return $this->belongsToMany(ProductAttribute::class,'product_variant_product_attribute','product_variant_id','product_attribute_id');
    }

    public function providers()
    {
        return $this->belongsToMany(ProductProvider::class,'variant_provider')->withPivot('price')->withTimestamps();
    }

    public function createInfo($attributes)
    {
        $info = new ProductVariantInfo(ProductVariantInfo::filterKeys($attributes));
        $this->info()->save($info);
        return $info;
    }

    public function planInfo()
    {
        return $this->hasMany(ProcurementPlanProductVariant::class);
    }


}
