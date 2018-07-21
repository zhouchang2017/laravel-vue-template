<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Transformers\AddressTransformer;
use App\Http\Transformers\ManuallyTransformer;
use App\Http\Transformers\ProcurementTransformer;
use App\Http\Transformers\WarehouseTransformer;
use App\Models\Warehouse;
use Illuminate\Http\Request;


/**
 * @module 仓库管理
 * Class WarehouseController
 * @package App\Http\Controllers\Api
 */
class WarehouseController extends Controller
{
    /**
     * WarehouseController constructor.
     * @param Warehouse $model
     * @param WarehouseTransformer $transformer
     */
    public function __construct(Warehouse $model, WarehouseTransformer $transformer)
    {
        parent::__construct($model, $transformer);
    }

    /**
     * @permission 添加/更新地址
     * @param Request $request
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function address(Request $request, $id)
    {
        $this->setModel($this->model::findOrFail($id));
        // 检测该仓库是否已经有地址
        if ($this->model->addresses->count() > 0) {
            // update
            $address = $this->model->addresses->first()->store($request->all());
        } else {
            // create
            $address = $this->model->addresses()->create($request->all());
        }
        return $this->response->item($address, new AddressTransformer())->setStatusCode(201);
    }

    /**
     * @permission 手工入库列表
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function manuallise($id)
    {
        $this->setModel($this->model::findOrFail($id));
        return $this->response->collection($this->model->manuallise, new ManuallyTransformer());
    }

    /**
     * @permission 采购入库列表
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function procurements($id)
    {
        $this->setModel($this->model::findOrFail($id));
        return $this->response->collection($this->model->procurements, new ProcurementTransformer());
    }

}
