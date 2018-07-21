<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        auth()->login(User::find(1));
        $permissionName = $request->route()->getName();
        if ($permission = $this->checkNeedPermission($permissionName)) {
            dd($permission);
        } else {
            return $next($request);
        }
        dd(auth()->user()->can($request->route()->getName()));
//        dd($request->route()->getName());
        return $next($request);
    }

    private function checkNeedPermission($permissionName)
    {
        try {
            return \Spatie\Permission\Models\Permission::findByName($permissionName);
        } catch (\Exception $exception) {
            // 该条路由不需要权限
            return false;
        }

    }
}
