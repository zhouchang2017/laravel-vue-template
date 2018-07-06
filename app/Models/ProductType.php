<?php

namespace App\Models;


class ProductType extends Model
{
    protected $fillable = ['name','config'];
    protected $fieldSearchable = [
        'id',
        'name'
    ];
    /**
     * 应该被转换成原生类型的属性。
     *
     * @var array
     */
    protected $casts = [
        'config' => 'array',
    ];


    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(AttributeGroup::class,'product_type_attribute_group','type_id','group_id');
    }

}
