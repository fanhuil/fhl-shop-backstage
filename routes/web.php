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

Route::get('/', function () {
    return view('welcome');
});

// 测试路由
Route::get('/func',[App\Http\Controllers\Func\FuncController::class,'index']);
Route::get('/testclosure',[App\Http\Controllers\Func\FuncController::class,'testClosure']);
Route::get('/testarrayreduce',[App\Http\Controllers\Func\FuncController::class,'testArrayReduce']);
