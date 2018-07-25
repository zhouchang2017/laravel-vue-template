<?php

namespace App\Modules\Product\Transformers;

use App\Modules\Scaffold\Transformer;
use App\Modules\Product\Models\ProductType;

class ProductTypeTransformer extends Transformer
{
    protected $availableIncludes = [  ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(ProductType $model)
    {
        $this->hidden && $model->addHidden($this->hidden);
        return $model->attributesToArray();
    }


}
