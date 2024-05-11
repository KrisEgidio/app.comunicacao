<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    CidadeController,
    ComunicadoController,
    EventoController,
    UsuarioController,
    GrupoController,
    ImagemController,
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('inicio');
});

Auth::routes();

Route::get('/usuarios/verificar/{uuid}', [UsuarioController::class, 'verificar'])->name('usuarios.verificar');
Route::post('/usuarios/verificado/{uuid}', [UsuarioController::class, 'verificado'])->name('usuarios.verificado');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('inicio');

Route::resources([
    'usuarios' => UsuarioController::class,
    'grupos' => GrupoController::class,
    'eventos' => EventoController::class,
    'comunicados' => ComunicadoController::class,
]);


 // ajax
 Route::get('/cidades/{estado_id}', [CidadeController::class, 'getCidades'])->name('cidades.get');

 //Imagens
 Route::get('/imagens/{nomeArquivo}', [ImagemController::class, 'exibir'])->name('imagens.exibir');
