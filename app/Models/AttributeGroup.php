<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    protected $fillable = [
        'name','variant','variant','type','required','customized','can_upload'
    ];

    public function group()
    {
        return $this->belongsTo(AttributeGroup::class);
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class, 'group_id');
    }

    public function type()
    {
        
    }
}
