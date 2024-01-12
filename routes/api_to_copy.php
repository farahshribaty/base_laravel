<?php


Route::prefix('Product')->group(function(){
    Route::get('/getOne' , [YourController::class , 'getOne']);
    Route::get('/getAll' , [YourController::class , 'getAll']);
    Route::post('/add' , [YourController::class , 'add']);
    Route::post('/update' , [YourController::class , 'update']);
    Route::post('/delete' , [YourController::class , 'delete']);
}); 