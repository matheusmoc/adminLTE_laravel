<?php

use App\Http\Controllers\{PostController, UsuarioController};
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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



//Route::middleware(['auth'])->group(function(){
// ----colocar rotas que deseja restirngir
//});

Route::/*aceita todas as requisições*/any('posts/search', [PostController::class, 'search'])->name('posts.search')->middleware(['auth']);

Route::get('/painel', [PostController::class, 'painel'])->name('painel.painel')->middleware(['auth']); //rota dubplicada para /noticia

Route::get('/painel/noticias', [PostController::class, 'index'])->name('painel.index')->middleware(['auth']);

Route::post('/store', [PostController::class, 'store'])->name('painel.store')->middleware(['auth']); //responsável pelo request/ cadastrar do user ao db

Route::get('/painel/noticias/novo', [PostController::class, 'novo'])->name('painel.novo')->middleware(['auth']); //colocar create antes das rotas com id

Route::put('/painel/noticias/{id}', [PostController::class, 'update'])->name('painel.update')->middleware(['auth']);

Route::get('/painel/noticias/editar/{id}', [PostController::class, 'editar'])->name('painel.editar')->middleware(['auth']);

Route::delete('/painel/noticias/{id}', [PostController::class, 'excluir'])->name('painel.excluir')->middleware(['auth']);

Route::get('/painel/noticias/visualizar/{id}', [PostController::class, 'show'])->name('painel.show')->middleware(['auth']);

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);



//---------------------------------------usuarios--------------------------//

Route::get('painel/usuarios', [UsuarioController::class, 'usuarios'])->name('painel.usuarios');



//---------------------------------------programacao--------------------------//
