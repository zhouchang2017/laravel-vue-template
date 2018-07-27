<?php

namespace App\Modules\ProductProvider\Models;

use App\Modules\Scaffold\BaseModel as Model;
/**
 * 支付方式
 * Class Payment
 * @package App\Models
 */
class Payment extends Model
{
    protected $fillable = ['name','options'];

    protected $casts = [
        'options' => 'array',
    ];
}
