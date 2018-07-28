<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware'=>'api'
], function ($api) {
    $api->get('users','TestController@test')->name('user.test');
    $api->resource('products', 'ProductController');
    $api->resource('product_types','ProductTypeController');
    $api->resource('attribute_groups','AttributeGroupController');
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
    $api->put('product_types/{id}/attributes','ProductTypeController@attributes')->name('product_type.attribute');
    // 产品组归属类型
    $api->put('attribute_groups/{id}/types','AttributeGroupController@types')->name('attribute_group.type');
    // 产品组添加属性
    $api->post('attribute_groups/{id}/attribute','AttributeGroupController@attribute')->name('attribute_group.attribute');
    // 产品分类添加产品
    $api->post('categories/{id}/products','CategoryController@products')->name('category.product');
    // 产品供应商管理产品
    $api->post('product_providers/{id}/products','ProductProviderController@products')->name('product_provider.product');
    // 仓库更新或创建地址
    $api->post('warehouses/{id}/address','WarehouseController@address')->name('warehouse.address');
    // 获取关联的手动入仓列表
    $api->get('warehouses/{id}/manuallise','WarehouseController@manuallise')->name('warehouse.manually');
    // 获取关联的采购单列表
    $api->get('warehouses/{id}/procurements','WarehouseController@procurements')->name('warehouse.procurement');
    // 审核采购计划
    $api->put('procurement_plans/{id}/approval','ProcurementPlanController@approval')->name('procurement_plan.approval');
    // 手工存入仓库
    $api->post('manuallies/{id}/put','ManuallyController@addStorage')->name('manually.add_storage');
    // 采购存入库存
    $api->post('procurements/{id}/put','ProcurementController@addStorage')->name('procurement.add_storage');

    $api->post('login','Auth\AuthController@login')->name('login');
    $api->post('logout','Auth\AuthController@logout')->name('logout');
    $api->post('me','Auth\AuthController@me')->name('me');
});

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware'=>'refresh.token'
], function ($api) {
    $api->get('refresh','Auth\AuthController@refresh')->name('refresh');
});

$api->version('v2', [
    'namespace' => 'App\Http\Controllers\Api\V2',
    'middleware'=>'api',
], function ($api) {
    $api->post('login','UserController@login');
    $api->get('me','UserController@me');

    // 品牌
    $api->resource('brands','BrandController');
    // 产品类型
    $api->resource('product-types','ProductTypeController');
    // 属性组
    $api->resource('attribute-groups','AttributeGroupController');
    // 属性值
    $api->resource('attributes','AttributeController');
    // 产品
    $api->resource('products','ProductController');
    // 产品分类
    $api->resource('categories','CategoryController');
    // 产品供应商
    $api->resource('product_providers','ProductProviderController');
    // 产品供应商关联产品
    $api->post('product_providers/{id}/products','ProductProviderController@products');
});

$api->version('v2', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware'=>'api',
], function ($api) {
    $api->resource('balances','BalanceController');
    $api->resource('payments','PaymentController');

});
