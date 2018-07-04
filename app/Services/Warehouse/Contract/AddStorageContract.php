<?php
/**
 * Created by PhpStorm.
 * User: z
 * Date: 2018/7/3
 * Time: 上午9:43
 */

namespace App\Services\Warehouse\Contract;


/**
 * 添加库存接口
 * Interface AddStorageContract
 * @package App\Services\Warehouse\Contract
 */
interface AddStorageContract {

    // 入仓
    public function put($attribute = []);

}