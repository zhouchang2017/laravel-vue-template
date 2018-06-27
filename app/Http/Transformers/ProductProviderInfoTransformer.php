<?php

namespace App\Http\Transformers;

use App\Models\ProductProviderInfo;

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
        return $info->toArray();
    }


}
