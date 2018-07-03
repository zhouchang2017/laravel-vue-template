<?php
/**
 * Created by PhpStorm.
 * User: z
 * Date: 2018/7/3
 * Time: 上午9:35
 */

namespace App\Services\Warehouse;


use App\Models\Warehouse;
use App\Services\Warehouse\Contract\AddStorageContract;

class WarehouseService {

    protected $model;

    protected $provider;

    /**
     * WarehouseService constructor.
     * @param $model
     * @param $provider
     */
    public function __construct(Warehouse $model,AddStorageContract $provider = null)
    {
        $this->model = $model;
        $this->provider = $provider;
    }

    /*
     * 功能
     * */

    // 入库
    public function add()
    {
        dd($this->provider->put());
    }

    
    // 明细
    public function detail()
    {
        
    }


    // 中转
    public function transfer()
    {

    }


    // 出库
    public function put()
    {
        
    }

    public static function getInstance()
    {
        return app(WarehouseService::class);
    }

    public static function origin(AddStorageContract $origin)
    {
        $instance = self::getInstance();
        $instance->provider = $origin;
        return $instance;
    }

    public static function __callStatic($name, $arguments)
    {
        dump($name);
        dd($arguments);
    }
}