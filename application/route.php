<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
//动态注册
use think\Route;
//Route::rule("路由表达式","路由地址","请求方式","请求参数","变量规则");
Route::rule("api/:version/banner/:id","api/:version.Banner/banner");

Route::rule("api/:version/theme","api/:version.Theme/theme");
Route::rule("api/:version/theme/:id","api/:version.Theme/getComplexOne");


//Route::rule("api/:version/product/by_category","api/:version.Product/getAllInCategory");
//Route::rule("api/:version/product/recent","api/:version.Product/getRecent");
//Route::rule("api/:version/product/:id","api/:version.Product/getOne",'get',[],['id'=>'\d+']);

Route::group("api/:version/product",function (){
    Route::rule("/by_category/:id","api/:version.Product/getAllInCategory");
    Route::rule("/recent","api/:version.Product/getRecent");
    Route::rule("/:id","api/:version.Product/getOne");
});


Route::rule("api/:version/category/all","api/:version.Category/getAllCategory");

Route::rule("api/:version/token/user","api/:version.Token/getToken");

Route::rule("api/:version/address","api/:version.Address/createOrUpdateAddress");

Route::rule("api/:version/second","api/:version.Address/second");

Route::rule("api/:version/order","api/:version.Order/placeOrder");

Route::rule("api/:version/pre_order/:id","api/:version.Pay/getPreOrder");

//不想把所有查询都写在一起，所以增加by_user，很好的REST与RESTFul的区别
Route::get('api/:version/order/by_user', 'api/:version.Order/getSummaryByUser');
Route::get('api/:version/order/paginate', 'api/:version.Order/getSummary');


//Pay
Route::post('api/:version/pay/pre_order', 'api/:version.Pay/getPreOrder');
Route::post('api/:version/pay/notify', 'api/:version.Pay/receiveNotify');
Route::post('api/:version/pay/re_notify', 'api/:version.Pay/redirectNotify');
Route::post('api/:version/pay/concurrency', 'api/:version.Pay/notifyConcurrency');