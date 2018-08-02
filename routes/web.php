<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/test', 'TestController@index');
Route::get('/test', function (\App\Modules\Scaffold\Services\AssetService $service) {
//    $manually =  new ManuallyService();
    $path = '/storage/product/B3pia6URoT1bZMEveVNwoQw6WsXAEyWH21AeFTgk.jpeg';
    /** @var \Illuminate\Database\Eloquent\Model $brand */
    $brand = \App\Modules\Product\Models\Brand::find(4);
    $img = $service->store([$path],function($img)use ($brand){
        $brand->images()->createMany($img);
    });
    dd($img);
//    dd($manually->put());
});
Route::get('/test/xsd', 'TestController@xsd');
Route::get('/products', 'TestController@products');
Route::get('/products/match', 'TestController@byAsins');

Route::view('{path}', 'index')->where('path', '^(?!api).*');
