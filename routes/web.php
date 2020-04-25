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

Route::get('/notificacion', 'conferenciaController@notificacion')->name('notificacion');

//**Conferencias */
Route::get('/conferencia', 'conferenciaController@conferencia')->name('conferencia.index');
Route::post('/crear_conferencia', 'conferenciaController@crear_conferencia')->name('crear_conferencia');
Route::post('/video/nueva', 'conferenciaController@save')->name('save');
Route::get('/online/{id}', 'conferenciaController@online')->name('online');
Route::post('/modal_ver', 'conferenciaController@modal_ver')->name('modal_ver');
Route::post('/editar_conferencia/{id}', 'conferenciaController@editar_conferencia')->name('editar_conferencia');
Route::post('/delete_lista', 'conferenciaController@delete_lista')->name('delete_lista');
Route::post('/do_delete/{id}', 'conferenciaController@do_delete')->name('do_delete');
Route::post('/invitar_usuarios', 'conferenciaController@invitar_usuarios')->name('invitar_usuarios');
Route::post('/video/invitar_interno', 'conferenciaController@invitarInterno')->name('invitarInterno');
Route::post('/invitar_externos', 'conferenciaController@invitar_externos')->name('invitar_externos');
Route::post('/terminar', 'conferenciaController@terminar')->name('terminar');
//**Fin conferencias */
