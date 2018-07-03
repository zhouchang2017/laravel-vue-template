<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware'=>'api'
], function ($api) {
    $api->resource('products', 'ProductController');
    $api->resource('product-types','ProductTypeController');
    $api->resource('attribute-groups','AttributeGroupController');
    $api->resource('attributes','AttributeController');
    $api->resource('categories','CategoryController');
    $api->resource('balances','BalanceController');
    $api->resource('payments','PaymentController');
    $api->resource('product_providers','ProductProviderController');
    $api->resource('warehouse_types','WarehouseTypeController');
    $api->resource('warehouses','WarehouseController');
    $api->resource('procurement_plans','ProcurementPlanController');
    $api->resource('procurements','ProcurementController');
    $api->resource('manuallies','ManuallyController');

    // 关联更新
    $api->put('product-types/{id}/attributes','ProductTypeController@attributes');
    // 产品组归属类型
    $api->put('attribute-groups/{id}/types','AttributeGroupController@types');
    // 产品组添加属性
    $api->post('attribute-groups/{id}/attribute','AttributeGroupController@attribute');
    // 产品分类添加产品
    $api->post('categories/{id}/products','CategoryController@products');
    // 产品供应商管理产品
    $api->post('product_providers/{id}/products','ProductProviderController@products');
    // 仓库更新或创建地址
    $api->post('warehouses/{id}/address','WarehouseController@address');
    // 获取关联的手动入仓列表
    $api->get('warehouses/{id}/manuallise','WarehouseController@manuallise');
    // 获取关联的采购单列表
    $api->get('warehouses/{id}/procurements','WarehouseController@procurements');
    // 审核采购计划
    $api->put('procurement_plans/{id}/approval','ProcurementPlanController@approval');
    // 存入仓库
    $api->post('manuallies/{id}/put','ManuallyController@addStorage');

    $api->post('login','Auth\AuthController@login');
    $api->post('logout','Auth\AuthController@logout');
    $api->post('me','Auth\AuthController@me');
});

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware'=>'refresh.token'
], function ($api) {
    $api->get('refresh','Auth\AuthController@refresh');
});
