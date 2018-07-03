<?php
/**
 * Created by PhpStorm.
 * User: z
 * Date: 2018/7/3
 * Time: 上午11:38
 */

namespace App\Services\Warehouse;


use App\Services\Warehouse\Contract\AddStorageContract;

abstract class Origin implements AddStorageContract {
    abstract public function history();
}