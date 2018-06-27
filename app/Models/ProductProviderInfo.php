<?php

namespace App\Models;


/**
 * 产品供应商详情
 * Class ProductProviderInfo
 * @package App\Models
 */
class ProductProviderInfo extends Model
{
    protected $fillable = [
        'email',
        'qq',
        'wechat',
        'product_provider_id'
    ];

    protected $table = 'product_provider_info';
}
