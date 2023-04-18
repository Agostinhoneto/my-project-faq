<?php

use App\Http\Controllers\Api\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Resources\UserResource;
use App\Http\Middleware\AdminMiddleware;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return new UserResource($request->user());
});

/*
Route::middleware(['auth','is_admin'])->group(function(){
    Route::get('/admin',[AuthController::class,'admin']);
});
*/
/*
Route::middleware(['admin'])->group(function(){
    Route::get('/admin',[AuthController::class,'admin']);
});
*/
Route::post('/login',[LoginController::class,'login']);


Route::controller(AuthController::class)->group(function () {
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('register', 'register')->middleware('AdminMiddleware');  
    Route::get('get_user', 'get_user');
    Route::get('index','index');
    Route::get('show/{id}','show');
    Route::put('update/{id}','update'); 
    Route::delete('destroy/{id}','destroy');
});

Route::controller(RoleController::class)->group(function () {
    Route::post('store', 'store');
    Route::get('index', 'index');
    Route::get('attachUserRole/{userId}/roles/{role_name}','attachUserRole');
    Route::get('getUserRole/{userId}/roles','getUserRole');
    Route::post('attachPermission','attachPermission');
    Route::get('getPermissions/{roleParam}','getPermissions');
});










