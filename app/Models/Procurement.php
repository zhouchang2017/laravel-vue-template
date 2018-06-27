<?php

namespace App\Models;


use App\Observers\ProcurementObserver;

class Procurement extends Model
{
    protected $procurement_status = [
        'part_finished', // 未全部到货
        'pending', // 等待发货
        'sending',// 途中
        'finished',// 全部到货
        'cancel'// 作废
    ];

    protected $payment_status = [
        'unpaid',// 未支付
        'paid',// 以支付
        'part_paid',// 部分支付
        'cancel',// 以取消支付
    ];

    protected $fillable = [
        'procurement_status',//采购状态
        'total_pcs',//总计件数
        'total_price',//货款
        'able_price',//应付款
        'already_price',//已付款
        'procurement_at',//采购日期
        'pre_arrived_at',//预计到货日期
        'arrived_at',//到货日期
        'shipment',//物流
    ];

    protected $casts = [
        'shipment' => 'array',
    ];

    /**
     * 数据模型的启动方法
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        self::observe(ProcurementObserver::class);
    }

    public function plan()
    {
        return $this->belongsTo(ProcurementPlan::class, 'procurement_plan_id');
    }

    public function calcTotalPriceOrPcs()
    {
        return $this->plan->variants->reduce(function ($calc, $variant) {
            $calc['total_price'] += $variant->plan_info->getTotalPrice();
            $calc['total_pcs'] += $variant->plan_info->pcs;
            $calc['able_price'] = $calc['total_price'];
            return $calc;
        }, [ 'total_price' => 0, 'total_pcs' => 0, 'able_price' => 0 ]);
    }
}
