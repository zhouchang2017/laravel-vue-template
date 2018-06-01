<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;

    protected $fillable = [
         'parent_id'
    ];

    public function hasChildren()
    {
        return (bool) $this->children()->count();
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }

    public function getProductCount()
    {
        return $this->belongsToMany(Product::class, 'product_categories')->count();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_categories');
    }
}
