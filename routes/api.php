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
});*/

Route::apiResource('v2/hechos', 'Hechos\HechoController');

Route::apiResource('v2/sujetosProcesales', 'Hechos\HechoPersonaController')->only(['show','store']);


Route::apiResource('v2/casos', 'Casos\CasoController')->only(['index','show']);

Route::apiResource('v2/casos.personas', 'Casos\CasoPersonasController')->only('index');

//Route::apiResource('v1/usuarios', 'UserController');