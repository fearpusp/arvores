<?php

use App\Http\Controllers\ArquivoController;
use App\Http\Controllers\ArvoreController;
use App\Http\Controllers\EspecieController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\OcorrenciaController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ArvoreController::class, 'index'])->name('arvores.index');

Route::prefix('arvores')->group(function () {
    Route::get('/', [ArvoreController::class, 'index'])->name('arvores.index');
    Route::get('/create', [ArvoreController::class, 'create'])->name('arvores.create')->middleware('can:admin');
    Route::post('/', [ArvoreController::class, 'store'])->name('arvores.store')->middleware('can:admin');
    Route::get('/show/{arvore}', [ArvoreController::class, 'show'])->name('arvores.show');
    Route::get('/especies/create', [EspecieController::class, 'create'])->name('especies.create')->middleware('can:admin');
    Route::get('/especies/', [EspecieController::class, 'index'])->name('especies.index')->middleware('can:admin');
    Route::get('/ocorrencias/create/{arvore}', [OcorrenciaController::class, 'create'])->name('ocorrencias.create')->middleware('can:admin');
    Route::post('/ocorrencias/', [OcorrenciaController::class, 'store'])->name('ocorrencias.store')->middleware('can:admin');
    Route::post('/especies/', [EspecieController::class, 'store'])->name('especies.store')->middleware('can:admin');
    Route::resource('/arquivos', ArquivoController::class);
});

Route::resource('foto', FotoController::class);
