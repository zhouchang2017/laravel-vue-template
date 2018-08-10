<?php

namespace App\Http\Controllers\Api\V2;

use App\Modules\Product\Models\Product;
use App\Modules\Product\Services\ProductService;
use App\Modules\Product\Transformers\ProductTransformer;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function __construct(Product $model,ProductTransformer $transformer)
    {
        parent::__construct($model, $transformer);
    }


    /**
     * @return \Dingo\Api\Http\Response|\Illuminate\Http\Response
     */
    public function store()
    {
        $product = app(ProductService::class)->create(request()->all());
        return $this->response->item($product, new $this->transformer())->setStatusCode(201);
    }

    public function update($id)
    {
        app(ProductService::class)->update($id,request()->all());
        return $this->response->noContent();
    }
}
