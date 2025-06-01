<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\EmpresaController;
use App\http\Controllers\SegmentoController;

Route::get('/', [EmpresaController::class, 'create']);
Route::post('/criarEmpresa', [EmpresaController::class, 'store']);
Route::get('/listSegmentos', [SegmentoController::class, 'index']);


