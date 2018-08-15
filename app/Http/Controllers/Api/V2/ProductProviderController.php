<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Modules\ProductProvider\Models\ProductProvider;
use App\Modules\ProductProvider\Transformers\ProductProviderTransformer;
use Illuminate\Http\Request;

/**
 * @module 产品供应商管理
 * Class ProductProviderController
 * @package App\Http\Controllers\Api
 */
class ProductProviderController extends Controller
{
    /**
     * ProductProviderController constructor.
     * @param ProductProvider $model
     * @param ProductProviderTransformer $transformer
     */
    public function __construct(ProductProvider $model, ProductProviderTransformer $transformer)
    {
        parent::__construct($model, $transformer);
    }

    /**
     * @permission 添加/修改关联产品
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function products(Request $request, $id)
    {
        $this->setModel($this->model::findOrFail($id));
        return response()->json([ 'data' => $this->model->products()->sync($request->input('products')) ]);
    }

    /**
     * @permission 附加关联产品
     * @param Request $request ['id'=>number,'price'=>number]
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function attachProducts(Request $request, $id)
    {
        $this->setModel($this->model::findOrFail($id));
        $products = $request->input('products');
        if($this->model->products()->find(array_keys($products))){

        }
        return response()->json([ 'data' => $this->model->products()->attach($request->input('products')) ]);
    }

    private function updateProduct()
    {
        
    }

    /**
     * @permission 分离关联产品
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function detachProducts(Request $request, $id)
    {
        $this->setModel($this->model::findOrFail($id));
        return response()->json([ 'data' => $this->model->products()->detach($request->input('product_ids')) ]);
    }

}
