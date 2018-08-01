<?php

namespace App\Modules\Scaffold\Models;

use App\Modules\Scaffold\BaseModel as Model;

class Asset extends Model
{
    protected $fillable = [
        'path',
        'url',
        'height',
        'weight',
        'size'
    ];

    public function assetable()
    {
        return $this->morphTo();
    }
}
