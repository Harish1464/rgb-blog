<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\FrontEndController;
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
Route::controller(FrontEndController::class)->group( function(){
    Route::get('/', 'index')->name('home');
    Route::get('/login', 'login')->name('user-login-form');
    Route::post('/login-post', 'frontLogin')->name('user-login');
    Route::get('/user-register-form', 'registerForm')->name('user-register-form');
    Route::post('/register-user', 'registerUSer')->name('register-user');
    Route::get('/blog/category/{category_slug}', 'getBlogByCategory')->name('category-blogs');
    Route::get('/blog/tag/{tag_slug}', 'getBlogByTag')->name('tag-blogs');
});


Route::controller(AdminController::class)->prefix('admin')->as('admin.')->group( function(){
    Route::match(['get', 'post'],'/login', 'adminLogin')->name('login');
    Route::get('/register', 'registerUser')->name('register');
    Route::get('/forget-password', 'forgetPassword')->name('forget-password');
});

Route::group(['middleware'=> 'admin'], function(){
    Route::controller(AdminController::class)->prefix('admin')->as('admin.')->group(function(){
        Route::get('/dashboard', 'adminDashboard')->name('dashboard'); 
        Route::get('/logout', 'adminLogout')->name('logout'); 
    });

    Route::controller(CategoryController::class)->prefix('category')->as('category.')->group(function(){
        Route::get('/', 'index')->name('index'); 
        Route::get('/create', 'create')->name('create'); 
        Route::post('/store', 'store')->name('store'); 
        Route::get('/edit/{slug}', 'edit')->name('edit'); 
        Route::post('/update/{slug}', 'update')->name('update'); 
        Route::get('/delete/{slug}', 'delete')->name('delete'); 
    });

    Route::controller(TagController::class)->prefix('tag')->as('tag.')->group(function(){
        Route::get('/', 'index')->name('index'); 
        Route::get('/create', 'create')->name('create'); 
        Route::post('/store', 'store')->name('store'); 
        Route::get('/edit/{slug}', 'edit')->name('edit'); 
        Route::post('/update/{slug}', 'update')->name('update'); 
        Route::get('/delete/{slug}', 'delete')->name('delete'); 
    });

    Route::controller(BlogController::class)->prefix('blog')->as('blog.')->group(function(){
        Route::get('/', 'index')->name('index'); 
        Route::get('/create', 'create')->name('create')->middleware('category_count'); 
        Route::post('/store', 'store')->name('store'); 
        Route::get('/edit/{slug}', 'edit')->name('edit'); 
        Route::post('/update/{slug}', 'update')->name('update'); 
        Route::get('/delete/{slug}', 'delete')->name('delete'); 
    });
});
