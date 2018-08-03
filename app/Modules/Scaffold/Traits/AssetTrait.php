<?php


namespace App\Modules\Scaffold\Traits;


use App\Modules\Scaffold\Services\AssetService;
use Closure;

trait AssetTrait
{
    public function storeAsset(string $key, Closure $closure)
    {
        if (request($key) && count(request($key)) > 0) {
            $options = app(AssetService::class)->store(request($key));
            call_user_func($closure,$options);
        }
    }
}