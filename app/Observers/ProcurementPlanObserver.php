<?php

namespace App\Observers;


use App\Models\ProcurementPlan;
use Illuminate\Support\Str;

class ProcurementPlanObserver
{

    public function creating(ProcurementPlan $plan)
    {
        $plan->setAttribute('code', $this->genCode());
    }

    public function created(ProcurementPlan $plan)
    {
        $this->syncProductVariants($plan);
    }

    public function updated(ProcurementPlan $plan)
    {
        $this->createProcurement($plan);
    }

    public function afterUpdated(ProcurementPlan $plan)
    {
        $this->syncProductVariants($plan);
    }

    public function deleted(ProcurementPlan $plan)
    {

    }

    private function syncProductVariants(ProcurementPlan $plan)
    {
        if (request()->has('variants')) {
            $plan->variants()->sync(request()->input('variants'));
        }
        return $plan;
    }

    private function genCode()
    {
        return (string)Str::uuid();
    }

    /**
     * 审核通过创建采购单
     * @param ProcurementPlan $plan
     */
    private function createProcurement(ProcurementPlan $plan)
    {
        // todo 检测是否已存在对应的采购单！！
        if (in_array($plan->status, [ 'already', 5, '5' ])) {
            $plan->procurement()->create($this->calcTotalPriceOrPcs($plan));
        }
    }

    /**
     * 计算采购单总价格和总数量
     * @param ProcurementPlan $plan
     * @return mixed
     */
    private function calcTotalPriceOrPcs(ProcurementPlan $plan)
    {
        return $plan->variants->reduce(function ($calc, $variant) {
            $calc['total_price'] += $variant->plan_info->getTotalPrice();
            $calc['total_pcs'] += $variant->plan_info->pcs;
            $calc['able_price'] = $calc['total_price'];
            return $calc;
        }, [ 'total_price' => 0, 'total_pcs' => 0, 'able_price' => 0 ]);
    }
}