<?php
/**
 * Created by PhpStorm.
 * User: z
 * Date: 2018/7/3
 * Time: 上午11:38
 */

namespace App\Services\Warehouse;

use App\Services\Warehouse\Contract\AddStorageContract;
use Illuminate\Database\Eloquent\Model;

/**
 * 仓库来源虚拟类
 * Class Origin
 * @package App\Services\Warehouse
 */
abstract class Origin implements AddStorageContract {

    /**
     * @var Model
     */
    protected $model;

    /**
     * Origin constructor.
     * @param $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }


    /**
     * @param Model $model
     */
    public function setModel(Model $model)
    {
        $this->model = $model;
    }



    /**
     * 获取仓库id
     * @return mixed
     */
    abstract public function getWarehouseId();

    /**
     * @param $id
     * @return  \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    abstract public function getHistoryRelation($id);

    /**
     * 产品入库方法
     * @param array $attribute
     * @return static
     */
    public function put($attribute = [])
    {
        return collect($attribute)->map(function ($item, $key) {
            $this->createStorage($item);
            $this->createHistory($key, $item);
        });
    }

    /**
     * @param $id
     * @param array $columns
     * @return $this
     */
    public function find($id, $columns = ['*'])
    {
        $this->setModel($this->model::findOrFail($id, $columns));
        return $this;
    }


    /**
     * @return mixed
     */
    abstract public function history();

    /**
     * 获取仓库
     * @return \App\Models\Warehouse
     */
    abstract public function getWarehouse();


    /**
     * 获取仓库Storage
     * @return \App\Models\Storage
     */
    abstract public function getStorage();


    /**
     * @param array $attribute
     * @return Model
     */
    protected function createStorage(array $attribute)
    {
        $storage = $this->getStorage()->whereProductVariantId($attribute['product_variant_id'])->first();
        if ( !is_null($storage)) {
            return $this->incrementAttributes($attribute, $storage, ['num', 'good', 'bad']);
        }
        return $this->getStorage()->updateOrCreate($attribute);
    }


    /**
     * 更新库存
     * @param array $attribute
     * @param Model $model
     * @param array $fillable
     * @return Model
     */
    private function incrementAttributes(array $attribute, Model $model, $fillable = [])
    {
        if (count($fillable) === 0) array_merge($fillable, $model->getFillable());
        $attribute = array_only($attribute, $fillable);
        collect($attribute)->each(function ($attr, $key) use ($model) {
            $model->increment($key, $attr);
        });
        return $model;
    }

    /**
     * 创建入库历史记录
     * @param $id
     * @param array $attribute
     * @return mixed
     */
    protected function createHistory($id, $attribute = [])
    {
        $attribute = array_merge($attribute, ['warehouse_id' => $this->getWarehouseId()]);
        return $this->getHistoryRelation($id)->create($attribute);
    }

}