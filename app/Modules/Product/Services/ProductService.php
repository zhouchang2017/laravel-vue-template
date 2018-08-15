<?php

namespace App\Modules\Product\Services;

use App\Modules\Product\Models\Attribute;
use App\Modules\Product\Models\AttributeGroup;
use App\Modules\Product\Models\Brand;
use App\Modules\Product\Models\Category;
use App\Modules\Product\Models\Product;
use App\Modules\Product\Models\ProductAttribute;
use App\Modules\Product\Models\ProductType;
use App\Modules\Product\Models\ProductVariant;
use App\Modules\Product\Models\ProductVariantInfo;
use App\Modules\Scaffold\BaseService;
use Illuminate\Support\Collection;
use DB;
use Log;
/**
 * Class ProductService
 * @package App\Modules\Product\Services
 */
class ProductService extends BaseService
{
    /**
     * @var Attribute
     */
    protected $attribute;
    /**
     * @var AttributeGroup
     */
    protected $attributeGroup;
    /**
     * @var Brand
     */
    protected $brand;
    /**
     * @var Category
     */
    protected $category;
    /**
     * @var Product
     */
    protected $product;
    /**
     * @var ProductAttribute
     */
    protected $productAttribute;
    /**
     * @var ProductType
     */
    protected $productType;
    /**
     * @var ProductVariant
     */
    protected $productVariant;
    /**
     * @var ProductVariantInfo
     */
    protected $productVariantInfo;


    /**
     * ProductService constructor.
     * @param Attribute $attribute
     * @param AttributeGroup $attributeGroup
     * @param Brand $brand
     * @param Category $category
     * @param Product $product
     * @param ProductAttribute $productAttribute
     * @param ProductType $productType
     * @param ProductVariant $productVariant
     * @param ProductVariantInfo $productVariantInfo
     */
    public function __construct(
        Attribute $attribute,
        AttributeGroup $attributeGroup,
        Brand $brand,
        Category $category,
        Product $product,
        ProductAttribute $productAttribute,
        ProductType $productType,
        ProductVariant $productVariant,
        ProductVariantInfo $productVariantInfo
    )
    {
        $this->attribute = $attribute;
        $this->attributeGroup = $attributeGroup;
        $this->brand = $brand;
        $this->category = $category;
        $this->product = $product;
        $this->productAttribute = $productAttribute;
        $this->productType = $productType;
        $this->productVariant = $productVariant;
        $this->productVariantInfo = $productVariantInfo;
    }

    /**
     * @param Attribute $attribute
     */
    public function setAttribute(Attribute $attribute): void
    {
        $this->attribute = $attribute;
    }

    /**
     * @param AttributeGroup $attributeGroup
     */
    public function setAttributeGroup(AttributeGroup $attributeGroup): void
    {
        $this->attributeGroup = $attributeGroup;
    }

    /**
     * @param Brand $brand
     */
    public function setBrand(Brand $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    /**
     * @param ProductAttribute $productAttribute
     */
    public function setProductAttribute(ProductAttribute $productAttribute): void
    {
        $this->productAttribute = $productAttribute;
    }

    /**
     * @param ProductType $productType
     */
    public function setProductType(ProductType $productType): void
    {
        $this->productType = $productType;
    }

    /**
     * @param ProductVariant $productVariant
     */
    public function setProductVariant(ProductVariant $productVariant): void
    {
        $this->productVariant = $productVariant;
    }

    /**
     * @param ProductVariantInfo $productVariantInfo
     */
    public function setProductVariantInfo(ProductVariantInfo $productVariantInfo): void
    {
        $this->productVariantInfo = $productVariantInfo;
    }

    public function create(array $attributes)
    {

        try{
            DB::beginTransaction();
            /** @var Product $product */
            $this->setProduct($this->product::create($attributes));

            /*
             * Create Product Attribute
             * */
            request()->has('attributes')
            && $this->createProductAttribute(request()->input('attributes'));

            /*
             * Create Product Variants
             * */
            request()->has('variants')
            && $this->createProductVariant(request('variants'));

            DB::commit();
            return $this->product;
        }catch (\Exception $exception){
            DB::rollBack();
            dd($exception);
            Log::error('创建产品失败: ' . $exception->getMessage() . '');
        }

    }

    /**
     * 创建产品属性
     * @param $attributes
     * @return mixed
     */
    private function createProductAttribute($attributes)
    {
        $attributes = collect($attributes);
        return $attributes->reduce(function ($res, $attribute) {
            if (array_key_exists('comment', $attribute) && !is_null($attribute['comment'])) {

                $res->push($this->product->attributes()->create($attribute));

            } else {
                $groupId = $attribute['attribute_group_id'];

                collect($attribute['attribute_id'])->map(function ($attributeId) use ($groupId, $res) {

                    $res->push($this->product->attributes()->create([ 'attribute_group_id' => $groupId, 'attribute_id' => $attributeId ]));

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
    private function createProductVariant($attributes)
    {
        $attributes = collect($attributes);
        return $attributes->map(function ($variant) {
            /** @var ProductVariant $variantInstance */
            $variantInstance = $this->product->variants()->create(array_only($variant, [ 'price', 'sku','attribute_key' ]));
            // 关联供应商
//            if (array_key_exists('providers', $variant)) {
//                $variantInstance->providers()->sync($variant['providers']);
//            }
//            if (array_key_exists('info', $variant)) {
//                $variantInstance->createInfo($variant['info']);
//            }
            // 同步多对多关联产品属性值
            $variantInstance->attributes()->sync(
                $this->findProductAttributePrimaryKeys(array_get($variant, 'attributes'))
            );
            return $variantInstance->id;
        });
    }

    private function findProductAttributePrimaryKeys($keys,$primaryKey = 'id')
    {
        return $this->product->attributes()->whereIn('attribute_id',$keys)->pluck($primaryKey);
    }


    public function update($id,array $attributes)
    {
        try{
            DB::beginTransaction();
            /** @var Product $product */
            $product = $this->product::findOrFail($id);
            if($product){
                $this->setProduct($product);
            }
            $this->product->update($attributes);

            /*
             * Create Product Attribute
             * */
            request()->has('attributes')
            && $this->updateAttributes(request()->input('attributes'));

            /*
             * Create Product Variants
             * */
            request()->has('variants')
            && $this->updateVariant(request('variants'));

            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('创建产品失败');
        }
    }

    /**
     * 更新属性
     * @param array $attributes
     * @return array|mixed
     */
    private function updateAttributes(array $attributes)
    {
        $update = [];
        $changes = $this->attributesMapWithKeys($attributes);
        $update = $this->product->attributes()->get()->reduce(function ($res, $attribute) use ($changes) {
            /** @var ProductAttribute $attribute */
            if (is_null($changes->get($attribute->id))) {
                $attribute->delete();
                $res['deleted'][] = $attribute->id;
            } else {
                $attribute->update($changes->get($attribute->id));
                if (count($attribute->getChanges()) > 0) {
                    $res['updated'][] = $attribute->id;
                }
            }
            return $res;
        }, $update);

        $update['created'] = $this->product->createAttributes($this->findAddAttributes($attributes))->pluck('id')->toArray();
        Log::info('updateAttributes:', $update);


        return $update;
    }


    /**
     * @param array $attributes
     * @return array
     */
    private function updateVariant(array $attributes)
    {
        $update = [ 'updated' => [], 'deleted' => [] ];
        // 1.有id    更新（库存，价格，info)
        $changes = $this->attributesMapWithKeys($attributes);
        $update = $this->product->variants->reduce(function ($res, $variant) use ($changes) {
            /** @var ProductVariant $variant */
            if (is_null($changes->get($variant->id))) {
                $variant->delete();
                $res['deleted'][] = $variant->id;
            } else {
                $updateAttribute = $changes->get($variant->id);

                $variant->update($updateAttribute);

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
        $update['created'] = $this->createProductVariant($this->findAddAttributes($attributes))->toArray();
        Log::info('updateVariant:', $update);
        return $update;
    }

    /**
     * 通过字段获取product_attribute 表id
     * @param $field
     * @param $fieldId
     * @return Collection
     */
    public function getAttributesIdBy($field, $fieldId)
    {
        return $this->product->attributes()->whereIn($field, $fieldId)->pluck('id');
    }

    public function attributesMapWithKeys(iterable $attributes, $key = 'id'): Collection
    {
        $attributes = $this->takeCollect($attributes);
        // 过滤不存在$key的元素
        $attributes = $attributes->filter(function ($value) use ($key) {
            return array_key_exists($key, $value) && !is_null($value[$key]);
        });
        return $attributes->mapWithKeys(function ($item) use ($key) {
            return [ $item[$key] => $item ];
        });
    }

    /**
     * 转换集合
     * @param array $attributes
     * @return \Illuminate\Support\Collection
     */
    public function takeCollect($attributes): Collection
    {
        if ( !$attributes instanceof Collection) {
            return collect($attributes);
        }
        return $attributes;
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
}