<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\RegisterController;
use app\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\Request;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\AdminRegisterController;
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
Route::get('/', function () {return view('welcome');});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Users CRUD ------------------------------------------
// 見本 Route::get('/users/{id}',[App\Http\Controllers\UsersController::class,'create']);
Route::prefix('user')->name('user.')->group(function(){

    Route::get('', [App\Http\Controllers\UsersController::class,'index'])->name('index'); // ユーザの一覧表示はいらんかも
    Route::post('', [App\Http\Controllers\UsersController::class,'store'])->name('store'); 
    Route::put('/{id}', [App\Http\Controllers\UsersController::class,'update'])->name('update'); 
    Route::get('/{id}', [App\Http\Controllers\UsersController::class,'show'])->name('show'); 
    Route::delete('/{id}', [App\Http\Controllers\UsersController::class,'destroy'])->name('destroy');
    Route::get('/create', [App\Http\Controllers\UsersController::class,'create'])->name('create'); 
    Route::get('/{id}/edit', [App\Http\Controllers\UsersController::class,'edit'])->name('edit');

});

// Auth::routes(['register' => false]); -------------------------------------
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class,'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class,'login']);
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');
    Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class,'showRegistrationForm'])->name('register');
    // Route::post('/register', [Auth\RegisterController::class,'register']);
    Route::get('/password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class,'endResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class,'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class,'reset']);
    Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class,'userRegister']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('admin')->name('admin.')->group(function(){

    Route::get('/login', [App\Http\Controllers\Admin\Auth\AdminLoginController::class,'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\Auth\AdminLoginController::class,'login']);
    Route::post('/logout', [App\Http\Controllers\Admin\Auth\AdminLoginController::class,'logout'])->name('logout');    
    Route::get('/register', [App\Http\Controllers\Admin\Auth\AdminRegisterController::class,'showRegistrationForm'])->name('register');
    Route::post('/register', [App\Http\Controllers\Admin\Auth\AdminRegisterController::class,'register']);
    Route::get('/password/reset', [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class,'endResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [App\Http\Controllers\Admin\Auth\ResetPasswordController::class,'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [App\Http\Controllers\Admin\Auth\ResetPasswordController::class,'reset']);
    
});