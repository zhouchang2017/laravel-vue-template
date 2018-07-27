<?php

namespace App\Modules\ProductProvider\Transformers;

use App\Modules\ProductProvider\Models\ProductProvider;
use App\Modules\ProductProvider\Models\ProductProviderInfo;
use App\Modules\Scaffold\Transformer;

class ProductProviderInfoTransformer extends Transformer
{
    protected $availableIncludes = [  ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(ProductProviderInfo $info)
    {
        $this->hidden && $info->addHidden($this->hidden);
        return $info->attributesToArray();
    }


}
