<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\Request;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// ユーザ認証 
Auth::routes();
Route::get('/', function () {return view('welcome');});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Users CRUD
// 見本 Route::get('/users/{id}',[App\Http\Controllers\UsersController::class,'create']);
Route::get('/bosyu/users', [App\Http\Controllers\UsersController::class,'index'])->name('/bosyu/users.index'); // ユーザの一覧表示はいらんかも
Route::post('/bosyu/users', [App\Http\Controllers\UsersController::class,'store'])->name('/bosyu/users.store'); 
Route::put('/bosyu/users/{id}', [App\Http\Controllers\UsersController::class,'update'])->name('/bosyu/users.update'); 
Route::get('/bosyu/users/{id}', [App\Http\Controllers\UsersController::class,'show'])->name('/bosyu/users.show'); 
Route::delete('/bosyu/users/{id}', [App\Http\Controllers\UsersController::class,'destroy'])->name('/bosyu/users.destroy');
Route::get('/bosyu/users/create', [App\Http\Controllers\UsersController::class,'create'])->name('/bosyu/users.create'); 
Route::get('/bosyu/users/{id}/edit', [App\Http\Controllers\UsersController::class,'edit'])->name('/bosyu/users.edit');

Auth::routes(['register' => false]);
Route::post('bosyu/register', [Auth\RegisterController::class,'userRegister']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
