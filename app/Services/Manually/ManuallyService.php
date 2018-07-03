<?php
/**
 * Created by PhpStorm.
 * User: z
 * Date: 2018/7/3
 * Time: 上午11:30
 */

namespace App\Services\Manually;


use App\Models\Manually;
use App\Models\ManuallyProductVariant;
use App\Models\Model;
use App\Services\Warehouse\Origin;

class ManuallyService extends Origin {

    protected $model;

    private $putCollection;

    private $putList;

    /**
     * @return Manually
     */
    public function getModel(): Manually
    {
        return $this->model;
    }

    /**
     * @param Manually $model
     */
    public function setModel(Manually $model): void
    {
        $this->model = $model;
    }

    /**
     * ManuallyService constructor.
     * @param Manually $model
     */
    public function __construct(Manually $model)
    {
        $this->model = $model;
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

    public function put($attribute = [])
    {
        return collect($attribute)->map(function ($item, $key) {
            $this->createStorage($item);
            return $this->createHistory($key, $item);
        });
//        return $this;
    }

    public function createStorage($attribute)
    {
        $storage = $this->model->warehouse->storage()->whereProductVariantId($attribute['product_variant_id'])->first();
        if (!is_null($storage)) {
            $this->incrementAttributes($attribute,$storage,['num','good','bad']);
        }
        return $this->model->warehouse->storage()->updateOrCreate($attribute);
    }

    /**
     * 更新库存
     * @param array $attribute
     * @param Model $model
     * @param array $fillable
     */
    private function incrementAttributes(array $attribute, Model $model, $fillable = [])
    {
        if (count($fillable) === 0) array_merge($fillable, $model->getFillable());
        $attribute = array_only($attribute, $fillable);
        collect($attribute)->each(function($attr,$key) use ($model){
            $model->increment($key,$attr);
        });
    }

    private function list()
    {
        $this->putCollection = $this->model->variants;
        return $this;
    }

    public function createHistory($id, $attribute = [])
    {
        $attribute = array_merge($attribute, ['warehouse_id' => $this->model->warehouse_id]);
        return ManuallyProductVariant::findOrFail($id)->history()->create($attribute);
    }

    public function history()
    {

    }
}