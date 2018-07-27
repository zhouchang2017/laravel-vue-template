<?php

namespace App\Modules\Product\Transformers;

use App\Modules\Scaffold\Transformer;
use App\Modules\Product\Models\Category;

class CategoryTransformer extends Transformer
{
    protected $availableIncludes = [  ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(Category $category)
    {
        $this->hidden && $category->addHidden($this->hidden);
        return $category->attributesToArray();
    }


}
