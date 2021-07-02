<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/home', function () {
    return view('test');
});

Route::get('/secondo_test', function () {
    return view('secondo_test');
});

Route::get('lang/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);
require 'admin.php';
