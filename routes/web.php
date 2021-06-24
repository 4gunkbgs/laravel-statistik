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

Route::delete('/delete/{id}', 'App\Http\Controllers\HomeController@delete');
// Route::delete('/delete', 'App\Http\Controllers\HomeController@deleteAll');     //route ke delete (klik delete)

Route::get('/export', 'App\Http\Controllers\HomeController@export');       //route ke export
Route::post('/import', 'App\Http\Controllers\HomeController@import');       //route ke export

Route::get('/exportmoment', 'App\Http\Controllers\HomeController@exportmoment');       //route ke export
Route::post('/importmoment', 'App\Http\Controllers\HomeController@importmoment');       //route ke export

Route::get('/exportbiserial', 'App\Http\Controllers\HomeController@exportbiserial');       //route ke export
Route::post('/importbiserial', 'App\Http\Controllers\HomeController@importbiserial');       //route ke export

Route::get('/frekuensi', 'App\Http\Controllers\HomeController@frekuensi');
Route::get('/statistik', 'App\Http\Controllers\HomeController@statistik');

Route::get('/databergolong', 'App\Http\Controllers\HomeController@databergolong');
Route::get('/chikuadrat', 'App\Http\Controllers\HomeController@chikuadrat');
Route::get('/lillifors', 'App\Http\Controllers\HomeController@lilliefors');

Route::get('/korelasiMoment', 'App\Http\Controllers\HomeController@korelasiMoment');
Route::get('/korelasiBiserial', 'App\Http\Controllers\HomeController@korelasiBiserial');