<?php

use Illuminate\Support\Facades\Route;

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

// 登录验证
Auth::routes();
// 个人中心
Route::get('/home', 'HomeController@index')->name('home');

// 博客首页
Route::get('/', 'PostController@index')->name('posts.index');
// 博客帖子
Route::resource('posts', 'PostController')->except('index');

// 商店首页
Route::get('/shop', 'ProductController@index')->name('products.index');
// 商店产品
Route::resource('products', 'ProductController')->only('show');
// 商店订单
Route::resource('orders', 'OrderController')->only('index', 'create');

// 购物车
Route::resource('wares', 'WareController')->only('index');

// 后台
Route::namespace('Admin')->group(function () {
    // 首页
    Route::get('/admin', 'HomeController@index')->name('admin');
    // 其他页面
    Route::prefix('/admin')->name('admin.')->group(function () {
        // 登录验证
        Auth::routes(['register' => false, 'reset' => false, 'confirm' => false, 'verify' => false]);
        // 帖子管理
        Route::resource('posts', 'PostController')->only('index', 'update');
        // 订单管理
        Route::resource('orders', 'OrderController')->only('index', 'update');
    });
});
