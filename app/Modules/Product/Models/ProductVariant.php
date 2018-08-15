<?php

namespace App\Modules\Product\Models;


//use App\Observers\ProductVariantObserver;
use App\Modules\ProductProvider\Models\ProductProvider;
use App\Modules\Scaffold\BaseModel as Model;
class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'sku',
        'options',
        'price',
        'attribute_key'
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

    public function getNameAttribute()
    {
        return $this->product->name ?? '';
    }

    public function getTypeAttribute()
    {
        return $this->product->type ? $this->product->type->name : '暂无产品类型';
    }

    public function getBrandAttribute()
    {
        return $this->product->brand ? $this->product->brand->name : '暂无品牌';
    }

    public function name()
    {
        return $this->product->name ?? '';
    }

    public function brand()
    {
        return $this->product->brand ? $this->product->brand->name : '暂无品牌';
    }

    public function type()
    {
        return $this->product->type ? $this->product->type->name : '暂无产品类型';
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
        // return $this->hasMany(ProcurementPlanProductVariant::class);
    }


}
