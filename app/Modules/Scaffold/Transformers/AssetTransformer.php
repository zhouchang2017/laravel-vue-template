<?php

namespace App\Modules\Scaffold\Transformers;

use App\Modules\Scaffold\Models\Asset;
use App\Modules\Scaffold\Transformer;

class AssetTransformer extends Transformer
{
    protected $availableIncludes = [  ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(Asset $asset)
    {
        $this->hidden && $asset->addHidden($this->hidden);
        return $asset->attributesToArray();
    }


}
