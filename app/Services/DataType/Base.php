<?php
/**
 * Created by PhpStorm.
 * User: zhouchang
 * Date: 2018/5/14
 * Time: 下午10:38
 */

namespace App\Services\DataType;

abstract class Base
{
    public function __get($propertyName)
    {
        $getter = "get$propertyName";
        return $this->$getter();
    }

    public function __set($propertyName, $propertyValue)
    {
//        $setter = "set$propertyName";
//        $this->$setter($propertyValue);
        $this->$propertyName = $propertyValue;
        return $this;
    }

    public function toArray()
    {
        $arr = [];
        foreach ($this as $key=>$val){
            if($val){
                $arr[studly_case($key)] = $val;
            }
        }
        return $arr;
    }
}