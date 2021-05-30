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

Auth::routes();

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
Route::resource('orders', 'OrderController');
// 个人空间
Route::get('/profile/{user}', 'UserController@profile');
// 个人中心
Route::prefix('/user')->namespace('User')->group(function () {
    Route::get('/profile', 'ProfileController@show');
    Route::patch('/profile', 'ProfileController@update');
    Route::get('/profile_picture', 'ProfilePictureController@show');
    Route::patch('/profile_picture', 'ProfilePictureController@update');
});

// 后台首页
Route::view('/admin', 'admin.dashboard')->name('admin')->middleware('auth:admin');
// 后台其他页面
Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function () {

    Auth::routes(['register' => false, 'reset' => false, 'confirm' => false, 'verify' => false]);
    // 帖子管理
    Route::resource('posts', 'PostController');
    // 订单管理
    Route::resource('orders', 'OrderController');
});
