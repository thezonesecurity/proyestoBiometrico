<?php
use App\Http\Controllers\Test;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| ---------------SERVIDOR VIRTUAL => COMPOSER
| ---------------LOCAL HOST  =>  XAMPP

Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('login', 'LoginController@index')->name('login');
Route::post('login', 'LoginController@login')->name('login_post');
Route::get('logout', 'LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', 'HomeController@index')->name('inicio');

    Route::get('/Servicios', 'ServicioController@index')->name('listar.servicio');
    Route::get('/CrearServicio', 'ServicioController@create')->name('crear.servicio');
    Route::post('/GuardarServicio', 'ServicioController@store')->name('guardar.servicio');
    //Route::get('/EditarServicio/{id}', 'ServicioController@edit')->name('editar.servicio');
    Route::post('/ActualizarServicio/', 'ServicioController@update')->name('editarsave.servicio');
    Route::get('/Servicio/Inahabilitado/{id}', 'ServicioController@deshabilitar')->name('inhabilitar.servicio');
    Route::get('/Servicio/Habilitado/{id}', 'ServicioController@habilitar')->name('habilitar.servicio');
    Route::get('/Servicio/Eliminado/{id}', 'ServicioController@destroy')->name('eliminado.servicio');

    Route::get('/Personal', 'PersonalController@index')->name('listar.personal');
    Route::post('actualizar/personal/', 'PersonalController@update')->name('editar.personal');
    Route::get('/Persona/Inahabilitado/{id}', 'PersonalController@deshabilitar')->name('inhabilitar.persona');
    Route::get('/Persona/Habilitado/{id}', 'PersonalController@habilitar')->name('habilitar.persona');

    Route::get('/rol/turno/', 'RolturnoController@index')->name('listar.registrar.rolturno');
    Route::post('/registrar/rolturno/', 'RolturnoController@store')->name('guardar.rolturno');
    Route::get('/listar/roles/turnos/', 'RolturnoController@lista')->name('listar.roles.turno');

    Route::get('/eliminar/rol/turno/{id}', 'RolturnoController@destroy')->name('eliminar.roles.turno');

    Route::get('/tabla', 'ServicioController@mostrartabla')->name('tabla');
});

//Route::get('/test',[TestController::class, 'index']);