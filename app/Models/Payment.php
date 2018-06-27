<?php

namespace App\Models;


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
