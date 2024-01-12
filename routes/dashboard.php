<?php

use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function(){
    Route::prefix('category')->middleware(['languageSwitcher','permission'])->group(function(){
        Route::get('/getOne' , [CategoryController::class , 'getOne'])->name('premission_get_one_product');
        Route::get('/getAll' , [CategoryController::class , 'getAll'])->name('premission_get_all_product');
        Route::post('/add' , [CategoryController::class , 'create'])->name('premission_add_product');
        Route::post('/update' , [CategoryController::class , 'update'])->name('permission_update_category');
        Route::post('/delete' , [CategoryController::class , 'delete'])->name('premission_delete_product');
    });
});

Route::group(['prefix' => 'admin'], function () {

    Route::post('login', [AuthController::class, 'adminLogin']);

    Route::group(['middleware' => ['auth:sanctum'] ], function () {

        // Logout
        Route::get('logout', [AuthController::class, 'logout']);
    });
});
// Route::prefix('product')->group(function(){
//     Route::get('/getOne' , [ProductController::class , 'getOne']);
//     Route::get('/getAll' , [ProductController::class , 'getAll']);
//     Route::post('/add' , [ProductController::class , 'create']);
//     Route::post('/update' , [ProductController::class , 'update']);
//     Route::post('/delete' , [ProductController::class , 'delete']);
// });
