<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::group(['prefix'=>'users','controller'=>UserController::class],function (){
    route::get('/','showUsers')->name('users'); //vista
    Route::get('/GetAllUsers','getAllUsers');
    Route::get('/GetAUser/{user}','getAUser');
    Route::post('/CreateUser','createUser');
    Route::post('/EditUser/{user}','EditUser');
    Route::delete('/DeleteUser/{user}','deleteUser');
});

Route::group(['prefix'=>'products','controller'=>ProductController::class],function (){
    route::get('/','showProductsAdmin')->name('productsAdmin');//vista
    route::get('/ShowProductsForCategory/{category}','showProductsForCategory');//vista
    Route::get('/GetAllProducts','getAllProducts');
    Route::get('/GetAllProductsForCategory','getAllProductsForCategory');
    Route::get('/ProductsByCategory/{category}','productsByCategory');
    Route::get('/GetAProduct/{product}','getAProduct');
    Route::post('/CreateProduct','createProduct');
    Route::post('/EditProduct/{product}','editProduct');
    Route::delete('/DeleteProduct/{product}','deleteProduct');
});

Route::group(['prefix'=>'categories','controller'=>CategoryController::class],function (){
    route::get('/','showCategories')->name('categories');//vista
    Route::get('/GetAllCategories','getAllCategories');
    Route::get('/GetACategory/{category}','getACategory');
    Route::post('/CreateCategory','createCategory');
    Route::post('/EditCategory/{category}','editCategory');
    Route::delete('/DeleteCategory/{category}','deleteCategory');
});
Route::group(['prefix'=>'carts','controller'=>CartController::class],function (){
    Route::get('/showCart','showCart')->name('ShowCart');
    Route::get('/cart/{user}','cartForUser');
    Route::post('/AddProduct','addProduct');
    Route::delete('/DeleteCart/{cart}','deleteCart');
});



// LOGIN AND REGISTER
Route::group(['controller'=>RegisterController::class],function(){
    Route::get('register', 'showRegistrationForm')->name('register');
    Route::post('register', 'register');
});
    

Route::group(['controller' => LoginController::class], function () {
    Route::get('login', 'showLoginForm')->name('login');
    Route::post('login', 'login');
    Route::post('logout', 'logout')->name('logout');
});

Route::group(['controller' => ForgotPasswordController::class], function () {
    Route::get('password/reset', 'showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'sendResetLinkEmail')->name('password.email');
});

Route::group(['controller' => ConfirmPasswordController::class], function () {
    Route::get('password/confirm', 'showConfirmForm')->name('password.confirm');
    Route::post('password/confirm', 'confirm');
});

Route::group(['controller' => ResetPasswordController::class], function () {
    Route::get('password/reset/{token}', 'showResetForm')->name('password.reset');
    Route::post('password/reset', 'reset')->name('password.update');
});

Route::group(['controller' => VerificationController::class], function () {
    Route::get('email/verify', 'show')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'verify')->name('verification.verify');
    Route::post('email/resend', 'resend')->name('verification.resend');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
