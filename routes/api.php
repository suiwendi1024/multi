<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// 博客评论
Route::apiResource('posts.comments', 'CommentController')->only('index', 'store');
Route::delete('comments/{comment}', 'CommentController@destroy')->name('comments.destroy');
// 博客点赞
Route::apiResource('posts.likes', 'LikeController')->only('store');
Route::delete('posts/{post}/likes', 'LikeController@destroy')->name('posts.likes.destroy');
Route::apiResource('comments.likes', 'LikeController')->only('store');
Route::delete('comments/{comment}/likes', 'LikeController@destroy')->name('comments.likes.destroy');
// 博客收藏
Route::apiResource('posts.favorites', 'FavoriteController')->only('store');
Route::delete('posts/{post}/favorites', 'FavoriteController@destroy')->name('posts.favorites.destroy');
// 商店产品
Route::apiResource('products', 'ProductController')->only('index');
