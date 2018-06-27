<?php

namespace App\Http\Transformers;

use App\Models\Category;

class CategoryTransformer extends Transformer
{
    protected $availableIncludes = [ 'children','products','product_count' ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(Category $category)
    {
        $this->hidden && $category->addHidden($this->hidden);
        return $category->attributesToArray();
    }

    public function includeProducts(Category $category)
    {
        return $this->collection($category->products, new ProductTransformer());
    }

    public function includeChildren(Category $category)
    {
        return $this->collection($category->children, new $this());
    }

    public function includeProductCount(Category $category)
    {
        return $this->primitive($category->getProductCountAttribute());
    }

}