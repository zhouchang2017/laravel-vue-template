<?php

namespace App\Http\Transformers;

use App\Models\ProductVariant;

class ProductVariantTransformer extends Transformer
{
    protected $availableIncludes = [ 'attributes', 'info','product', 'providers', 'plan_info', 'manually_info','name' ];

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

    public function includeProduct(ProductVariant $variant)
    {
        return $this->item($variant->product, new ProductTransformer());
    }

    public function includeName(ProductVariant $variant)
    {
        return $this->primitive($variant->product->name);
    }

    public function includeProviders(ProductVariant $variant)
    {
        return $this->collection($variant->providers, new ProductProviderTransformer());
    }

    public function includePlanInfo(ProductVariant $variant)
    {
        return $this->item($variant->plan_info, new ProcurementPlanProductVariantTransformer());
    }

    public function includeManuallyInfo(ProductVariant $variant)
    {
        return $this->item($variant->manually_info, new ManuallyProductVariantTransformer());
    }

}