<?php
use App\Http\Controllers\Test;
/*
| ---------------SERVIDOR VIRTUAL => COMPOSER
| ---------------LOCAL HOST  =>  XAMPP
*/
Route::get('login', 'LoginController@index')->name('login');
Route::post('login', 'LoginController@login')->name('login_post');
Route::get('logout', 'LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function(){
  Route::get('/', 'HomeController@index')->name('inicio');
  //RUTAS PARA SERVICIOS
  Route::get('/listar/servicios/', 'ServicioController@index')->name('listar.servicio');
  Route::get('/CrearServicio', 'ServicioController@create')->name('crear.servicio');
  Route::post('/registrar/servicio/', 'ServicioController@store')->name('registrar.servicio');
  Route::post('/servicio/actualizar', 'ServicioController@update')->name('editarsave.servicio');
  Route::get('/servicio/Inahabilitado/{id}', 'ServicioController@deshabilitar')->name('inhabilitar.servicio');
  Route::get('/servicio/Habilitado/{id}', 'ServicioController@habilitar')->name('habilitar.servicio');
  Route::get('/servicio/Eliminado/{id}', 'ServicioController@destroy')->name('eliminado.servicio');

  //RUTAS PARA AREAS
  Route::get('/listar/areas/servicio', 'AreaServicioController@index')->name('listar.area.servicio');
  Route::post('/registrar/area/servicio', 'AreaServicioController@store')->name('guardar.area.servicio');
  Route::post('/editar/area/servicio/', 'AreaServicioController@update')->name('editarsave.area.servicio');
  Route::get('/area/servicio/inahabilitado/{id}', 'AreaServicioController@deshabilitar')->name('inhabilitar.area.servicio');
  Route::get('/area/servicio/habilitado/{id}', 'AreaServicioController@habilitar')->name('habilitar.area.servicio');

});

Route::group(['middleware' => 'auth'], function(){
    //RUTAS PARA EL PERSONAL
    Route::get('/listar/personal', 'PersonalController@index')->name('listar.personal');
    Route::post('/registrar/persona/', 'PersonalController@store')->name('registrar.persona.nueva');
    Route::post('/actualizar/personal/', 'PersonalController@update')->name('editar.personal');
    Route::get('/persona/inahabilitado/{id}', 'PersonalController@deshabilitar')->name('inhabilitar.persona');
    Route::get('/persona/habilitado/{id}', 'PersonalController@habilitar')->name('habilitar.persona');

});

Route::group(['middleware' => 'auth'], function(){
   
    //rutas para tipo de contratos
    Route::get('/listar/tipo/turnos/', 'TipoTurnosController@index')->name('listar.tipos.turnos');
    Route::post('/registrar/tipo/turno/', 'TipoTurnosController@store')->name('guardar.tipo.turno');
    Route::post('/editar/tipo/turno/', 'TipoTurnosController@update')->name('editarsave.tipo.turno');
    Route::get('/tipo/turno/inahabilitado/{id}', 'TipoTurnosController@deshabilitar')->name('inhabilitar.tipo.turno');
    Route::get('/tipo/turno/habilitado/{id}', 'TipoTurnosController@habilitar')->name('habilitar.tipo.turno');
    //rutas para tipos de turnos
    Route::get('/listar/tipos/contratos/', 'TipoContratosController@index')->name('listar.tipos.contratos');
    Route::post('/registrar/tipo/contrato/', 'TipoContratosController@store')->name('guardar.tipo.contrato');
    Route::post('/editar/tipo/contrato/', 'TipoContratosController@update')->name('editarsave.tipo.contrato');
    Route::get('/tipo/contrato/inahabilitado/{id}', 'TipoContratosController@deshabilitar')->name('inhabilitar.tipo.contrato');
    Route::get('/tipo/contrato/habilitado/{id}', 'TipoContratosController@habilitar')->name('habilitar.tipo.contrato');
});


Route::group(['middleware' => 'auth'], function(){
  //RUTAS PARA ROLTURNOS DEL PERSONAL
  Route::get('/registrar/rol/turno', 'RolturnoController@index')->name('listar.registrar.rolturno');
  Route::post('/rolturno/registrar/', 'RolturnoController@store')->name('guardar.rolturno');

  Route::post('/eliminar/rolturno/', 'RolturnoController@destroy')->name('rolturno.eliminado');

  Route::get('/imprimir/rolturno/{id}', 'RolturnoController@print')->name('rolturno.imprimir.pdf');
 
  Route::get('/area/servicio', 'RolturnoController@getAreas')->name('areas.servicio');
  Route::get('/persona/servicio', 'RolturnoController@getPersons')->name('servicio.personas');
  Route::post('/enviar/rolturno', 'RolturnoController@send')->name('enviar.rolturno');

  Route::get('/imprimir/tabla', 'RolturnoController@tabla')->name('tablas');//--

  Route::get('/area/servicio/test', 'RolturnoController@getAreasTest')->name('areas.servicio.test');

  Route::get('/listar/roles/turnos/', 'RolturnoController@lista')->name('listar.roles.turno');

  Route::post('/registrar/rolturno/test', 'RolturnoController@storetest')->name('guardar.rolturno.test');

  Route::get('/registrar/listar/rolturno/{id}', 'RolturnoController@gettest')->name('editar.rolturno.test');

  Route::post('/editar/rolturno/', 'RolturnoController@actualizar')->name('editarsave.rolturno');
  Route::get('/servicio/gestion/', 'RolturnoController@controlGestion')->name('gestion.registrado');
});

Route::group(['middleware' => 'auth'], function(){
  //rutas para habilitacion de turnos
  Route::get('/lista/habilitacion/turnos', 'HabilitacionController@index')->name('habilitar.rolturno');//--
  Route::post('/habilitacion/turno/', 'HabilitacionController@habilitacion')->name('habilitar.servicio.rolturno');//--
  Route::post('/deshacer/accion/rolturno/', 'HabilitacionController@cambioRolturno')->name('anular.accion.rolturno');//--

  //rutas pra reportes
  Route::get('/reportes/roturnos/', 'ReportesController@index')->name('primer.reporte.rolturno');
  //rutas para cambio de turno   /editar/rolturno/test/{id}
  /*Route::get('/listar/cambioturnos/', 'CambioTurnoController@index')->name('listar.cambio_turno');
  Route::post('/registrar/cambioturno/', 'CambioTurnoController@store')->name('crear.cambio_turno');
  Route::get('/verificacion/rolturno/', 'CambioTurnoController@getGestion')->name('existe.rolturno.gestion');
  Route::get('/cambioturno/persona/servicio', 'CambioTurnoController@getPersonas')->name('servicio.personas.cambioturno');
  Route::get('/cambioturno/persona/rolturno', 'CambioTurnoController@PersonaControl')->name('control.persona.rolturno');
  Route::get('/cambioturno/eliminar/', 'CambioTurnoController@delete')->name('eliminar.cambioturno');*/

});

//Route::get('/test',[TestController::class, 'index']);