<?php

namespace App\Modules\ProductProvider\Observers;


use App\Modules\ProductProvider\Models\ProductProvider;

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
        $this->deleteAddress($provider);
    }

    /**
     * @param ProductProvider $provider
     */
    public function afterUpdate(ProductProvider $provider)
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
        request()->has('info')
        && $info = $provider->info()->create(request('info'));

    }

    /**
     * 更新供应商详情
     * @param ProductProvider $provider
     */
    private function updateInfo(ProductProvider $provider)
    {
        request()->has('info')
        && $info = $provider->info->update(request('info'));
    }

    /**
     * 创建或者更新供应商地址
     * @param ProductProvider $provider
     */
    private function createOrUpdateAddress(ProductProvider $provider)
    {
        if (request()->has('addresses')) {
            // 检测该供应商是否已经有地址
            $provider->addresses->count() > 0
                ? $provider->addresses->first()->update(request('addresses'))
                : $provider->addresses()->create(request('addresses'));
        }
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
     * 创建收款方式
     * @param ProductProvider $provider
     */
    private function createPayment(ProductProvider $provider)
    {
        request()->has('payment')
        && $provider->providerPayment()->create(request('payment'));
    }

    /**
     * 更新供应商收款方式
     * @param ProductProvider $provider
     */
    private function updatePayment(ProductProvider $provider)
    {
        request()->has('payment')
        && $provider->providerPayment->update(request('payment'));
    }

}