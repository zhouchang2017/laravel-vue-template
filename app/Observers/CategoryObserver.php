<?php

namespace App\Observers;


use App\Models\Category;

class CategoryObserver
{

//    public function deleting(Category $category)
//    {
//        if($category->hasChildren()){
//            abort(405,$category->name . '分类下存在子分类,不允许删除');
//        }
//    }

    public function deleted(Category $category)
    {
        $category->products()->detach($category->products->pluck('id'));
    }

}