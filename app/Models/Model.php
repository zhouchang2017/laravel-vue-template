<?php
/**
 * Created by PhpStorm.
 * User: z
 * Date: 2018/6/8
 * Time: 下午5:22
 */

namespace App\Models;

use App\Models\Contracts\ModelContract;
use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model as BaseModel;


class Model extends BaseModel implements ModelContract
{
    use ModelTrait;

    protected $observables = [
        'willUpdate',
        'didUpdate',
    ];



}