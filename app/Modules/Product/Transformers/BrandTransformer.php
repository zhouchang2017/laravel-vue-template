<?php

namespace App\Modules\Product\Transformers;

use App\Modules\Scaffold\Transformer;
use App\Modules\Product\Models\Brand;

class BrandTransformer extends Transformer
{
    protected $availableIncludes = [  ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(Brand $brand)
    {
        $this->hidden && $brand->addHidden($this->hidden);
        return $brand->attributesToArray();
    }


}
