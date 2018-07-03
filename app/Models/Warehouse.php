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

    public function manuallise()
    {
        return $this->hasMany(Manually::class)->when(request()->has('manuallise:status'),function($query){
            $query->whereStatus(request('manuallise:status'));
        });
    }

    public function procurements()
    {
        return $this->hasManyThrough(Procurement::class, ProcurementPlan::class)->when(request()->has('procurement:status'),function($query){
            $query->whereStatus(request('procurement:status'));
        });
    }

    public function storage()
    {
        return $this->hasMany(Storage::class);
    }
}
