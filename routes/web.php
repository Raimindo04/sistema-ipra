<?php

use App\Exports\IpraFormsExport;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContribuinteController;
use App\Models\PostoAdministrativo;
use Maatwebsite\Excel\Facades\Excel;

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


Route::get('/bairros/{posto_administrativo}', function($id){
    $postoAdministrativo = PostoAdministrativo::find($id);
    return response()->json($postoAdministrativo->bairros);
});
Route::get('/ipraforms/export', [ContribuinteController::class, 'export'])->name('ipraforms.export');

Route::get('/', [ContribuinteController::class, 'index']);
Route::get('/contribuintes', [ContribuinteController::class, 'index'])->name('contribuintes.index');
Route::get('/contribuintes/create', [ContribuinteController::class, 'create'])->name('contribuintes.create');
Route::get('/contribuintes/{ipraForm}/show', [ContribuinteController::class, 'show'])->name('contribuintes.show');
Route::post('/contribuintes/validar', [ContribuinteController::class, 'validar'])->name('contribuintes.validar');
Route::get('/contribuintes/confirmar', [ContribuinteController::class, 'confirmar'])->name('contribuintes.confirmar');
Route::post('/contribuintes/salvar', [ContribuinteController::class, 'salvar'])->name('contribuintes.salvar');
Route::get('/contribuintes/limpar', [ContribuinteController::class, 'limpar'])->name('contribuintes.limpar');
