<?php

namespace App\Modules\Product\Models;


//use App\Observers\ProductAttributeObserver;
use App\Modules\Scaffold\BaseModel as Model;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductAttribute
 * @package App\Models
 */
class ProductAttribute extends Model
{
    use SoftDeletes;
    /**
     * @var array
     */
    protected $fillable = [
        'product_id',
        'attribute_group_id',
        'attribute_id',
        'comment',
    ];

    /**
     * @var array
     */
    protected $appends = [ 'variant' ];


    /**
     * 数据模型的启动方法
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

//        self::observe(ProductAttributeObserver::class);
    }

    /**
     * @return mixed
     */
    public function getVariantAttribute()
    {
        return $this->group->isVariant();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(AttributeGroup::class, 'attribute_group_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attributeValue()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function variants()
    {
        return $this->belongsToMany(ProductVariant::class, 'product_variant_product_attribute', 'product_attribute_id', 'product_variant_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->hasOne(Product::class, 'product_id');
    }

    public function detachVariant()
    {
        $this->variants()->detach($this->variants->pluck('id'));
    }

    public function deleteVariant()
    {
        $variants = $this->variants;
        // 解除关联
        $this->variants()->detach($variants->pluck('id'));
        // 删除变体
        return $variants->map(function ($variant) {
            $variant->delete();
            return $variant->id;
        });
    }


    /**
     * @param string $field
     * @param $fieldIds
     * @return static
     */
    public static function deleteBy(string $field, $fieldIds)
    {
        return self::where($field, $fieldIds)->get()->map(function ($productAttribute) {
            return [ $productAttribute->id => $productAttribute->delete() ];
        });
    }

    /**
     * @param array $attributes
     * @param Product $product
     * @return Collection
     */
    public static function createInstance(array $attributes, Product $product)
    {
        return collect($attributes)->reduce(function ($res, $attribute) use ($product) {
            if (array_key_exists('comment', $attribute)) {
                $attributeInstance = new static(self::filterKeys($attribute));
                $product->attributes()->save($attributeInstance);
                $res->push($attributeInstance);
            } else {
                $groupId = $attribute['attribute_group_id'];
                collect($attribute['attribute_id'])->each(function ($attributeId) use ($groupId, $product, $res) {
                    $attributeInstance = new static(self::filterKeys([ 'attribute_group_id' => $groupId, 'attribute_id' => $attributeId ]));
                    $product->attributes()->save($attributeInstance);
                    $res->push($attributeInstance);
                });
            }
            return $res;
        }, new Collection());
    }

}
