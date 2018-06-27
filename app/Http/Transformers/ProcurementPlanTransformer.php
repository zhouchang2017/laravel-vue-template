<?php

namespace App\Http\Transformers;

use App\Models\ProcurementPlan;

class ProcurementPlanTransformer extends Transformer
{
    protected $availableIncludes = [ 'variants' ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(ProcurementPlan $plan)
    {
        $this->hidden && $plan->addHidden($this->hidden);
        return $plan->attributesToArray();
    }

    public function includeUser(ProcurementPlan $plan)
    {
//        return $this->item($plan->user,new )
    }

    public function includeVariants(ProcurementPlan $plan)
    {
        return $this->collection($plan->variants,new ProductVariantTransformer());
    }


}
