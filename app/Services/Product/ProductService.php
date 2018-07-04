<?php
/**
 * Created by PhpStorm.
 * User: zhouchang
 * Date: 2018/7/4
 * Time: 下午10:13
 */

namespace App\Services\Product;


use App\Models\Product;
use Illuminate\Support\Collection;

/**
 * Class ProductService
 * @package App\Services\Product
 */
class ProductService
{
    /**
     * @var Product
     */
    protected $model;

    /**
     * ProductService constructor.
     * @param $model
     */
    public function __construct(Product $model)
    {
        $this->model = $model;
    }


    /**
     * 创建产品
     * @param $data
     */
    public function create($data)
    {
        $this->model = $this->model::create($data);
        request()->has('attributes') && $this->createProductAttributes(request('attributes'));
        request()->has('variants') && $this->createProductVariants(request('variants'));
        request()->has('category_ids') && $this->syncCategories(request('category_ids'));
    }

    /**
     * 同时创建产品对应的属性值
     * @param $attributes
     * @return mixed
     */
    public function createProductAttributes($attributes)
    {
        return takeCollect($attributes)->reduce(function ($res, $attribute) {
            if (array_key_exists('comment', $attribute)) {
                $res->push($this->model->attributes()->create($attribute));
            } else {
                $groupId = array_get($attribute, 'attribute_group_id');
                collect($attribute['attribute_id'])->each(function ($attributeId) use ($groupId, $res) {
                    $res->push($this->model->attributes()->create([ 'attribute_group_id' => $groupId, 'attribute_id' => $attributeId ]));
                });
            }
            return $res;
        }, new Collection());
    }

    /**
     * 同时创建产品对应变体&变体与产品属性多对多关联
     * @param $attributes
     */
    public function createProductVariants($attributes)
    {
        takeCollect($attributes)->map(function ($variant) {
            $productAttributeIds = $this->getProductAttributeId($variant['attributes'])->toArray();
            $variantInstance = $this->model->variants()->create($variant);
            // 同步多对多关联产品属性值
            $variantInstance->attributes()->sync($productAttributeIds);
            // 关联供应商
            if (array_key_exists('providers', $variant)) {
                $variantInstance->providers()->sync($variant['providers']);
            }
            if (array_key_exists('info', $variant)) {
                $variantInstance->info()->create($variant['info']);
            }
            return $variantInstance->id;
        });
    }

    /**
     * 同时关联分类
     * @param array $categories
     */
    public function syncCategories(array $categories)
    {
        $this->model->categories()->sync($categories);
    }

    /**
     * 通过字段获取product_attribute 表id
     * @param $field
     * @param $fieldId
     * @return Collection
     */
    private function getProductAttributeId($fieldId, $field = 'attribute_id')
    {
        return $this->model->attributes()->whereIn($field, $fieldId)->pluck('id');
    }

    // 更新产品

    /**
     *
     */
    public function update()
    {

    }

    // 删除产品

    /**
     *
     */
    public function destroy()
    {

    }
}