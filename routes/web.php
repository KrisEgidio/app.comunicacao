<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    UsuarioController,
    GrupoController,
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
    return view('welcome');
});

Auth::routes();

Route::get('/usuarios/verificar/{uuid}', [UsuarioController::class, 'verificar'])->name('usuarios.verificar');
Route::post('/usuarios/verificado/{uuid}', [UsuarioController::class, 'verificado'])->name('usuarios.verificado');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rotas para usuário administrador
/*Route::middleware('')->group(function () {
    Route::resources([
        'usuarios' => UsuarioController::class,
        'cargos' => CargoController::class,
        'lojas' => LojaController::class,
        'templos' => TemploController::class,
    ]);
});*/

Route::resources([
    'usuarios' => UsuarioController::class,
    'grupos' => GrupoController::class,
]);
