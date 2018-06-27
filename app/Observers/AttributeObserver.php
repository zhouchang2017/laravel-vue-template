<?php
/**
 * Created by PhpStorm.
 * User: z
 * Date: 2018/6/8
 * Time: 下午4:05
 */

namespace App\Observers;


use App\Models\Attribute;

class AttributeObserver
{
    public function deleted(Attribute $attribute)
    {
        // 删除产品属性中具备的该属性值
//        ProductAttribute::deleteBy('attribute_id',$attribute->id);
        $attribute->productAttribute->each(function($productAttribute){
            $productAttribute->delete();
        });
    }

    public function updated(Attribute $attribute)
    {
        // 当属性组改变时同时更新与之关联的所有产品
        $attribute->productAttribute->each(function($productAttribute)use ($attribute){
            $productAttribute->attribute_group_id = $attribute->group_id;
            $productAttribute->save();
        });
    }


}