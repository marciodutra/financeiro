<?php

use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/teste-render', function () {
    return response()->json([
        'status' => 'ok',
        'laravel' => app()->version(),
        'php' => PHP_VERSION,
        'environment' => app()->environment(),
    ]);
});

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/financeiro', [FinanceiroController::class, 'index'])
        ->name('financeiro.index');

    Route::post('/financeiro/salario', [FinanceiroController::class, 'salvarSalario'])
        ->name('financeiro.salario');    

    Route::post('/financeiro/gasto', [FinanceiroController::class, 'adicionarGasto'])
        ->name('financeiro.gasto');   
        
    Route::delete('/financeiro/gasto/{gasto}', [FinanceiroController::class, 'excluirGasto'])
        ->name('financeiro.gasto.excluir');    

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';