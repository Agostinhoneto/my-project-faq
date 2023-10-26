<?php

use App\Http\Controllers\Api\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContratosController;
use App\Http\Controllers\RoleController;
use App\Http\Resources\UserResource;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\FilialEmpresaController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Filial;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return new UserResource($request->user());
});

Route::post('/login',[LoginController::class,'login']);

Route::controller(AuthController::class)->group(function () {
    Route::post('logout', 'logout')->name('auth_logout');
    Route::post('refresh', 'refresh')->name('refresh');
    Route::post('register', 'register')->middleware('AdminMiddleware');
    Route::get('get_user', 'get_user')->name('refresh');
    Route::get('index','index')->name('index.auth');
    Route::get('show/{id}','show')->name('show.auth');
    Route::put('update/{id}','update')->name('update.auth');
    Route::delete('destroy/{id}','destroy')->name('destroy.auth');
});

Route::controller(EmpresaController::class)->group(function () {
    Route::get('/empresa/index','index');
    Route::post('/empresa/register','register');
    Route::get('/empresa/show/{id}','show');
    Route::put('/empresa/update/{id}','update');
    Route::delete('/empresa/alterar_status/{id}','alterar_status');

});

Route::controller(FilialEmpresaController::class)->group(function () {
    Route::get('/filial/index','index');
    Route::post('/filial/register','register');
    Route::get('/filial/show/{id}','show');
    Route::put('/filial/update/{id}','update');
    Route::delete('/filial/alterar_status/{id}','alterar_status');
});


Route::controller(RoleController::class)->group(function () {
    Route::post('store', 'store');
    Route::get('index', 'index');
    Route::get('attachUserRole/{userId}/roles/{role_name}','attachUserRole');
    Route::get('getUserRole/{userId}/roles','getUserRole');
    Route::post('attachPermission','attachPermission');
    Route::get('getPermissions/{roleParam}','getPermissions');
});

Route::controller(ContratosController::class)->group(function () {
    Route::get('/contratos/index','index');
    Route::post('/contratos/register','register');
    Route::get('/contratos/show/{id}','show');
    Route::put('/contratos/update/{id}','update');
    Route::delete('/contratos/alterar_status/{id}','alterar_status');
});
