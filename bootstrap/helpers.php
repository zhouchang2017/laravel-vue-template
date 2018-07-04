<?php

if ( !function_exists('takeCollect')) {
    /**
     * 转换集合
     * @param array|\Illuminate\Support\Collection $attributes
     * @return \Illuminate\Support\Collection
     */
    function takeCollect($attributes)
    {
        if ( !$attributes instanceof Collection) {
            return collect($attributes);
        }
        return $attributes;
    }
}