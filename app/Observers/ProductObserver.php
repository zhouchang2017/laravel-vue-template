<?php

namespace App\Observers;


use App\Models\Product;
use App\Models\ProductAttribute;

class ProductObserver
{

    public function saved(Product $product)
    {
        array_key_exists('product_type_id', $product->getChanges())
        && $product->dissociatedProductAttribute();
    }

    public function afterUpdated(Product $product)
    {
        request()->has('attributes') && $product->updateAttributes(request()->input('attributes'));

        $product->loadAttributes();

        request()->has('variants') && $product->updateVariant(request()->input('variants'));

        $product->loadVariants();

        request()->has('category_ids') && $product->syncCategories(request()->input('category_ids'));

    }

    public function created(Product $product)
    {
        // 同时创建产品对应的属性值
        // request()->has('attributes') && ProductAttribute::createInstance(request()->input('attributes'), $product);
        // 同时创建产品对应变体&变体与产品属性多对多关联
        // request()->has('variants') && $product->createVariant(request()->input('variants'));
        // 同时关联分类
        // request()->has('category_ids') && $product->syncCategories(request()->input('category_ids'));

    }


    /**
     * @param Product $product
     */
    public function deleted(Product $product)
    {
        // 删除产品同时，把产品属性值删除
        $product->deleteAttributes();
        $product->deleteVariant();
        $product->dissociatedCategories();
    }


}