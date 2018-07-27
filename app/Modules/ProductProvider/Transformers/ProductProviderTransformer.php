<?php

namespace App\Modules\ProductProvider\Transformers;

use App\Modules\ProductProvider\Models\ProductProvider;
use App\Modules\Scaffold\Transformer;

class ProductProviderTransformer extends Transformer
{
    protected $availableIncludes = [  ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(ProductProvider $provider)
    {
        $this->hidden && $provider->addHidden($this->hidden);
        return $provider->attributesToArray();
    }


}
