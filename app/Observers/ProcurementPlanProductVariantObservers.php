<?php

namespace App\Observers;


use App\Models\ProcurementPlanProductVariant;

class ProcurementPlanProductVariantObservers
{

    public function creating(ProcurementPlanProductVariant $planInfo)
    {

    }

    public function created(ProcurementPlanProductVariant $planInfo)
    {

    }

    public function updating(ProcurementPlanProductVariant $planInfo)
    {
        dump('updating');
        dump($planInfo);
    }

    public function updated(ProcurementPlanProductVariant $planInfo)
    {
        dump('updated');
        dump($planInfo);
    }

    public function saved(ProcurementPlanProductVariant $planInfo)
    {
        dump('saved');

        dd($planInfo);
    }

    public function afterUpdated(ProcurementPlanProductVariant $planInfo)
    {
        // 更新plan_info
        // plan_info : [{},]
    }

    public function deleted(ProcurementPlanProductVariant $planInfo)
    {

    }

    private function reCalcTotalPriceOrPcs(ProcurementPlanProductVariant $planInfo)
    {
        $change = $planInfo->getChanges();
        if (array_key_exists('pcs', $change) || array_key_exists('price', $change)) {

        }
//        return $planInfo->reduce(function ($calc, $variant) {
//            $calc['total_price'] += $variant->plan_info->getTotalPrice();
//            $calc['total_pcs'] += $variant->plan_info->pcs;
//            $calc['able_price'] = $calc['total_price'];
//            return $calc;
//        }, [ 'total_price' => 0, 'total_pcs' => 0, 'able_price' => 0 ]);
    }


}