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

    /**
     * 应该被转换成原生类型的属性。
     *
     * @var array
     */
    protected $casts = [
        'thumb' => 'array'
    ];

    protected $hidden =[
      'path'
    ];

    public function assetable()
    {
        return $this->morphTo();
    }
}
