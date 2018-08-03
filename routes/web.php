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

//    dd($manually->put());
});
Route::get('/test/xsd', 'TestController@xsd');
Route::get('/products', 'TestController@products');
Route::get('/products/match', 'TestController@byAsins');

Route::view('{path}', 'index')->where('path', '^(?!api).*');
