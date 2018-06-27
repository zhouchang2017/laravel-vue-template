<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Transformers\ProductTransformer;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(Product $model, ProductTransformer $transformer)
    {
        parent::__construct($model, $transformer);
    }


    public function categories(Request $request, $id)
    {
        $this->setModel($this->model::findOrFail($id));
        return response()->json([ 'data' => $this->model->categories()->sync($request->input('categories_ids')) ]);
    }


}
