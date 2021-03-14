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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::post('/', 'App\Http\Controllers\HomeController@store');

Route::get('/edit/{id}', 'App\Http\Controllers\HomeController@edit');
Route::put('/edit/{id}', 'App\Http\Controllers\HomeController@update');

Route::delete('/delete/{id}', 'App\Http\Controllers\HomeController@delete');