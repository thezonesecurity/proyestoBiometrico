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
|


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

    Route::get('/tabla', 'ServicioController@mostrartabla')->name('tabla');
});

//Route::get('/test',[TestController::class, 'index']);