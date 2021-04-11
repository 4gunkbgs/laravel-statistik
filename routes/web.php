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

Route::get('/welcome', function () {
    return view('edit');
});

Route::get('/', 'App\Http\Controllers\HomeController@index');       //route ke index
Route::post('/', 'App\Http\Controllers\HomeController@store');      //route ke store (bagian input)

Route::get('/edit/{id}', 'App\Http\Controllers\HomeController@edit');   //route ke edit (bagian edit.blade)
Route::put('/edit/{id}', 'App\Http\Controllers\HomeController@update'); //route ke update (setelah klik edit pada edit.blade)

Route::delete('/delete/{id}', 'App\Http\Controllers\HomeController@delete');    //route ke delete (klik delete)