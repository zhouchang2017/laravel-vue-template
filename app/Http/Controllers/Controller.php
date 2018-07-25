<?php

namespace App\Http\Controllers;

use App\Traits\QueryTrait;
use Dingo\Api\Routing\Helpers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use Helpers, AuthorizesRequests, DispatchesJobs, ValidatesRequests, QueryTrait;


    protected $model;

    protected $transformer;

    /**
     * Controller constructor.
     * @param $model
     * @param $transformer
     */
    public function __construct(Model $model, $transformer)
    {
        $this->model = $model;
        $this->transformer = $transformer;
        $this->mergeFormRequest();
    }

    protected $formRequest = [

    ];

    private function mergeFormRequest()
    {
        $this->formRequest = array_merge(
            [ 'store'  => Request::class,
              'update' => Request::class ], $this->formRequest
        );
    }


    /**
     * @param Model $model
     * @return $this
     */
    public function setModel(Model $model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setModelBy($id)
    {
        $this->model = $this->model->findOrFail($id);
        return $this;
    }


    protected function parseFilter(Builder $query, $where = [])
    {
        $query = $this->apply($query);

        if ($this->isBlacklist($query)) {
            return new LengthAwarePaginator([]
                , 0, +request()->get('per_page', 15));
        }

        //分页
        return $query->paginate(+request()->get('per_page', 15))->appends(request()->except('page'));
    }


    /**
     * sql语句黑名单检测机制检测机制
     * @param $query
     * @return bool
     */
    private function isBlacklist($query)
    {
        $limit = 100;

        if (+request('per_page') && +request('per_page') < $limit) {
            return false;
        }

        $key = 'sql:' . $query->toSql();

        if (\Cache::has($key)) {
            return true;
        }
        if ($query->count() > $limit) {
            \Cache::forever($key, date('Y-m-d H:i:s'));
            return true;
        }

        return false;
    }

    private function getQuery()
    {
        $query = $this->model::query();

        if (method_exists($this->model, 'trashed')) {
            if (request()->input('trashed', 0) == 1) {
                $query = $this->model::onlyTrashed();
            }

            if (request()->input('trashed', 0) == 2) {
                $query = $this->model::withTrashed();
            }
        }
        return $query;
    }


    /**
     *
     * Display a listing of the resource.
     * @permission 列表
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $this->getQuery();
        $paginate = $this->parseFilter($query);
        return $this->response->paginator($paginate, new $this->transformer());
    }

    /**
     * Store a newly created resource in storage.
     * @permission 保存
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $request = $this->getRequest(__FUNCTION__);

        $this->setModel($this->model::create($request->all()));
//        return $this->response->item($this->model, new $this->transformer())->setStatusCode(201);
        return $this->response->created();
    }


    /**
     * Display the specified resource.
     * @permission 详情
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query = $this->apply($this->model::query());
        return $this->response->item($query->findOrFail($id), new $this->transformer());
    }

    /**
     * @param $name
     * @return \Illuminate\Http\Request
     */
    protected function getRequest($name)
    {
        return app($this->formRequest[$name]);
    }

    /**
     * Update the specified resource in storage.
     * @permission 更新
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function update($id)
    {
        $request = $this->getRequest(__FUNCTION__);
        $this->setModelBy($id);
        $this->model->update($request->all());
        $this->registerEvent('afterUpdated');
//        return $this->response->item($this->model, new $this->transformer())->setStatusCode(201);
        return $this->response->noContent();
    }

    /**
     * Remove the specified resource from storage.
     * @permission 删除
     * @param  int|string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ids = collect(explode(',', $id));
        $ids->each(function ($id) {
            $model = $this->model::findOrFail($id);
            $model->delete();
        });

        return $this->response->noContent();
    }

    /**
     * @param $eventName
     * @return mixed
     */
    public function registerEvent($eventName)
    {
        $nameSpace = 'App\\Observers';
        $observerClassName = $nameSpace . '\\' . class_basename($this->model) . 'Observer';
        if (class_exists($observerClassName)) {
            $observerClass = app($observerClassName);
            if (method_exists($observerClass, $eventName)) {
                return $observerClass->$eventName($this->model);
            };
        };
        return false;
    }

}
