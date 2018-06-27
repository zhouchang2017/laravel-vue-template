<?php

namespace App\Http\Transformers;

use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class Transformer extends TransformerAbstract
{
    protected $availableIncludes = [ 'group' ];

    protected $hidden;

    protected $disableEagerLoadedIncludes = [];

    public function __construct($field = null)
    {
        $this->hidden = $field;
    }

    public function getDisableEagerLoadedIncludes()
    {
        return $this->disableEagerLoadedIncludes;
    }


    /**
     * 重写item方法，解决$data = null 的报错
     * @param mixed $data
     * @param callable|TransformerAbstract $transformer
     * @param null $resourceKey
     * @return Item|\League\Fractal\Resource\Primitive
     */
    protected function item($data, $transformer, $resourceKey = null)
    {
        if (is_null($data)) {
            return $this->primitive(null);
        }
        return new Item($data, $transformer, $resourceKey);
    }
}