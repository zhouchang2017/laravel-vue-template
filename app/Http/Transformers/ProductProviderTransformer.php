<?php

namespace App\Http\Transformers;

use App\Models\ProductProvider;

class ProductProviderTransformer extends Transformer
{
    protected $defaultIncludes = [];
    protected $availableIncludes = [ 'info', 'payment' ];

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

}