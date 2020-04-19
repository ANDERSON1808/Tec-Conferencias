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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//**Conferencias */
Route::get('/conferencia', 'conferenciaController@conferencia')->name('conferencia.index');
Route::post('/crear_conferencia', 'conferenciaController@crear_conferencia')->name('crear_conferencia');
Route::post('/video/nueva', 'conferenciaController@save')->name('save');
Route::get('/modal_ver/{id}', 'conferenciaController@modal_ver')->name('modal_ver');
//**Fin conferencias */
