<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| SPA (Vue) — login, vistas de la app, etc.
|--------------------------------------------------------------------------
| Catch-all: cualquier ruta no capturada arriba cae en la vista 'app',
| que monta la aplicación Vue. Debe ir SIEMPRE al final del archivo.
|--------------------------------------------------------------------------
*/

Route::view('/{any}', 'app')->where('any', '.*');