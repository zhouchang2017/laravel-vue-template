<?php

namespace App\Models;

/**
 * 仓库
 * Class Warehouse
 * @package App\Models
 */
class Warehouse extends Model
{
    protected $fillable = ['name','type_id'];

    public function type()
    {
        return $this->belongsTo(WarehouseType::class,'type_id');
    }

    public function addresses()
    {
        return $this->morphMany(Address::class,'addressable');
    }
}
