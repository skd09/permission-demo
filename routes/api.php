<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Enums\Permission as UserPermission;


Route::get('/test', [UserController::class, 'test']);
Route::post('/login', [UserController::class, 'login']);


//Route::get('/user', [UserController::class, 'user'])->middleware('auth:sanctum');


Route::group(['middleware' => ['permission:'.UserPermission::SUPER_ADMIN, 'auth:sanctum']], function () {
    Route::get('/user', [UserController::class, 'user']);
});
