<?php

namespace App\Observers;


use App\Models\Procurement;
use App\Models\ProcurementPlanProductVariant;

class ProcurementObserver
{

    public function creating(Procurement $procurement)
    {
        $this->changePaymentStatus($procurement);
    }

    public function created(Procurement $procurement)
    {

    }

    public function updating(Procurement $procurement)
    {
        $this->changePaymentStatus($procurement);
    }

    public function updated(Procurement $procurement)
    {

    }

    public function afterUpdated(Procurement $procurement)
    {
        // 更新plan_info
        // plan_info : [{},]
        $this->updateProcurementPlanProductVariant($procurement);
    }

    public function deleted(Procurement $procurement)
    {

    }

    private function updateProcurementPlanProductVariant(Procurement $procurement)
    {
        if (request()->has('plan_info')) {
            collect(request('plan_info'))->each(function ($info) {
                ProcurementPlanProductVariant::findOrFail($info['id'])->update($info);
            });
        }
    }

    /**
     * 改变支付状态
     * @param Procurement $procurement
     */
    private function changePaymentStatus(Procurement $procurement)
    {
//        'unpaid',// 未支付
//        'paid',// 以支付
//        'part_paid',// 部分支付
//        'cancel',// 以取消支付
        $ablePrice = (int)$procurement->getAttribute('able_price') ?? 0;
        $alreadyPrice = (int)$procurement->getAttribute('already_price') ?? 0;
        $difference = $ablePrice - $alreadyPrice;

        switch (true) {
            case ($difference > 0 && $difference < $ablePrice):
                $procurement->setAttribute('payment_status', 'part_paid');
                break;
            case ($difference === $ablePrice):
                $procurement->setAttribute('payment_status', 'unpaid');
                break;
            case ($difference === 0):
                $procurement->setAttribute('payment_status', 'paid');
        }
    }

}