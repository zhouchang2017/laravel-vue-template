<?php

namespace App\Http\Transformers;

use App\Models\Product;

class ProductTransformer extends Transformer
{
    protected $availableIncludes = [ 'variants', 'type', 'attributes', 'categories' ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(Product $product)
    {
        $this->hidden && $product->addHidden($this->hidden);

        return $product->toArray();
    }

    public function includeVariants(Product $product)
    {
        return $this->collection($product->variants, new ProductVariantTransformer(['created_at','updated_at']));
    }

    public function includeType(Product $product)
    {
        return $this->item($product->type, new ProductTypeTransformer(['created_at','updated_at']));
    }

    public function includeAttributes(Product $product)
    {
        return $this->collection($product->attributes, new ProductAttributeTransformer(['created_at','updated_at']));
    }

    public function includeCategories(Product $product)
    {
        return $this->collection($product->categories, new CategoryTransformer(['created_at','updated_at']));
    }

}