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
  Route::post('/servicio/Inahabilitado/Habilitado', 'ServicioController@deshabilitar')->name('inhabilitar.servicio');

  //RUTAS PARA AREAS
  Route::get('/listar/areas/servicio', 'AreaServicioController@index')->name('listar.area.servicio');
  Route::post('/registrar/area/servicio', 'AreaServicioController@store')->name('guardar.area.servicio');
  Route::post('/editar/area/servicio/', 'AreaServicioController@update')->name('editarsave.area.servicio');
  Route::post('/area/servicio/inahabilitado/', 'AreaServicioController@deshabilitar')->name('inhabilitar.area.servicio');

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
    Route::post('/tipo/turno/inahabilitado/', 'TipoTurnosController@deshabilitar')->name('inhabilitar.tipo.turno');

    //rutas para tipos de turnos
    Route::get('/listar/tipos/contratos/', 'TipoContratosController@index')->name('listar.tipos.contratos');
    Route::post('/registrar/tipo/contrato/', 'TipoContratosController@store')->name('guardar.tipo.contrato');
    Route::post('/editar/tipo/contrato/', 'TipoContratosController@update')->name('editarsave.tipo.contrato');
    Route::post('/tipo/contrato/inahabilitado/', 'TipoContratosController@deshabilitar')->name('inhabilitar.tipo.contrato');
});

Route::group(['middleware' => 'auth'], function(){
  //RUTAS PARA ROLTURNOS DEL PERSONAL
  Route::get('/registrar/rol/turno', 'RolturnoController@index')->name('listar.registrar.rolturno');
  Route::post('/rolturno/registrar/', 'RolturnoController@store')->name('guardar.rolturno');
  Route::post('/eliminar/rolturno/', 'RolturnoController@destroy')->name('rolturno.eliminado');
  Route::get('/imprimir/rolturno/{id}', 'RolturnoController@print')->name('rolturno.imprimir.pdf');
//rutas para algunos proccesos de rolturnos
  Route::get('/area/servicio', 'RolturnoController@getAreas')->name('areas.servicio');
  Route::get('/persona/servicio', 'RolturnoController@getPersons')->name('servicio.personas');
  Route::post('/enviar/rolturno', 'RolturnoController@send')->name('enviar.rolturno');
  Route::get('/imprimir/tabla', 'RolturnoController@tabla')->name('tablas');//--prueba

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

  //rutas pra reportes
  Route::get('/lista/reportes/roturnos/', 'ReportesController@index')->name('lista.reporte.rolturno');
  Route::post('/reportes/roturnos/', 'ReportesController@reportOne')->name('primer.reporte.rolturno');

  Route::get('/lista/reportes/roturnos2/', 'ReportesController@index2')->name('lista.reporte.rolturno.two');
  Route::get('/lista/reportes/roturnos3/', 'ReportesController@index3')->name('lista.reporte.rolturno.three');
  //rutas para cambio de turno   /editar/rolturno/test/{id}
  /*Route::get('/listar/cambioturnos/', 'CambioTurnoController@index')->name('listar.cambio_turno');
  Route::post('/registrar/cambioturno/', 'CambioTurnoController@store')->name('crear.cambio_turno');
  Route::get('/verificacion/rolturno/', 'CambioTurnoController@getGestion')->name('existe.rolturno.gestion');
  Route::get('/cambioturno/persona/servicio', 'CambioTurnoController@getPersonas')->name('servicio.personas.cambioturno');
  Route::get('/cambioturno/persona/rolturno', 'CambioTurnoController@PersonaControl')->name('control.persona.rolturno');
  Route::get('/cambioturno/eliminar/', 'CambioTurnoController@delete')->name('eliminar.cambioturno');*/

});

//Route::get('/test',[TestController::class, 'index']);