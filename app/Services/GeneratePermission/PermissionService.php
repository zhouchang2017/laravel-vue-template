<?php

namespace App\Services\GeneratePermission;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Guard;
use App\Services\ParseDoc\ParseDocService;
use Dingo\Api\Routing\Router;
use Illuminate\Routing\Route;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;

class PermissionService
{
    /**
     * @var \App\Services\ParseDoc\ParseDocService
     */
    private $parseDocService;

    /**
     * @var \Illuminate\Routing\RouteCollection
     */
    protected $routes;

    /**
     * @var string
     */
    protected $filterNamespace;

    /**
     * @var string
     */
    protected $moduleTag;

    /**
     * @var string
     */
    protected $permissionTag;


    public function __construct(ParseDocService $parseDocService, Router $router)
    {
        $this->parseDocService = $parseDocService;
        $this->routes = $router->getRoutes(config('api.version'));
        $this->filterNamespace = config('permission.generate.namespace');
        $this->moduleTag = config('permission.generate.moduleTag');
        $this->permissionTag = config('permission.generate.permissionTag');
    }

    private function getAllPermissions($guard)
    {
        $routers = $this->routes->getRoutes();
        return collect($routers)->reduce(function ($permissions, $route) use ($guard) {
            /** @var Route $route */
            $actions = $route->getAction();

            if ($this->checkNamespace($actions['namespace'])) {
                $ref = $this->reflection($route->controller);
                // 获取模块名称
                $moduleName = $this->getModuleName($ref);
                // 权限描述
                $permissionDescription = $this->getMethodDescription($ref, $route->getActionMethod());
                $attribute = [
                    'name' => $route->getName(),
                    'description' => $moduleName . '' . $permissionDescription,
                    'guard_name' => $guard,
                ];
                array_push($permissions, $attribute);
            }
            return $permissions;
        }, []);
    }

    /**
     * @param null|string $guard
     * @return array
     */
    public function syncPermission($guard = null)
    {
        $keys = ['name', 'guard_name'];
        $guard = $guard ?? Guard::getDefaultName(static::class);

        /** @var Collection $originalPermission */
        $originalPermission = Permission::whereGuardName($guard)->get();

        $permissions = $this->getAllPermissions($guard);

        return [
            'deleted'=>$this->deletedPermissions($keys, $permissions, $originalPermission),
            'created'=>$this->createPermissions($keys, $originalPermission, $permissions)
        ];
    }

    private function onlyKeys(array $keys, Collection $collection)
    {
        return $collection->map(function ($item) use ($keys) {
            if ($item instanceof Model) {
                $item = $item->getAttributes();
            }
            return array_only($item, $keys);
        });
    }

    /**
     * @param $arg
     * @return \ReflectionClass
     * @throws \ReflectionException
     */
    private function reflection($arg)
    {
        return new \ReflectionClass($arg);
    }

    private function checkNamespace(string $namespace): bool
    {
        return starts_with($namespace, $this->filterNamespace);
    }

    private function getModuleName(\ReflectionClass $ref)
    {
        $doc = $ref->getDocComment();
        $docArray = $this->parseDocService->parse($doc);
        return array_get($docArray, $this->moduleTag);
    }

    private function getMethodDescription(\ReflectionClass $ref, string $methodName)
    {
        $doc = $ref->getMethod($methodName)->getDocComment();
        $docArray = $this->parseDocService->parse($doc);
        return array_get($docArray, $this->permissionTag);
    }

    /**
     * @param $keys
     * @param $permissions
     * @param $originalPermission
     * @return array
     */
    private function deletedPermissions($keys, $permissions, $originalPermission): array
    {
        $filterPermissions = $this->onlyKeys($keys, collect($permissions))->toArray();
        /** @var Collection $originalPermission */
        return $originalPermission->reduce(function ($deleted, $origin) use ($filterPermissions, $keys) {
            /** @var Permission $origin */
            if ( !in_array(array_only($origin->toArray(), $keys), $filterPermissions)) {
                $attr = [
                    'id' => $origin->id,
                    'name' => $origin->name,
                    'description' => $origin->description,
                ];
                $origin->delete();
                array_push($deleted, $attr);
            }
            return $deleted;
        }, []);
    }

    /**
     * @param $keys
     * @param $originalPermission
     * @param $permissions
     * @return array
     */
    private function createPermissions($keys, $originalPermission, $permissions): array
    {
        $filterOriginalPermission = $this->onlyKeys($keys, collect($originalPermission))->toArray();
        return collect($permissions)->reduce(function ($created, $permission) use (
            $filterOriginalPermission,
            $keys
        ) {
            if ( !in_array(array_only($permission, $keys), $filterOriginalPermission)) {
                // create!!
                array_push($created, Permission::create($permission));
            }
            return $created;
        }, []);
    }
}