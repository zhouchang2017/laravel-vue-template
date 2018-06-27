<?php

namespace App\Models;

use App\Models\Contracts\ModelContract;
use App\Observers\ProcurementPlanProductVariantObservers;
use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProcurementPlanProductVariant extends Pivot implements ModelContract
{
    use ModelTrait;

    protected $table = 'procurement_plan_product_variant';

    /**
     * 数据模型的启动方法
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        self::observe(ProcurementPlanProductVariantObservers::class);
    }

    /**
     * 产品供应商
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo(ProductProvider::class, 'product_provider_id');
    }

    public function getTotalPrice(): int
    {
        return (int)$this->price * (int)$this->pcs;
    }

    public function plan()
    {
        return $this->belongsTo(ProcurementPlan::class,'procurement_plan_id');
    }


}
