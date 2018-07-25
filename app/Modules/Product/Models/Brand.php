<?php

namespace App\Modules\Product\Models;

use App\Modules\Scaffold\BaseModel as Model;
class Brand extends Model
{
    protected $fillable=['name','avatar','description'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
