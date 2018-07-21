<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Http\Transformers\CategoryTransformer;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

/**
 * @module 产品分类管理
 * Class CategoryController
 * @package App\Http\Controllers\Api
 */
class CategoryController extends Controller
{
    /**
     * CategoryController constructor.
     * @param Category $model
     * @param CategoryTransformer $transformer
     */
    public function __construct(Category $model, CategoryTransformer $transformer)
    {
        parent::__construct($model, $transformer);
    }


    /**
     * @permission 列表
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $this->model::query();

        if ($request->has('q')) {
            $query->where('name', 'like', "{$request->get('q')}%");
        }

        $tree = $this->parseFilter($query)->toTree();

        $paginate = new LengthAwarePaginator($tree, $tree->count(), +$request->input('per_page', 15));
        return CategoryResource::collection($paginate);
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
}
