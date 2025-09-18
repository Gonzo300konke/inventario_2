<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BienController;
use App\Http\Controllers\DependenciaController;
use App\Http\Controllers\HistorialMovimientoController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\OrganismoController;   
use App\Http\Controllers\ReporteController; 
use App\Http\Controllers\ResponsableController; 
use App\Http\Controllers\UsuarioController;



Route::apiResource('dependencias', DependenciaController::class);
Route::apiResource('bienes', BienController::class);
Route::apiResource('historial-movimientos', HistorialMovimientoController::class);
Route::apiResource('movimientos', MovimientoController::class);
Route::apiResource('organismos', OrganismoController::class);
Route::apiResource('reportes', ReporteController::class);
Route::apiResource('responsables', ResponsableController::class);
Route::apiResource('usuarios', UsuarioController::class);
Route::get('/', function () {
    return view('welcome');
});
