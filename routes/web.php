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
Route::get('/test', function () {
//    $res = \App\Models\Product::find(9)->attributes()->get()
//        ->mapWithKeys(function ($item) {
//            $arr = [];
//            is_null($item['attribute_id']) ||  $arr['attribute_id'] = $item['attribute_id'];
//            is_null($item['comment']) || $arr['comment'] = $item['comment'];
//            return [ $item['id'] => $arr ];
//        });
//    $lan = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4);
//    $res = !!preg_match("/zh/i", $lan);
//    dd($res);

    function isClientChina(){
        return !!preg_match("/zh/i", substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4));
    }
    function getIp(){
        //判断服务器是否允许$_SERVER
        if(isset($_SERVER)){
            if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }elseif(isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            }else{
                $ip = $_SERVER['REMOTE_ADDR'];
            }
        }else{
            //不允许就使用getenv获取
            if(getenv("HTTP_X_FORWARDED_FOR")){
                $ip = getenv( "HTTP_X_FORWARDED_FOR");
            }elseif(getenv("HTTP_CLIENT_IP")) {
                $ip = getenv("HTTP_CLIENT_IP");
            }else{
                $ip = getenv("REMOTE_ADDR");
            }
        }
        return $ip;
    }

    function isChinaIp($ip){
        try {
            $res1 = file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=$ip");
            $res1 = json_decode($res1,true);

            if ($res1[ "code"]==0){
                return $res1['data']["country_id"] =='CN' || $res1['data']['isp_id'] == 'local';
            }else{
                return true;
            }
        }catch (Exception $e){
            return true;
        }
    }

    if(isClientChina() && isChinaIp(getIp())){
        Header("Location:https://www.baidu.com");
    }else{
        Header("Location:https://www.google.com");
    }

});
Route::get('/test/xsd', 'TestController@xsd');
Route::get('/products', 'TestController@products');
Route::get('/products/match', 'TestController@byAsins');

Route::view('{path}', 'index')->where('path', '^(?!api).*');
