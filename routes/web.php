<?php

use App\Http\Controllers\{PostController};
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

Route::get('/', [PostController::class, 'welcome'])->name('.welcome')->middleware(['auth']); //rota dubplicada para /noticia

Route::get('/painel/noticias', [PostController::class, 'index'])->name('posts.index')->middleware(['auth']);

Route::post('/painel', [PostController::class, 'store'])->name('posts.store')->middleware(['auth']); //responsável pelo request/ cadastrar do user ao db

Route::get('/painel/noticias/novo', [PostController::class, 'create'])->name('posts.create')->middleware(['auth']); //colocar create antes das rotas com id

Route::put('/painel/noticias/{id}', [PostController::class, 'update'])->name('posts.update')->middleware(['auth']);

Route::get('/painel/noticias/editar/{id}', [PostController::class, 'edit'])->name('posts.edit')->middleware(['auth']);

Route::delete('/painel/noticias/{id}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware(['auth']);

Route::get('/painel/noticias/visualizar/{id}', [PostController::class, 'show'])->name('posts.show')->middleware(['auth']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

//-----------------------------------programação---------------------//

