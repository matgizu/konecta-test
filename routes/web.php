<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;
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

Route::post('login', [SessionController::class,'login'])->name('login');
Route::post('logout', [SessionController::class,'logout'])->name('logout');
Route::get('register', [SessionController::class,'sing_up'])->name('sign_up');
Route::post('register', [SessionController::class,'registerForm'])->name('registerForm');
Route::get('dashboard', [SessionController::class,'dashboard'])->name('dashboard');

//CLIENTS
Route::post('createClient', [ClientController::class,'createForm'])->name('createClient');
Route::delete('deleteClient/{id}', [ClientController::class,'deleteForm'])->name('deleteClient');
Route::get('editClient/{id}', [ClientController::class,'edit'])->name('editClient');
Route::put('updateClient/{id}', [ClientController::class,'updateForm'])->name('updateClient');

//USERS
Route::post('createUser', [UserController::class,'createForm'])->name('createUser');
Route::delete('deleteUser/{id}', [UserController::class,'deleteForm'])->name('deleteUser');
Route::delete('editUser', [UserController::class,'editForm'])->name('editUser');

