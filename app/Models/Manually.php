<?php

namespace App\Models;

use App\Observers\ManuallyObserver;
use App\Services\Warehouse\Contract\AddStorageContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manually extends Model {
    use SoftDeletes;

    protected $fillable = ['user_id', 'warehouse_id', 'description', 'status'];

    protected $casts = [
        'history' => 'array',
    ];

    protected $status = ['uncommitted', 'pending', 'finished', 'cancel'];

    /**
     * 数据模型的启动方法
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        self::observe(ManuallyObserver::class);
    }

    public function scopeOfStatus($query, $status = null)
    {
        return $query->when($status, function ($query) use ($status) {
            return $query->where('status', $status);
        });
    }

    /**
     * 手动入库指定仓库
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    /**
     * 手动入库创建人
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 手动入库关联的产品变体
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function variants()
    {
        return $this->belongsToMany(ProductVariant::class)->using(ManuallyProductVariant::class)
            ->as('manually_info')
            ->withPivot(
                'id', 'price', 'pcs', 'offer_price', 'product_id', 'product_provider_id', 'user_id', 'good', 'bad'
            )
            ->withTimestamps();
    }

    public function manuallyInfo()
    {
        return $this->hasMany(ManuallyProductVariant::class);
    }

    public function getHistoryAttribute()
    {
        return $this->manuallyInfo()->has('history')->with('history')->get();
    }

}
