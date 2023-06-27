<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'users','controller'=>UserController::class], function(){
    Route::get('/GetAllUsers','getAllUsers');
    Route::get('/GetAUser/{user}','getAUser');
    Route::post('/CreateUser','createUser');
    Route::put('/EditUser/{user}','EditUser');
    Route::delete('/DeleteUser/{user}','');
});

Route::group(['prefix'=>'products','controller'=>ProductController::class],function(){
    Route::get('/GetAllProducts','getAllProducts');
    Route::get('/GetAProduct/{product}','getAProduct');
});

Route::group(['prefix'=>'categories','controller'=>CategoryController::class],function(){
    Route::get('/GetAllCategories','getAllCategories');
});

