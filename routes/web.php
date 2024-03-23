<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FluxController;
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

Route::get('/dashboard', function () {
    $categories = Category::where('parent_id', null)->with('children')->where('user_id', auth()->user()->id)->get();
    $items = [];
    foreach($categories as $category) {
        foreach($category->children as $child) {
            $flux_rss = Flux::where('category_id', $child->id)->get();
            foreach ($flux_rss as $flux) {
                $feed = new SimplePie();
                $feed->set_feed_url($flux->link); // Utilisez l'URL du flux RSS associé
                $feed->enable_cache(false); // Désactiver le cache pour éviter les problèmes de mise en cache
                $feed->init();
                $items = array_merge($items, $feed->get_items()); // Ajoutez les éléments de flux au tableau $items
            }
        }
    }
    return view('dashboard', compact('categories', 'items'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/categories/{id}/show', [CategoryController::class, 'show'])->name('category.show'); // affiche une catégorie
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create'); // affiche le formulaire de création
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('category.store'); // enregistre une catégorie
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit'); // affiche le formulaire d'édition
    Route::put('/categories/{id}/update', [CategoryController::class, 'update'])->name('category.update'); // modifie une catégorie
    Route::delete('/categories/{id}/destroy', [CategoryController::class, 'destroy'])->name('category.destroy'); // supprime une catégorie
    
    Route::post('/flux/store', [FluxController::class, 'store'])->name('flux.store'); // enregistre une catégorie
    Route::put('/flux/{id}/update', [FluxController::class, 'update'])->name('flux.update'); // modifie une catégorie
    Route::delete('/flux/{id}/destroy', [FluxController::class, 'destroy'])->name('flux.destroy'); // supprime une catégorie
    
});

Route::get('/settings', function () {
    return view('settings');
})->middleware(['auth', 'verified'])->name('settings');

require __DIR__.'/auth.php';

