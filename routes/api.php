<?php

use App\Http\Controllers\Api\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Resources\UserResource;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\FilialEmpresaController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Filial;

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


Route::controller(AuthController::class)->group(function () {
    Route::get('index','index');
    Route::get('show/{id}','show');
    Route::put('update/{id}','update'); 
    Route::delete('destroy/{id}','destroy');
});

Route::controller(EmpresaController::class)->group(function () {
    Route::get('/empresa/index','index');
    Route::get('/empresa/register','register');
    Route::get('/empresa/show/{id}','show');
    Route::put('/empresa/update/{id}','update'); 
    Route::delete('/empresa/destroy/{id}','destroy');
});

Route::controller(FilialEmpresaController::class)->group(function () {
    Route::get('/filial/index','index');
    Route::get('/filial/register','register');
    Route::get('/filial/show/{id}','show');
    Route::put('/filial/update/{id}','update'); 
    Route::delete('/filial/destroy/{id}','destroy');
});


Route::controller(RoleController::class)->group(function () {
    Route::post('store', 'store');
    Route::get('index', 'index');
    Route::get('attachUserRole/{userId}/roles/{role_name}','attachUserRole');
    Route::get('getUserRole/{userId}/roles','getUserRole');
    Route::post('attachPermission','attachPermission');
    Route::get('getPermissions/{roleParam}','getPermissions');
});










