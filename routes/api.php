<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});








//Route::apiResource('v1/usuarios', 'UserController');
//Route::apiResource('v2/sujetosProcesales', 'Hechos\HechoPersonaController')->only(['show','store']);*/

Route::apiResource('v2/casoDircabi', 'Hechos\HechoController')->only(['show']);


Route::apiResource('v2/agendaPersonal', 'metis\ValidarPersonasController')->only(['show']);
Route::apiResource('v2/certificacion', 'metis\ConsultaSegipcontroller')->only(['show']);


Route::apiResource('v2/actividad', 'Actividades\ActividadController')->only(['store']);

Route::apiResource('v2/aprobaciondocumentos', 'Ciudadania\AprobacionDocumentosController')->only(['store']);

Route::apiResource('v2/connection', 'Casos\ConnectionApiController')->only(['index']);

//Route::apiResource('v2/rejaf', 'Actividades\RejafController')->only(['store']);

Route::apiResource('v2/agendamiento', 'Actividades\AgendamientoController')->only(['store','show','index']);
Route::apiResource('v2/reparto/{codigo}/juez', 'Actividades\JuezController')->only(['store']);
Route::apiResource('v2/agendamiento/suspencion', 'Actividades\AgendaSuspencionController')->only(['store']);
Route::apiResource('v2/actualizarjuzgado', 'Actividades\HechoJuzgadoController')->only(['store']);


Route::apiResource('v2/notificaciones', 'Notificaciones\NotificacionesController')->only(['store']);
Route::apiResource('v2/abogados', 'Notificaciones\AbogadoController')->only(['show']);

Route::apiResource('v2/casos', 'Casos\CasoController')->only(['show']);
Route::apiResource('v2/funcionario', 'Casos\FuncionarioCasosController')->only(['show']);

//Route::apiResource('v2/casos/{hecho}/sujetosprocesales', 'Casos\CasoPersonasController')->only(['store','update','index']);s

Route::apiResource('v2/casos/{hecho}/medidas', 'Casos\MedidasVictimaController')->only(['update']);

Route::apiResource('v2/fudactualizado', 'Casos\FudActualizadoController')->only(['show']);

Route::apiResource('v2/busqueda', 'Busquedas\BusquedaCasoController')->only(['index']);
