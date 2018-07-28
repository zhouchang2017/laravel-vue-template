<?php

namespace App\Modules\ProductProvider\Transformers;

use App\Modules\Product\Transformers\ProductVariantTransformer;
use App\Modules\ProductProvider\Models\ProductProvider;
use App\Modules\Scaffold\Transformer;
use App\Modules\Scaffold\Transformers\AddressTransformer;

class ProductProviderTransformer extends Transformer
{
    protected $defaultIncludes = [];
    protected $availableIncludes = [ 'info', 'payment','addresses','products' ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(ProductProvider $productProvider)
    {
        $this->hidden && $productProvider->addHidden($this->hidden);
        return $productProvider->toArray();
    }

    public function includeInfo(ProductProvider $productProvider)
    {
        return $this->item($productProvider->info, new ProductProviderInfoTransformer());
    }

    public function includePayment(ProductProvider $productProvider)
    {
        return $this->item($productProvider->providerPayment, new ProductProviderPaymentTransformer());
    }

    public function includeAddresses(ProductProvider $productProvider)
    {
        return $this->collection($productProvider->addresses, new AddressTransformer());
    }

    public function includeProducts(ProductProvider $productProvider)
    {
        return $this->collection($productProvider->products, new ProductVariantTransformer());
    }


}
