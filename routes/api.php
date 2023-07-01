<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'users','controller'=>UserController::class], function(){
    Route::get('/GetAllUsers','getAllUsers');
    Route::get('/GetAUser/{user}','getAUser');
    Route::post('/CreateUser','createUser');
    Route::post('/EditUser/{user}','EditUser');
    Route::delete('/DeleteUser/{user}','deleteUser');
});

Route::group(['prefix'=>'products','controller'=>ProductController::class],function(){
    Route::get('/GetAllProducts','getAllProducts');
    Route::get('/GetAllProductsForCategory','getAllProductsForCategory');
    Route::get('/GetAProduct/{product}','getAProduct');
    Route::post('/CreateProduct','createProduct');
    Route::post('/EditProduct/{product}','editProduct');
    Route::delete('/DeleteProduct/{product}','deleteProduct');
});

Route::group(['prefix'=>'categories','controller'=>CategoryController::class],function(){
    Route::get('/GetAllCategories','getAllCategories');
    Route::get('/GetACategory/{category}','getACategory');
    Route::post('/CreateCategory','createCategory');
    Route::post('/EditCategory/{category}','editCategory');
    Route::delete('/DeleteCategory/{category}','deleteCategory');
});


Route::group(['prefix'=>'carts','controller'=>CartController::class],function () {

});

