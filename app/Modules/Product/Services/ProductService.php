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
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('创建产品失败');
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
            $variantInstance = $this->product->variants()->create(array_only($variant, [ 'price', 'sku' ]));
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
}