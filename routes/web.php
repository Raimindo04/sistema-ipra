<?php

use App\Exports\IpraFormsExport;
use App\Helpers\ConversorHelper;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ContribuinteController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\IpraForm;
use App\Models\PostoAdministrativo;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
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
Auth::routes(['verify' => true]);

Route::get('/bairros/{posto_administrativo}', function($id){
    $postoAdministrativo = PostoAdministrativo::find($id);
    return response()->json($postoAdministrativo->bairros);
});
Route::get('/ipraforms/export', [ContribuinteController::class, 'export'])->name('ipraforms.export');

Route::get('/home',[ContribuinteController::class, 'index'])->name('home');
Route::get('/', [ContribuinteController::class, 'index']);
Route::get('/contribuintes', [ContribuinteController::class, 'index'])->name('contribuintes.index');
Route::get('/contribuintes/create', [ContribuinteController::class, 'create'])->name('contribuintes.create');
Route::get('/contribuintes/{ipraForm}/show', [ContribuinteController::class, 'show'])->name('contribuintes.show');
Route::post('/contribuintes/validar', [ContribuinteController::class, 'validar'])->name('contribuintes.validar');
Route::get('/contribuintes/{ipraForm}/edit', [ContribuinteController::class, 'edit'])->name('contribuintes.edit');
Route::patch('/contribuintes/{ipraForm}/validar', [ContribuinteController::class, 'validarUpdate'])->name('contribuintes.validar.update');
Route::get('/contribuintes/confirmar', [ContribuinteController::class, 'confirmar'])->name('contribuintes.confirmar');
Route::get('/contribuintes/confirmarUpdate/{ipraForm}', [ContribuinteController::class, 'confirmarUpdate'])->name('contribuintes.confirmarUpdate');
Route::post('/contribuintes/salvar', [ContribuinteController::class, 'salvar'])->name('contribuintes.salvar');
Route::post('/contribuintes/{ipraForm}/update', [ContribuinteController::class, 'update'])->name('contribuintes.update');
Route::get('/contribuintes/limpar', [ContribuinteController::class, 'limpar'])->name('contribuintes.limpar');
Route::get('/contribuintes/{ipraForm}/historico', [ContribuinteController::class, 'history'])->name('contribuintes.history');
Route::get('/contribuintes/{ipraForm}/resumoPDF', [ContribuinteController::class, 'resumoPDF'])->name('contribuintes.resumoPDF');
Route::resource('permissions', PermissionController::class);
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::get('/roles/{role}/sync', [App\Http\Controllers\RoleController::class, 'syncPermission'])->name('roles.sync');
Route::post('/roles/{role}/sync', [App\Http\Controllers\RoleController::class, 'sync'])->name('roles.save.sync');
Route::get('/user-inactive', function () {
    return view('auth.user-inactive');
})->name('user.inactive');

Route::get('/imovel-details/{ipraForm}', function (IpraForm $ipraForm) {
    //Ipra calculation
    $Ae = $ipraForm->area_construida; //Area edificada
    $P = $ipraForm->classeImovel->preco_m2; // Preco medio por Metro quadrado
    $Fl = $ipraForm->zona->fator_localizacao; // Factor de Localizacao
    $Fa = ConversorHelper::calcularFactorAntiguidade($ipraForm->ano_construcao, $ipraForm->finalidadeImovel); // Factor de Antiguidade
    $Al = $ipraForm->area_terreno - $ipraForm->area_construida; // Area de Logradouro
    $taxaUso = $ipraForm->finalidadeImovel->fator_finalidade;


    $Vp = (($Ae * $P * $Fa) + ( 0.05 * $Al * $P  )) * $Fl;
    $ipra = $Vp * $taxaUso;

    return view('contribuintes.show', compact('ipraForm','Ae', 'P', 'Fl', 'Fa', 'Al', 'taxaUso', 'Vp', 'ipra'));
})->name('imovel.details');
