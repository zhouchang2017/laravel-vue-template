<?php

namespace App\Modules\Scaffold\Models;

use App\Modules\Scaffold\BaseModel as Model;


/**
 * 地址
 * Class Address
 * @package App\Models
 */
class Address extends Model
{
    protected $fillable = [
        'name',
        'tel',
        'phone',
        'fax',
        'zip',
        'country',
        'province',
        'city',
        'district',
        'address',
        'en'
    ];

    protected $casts = [
        'en'=>'array'
    ];

    public function addressable()
    {
        return $this->morphTo();
    }


}
