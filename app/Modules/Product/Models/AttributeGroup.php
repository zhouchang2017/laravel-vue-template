<?php

namespace App\Modules\Product\Models;

use App\Observers\AttributeGroupObserver;
use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    protected $fillable = [
        'name','variant','variant','type','required','customized','can_upload'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
//        'can_upload',
    ];

    /**
     * 应该被转换成原生类型的属性。
     *
     * @var array
     */
    protected $casts = [
        'variant' => 'boolean',
        'required' => 'boolean',
        'customized' => 'boolean',
        'can_upload' => 'boolean',
    ];

    /**
     * 数据模型的启动方法
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::observe(AttributeGroupObserver::class);
    }


    public function scopeSkuAttributes($query)
    {
        return $query->where('variant',true);
    }

    public function isVariant()
    {
        return $this->getAttribute('variant');
    }

    public function types()
    {
        return $this->belongsToMany(ProductType::class,'product_type_attribute_group','group_id','type_id');
    }

    public function values()
    {
        return $this->hasMany(Attribute::class, 'group_id');
    }

}
