<?php

namespace App\Modules\ProductProvider\Models;

use App\Modules\Scaffold\BaseModel as Model;
/**
 * 结算方式
 * Class Balance
 * @package App\Models
 */
class Balance extends Model
{
    protected $fillable = [ 'name', 'options' ];

    protected $casts = [
        'options' => 'array',
    ];

    public function providerPayments()
    {
        return $this->hasMany(ProductProviderPayment::class);
    }

    public function providers()
    {
        return $this->load('ProductProviderPayment.provider');
    }

}
