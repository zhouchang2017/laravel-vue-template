<?php


namespace App\Modules\Scaffold\Facade;
use Illuminate\Support\Facades\Facade;


class AssetFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Asset';
    }
}