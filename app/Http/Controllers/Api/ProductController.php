<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Transformers\ProductTransformer;
use App\Models\Product;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $service;

    public function __construct(Product $model, ProductTransformer $transformer,ProductService $service)
    {
        parent::__construct($model, $transformer);
        $this->service = $service;
    }

    public function store()
    {
        $request = $this->getRequest(__FUNCTION__);
        $this->service->create($request->all());
        //$this->setModel($this->model::create($request->all()));
        return $this->response->created();
    }


    public function categories(Request $request, $id)
    {
        $this->setModel($this->model::findOrFail($id));
        return response()->json([ 'data' => $this->model->categories()->sync($request->input('categories_ids')) ]);
    }


}
