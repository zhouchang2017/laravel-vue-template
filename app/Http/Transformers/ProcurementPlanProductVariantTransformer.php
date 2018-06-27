<?php

namespace App\Http\Transformers;

use App\Models\ProcurementPlanProductVariant;

class ProcurementPlanProductVariantTransformer extends Transformer
{
    protected $availableIncludes = [ 'provider' ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(ProcurementPlanProductVariant $planInfo)
    {
        $this->hidden && $planInfo->addHidden($this->hidden);
        return $planInfo->attributesToArray();
    }

    public function includeProvider(ProcurementPlanProductVariant $planInfo)
    {
        return $this->item($planInfo->provider, new ProductProviderTransformer());
    }


}
