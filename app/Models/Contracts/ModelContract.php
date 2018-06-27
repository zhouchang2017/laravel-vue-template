<?php

namespace App\Models\Contracts;


use Illuminate\Support\Collection;

interface ModelContract
{
    public static function filterKeys(array $attributes);

    public function store(array $attributes);

    public function assign(iterable $attributes);

    public function attributesMapWithKeys(iterable $attributes, $key = 'id'): Collection;


    /**
     * 转换集合
     * @param $attributes
     * @return Collection
     */
    public function takeCollect($attributes): Collection;

}