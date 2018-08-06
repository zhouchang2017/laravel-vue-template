<?php
/**
 * Created by PhpStorm.
 * User: z
 * Date: 2018/8/6
 * Time: 2:50 PM
 */

namespace App\Modules\Scaffold\Contracts;


interface AssetRelation
{
    /**
     * @return string
     */
    public function getAssetMethod(): string;
}