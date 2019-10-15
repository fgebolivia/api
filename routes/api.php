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
//Route::apiResource('v2/abogados', 'Notificaciones\AbogadoController')->only(['index', 'show']);//esperar a estar enlasado realmente con el i 4
//Route::apiResource('v2/hechos', 'Hechos\HechoController');
//Route::apiResource('v1/usuarios', 'UserController');
//Route::apiResource('v2/sujetosProcesales', 'Hechos\HechoPersonaController')->only(['show','store']);*/

Route::apiResource('v2/actividad', 'Actividades\ActividadController')->only(['store']);

Route::apiResource('v2/aprobaciondocumentos', 'Ciudadania\AprobacionDocumentosController')->only(['store']);

Route::apiResource('v2/connection', 'Casos\ConnectionApiController')->only(['index']);

Route::apiResource('v2/rejaf', 'Actividades\RejafController')->only(['store']);

Route::apiResource('v2/agendamiento', 'Actividades\AgendamientoController')->only(['store']);
Route::apiResource('v2/agendamiento/{codigo}/juez', 'Actividades\JuezController')->only(['store']);
Route::apiResource('v2/agendamiento/suspencion', 'Actividades\AgendaSuspencionController')->only(['store']);


Route::apiResource('v2/notificaciones', 'Notificaciones\NotificacionesController')->only(['store']);

Route::apiResource('v2/casos', 'Casos\CasoController')->only(['store']);

Route::apiResource('v2/casos/{hecho}/sujetosprocesales', 'Casos\CasoPersonasController')->only(['store','update']);

Route::apiResource('v2/casos/{hecho}/medidas', 'Casos\MedidasVictimaController')->only(['store','update']);

