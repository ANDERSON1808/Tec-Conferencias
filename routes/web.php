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
Route::get('/online/{id}', 'conferenciaController@online')->name('online');
Route::post('/modal_ver', 'conferenciaController@modal_ver')->name('modal_ver');
Route::post('/editar_conferencia/{id}', 'conferenciaController@editar_conferencia')->name('editar_conferencia');
Route::post('/delete_lista', 'conferenciaController@delete_lista')->name('delete_lista');
Route::post('/do_delete/{id}', 'conferenciaController@do_delete')->name('do_delete');
//**Fin conferencias */
//INICIO usuarios --------------------------------------------


Route::get('user.view', 'userController@users')->name('user.view');
Route::get('getUsers', 'userController@get');

Route::get('modal_ver', 'userController@modal_ver')->name('user_ver');
Route::post('updateUser', 'userController@update');
Route::get('user_crear', 'userController@userCrear');
Route::post('delete_user', 'userController@delete');
Route::post('createUser', 'userController@create');


//FIN usuarios--------------------------------------------------------
//INICIO roles ------------------------------------------------



Route::get('/viewRoles', 'rolController@view');
Route::get('getRoles', 'rolController@get');


//FIN --------------------------------------------------------
//NOTIFICACIONES -------------------------

Route::get('notificaciones', 'NotificationController@get');

Route::get('cantNotificaciones', 'NotificationController@cantidadNotSinVer');


//FIN --------------------------------------
