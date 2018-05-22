<?php
namespace Mws\Support;

use Illuminate\Support\Facades\Facade;

class MwsFacade extends Facade
{
    protected static function getFacadeAccessor() { 
        return 'Mws\Mws';
    }
}