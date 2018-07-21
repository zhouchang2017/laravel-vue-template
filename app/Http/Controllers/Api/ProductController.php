<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Transformers\ProductTransformer;
use App\Models\Product;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;

/**
 * @module 产品管理
 * Class ProductController
 * @package App\Http\Controllers\Api
 */
class ProductController extends Controller
{
    /**
     * @var ProductService
     */
    private $service;

    /**
     * ProductController constructor.
     * @param Product $model
     * @param ProductTransformer $transformer
     * @param ProductService $service
     */
    public function __construct(Product $model, ProductTransformer $transformer,ProductService $service)
    {
        parent::__construct($model, $transformer);
        $this->service = $service;
    }

    /**
     * @permission 保存
     * @return \Dingo\Api\Http\Response|\Illuminate\Http\Response
     */
    public function store()
    {
        $request = $this->getRequest(__FUNCTION__);
        $this->service->create($request->all());
        //$this->setModel($this->model::create($request->all()));
        return $this->response->created();
    }


    /**
     * @permission 添加/更新分类
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function categories(Request $request, $id)
    {
        $this->setModel($this->model::findOrFail($id));
        return response()->json([ 'data' => $this->model->categories()->sync($request->input('categories_ids')) ]);
    }


}
