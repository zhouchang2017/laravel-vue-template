<?php
/**
 * Created by PhpStorm.
 * User: z
 * Date: 2018/7/23
 * Time: 上午10:56
 */

namespace App\Http\Controllers\Api\V2;


use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
class Controller extends BaseController
{
    use Helpers, AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}