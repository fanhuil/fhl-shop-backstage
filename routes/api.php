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


// 登录注册不需要验证Token
Route::post('login',[\App\Http\Controllers\AdminApi\LoginController::class,'login']);
Route::get('register', [\App\Http\Controllers\AdminApi\LoginController::class,'register']);

// 其它页面需要验证Token
Route::group(['middleware' => 'auth.jwt'],function(){
   Route::get('index',[\App\Http\Controllers\AdminApi\IndexController::class,'index']);
});


















//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
