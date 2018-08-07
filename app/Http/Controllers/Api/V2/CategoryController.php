<?php

namespace App\Http\Controllers\Api\V2;

use App\Modules\Product\Models\Category;
use App\Modules\Product\Transformers\CategoryTransformer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(Category $model, CategoryTransformer$transformer)
    {
        parent::__construct($model, $transformer);
    }


    /**
     * @permission 添加/更新关联产品
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function products(Request $request, $id)
    {
        $this->setModel($this->model::findOrFail($id));
        return response()->json([ 'data' => $this->model->products()->sync($request->input('product_ids')) ]);
    }


    public function attachProducts(Request $request, $id)
    {
        $this->setModel($this->model::findOrFail($id));
        return response()->json([ 'data' => $this->model->products()->attach($request->input('product_ids')) ]);
    }

    public function detachProducts(Request $request, $id)
    {
        $this->setModel($this->model::findOrFail($id));
        return response()->json([ 'data' => $this->model->products()->detach($request->input('product_ids')) ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int|string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ids = collect(explode(',',$id));
        $ids->each(function($categoryId){
            $model = $this->model::findOrFail($categoryId);
            if($model->hasChildren()){
                abort(405,$model->name . '分类下存在子分类,不允许删除');
            }
            $model->delete();
        });

        return $this->response->noContent();
    }

    public function tree()
    {
        $nodes = $this->model::get()->toTree();
        return response()->json(['data'=>$nodes]);
    }
}
