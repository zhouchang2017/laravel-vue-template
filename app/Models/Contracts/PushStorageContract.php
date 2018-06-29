<?php
/**
 * Created by PhpStorm.
 * User: z
 * Date: 2018/6/29
 * Time: 下午2:43
 */

namespace App\Models\Contracts;


interface PushStorageContract
{

    public function push();

    public function list();
}