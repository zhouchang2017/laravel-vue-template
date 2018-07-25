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
    ) {
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

    public function createBrand(array $attributes)
    {
        $this->brand::create($attributes);
    }
}