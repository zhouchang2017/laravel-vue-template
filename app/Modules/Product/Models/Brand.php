<?php

namespace App\Modules\Product\Models;

use App\Modules\Scaffold\BaseModel as Model;
use App\Modules\Scaffold\Models\Asset;

class Brand extends Model
{
    protected $fillable=['name','description'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function images()
    {
        return $this->morphMany(Asset::class,'assetable');
    }
}
