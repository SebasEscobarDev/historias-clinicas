<?php

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

/*

SUPERVISOR -> 10283577

*/

Route::get('/', 'IndexController@index')->name('/');
/*
Medico Especialista
*/
Route::get('/medico-especialista', 'MedicoEspecialistaController@index')->name('/medico-especialista');
Route::post('/medico-especialista/crear', 'MedicoEspecialistaController@crear');
Route::post('/medico-especialista/ver', 'MedicoEspecialistaController@ver');
Route::get('/correo-especialista', 'MedicoEspecialistaController@correo');
Route::post('/medico-especialista/editar', 'MedicoEspecialistaController@editar');
Route::post('/medico-especialista/active', 'MedicoEspecialistaController@active');
Route::get('/buscar-medico', 'MedicoEspecialistaController@buscar');

/*
Paciente
*/
Route::get('/pacientes', 'PacienteController@index')->name('/pacientes');
Route::post('/pacientes/crear', 'PacienteController@crear');
Route::post('/pacientes/ver', 'PacienteController@ver');
Route::post('/pacientes/editar', 'PacienteController@editar');
Route::post('/pacientes/active', 'PacienteController@active');
Route::get('/buscar-paciente', 'PacienteController@buscar');
Route::get('/consulta-paciente', 'PacienteController@consultaPaciente');


/*HISTORIAS CLINICAS*/
Route::get('/prueba-historia', 'HistoriaController@pruebaHistoria')->name('prueba-historia');
Route::get('/historia-clinica', 'HistoriaController@index')->name('historia.index');
Route::post('/historia/crear', 'HistoriaController@crear');
Route::get('/historia/ver', 'HistoriaController@ver')->name('historias.ver');
Route::post('/historia/editar', 'HistoriaController@editar');
//Route::get('/buscar-historia', 'HistoriaController@buscar');
/*MEDICAMENTOS*/
Route::get('/buscar-medicamento', 'HistoriaController@buscarMedicamento');
/*HISTORIA ORDENES*/
//Route::post('/editar-orden/{orden_id}', 'HistoriaOrdenesController@editar');
Route::post('/ordenes/crear', 'HistoriaOrdenesController@crear');
Route::get('/descargar-orden/{orden_id}', 'HistoriaOrdenesController@pdf');
/*HISTORIA PARACLINICOS*/
Route::post('/paraclinicos/crear', 'HistoriaParaclinicosController@crear');
Route::get('/descargar-paraclinico/{paraclinico_id}', 'HistoriaParaclinicosController@pdf');
/* INCAPACIDADES */
Route::post('/incapacidades/crear', 'HistoriaIncapacidadesController@crear');
Route::get('/descargar-incapacidad/{incapacidad_id}', 'HistoriaIncapacidadesController@pdf');
/* REFERENCIAS */
Route::post('/referencias/crear', 'HistoriaReferenciasController@crear');
Route::get('/descargar-referencia/{referencia_id}', 'HistoriaReferenciasController@pdf');
/* EVOLUCIONES */
Route::post('/evoluciones/crear', 'HistoriaEvolucionesController@crear');
Route::get('/descargar-evolucion/{evolucion_id}', 'HistoriaEvolucionesController@pdf');

/* ENTIDADES */
Route::get('/entidades', 'EntidadesController@index');
Route::get('/buscar-entidad', 'EntidadesController@buscar');
Route::post('/entidades/crear', 'EntidadesController@crear');
Route::post('/entidades/ver', 'EntidadesController@ver');
Route::post('/entidades/editar', 'EntidadesController@editar');
Route::post('/entidades/active', 'EntidadesController@active');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');