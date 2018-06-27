<?php

namespace App\Observers;


use App\Models\Warehouse;

class WarehouseObserver
{

    public function created(Warehouse $warehouse)
    {
        $this->createAddress($warehouse);
    }

    public function deleted(Warehouse $warehouse)
    {
        $this->deleteAddress($warehouse);
    }

    /**
     * 创建仓库地址
     * @param Warehouse $warehouse
     * @return Warehouse
     */
    private function createAddress(Warehouse $warehouse)
    {
        if(request()->has('address')){
            $warehouse->addresses()->create(request()->input('address'));
        }
        return $warehouse;
    }

    /**
     * 删除仓库地址
     * @param Warehouse $warehouse
     * @return mixed
     */
    private function deleteAddress(Warehouse $warehouse)
    {
        return $warehouse->addresses()->delete();
    }

}