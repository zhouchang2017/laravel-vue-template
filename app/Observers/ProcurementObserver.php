<?php

namespace App\Observers;


use App\Models\Procurement;
use App\Models\ProcurementPlanProductVariant;

class ProcurementObserver
{

    public function creating(Procurement $procurement)
    {
        $procurement->willStore($procurement->calcTotalPriceOrPcs());
        $this->testChangePaymentStatus($procurement);
    }

    public function created(Procurement $procurement)
    {

    }

    public function updating(Procurement $procurement)
    {
        $this->testChangePaymentStatus($procurement);
        $this->testChangStatusToSending($procurement);
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

    public function saving(Procurement $procurement)
    {

    }

    public function saved(Procurement $procurement)
    {

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
            $procurement->updateTotalPriceOrPcs();
            // 是否需要更新状态
            $this->testChangeProcurementStatus($procurement)->save();
        }
    }

    /**
     * 改变支付状态
     * @param Procurement $procurement
     */
    private function testChangePaymentStatus(Procurement $procurement)
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

    private function testChangStatusToSending(Procurement $procurement)
    {
        $original = json_decode($procurement->getOriginal('shipment'), true);
        $shipment = $procurement->getAttribute('shipment');
        if ($original !== $shipment && $procurement->procurement_status === 'pending') {
            $procurement->setAttribute('procurement_status', 'sending');
        }
    }

    private function testChangeProcurementStatus(Procurement $procurement)
    {
        $result = $procurement->planInfo->reduce(function ($result, $planInfo) {
            $result[] = $planInfo->getProcurementStatus();
            return $result;
        }, []);

        if (in_array('part_finished', $result)) {
            $procurement->setAttribute('procurement_status', 'part_finished');
        }

        if ( !in_array('part_finished', $result) && !in_array('sending', $result)) {
            $procurement->setAttribute('procurement_status', 'finished');
        }

        if ( !in_array('part_finished', $result) && !in_array('finished', $result)) {
            $procurement->setAttribute('procurement_status', 'sending');
        }
        return $procurement;
    }

}