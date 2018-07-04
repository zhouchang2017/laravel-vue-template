<?php

namespace App\Models;

use App\Models\Contracts\ModelContract;
use App\Observers\ProcurementPlanProductVariantObservers;
use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Relations\Pivot;


/**
 * Class ProcurementPlanProductVariant
 * @package App\Models
 */
class ProcurementPlanProductVariant extends Pivot implements ModelContract
{
    use ModelTrait;

    /**
     * @var string
     */
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

    /**
     * 采购单
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function procurement()
    {
        return $this->hasOne(Procurement::class, 'procurement_plan_id', 'procurement_plan_id');
    }

    /**
     * @return int
     */
    public function getTotalPrice(): int
    {
        return (int)$this->price * (int)$this->pcs;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plan()
    {
        return $this->belongsTo(ProcurementPlan::class, 'procurement_plan_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function history()
    {
        return $this->morphMany(StorageHistory::class,'origin');
    }

    /**
     * @return string
     */
    public function getProcurementStatus()
    {
        $res = (int)$this->pcs - (int)$this->arrived_pcs;
        $result = 'sending';
        switch (true) {
            case ($res > 0 && $res < (int)$this->pcs):
                $result = 'part_finished';
                break;
            case ($res === (int)$this->pcs):
                $result = 'sending';
                break;
            case ($res === 0):
                $result = 'finished';
        }
        return $result;
    }


}
