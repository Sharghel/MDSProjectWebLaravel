<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FluxController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

use App\Models\Category;
use App\Models\Flux;

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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('category.store'); // enregistre une catégorie
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit'); // affiche le formulaire d'édition
    Route::put('/categories/{id}/update', [CategoryController::class, 'update'])->name('category.update'); // modifie une catégorie
    Route::delete('/categories/{id}/destroy', [CategoryController::class, 'destroy'])->name('category.destroy'); // supprime une catégorie
    Route::get('/categories/{id}/show', [CategoryController::class, 'show'])->name('category.show'); // affiche une catégorie
    // Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create'); // affiche le formulaire de création
    
    Route::post('/flux/store', [FluxController::class, 'store'])->name('flux.store'); // enregistre une catégorie
    Route::put('/flux/{id}/update', [FluxController::class, 'update'])->name('flux.update'); // modifie une catégorie
    Route::delete('/flux/{id}/destroy', [FluxController::class, 'destroy'])->name('flux.destroy'); // supprime une catégorie
    
});

Route::get('/settings', function () {
    return view('settings');
})->middleware(['auth', 'verified'])->name('settings');

require __DIR__.'/auth.php';

