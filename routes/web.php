<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\UsersController;
use App\Http\Controllers\Auth\RegisterController;
use app\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\Request;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\AdminRegisterController;
use App\Http\Controllers\Admin\AdminControllers\AdminController;
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


// admin機能
Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function(){
    // 認証
    Route::get('/login', [App\Http\Controllers\Admin\Auth\AdminLoginController::class,'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\Auth\AdminLoginController::class,'login'])->name('login');
    Route::post('/logout', [App\Http\Controllers\Admin\Auth\AdminLoginController::class,'logout'])->name('logout');    
        Route::get('/register', [App\Http\Controllers\Admin\Auth\AdminRegisterController::class,'showRegistrationForm'])->name('register'); // admin登録機能は不要
        Route::post('/register', [App\Http\Controllers\Admin\Auth\AdminRegisterController::class,'register'])->name('register');
    Route::get('/password/reset', [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [App\Http\Controllers\Admin\Auth\ForgotPasswordController::class,'endResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [App\Http\Controllers\Admin\Auth\ResetPasswordController::class,'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [App\Http\Controllers\Admin\Auth\ResetPasswordController::class,'reset']);

    // AdminからのUsersデータのCRUD
    Route::get('user/home', [App\Http\Controllers\Admin\AdminControllers\AdminUserController::class,'home'])->name('home');
    Route::get('user/index', [App\Http\Controllers\Admin\AdminControllers\AdminUserController::class,'index'])->name('index'); 
    // Route::post('/index', [App\Http\Controllers\Admin\AdminControllers\AdminUserController::class,'store'])->name('store'); 
    Route::put('user/{id}', [App\Http\Controllers\Admin\AdminControllers\AdminUserController::class,'update'])->name('update'); 
    Route::get('user/{id}', [App\Http\Controllers\Admin\AdminControllers\AdminUserController::class,'show'])->name('show'); 
    Route::delete('user/{id}', [App\Http\Controllers\Admin\AdminControllers\AdminUserController::class,'destroy'])->name('destroy');
    // Route::get('/create', [App\Http\Controllers\Admin\AdminControllers\AdminUserController::class,'create'])->name('create'); 
    Route::get('user/{id}/edit', [App\Http\Controllers\Admin\AdminControllers\AdminUserController::class,'edit'])->name('edit');
    
    // AdminからのRecruitmentsデータのCRUD
    Route::get('user/{id}/recruitment/{recruitment_id}', [App\Http\Controllers\Admin\AdminControllers\AdminRecruitmentController::class,'show'])->name('recruitment.show');
    Route::get('recruitments/index', [App\Http\Controllers\Admin\AdminControllers\AdminRecruitmentController::class,'index'])->name('recruitment.index');

});

Route::prefix('recruitment')->name('recruitment.')->group(function(){
    Route::get('/create',[App\Http\Controllers\RecruitmentController::class,'create'])->name('create');
    Route::post('/create',[App\Http\Controllers\RecruitmentController::class,'store'])->name('store');
    Route::get('/{user_id}/index',[App\Http\Controllers\RecruitmentController::class,'index'])->name('index');// 募集の一覧表示 ここで募集の検索もする
    Route::get('/{recruitment_id}',[App\Http\Controllers\RecruitmentController::class,'show'])->name('show');
    Route::get('/{recruitment_id}/edit',[App\Http\Controllers\RecruitmentController::class,'edit'])->name('edit');
    Route::put('/{recruitment_id}',[App\Http\Controllers\RecruitmentController::class,'update'])->name('update');
    Route::get('/search/result',[App\Http\Controllers\RecruitmentController::class,'search'])->name('search');
    Route::post('/{recruitment_id}/comment/post',[App\Http\Controllers\RecruitmentController::class,'postComment'])->name('postComment');
    Route::delete('/{recruitment_id}',[App\Http\Controllers\RecruitmentController::class,'destroy'])->name('destroy');
});

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
    Route::get('settings/MyPage', [App\Http\Controllers\UsersController::class,'showMyPage'])->name('showMyPage');

});