<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Transformers\ProductProviderTransformer;
use App\Models\ProductProvider;
use Illuminate\Http\Request;

class ProductProviderController extends Controller
{
    public function __construct(ProductProvider $model, ProductProviderTransformer $transformer)
    {
        parent::__construct($model, $transformer);
    }

    public function products(Request $request,$id)
    {
        $this->setModel($this->model::findOrFail($id));
        return response()->json([ 'data' => $this->model->products()->sync($request->input('products')) ]);
    }
}
