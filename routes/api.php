<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->post('/', function (Request $request) {

});
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/getCode', [UserController::class, 'getCodeOTP']);
Route::post('/checkCode', [UserController::class, 'checkOTP']);
Route::post('/getHistory', [UserController::class, 'getHistory']);
Route::post('/storePost', [PostController::class, 'store']);
Route::get('/getAllPost', [PostController::class, 'index']);
