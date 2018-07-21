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
use App\Services\Procurement\ProcurementService;
use Illuminate\Http\Request;

/**
 * @module 采购管理
 * Class ProcurementController
 * @package App\Http\Controllers\Api
 */
class ProcurementController extends Controller
{
    /**
     * @var array
     */
    protected $formRequest = [
        'update' => UpdateProcurementRequest::class,
    ];

    /**
     * ProcurementController constructor.
     * @param Procurement $model
     * @param ProcurementTransformer $transformer
     */
    public function __construct(Procurement $model, ProcurementTransformer $transformer)
    {
        parent::__construct($model, $transformer);
    }


    /**
     * @permission 入库
     * @param $id
     * @param Request $request
     * @param ProcurementService $service
     * @return \Dingo\Api\Http\Response
     */
    public function addStorage($id, Request $request, ProcurementService $service)
    {
        $service->find($id)->put($request->all());
        return $this->response->created();
    }


}
