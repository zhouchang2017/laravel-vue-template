<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UpdateManuallyRequest;
use App\Http\Transformers\ManuallyTransformer;
use App\Models\Manually;
use App\Services\Manually\ManuallyService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @module 手工入库管理
 * Class ManuallyController
 * @package App\Http\Controllers\Api
 */
class ManuallyController extends Controller
{

    /**
     * @var array
     */
    protected $formRequest = [
        'update' => UpdateManuallyRequest::class,
    ];

    /**
     * ManuallyController constructor.
     * @param Manually $model
     * @param ManuallyTransformer $transformer
     */
    public function __construct(Manually $model, ManuallyTransformer $transformer)
    {
        parent::__construct($model, $transformer);
    }

    /**
     * @permission 入库
     * @param $id
     * @param Request $request
     * @param ManuallyService $service
     * @return \Dingo\Api\Http\Response
     */
    public function addStorage($id,Request $request,ManuallyService $service)
    {
        $service->find($id)->put($request->all());
        return $this->response->created();
    }
}
