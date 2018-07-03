<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorageHistory extends Model {

    protected $fillable = [
        'warehouse_id', 'product_id', 'product_variant_id', 'good', 'bad',
    ];

    public function origin()
    {
        return $this->morphTo();
    }

}
