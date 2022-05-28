<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\ClientController;
Use App\Http\Controllers\AuthController;



 //routes client



Route::post('register',[Authcontroller::class,'register']);
Route::post('login',[Authcontroller::class,'login']);
Route::get('destroy',[Authcontroller::class,'destroy']);

Route::middleware(['auth:sanctum'])->group(function(){      //rutas user  
    Route::get('user-profile',[Authcontroller::class,'userprofile']);
    Route::get('logout',[Authcontroller::class,'logout']);  
    Route::get('/clients',[ClientController::class, 'index']);
 Route::post('client-create',[ClientController::class, 'createClient']);
 Route::get('client-details/{id}',[ClientController::class, 'showClient']);
 Route::put('client-update/{id}',[ClientController::class, 'updateClient']);
 Route::delete('client-delete/{id}',[ClientController::class, 'deleteClient']);  


});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
