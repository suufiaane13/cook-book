<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/recettes', [RecipeController::class, 'index'])->name('recettes.index');
Route::get('/recettes/categorie/{category}', [RecipeController::class, 'byCategory'])->name('recettes.categorie');

Route::middleware(['auth', 'verified'])->group(function () {
Route::get('/dashboard', function () {
    return view('dashboard');
    })->name('dashboard');

    Route::get('/recettes/creer', [RecipeController::class, 'create'])->name('recettes.create');
    Route::post('/recettes', [RecipeController::class, 'store'])->name('recettes.store');
    Route::get('/recettes/{recipe}/editer', [RecipeController::class, 'edit'])->name('recettes.edit');
    Route::put('/recettes/{recipe}', [RecipeController::class, 'update'])->name('recettes.update');
    Route::delete('/recettes/{recipe}', [RecipeController::class, 'destroy'])->name('recettes.destroy');

    Route::get('/favoris', [FavoriteController::class, 'index'])->name('favoris.index');
    Route::post('/favoris/{recipe}', [FavoriteController::class, 'store'])->name('favoris.store');
    Route::delete('/favoris/{recipe}', [FavoriteController::class, 'destroy'])->name('favoris.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/recettes/{recipe}', [RecipeController::class, 'show'])->name('recettes.show');

require __DIR__.'/auth.php';
