<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ApprovalProcurementPlanRequest;
use App\Http\Requests\StoreProcurementPlanRequest;
use App\Http\Requests\UpdateProcurementPlanRequest;
use App\Http\Requests\UpdateProcurementRequest;
use App\Http\Transformers\ProcurementPlanTransformer;
use App\Http\Transformers\ProcurementTransformer;
use App\Models\Procurement;
use App\Models\ProcurementPlan;
use App\Http\Controllers\Controller;

class ProcurementController extends Controller
{
    protected $formRequest = [
        'update' => UpdateProcurementRequest::class,
    ];

    public function __construct(Procurement $model, ProcurementTransformer $transformer)
    {
        parent::__construct($model, $transformer);
    }

    public function store()
    {
        //
    }


}
