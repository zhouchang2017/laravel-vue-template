<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\UserTransformer;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Services\GeneratePermission\PermissionService;
use App\Services\ParseDoc\ParseDocService;

/**
 * @module 菜单管理
 * @name test
 */
class TestController extends Controller
{

    public function __construct(User $model, UserTransformer $transformer)
    {
        parent::__construct($model, $transformer);
        $this->middleware('permission');
    }

    /**
     * @return mixed
     * @permission 测试权限
     */
    public function test(PermissionService $permissionService)
    {
//        return $permissionService->syncPermission();
        /** @var User $user */
         $user = User::findOrFail(1);
         return ($user->getAllPermissions());
    }

}
