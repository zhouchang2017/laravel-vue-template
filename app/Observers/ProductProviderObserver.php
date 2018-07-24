<?php

namespace App\Observers;


use App\Models\ProductProvider;

/**
 * Class ProductProviderObserver
 * @package App\Observers
 */
class ProductProviderObserver
{

    /**
     * @param ProductProvider $provider
     */
    public function created(ProductProvider $provider)
    {
        $this->createPayment($provider);
        $this->createInfo($provider);
        $this->createOrUpdateAddress($provider);
    }

    /**
     * @param ProductProvider $provider
     */
    public function deleted(ProductProvider $provider)
    {
        $this->deletePayment($provider);
        $this->deleteInfo($provider);
        $this->deleteAddress($provider);
    }

    /**
     * @param ProductProvider $provider
     */
    public function afterUpdated(ProductProvider $provider)
    {
        $this->updatePayment($provider);
        $this->updateInfo($provider);
        $this->createOrUpdateAddress($provider);
    }

    /**
     * 创建供应商详情
     * @param ProductProvider $provider
     */
    private function createInfo(ProductProvider $provider)
    {
        if (request()->has('info')) {
            $info = $provider->info()->create(request()->input('info'));
            $provider->setRelation('info', $info);
        }
    }

    /**
     * 更新供应商详情
     * @param ProductProvider $provider
     */
    private function updateInfo(ProductProvider $provider)
    {
        if (request()->has('info')) {
            $info = $provider->info->store(request()->input('info'));
            $provider->setRelation('info', $info);
        }
    }

    /**
     * 创建或者更新供应商地址
     * @param ProductProvider $provider
     * @return ProductProvider
     */
    private function createOrUpdateAddress(ProductProvider $provider)
    {
        if(request()->has('addresses')){
            // 检测该供应商是否已经有地址
            if($provider->addresses->count()>0){
                // update
                $address = $provider->addresses->first()->store(request()->input('addresses'));
            }else{
                // create
                $address = $provider->addresses()->create(request()->input('addresses'));
            }
            $provider->setRelation('addresses', $address);
        }
        return $provider;
    }

    /**
     * 删除供应商地址
     * @param ProductProvider $provider
     */
    private function deleteAddress(ProductProvider $provider)
    {
        $provider->addresses()->delete();
    }

    /**
     * 删除供应商详情
     * @param ProductProvider $provider
     */
    private function deleteInfo(ProductProvider $provider)
    {
        $provider->info->delete();
    }

    /**
     * 创建收款方式
     * @param ProductProvider $provider
     */
    private function createPayment(ProductProvider $provider)
    {
        if (request()->has('payment')) {
            $payment = $provider->providerPayment()->create(request()->input('payment'));
            $provider->setRelation('payment', $payment);
        }
    }

    /**
     * 更新供应商收款方式
     * @param ProductProvider $provider
     */
    private function updatePayment(ProductProvider $provider)
    {
        if (request()->has('payment')) {
            $payment = $provider->providerPayment->store(request()->input('payment'));
            $provider->setRelation('payment', $payment);
        }
    }

    /**
     * 删除供应商的收款方式
     * @param ProductProvider $provider
     */
    private function deletePayment(ProductProvider $provider)
    {
        $provider->providerPayment->delete();
    }


}