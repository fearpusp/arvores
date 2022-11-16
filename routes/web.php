<?php

use App\Http\Controllers\ArquivoController;
use App\Http\Controllers\ArvoreController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ComentarioFotoController;
use App\Http\Controllers\EspecieController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\OcorrenciaController;
use App\Http\Controllers\PlacaController;
use App\Models\Comentario;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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

Route::get('/', [ArvoreController::class, 'inicio'])->name('arvores.inicio');
Route::get('/index', [ArvoreController::class, 'index'])->name('arvores.index');
Route::get('/index-mortas', [ArvoreController::class, 'mortas'])->name('arvores.mortas');
Route::get('/index-admin', [ArvoreController::class, 'indexAdmin'])->name('arvores.index-admin');
Route::get('/create', [ArvoreController::class, 'create'])->name('arvores.create')->middleware('can:admin');
Route::post('/arvores', [ArvoreController::class, 'store'])->name('arvores.store')->middleware('can:admin');
Route::get('/show/{arvore}', [ArvoreController::class, 'show'])->name('arvores.show');
Route::get('/edit/{arvore}', [ArvoreController::class, 'edit'])->name('arvores.edit');
Route::patch('/{arvore}', [ArvoreController::class, 'update'])->name('arvores.update')->middleware('can:admin');
Route::delete('/{arvore}', [ArvoreController::class, 'destroy'])->name('arvores.destroy')->middleware('can:admin');
Route::get('/especies/create', [EspecieController::class, 'create'])->name('especies.create')->middleware('can:admin');
Route::get('/especies/', [EspecieController::class, 'index'])->name('especies.index')->middleware('can:admin');
Route::get('/especies/edit/{especie}', [EspecieController::class, 'edit'])->name('especies.edit')->middleware('can:admin');
Route::patch('/especies/{especie}', [EspecieController::class, 'update'])->name('especies.update')->middleware('can:admin');
Route::get('/ocorrencias/create/{arvore}', [OcorrenciaController::class, 'create'])->name('ocorrencias.create')->middleware('can:admin');
Route::post('/ocorrencias/', [OcorrenciaController::class, 'store'])->name('ocorrencias.store')->middleware('can:admin');
Route::get('/ocorrencias/{ocorrencia}', [OcorrenciaController::class, 'edit'])->name('ocorrencias.edit')->middleware('can:admin');
Route::patch('/ocorrencias/{ocorrencia}', [OcorrenciaController::class, 'update'])->name('ocorrencias.update')->middleware('can:admin');
Route::post('/especies/', [EspecieController::class, 'store'])->name('especies.store')->middleware('can:admin');
Route::resource('arquivos', ArquivoController::class);

Route::resource('foto', FotoController::class);

Route::get('placa/{arvore}', [PlacaController::class, 'show'])->name('placa.show');

// Comentários
Route::get('/comentarios/create/{arvore}', [ComentarioController::class, 'create'])->name('comentarios.create')->middleware('can:user');
Route::post('/comentarios/', [ComentarioController::class, 'store'])->name('comentarios.store')->middleware('can:user');
Route::get('/comentarios/edit/{arvore}', [ComentarioController::class, 'edit'])->name('comentarios.edit')->middleware('can:admin');
Route::patch('/comentarios/{arvore}', [ComentarioController::class, 'update'])->name('comentarios.update')->middleware('can:admin');
Route::get('/comentarios/todos', [ComentarioController::class, 'editTodos'])->name('comentarios.editTodos')->middleware('can:admin');
Route::post('/comentarios/todos', [ComentarioController::class, 'updateTodos'])->name('comentarios.updateTodos')->middleware('can:admin');

Route::get('/mapa', function () {
    \UspTheme::activeUrl('mapa');
    return view('arvores.mapa');
})->name('arvores.mapa');

Route::resource('comentario_foto', ComentarioFotoController::class);

Route::get('resize_fotos/', [FotoController::class, 'resize'])->name('fotos.resize');

Route::get('concurso/', [ArvoreController::class, 'concurso'])->name('concurso')->middleware('can:admin');
Route::get('lista_concurso/', [ArvoreController::class, 'listaConcurso'])->name('lista_concurso')->middleware('can:admin');
Route::get('participantes_concurso/', [ArvoreController::class, 'participantesConcurso'])->name('participantes_concurso')->middleware('can:admin');

// Link para pdf do concurso
Route::get('concurso/resultado', function () {
    return Response::make(file_get_contents('concurso_de_fotografia_classificacao.pdf'), 200, [
        'content-type' => 'application/pdf',
    ]);
})->name('resultado')->middleware('can:admin');

Route::get('mapa_concurso', function () {
    \UspTheme::activeUrl('mapa_concurso');
    return view('arvores.mapa-concurso');
})->name('arvores.mapa_concurso')->middleware('can:admin');

Route::get('gerar-csv-completo', [ArvoreController::class, 'gerarCsvCompleto'])->name('gerar-csv-completo')->middleware('can:admin');
Route::get('gerar-csv-concurso', [ArvoreController::class, 'gerarCsvConcurso'])->name('gerar-csv-concurso')->middleware('can:admin');

Route::get('mailable', function () {
    $comentario = Comentario::all();
    return (new App\Mail\ComentarioEnviado($comentario->last()))->render();
})->middleware('can:admin');
