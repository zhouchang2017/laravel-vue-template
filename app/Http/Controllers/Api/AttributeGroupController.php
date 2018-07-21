<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\AttributeGroupTransformer;
use App\Http\Transformers\AttributeTransformer;
use App\Models\Attribute;
use App\Models\AttributeGroup;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @module 属性组管理
 * Class AttributeGroupController
 * @package App\Http\Controllers\Api
 */
class AttributeGroupController extends Controller
{

    /**
     * AttributeGroupController constructor.
     * @param $model
     * @param $transformer
     */
    public function __construct(AttributeGroup $model, AttributeGroupTransformer $transformer)
    {
        parent::__construct($model, $transformer);
    }


    /**
     * @permission 关联产品类型
     * 为该产品属性组关联产品类型
     * @param Request $request
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function types(Request $request, $id)
    {
        $typeIds = $request->input('type_ids');
        $model = $this->model::findOrFail($id);

        $res = collect($model->types()->sync($typeIds));

        count($res->get('detached')) > 0 && $this->detachProductAttribute($typeIds);

        return response()->json(['data'=>$res]);
    }

    /**
     * 删除产品中与之关联的属性组记录
     * @param $typeIds
     */
    private function detachProductAttribute($typeIds)
    {
        $productAttributeIds = ProductAttribute::whereAttributeGroupId($typeIds)->get([ 'id' ])->map(function ($item) {
            return $item['id'];
        })->toArray();
        ProductAttribute::destroy($productAttributeIds);
    }

    /**
     * @permission 添加属性
     * 为产品组创建属性
     * @param array $attributes
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function attribute(array $attributes, $id)
    {
        $model = $this->model::findOrFail($id);
        $attribute = $model->values()->save(new Attribute(Attribute::filterKeys($attributes)));
        return $this->response->item($attribute, new AttributeTransformer())->setStatusCode(201);
    }
}
