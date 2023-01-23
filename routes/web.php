<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB as FacadesDB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $users = DB::table('teste')->get();
    dd($users);
    return view('welcome');
    
});
