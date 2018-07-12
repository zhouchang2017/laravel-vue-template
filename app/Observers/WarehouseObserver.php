<?php

namespace App\Observers;


use App\Models\Warehouse;

class WarehouseObserver
{

    public function created(Warehouse $warehouse)
    {
        $this->updateOrCreateAddress($warehouse);
    }

    public function deleted(Warehouse $warehouse)
    {
        $this->deleteAddress($warehouse);
    }

    public function willUpdate(Warehouse $warehouse)
    {
        $this->updateOrCreateAddress($warehouse);
    }


    /**
     * 创建或更新仓库地址
     * @param Warehouse $warehouse
     * @return Warehouse
     */
    private function updateOrCreateAddress(Warehouse $warehouse)
    {
        if(request()->has('addresses')){
            if($warehouse->addresses()->count()>=1){
                $warehouse->addresses()->first()->update(request()->input('addresses'));
            }else{
                $warehouse->addresses()->create(request()->input('addresses'));
            }

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