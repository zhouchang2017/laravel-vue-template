<?php

namespace App\Modules\Product\Models;

use App\Modules\Product\Observers\ProductTypeObserver;
use App\Modules\Scaffold\BaseModel as Model;

class ProductType extends Model
{
    protected $fillable = ['name', 'config'];

    protected $fieldSearchable = [
        'id',
        'name',
    ];
    /**
     * 应该被转换成原生类型的属性。
     *
     * @var array
     */
    protected $casts = [
        'config' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        self::observe(ProductTypeObserver::class);
    }


    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function attributeGroups()
    {
        return $this->belongsToMany(AttributeGroup::class, 'product_type_attribute_group', 'type_id', 'group_id');
    }

}
