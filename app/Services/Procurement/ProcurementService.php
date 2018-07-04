<?php
/**
 * Created by PhpStorm.
 * User: z
 * Date: 2018/7/4
 * Time: 下午3:44
 */

namespace App\Services\Procurement;


use App\Models\Procurement;
use App\Models\ProcurementPlanProductVariant;
use App\Services\Warehouse\Origin;

class ProcurementService extends Origin
{

    public function __construct(Procurement $model)
    {
        parent::__construct($model);
    }


    /**
     * 获取仓库id
     * @return mixed
     */
    public function getWarehouseId()
    {
        return $this->model->warehouse->id;
    }

    /**
     * @return mixed
     */
    public function history()
    {
        return $this->model->history;
    }

    /**
     * 获取仓库
     * @return \App\Models\Warehouse
     */
    public function getWarehouse()
    {
        return $this->model->warehouse;
    }

    /**
     * 获取仓库Storage
     * @return \App\Models\Storage
     */
    public function getStorage()
    {
        return $this->model->warehouse->storage();
    }

    /**
     * @param $id
     * @return  \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function getHistoryRelation($id)
    {
        return ProcurementPlanProductVariant::findOrFail($id)->history();
    }
}