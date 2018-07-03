<?php

namespace App\Models;


class Storage extends Model
{
    protected $fillable = [
      'warehouse_id','product_id','product_variant_id','num','good','bad'
    ];
}
