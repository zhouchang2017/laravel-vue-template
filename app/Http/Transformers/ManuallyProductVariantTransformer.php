<?php

namespace App\Http\Transformers;

use App\Models\ManuallyProductVariant;

class ManuallyProductVariantTransformer extends Transformer
{
    protected $availableIncludes = [  ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(ManuallyProductVariant $manuallyInfo)
    {
        $this->hidden && $manuallyInfo->addHidden($this->hidden);
        return $manuallyInfo->attributesToArray();
    }


}
