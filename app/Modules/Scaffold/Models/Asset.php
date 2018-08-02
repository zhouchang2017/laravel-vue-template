<?php

namespace App\Modules\Scaffold\Models;

use App\Modules\Scaffold\BaseModel as Model;

class Asset extends Model
{
    protected $fillable = [
        'path',
        'url',
        'height',
        'width',
        'size',
        'type'
    ];

    public function assetable()
    {
        return $this->morphTo();
    }
}
