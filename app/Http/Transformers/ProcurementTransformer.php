<?php

namespace App\Http\Transformers;

use App\Models\Procurement;

class ProcurementTransformer extends Transformer
{
    protected $availableIncludes = [ 'plan' ];

    public function __construct($field = null)
    {
        parent::__construct($field);
    }

    public function transform(Procurement $procurement)
    {
        $this->hidden && $procurement->addHidden($this->hidden);
        return $procurement->attributesToArray();
    }

    public function includePlan(Procurement $procurement)
    {
        return $this->item($procurement->plan, new ProcurementPlanTransformer());
    }


}
