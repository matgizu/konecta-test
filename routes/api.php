<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use App\Models\Client;
use App\Models\User;

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
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('register', [AuthController::class,'register'])->name('register');
    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', [AuthController::class,'logout'])->name('logout');
});

Route::group([
    'prefix' => 'users'
], function () {
    Route::get('all',[UserController::class,'all']);
    Route::get('{id}',[UserController::class,'show']);
    Route::put('{id}',[UserController::class,'update']);
    Route::delete('{id}',[UserController::class,'delete']);
    Route::get('search',[UserController::class,'search']);
});

Route::group([
    'prefix' => 'clients'
], function () {
    Route::get('all',[ClientController::class,'all']);
    Route::post('create',[ClientController::class,'create'])->name('create');
    Route::get('{id}',[ClientController::class,'show']);
    Route::put('{id}',[ClientController::class,'update']);
    Route::delete('{id}',[ClientController::class,'delete']);
});

