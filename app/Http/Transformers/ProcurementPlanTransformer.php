<?php

namespace App\Http\Transformers;

use App\Models\ProcurementPlan;
use App\Models\ProcurementPlanProductVariant;

class ProcurementPlanTransformer extends Transformer
{
    protected $availableIncludes = [ 'variants','plan_info' ];

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

    public function includePlanInfo(ProcurementPlan $plan)
    {
        return $this->collection($plan->planInfo,new ProcurementPlanProductVariantTransformer());
    }


}
