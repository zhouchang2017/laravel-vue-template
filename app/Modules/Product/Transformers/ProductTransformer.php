<?php

namespace App\Modules\Product\Transformers;

use App\Modules\Scaffold\Transformer;
use App\Modules\Product\Models\Product;
use App\Modules\Scaffold\Transformers\AssetTransformer;

class ProductTransformer extends Transformer
{
    protected $availableIncludes = ['brand', 'type', 'attributes', 'variants', 'categories','avatars'];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(Product $product)
    {
        $this->hidden && $product->addHidden($this->hidden);
        return $product->attributesToArray();
    }

    public function includeBrand(Product $product)
    {
        return $this->item($product->brand, new BrandTransformer());
    }

    public function includeType(Product $product)
    {
        return $this->item($product->type, new ProductTypeTransformer());
    }

    public function includeAttributes(Product $product)
    {
        return $this->collection($product->attributes, new ProductAttributeTransformer());
    }

    public function includeVariants(Product $product)
    {
        return $this->collection($product->variants, new ProductVariantTransformer());
    }

    public function includeCategories(Product $product)
    {
        return $this->collection($product->categories, new CategoryTransformer());
    }

    public function includeAvatars(Product $product)
    {
        return $this->collection($product->avatars, new AssetTransformer());
    }


}
