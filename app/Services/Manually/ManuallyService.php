<?php
/**
 * Created by PhpStorm.
 * User: z
 * Date: 2018/7/3
 * Time: 上午11:30
 */

namespace App\Services\Manually;


use App\Models\Manually;
use App\Models\ManuallyProductVariant;
use App\Services\Warehouse\Origin;

class ManuallyService extends Origin
{

    public function __construct(Manually $model)
    {
        parent::__construct($model);
    }

    public function getWarehouseId()
    {
        return $this->model->warehouse_id;
    }


    /**
     * @return \App\Models\Warehouse|mixed
     */
    public function getWarehouse()
    {
        return $this->model->warehouse;
    }

    /**
     * @return \App\Models\Storage|\Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getStorage()
    {
        return $this->getWarehouse()->storage();
    }


    public function history()
    {
        return $this->model->history;
    }

    /**
     * @param $id
     * @return  \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function getHistoryRelation($id)
    {
        return ManuallyProductVariant::findOrFail($id)->history();
    }
}