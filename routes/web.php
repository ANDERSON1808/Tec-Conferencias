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
    return view('auth/login');
});
Route::get('logout', function () {
    //Desconctamos al usuario
    Auth::logout();

    //Redireccionamos al inicio de la app con un mensaje
    return Redirect::to('/login')->with('msg', 'Gracias por visitarnos!.');
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
Route::get('/entrar/{id}', 'conferenciaController@entrar')->name('entrar');
Route::post('/modal_ver', 'conferenciaController@modal_ver')->name('modal_ver');
Route::post('/editar_conferencia/{id}', 'conferenciaController@editar_conferencia')->name('editar_conferencia');
Route::post('/delete_lista', 'conferenciaController@delete_lista')->name('delete_lista');
Route::post('/do_delete/{id}', 'conferenciaController@do_delete')->name('do_delete');
Route::post('/invitar_usuarios', 'conferenciaController@invitar_usuarios')->name('invitar_usuarios');
Route::post('/video/invitar_interno', 'conferenciaController@invitarInterno')->name('invitarInterno');
Route::post('/invitar_externos', 'conferenciaController@invitar_externos')->name('invitar_externos');
Route::post('/terminar', 'conferenciaController@terminar')->name('terminar');
Route::get('/invitacion', 'conferenciaController@invitacion')->name('invitacion');
Route::get('/historico', 'conferenciaController@historico')->name('historico');
//**Fin conferencias */



















//SESIONES //




Route::post('getInvitadoSesion','sesionesController@getInvitadoSesion')->name('getInvitadoSesion');
Route::post('/sesiones/invitarInternoSesion', 'sesionesController@invitarInterno')->name('invitarInternoSesion');
Route::post('/terminarSesion', 'sesionesController@terminarSesion')->name('terminarSesion');
Route::post('/inviteUserSesion', 'sesionesController@inviteUserSesion')->name('inviteUserSesion');

Route::get('sesionesonline', function () {
    return view('sesiones/online');
});

Route::get('onlineSesionIdControl/{id}', 'sesionesController@onlineSesionControl')->name("onlineSesionIdControl");
Route::post('onlineSesionId', 'sesionesController@online');
Route::get('getSesiones','sesionesController@get');
Route::post('getSesionesInvitados','sesionesController@getInvited');
Route::get('viewSesion','sesionesController@view');
Route::get('viewParticipacion','sesionesController@viewParticipacion');
Route::get('editSesion','sesionesController@edit');
Route::post('createSesion','sesionesController@create');
Route::get('invitadosSesion','sesionesController@invitados');



Route::post('listaAsistencia','sesionesController@getAsistencia');
Route::post('guardarAsist','sesionesController@createAsistencia')->name("guardarAsist");
Route::post('guardarTemaNuevo','sesionesController@createTema')->name("guardarTemaNuevo");
Route::post('postTemas','sesionesController@getTemas')->name("getTemas");

Route::post('editTema','sesionesController@editTema')->name("editTema");
Route::post('deleteTema','sesionesController@deleteTema')->name("deleteTema");

Route::post('getEditTema','sesionesController@getEditTema')->name("getEditTema");

Route::post('getEditSesion','sesionesController@getEditSesion')->name("getEditSesion");
Route::post('editSesionpost','sesionesController@editSesionPost')->name("editSesionpost");

Route::post('deleteSesionpost','sesionesController@deleteSesionpost')->name("deleteSesionpost");
//modao votacion//*
Route::post('/modal_asistencia', 'sesionesController@modal_asistencia')->name('modal_asistencia');



Route::post('guardarVoto', 'sesionesController@guardarVoto')->name("guardarVoto");

Route::post('getUsersConferens', 'sesionesController@UserInConferencia')->name("getUsersConferens");

Route::post('getSolicitudesPalabra', 'sesionesController@getSolicitudesPalabra')->name("getSolicitudesPalabra");
Route::post('postSolicitudPalabra', 'sesionesController@postSolicitudPalabra')->name("postSolicitudPalabra");
Route::post('aprobarSolicitud', 'sesionesController@aprobarSolicitud')->name("aprobarSolicitud");

// FIN SESIONES //

























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
Route::get('getRoles', 'rolController@get')->name("getRoles");


//FIN --------------------------------------------------------
//NOTIFICACIONES -------------------------

Route::get('notificaciones', 'NotificationController@get');

Route::get('cantNotificaciones', 'NotificationController@cantidadNotSinVer');


//FIN --------------------------------------
