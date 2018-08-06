<?php

namespace App\Modules\Product\Transformers;

use App\Modules\Scaffold\Transformer;
use App\Modules\Product\Models\Brand;
use App\Modules\Scaffold\Transformers\AssetTransformer;

class BrandTransformer extends Transformer
{
    protected $availableIncludes = ['avatars'];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(Brand $brand)
    {
        $this->hidden && $brand->addHidden($this->hidden);
        return $brand->attributesToArray();
    }

    public function includeAvatars(Brand $brand)
    {
        return $this->collection($brand->avatars, new AssetTransformer());
    }


}
