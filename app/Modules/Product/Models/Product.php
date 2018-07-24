<?php

namespace App\Modules\Product\Models;


use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Log;

/**
 * Class Product
 * @package App\Models
 */
class Product extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'name_cn',
        'name_en',
        'enabled',
        'product_type_id',
        'body',
    ];

    /**
     * 应该被转换成原生类型的属性。
     *
     * @var array
     */
    protected $casts = [
        'enabled' => 'boolean',
    ];

    /**
     * 数据模型的启动方法
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        self::observe(ProductObserver::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }


    /**
     * 返回该产品下的所有供应商
     * @return Collection
     */
    public function providers(): Collection
    {
        return $this->variants->reduce(function ($collect, $variant) {
            $variant->providers->each(function ($provider) use ($collect) {
                $collect->push($provider);
            });
            return $collect;
        }, new Collection());
    }

    /**
     *
     */
    public function skuAttributes()
    {
        return $this->attributes()->get()->filter(function ($attr) {
            return ! !$attr->group->isVariant();
        });
    }

    /**
     * 创建产品属性
     * @param $attributes
     * @return mixed
     */
    public function createAttributes($attributes)
    {
        $attributes = $this->takeCollect($attributes);
        return $attributes->reduce(function ($res, $attribute) {
            if (array_key_exists('comment', $attribute) && !is_null($attribute['comment'])) {
                $attributeInstance = new ProductAttribute(ProductAttribute::filterKeys($attribute));
                $this->attributes()->save($attributeInstance);
                $res->push($attributeInstance);
            } else {
                $groupId = $attribute['attribute_group_id'];
                collect($attribute['attribute_id'])->map(function ($attributeId) use ($groupId, $res) {
                    $attributeInstance = new ProductAttribute(ProductAttribute::filterKeys([ 'attribute_group_id' => $groupId, 'attribute_id' => $attributeId ]));
                    $this->attributes()->save($attributeInstance);
                    $res->push($attributeInstance);
                });
            }
            return $res;
        }, new Collection());
    }


    /**
     * 创建变体
     * @param array|Collection $attributes
     * @return Collection
     */
    public function createVariant($attributes)
    {
        $attributes = $this->takeCollect($attributes);
        return $attributes->map(function ($variant) {
            $productAttributeIds = $this->getAttributesIdBy('attribute_id', $variant['attributes'])->toArray();
            $variantInstance = $this->variants()->create($variant);
            // 关联供应商
            if (array_key_exists('providers', $variant)) {
                $variantInstance->providers()->sync($variant['providers']);
            }
            if (array_key_exists('info', $variant)) {
                $variantInstance->createInfo($variant['info']);
            }
            // 同步多对多关联产品属性值
            $variantInstance->attributes()->sync($productAttributeIds);
            return $variantInstance->id;
        });
    }


    /**
     * 通过字段获取product_attribute 表id
     * @param $field
     * @param $fieldId
     * @return Collection
     */
    public function getAttributesIdBy($field, $fieldId)
    {
        return $this->attributes()->whereIn($field, $fieldId)->pluck('id');
    }


    /**
     * 更新属性
     * @param array $attributes
     * @return array|mixed
     */
    public function updateAttributes(array $attributes)
    {
        $update = [];
        $changes = $this->attributesMapWithKeys($attributes);
        $update = $this->attributes()->get()->reduce(function ($res, $attribute) use ($changes) {
            if (is_null($changes->get($attribute->id))) {
                $attribute->delete();
                $res['deleted'][] = $attribute->id;
            } else {
                $attribute->store($changes->get($attribute->id));
                if (count($attribute->getChanges()) > 0) {
                    $res['updated'][] = $attribute->id;
                }
            }
            return $res;
        }, $update);

        $update['created'] = $this->createAttributes($this->findAddAttributes($attributes))->pluck('id')->toArray();
        Log::info('updateAttributes:', $update);


        return $update;
    }

    public function loadAttributes()
    {
        $this->load([ 'attributes.attributeValue' ]);

        return $this;
    }

    public function loadVariants()
    {
        $this->load([ 'variants.attributes.attributeValue' ]);
        return $this;
    }


    /**
     * @param array $attributes
     * @return array
     */
    public function updateVariant(array $attributes)
    {
        $update = [ 'updated' => [], 'deleted' => [] ];
        // 1.有id    更新（库存，价格，info)
        $changes = $this->attributesMapWithKeys($attributes);
        $update = $this->variants->reduce(function ($res, $variant) use ($changes) {
            if (is_null($changes->get($variant->id))) {
                $variant->delete();
                $res['deleted'][] = $variant->id;
            } else {
                $updateAttribute = $changes->get($variant->id);

                $variant->store($updateAttribute)->info->store($updateAttribute['info']);

                $variant->attributes()->sync($this->getAttributesIdBy('attribute_id', $updateAttribute['attributes']));


                // 关联供应商
                if (array_key_exists('providers', $updateAttribute)) {
                    $variant->providers()->sync($updateAttribute['providers']);
                }

                if (count($variant->getChanges()) > 0) {
                    $res['updated'][] = $variant->id;
                }

            }
            return $res;
        }, $update);

        // 2.无id    创建
        $update['created'] = $this->createVariant($this->findAddAttributes($attributes))->toArray();
        Log::info('updateVariant:', $update);
        return $update;
    }

    /**
     * 删除变体
     * @return mixed
     */
    public function deleteVariant()
    {
        $variants = $this->variants;
        // 删除变体
        return $variants->map(function ($variant) {
            // $variant->info->delete();
            // 解除关联
//            $variant->attributes()->detach($variant->attributes()->get()->pluck('id'));
            $variant->delete();
            return $variant->id;
        });
    }

    public function deleteAttributes()
    {
        return $this->attributes()->get()->map(function ($attribute) {
            $attribute->delete();
            return $attribute->id;
        });
    }

    /**
     * 过滤需要创建的新属性
     * @param array|Collection $attributes
     * @param string $key
     * @return Collection
     */
    private function findAddAttributes($attributes, $key = 'id'): Collection
    {
        $attributes = $this->takeCollect($attributes);
        return $attributes->reduce(function ($res, $attribute) use ($key) {
            if ( !array_key_exists('id', $attribute) || is_null($attribute['id'])) {
                $res->push($attribute);
            };
            return $res;
        }, new Collection());
    }


    /**
     * 产品类型发生变化后，删除新类型下不存在的属性组记录
     */
    public function dissociatedProductAttribute()
    {
        $groupIds = $this->getGroupId($this->getOriginal('product_type_id'))
            ->diff($this->type->attributes->pluck('id'))->toArray();
        if (count($groupIds) > 0) {
            $this->attributes()->whereIn('attribute_group_id', $groupIds)->get()
                ->each(function ($productAttribute) {
                    $productAttribute->delete();
                });
        }

    }

    public function syncCategories(array $categories)
    {
        $this->categories()->sync($categories);
    }

    public function dissociatedCategories()
    {
        $this->categories()->detach();
    }

    /**
     * 通过类型id获取所有属性组id
     * @param $typeId
     * @return Collection
     */
    private function getGroupId($typeId)
    {
        return ProductType::findOrFail($typeId)->attributes->pluck('id');
    }


}
