<?php

namespace App\Traits;


use Illuminate\Support\Collection;

trait ModelTrait
{
    public static function filterKeys(array $attributes)
    {
        return array_only($attributes, (new static())->getFillable());
    }

    public function store(array $attributes)
    {
        $this->assign($this->filterKeys($attributes))->save();
        return $this;
    }

    public function willStore(array $attributes)
    {
        return $this->assign($this->filterKeys($attributes));
    }

    public function assign(iterable $attributes)
    {
        collect($attributes)->each(function ($item, $key) {
            $this->setAttribute($key, $item);
        });
        return $this;
    }

    public function attributesMapWithKeys(iterable $attributes, $key = 'id'): Collection
    {
        $attributes = $this->takeCollect($attributes);
        // 过滤不存在$key的元素
        $attributes = $attributes->filter(function ($value) use ($key) {
            return array_key_exists($key, $value) && !is_null($value[$key]);
        });
        return $attributes->mapWithKeys(function ($item) use ($key) {
            return [ $item[$key] => $item ];
        });
    }

    /**
     * 转换集合
     * @param $attributes
     * @return Collection
     */
    public function takeCollect($attributes): Collection
    {
        if ( !$attributes instanceof Collection) {
            return collect($attributes);
        }
        return $attributes;
    }
}