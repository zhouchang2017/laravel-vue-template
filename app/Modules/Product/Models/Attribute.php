<?php

namespace App\Modules\Product\Models;

//use App\Observers\AttributeObserver;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'group_id',
        'value',
    ];

    protected $appends = ['variant'];


    /**
     * 数据模型的启动方法
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
//        self::observe(AttributeObserver::class);
    }

    public function getVariantAttribute()
    {
        return $this->group->isVariant();
    }

    public function group()
    {
        return $this->belongsTo(AttributeGroup::class);
    }

    public function productAttribute()
    {
        return $this->hasMany(ProductAttribute::class, 'attribute_id', 'id');
    }
}
