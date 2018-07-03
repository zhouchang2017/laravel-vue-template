<?php

namespace App\Models;

use App\Models\Contracts\ModelContract;
use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ManuallyProductVariant extends Pivot implements ModelContract
{
    use ModelTrait;

    protected $table = 'manually_product_variant';

    /**
     * 产品供应商
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider()
    {
        return $this->belongsTo(ProductProvider::class, 'product_provider_id');
    }

    /**
     * 手工入库
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function manually()
    {
        return $this->belongsTo(Manually::class, 'manually_id');
    }

    public function history()
    {
        return $this->morphMany(StorageHistory::class,'origin');
    }

    public function getTotalPrice(): int
    {
        return (int)$this->price * (int)$this->pcs;
    }

}
