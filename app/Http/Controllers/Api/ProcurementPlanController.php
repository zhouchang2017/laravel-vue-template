<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ApprovalProcurementPlanRequest;
use App\Http\Requests\StoreProcurementPlanRequest;
use App\Http\Requests\UpdateProcurementPlanRequest;
use App\Http\Transformers\ProcurementPlanTransformer;
use App\Models\ProcurementPlan;
use App\Http\Controllers\Controller;

/**
 * @module 采购计划管理
 * Class ProcurementPlanController
 * @package App\Http\Controllers\Api
 */
class ProcurementPlanController extends Controller
{
    /**
     * @var array
     */
    protected $formRequest = [
        'store'  => StoreProcurementPlanRequest::class,
        'update' => UpdateProcurementPlanRequest::class,
    ];

    /**
     * ProcurementPlanController constructor.
     * @param ProcurementPlan $model
     * @param ProcurementPlanTransformer $transformer
     */
    public function __construct(ProcurementPlan $model, ProcurementPlanTransformer $transformer)
    {
        parent::__construct($model, $transformer);
    }

    /**
     * @permission 审核
     * @param ApprovalProcurementPlanRequest $request
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function approval(ApprovalProcurementPlanRequest $request, $id)
    {
        $model = $this->model::findOrFail($id)->willStore($request->all());
        $history = is_array($model->history) ? $model->history : [];
        array_push($history,$request->genHistory());
        $model->history = $history;
        $model->save();
        return $this->response->noContent();
    }


}
