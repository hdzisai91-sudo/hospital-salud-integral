<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SolicitudController;
use Illuminate\Http\Request;

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/solicitudes/resumen', [SolicitudController::class, 'resumen']);
    Route::get('/solicitudes', [SolicitudController::class, 'index']);
    Route::post('/solicitudes', [SolicitudController::class, 'store']);
    Route::get('/solicitudes/{solicitud}', [SolicitudController::class, 'show']);
    Route::put('/solicitudes/{solicitud}', [SolicitudController::class, 'update']);
    Route::delete('/solicitudes/{solicitud}', [SolicitudController::class, 'destroy']);
});