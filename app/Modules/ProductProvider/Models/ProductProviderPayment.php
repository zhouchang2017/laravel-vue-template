<?php

namespace App\Modules\ProductProvider\Models;

use App\Modules\Scaffold\BaseModel as Model;

/**
 * 供应商财务结算
 * Class ProductProviderPayment
 * @package App\Models
 */
class ProductProviderPayment extends Model
{
    protected $fillable = [ 'balance_id', 'description', 'payment_id', 'options', 'product_provider_id' ];

    /**
     * 应该被转换成原生类型的属性。
     *
     * @var array
     */
    protected $casts = [
        'options' => 'array',
    ];

    /**
     * 数据模型的启动方法
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

//        self::observe(ProductProviderPaymentObserver::class);
    }

    public function provider()
    {
        return $this->belongsTo(ProductProvider::class);
    }

    public function balance()
    {
        return $this->belongsTo(Balance::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
