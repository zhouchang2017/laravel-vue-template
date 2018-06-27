<?php

namespace App\Http\Transformers;

use App\Models\ProductVariantInfo;

class ProductVariantInfoTransformer extends Transformer
{
    protected $availableIncludes = [ 'variant' ];


    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(ProductVariantInfo $info)
    {
        $this->hidden && $info->addHidden($this->hidden);
        return $info->attributesToArray();
    }


    public function includeVariant(ProductVariantInfo $info)
    {
        return $this->item($info->variant, new ProductAttributeTransformer());
    }

}