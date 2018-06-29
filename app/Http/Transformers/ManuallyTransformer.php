<?php

namespace App\Http\Transformers;

use App\Models\Manually;

class ManuallyTransformer extends Transformer
{
    protected $availableIncludes = [ 'variants','manuallyInfo' ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(Manually $manually)
    {
        $this->hidden && $manually->addHidden($this->hidden);
        return $manually->attributesToArray();
    }

    public function includeVariants(Manually $manually)
    {
        return $this->collection($manually->variants,new ProductVariantTransformer());
    }

    public function includeManuallyInfo(Manually $manually)
    {
        return $this->collection($manually->manuallyInfo,new ManuallyProductVariantTransformer());
    }


}
