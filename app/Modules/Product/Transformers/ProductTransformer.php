<?php

namespace App\Modules\Product\Transformers;

use App\Modules\Scaffold\Transformer;
use App\Modules\Product\Models\Product;

class ProductTransformer extends Transformer
{
    protected $availableIncludes = [  ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(Product $product)
    {
        $this->hidden && $product->addHidden($this->hidden);
        return $product->attributesToArray();
    }


}
