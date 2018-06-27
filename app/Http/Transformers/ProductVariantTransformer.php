<?php

namespace App\Http\Transformers;

use App\Models\ProductVariant;

class ProductVariantTransformer extends Transformer
{
    protected $availableIncludes = [ 'attributes', 'info', 'providers','plan_info' ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(ProductVariant $variant)
    {
        $this->hidden && $variant->addHidden($this->hidden);
        return $variant->attributesToArray();
    }


    public function includeAttributes(ProductVariant $variant)
    {
        return $this->collection($variant->attributes, new ProductAttributeTransformer());
    }

    public function includeInfo(ProductVariant $variant)
    {
        return $this->item($variant->info, new ProductVariantInfoTransformer());
    }

    public function includeProviders(ProductVariant $variant)
    {
        return $this->collection($variant->providers, new ProductProviderTransformer());
    }

    public function includePlanInfo(ProductVariant $variant)
    {
        return $this->item($variant->plan_info,new ProcurementPlanProductVariantTransformer());
    }

}