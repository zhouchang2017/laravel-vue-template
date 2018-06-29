<?php

namespace App\Http\Transformers;

use App\Models\Procurement;

/**
 * Class ProcurementTransformer
 * @package App\Http\Transformers
 */
class ProcurementTransformer extends Transformer
{
    /**
     * @var array
     */
    protected $availableIncludes = [ 'plan', 'plan_info' ];

    /**
     * ProcurementTransformer constructor.
     * @param null $field
     */
    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    /**
     * @param Procurement $procurement
     * @return array
     */
    public function transform(Procurement $procurement)
    {
        $this->hidden && $procurement->addHidden($this->hidden);
        return $procurement->attributesToArray();
    }

    /**
     * @param Procurement $procurement
     * @return \League\Fractal\Resource\Item|\League\Fractal\Resource\Primitive
     */
    public function includePlan(Procurement $procurement)
    {
        return $this->item($procurement->plan, new ProcurementPlanTransformer());
    }

    /**
     * @param Procurement $procurement
     * @return \League\Fractal\Resource\Collection
     */
    public function includePlanInfo(Procurement $procurement)
    {
        return $this->collection($procurement->planInfo, new ProcurementPlanProductVariantTransformer());
    }


}
