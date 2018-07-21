<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\ProductTypeTransformer;
use App\Models\ProductAttribute;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @module 产品类型管理
 * Class ProductTypeController
 * @package App\Http\Controllers\Api
 */
class ProductTypeController extends Controller
{

    /**
     * ProductTypeController constructor.
     * @param $model
     * @param $transformer
     */
    public function __construct(ProductType $model, ProductTypeTransformer $transformer)
    {
        parent::__construct($model,$transformer);
    }




    /**
     * 为该产品类型添加属性组关联
     * @permission 添加属性组
     * @param Request $request
     * @param $id
     * @return \Dingo\Api\Http\Response
     */
    public function attributes(Request $request, $id)
    {
        $attributeGroupIds = $request->input('group_ids');

        $model = $this->model::findOrFail($id);

        $res = collect($model->attributes()->sync($attributeGroupIds));

        count($res->get('detached'))>0 && $this->detachProductAttribute($attributeGroupIds);

        return response()->json(['data'=>$res]);
    }

    /**
     * 删除产品中与之关联的属性组记录
     * @param $attributeGroupIds
     * @return int
     */
    private function detachProductAttribute($attributeGroupIds)
    {
        return ProductAttribute::destroy($attributeGroupIds);
    }
}
