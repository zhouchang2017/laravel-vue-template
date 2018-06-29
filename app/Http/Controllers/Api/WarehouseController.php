<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Transformers\AddressTransformer;
use App\Http\Transformers\ManuallyTransformer;
use App\Http\Transformers\ProcurementTransformer;
use App\Http\Transformers\WarehouseTransformer;
use App\Models\Warehouse;
use Illuminate\Http\Request;


class WarehouseController extends Controller
{
    public function __construct(Warehouse $model, WarehouseTransformer $transformer)
    {
        parent::__construct($model, $transformer);
    }

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

    public function manuallise($id)
    {
        $this->setModel($this->model::findOrFail($id));
        return $this->response->collection($this->model->manuallise, new ManuallyTransformer());
    }

    public function procurements($id)
    {
        $this->setModel($this->model::findOrFail($id));
        return $this->response->collection($this->model->procurements, new ProcurementTransformer());
    }

}
