<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MouvementStockController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])
    ->group(function () {
        //Route::resource('users', UserController::class);
        Route::resource('mouvements', MouvementStockController::class);
        Route::resource('fournisseurs', FournisseurController::class);
        Route::get('/produits/alertes', \App\Http\Controllers\AlertController::class)
            ->name('produits.alertes');
        Route::resource('produits', ProduitController::class);

        Route::get('/statistique', [StatistiqueController::class, 'index'])->name('statistique');
        Route::get('/statistique/excel', [StatistiqueController::class, 'exportExcel'])->name('statistique.excel');
        Route::get('/statistique/pdf', [StatistiqueController::class, 'exportPdf'])->name('statistique.pdf');

    });

/*
|--------------------------------------------------------------------------
| Employé Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
//Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
//    Route::get('/dashboard', function () {
//        return view('admin.dashboard');
//    })->name('admin.dashboard');
//});


Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {
        Route::resource('users', UserController::class);
    });



//Route::get('/statistique', [\App\Http\Controllers\StatistiqueController::class, 'index'])->name('statistique');
//Route::get('/statistique/excel', [StatistiqueController::class, 'exportExcel'])->name('statistique.excel');
//Route::get('/statistique/pdf', [StatistiqueController::class, 'exportPdf'])->name('statistique.pdf');
/*
|--------------------------------------------------------------------------
| Profile (Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
