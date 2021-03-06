<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutosController;

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

Route::get('/', function () {
    return view('welcome');
});



//Route::get('/contato',  [ContatoController::class, 'index']);


Route::resource('produtos', ProdutosController::class);

//Route::post('produtos.store',[ProdutosController::class, 'store']);


Route::post('produtos/create', ['App\Http\Controllers\ProdutosController'::class,'create']);


Route::post('produtos/buscar', [ProdutosController::class, 'buscar']);


Route::get('adicionar-produto',['App\Http\Controllers\ProdutosController'::class,'create']);

Route::get('produtos/{id}/editar',['App\Http\Controllers\ProdutosController'::class,'edit']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
