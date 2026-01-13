<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FavoriteController extends Controller
{
    public function index(): View
    {
        $recipes = auth()->user()->favoriteRecipes()
            ->with(['user', 'ingredients', 'etapes'])
            ->latest()
            ->paginate(12);

        return view('favorites.index', compact('recipes'));
    }

    public function store(Recipe $recipe): RedirectResponse
    {
        auth()->user()->favoriteRecipes()->syncWithoutDetaching([$recipe->id]);

        return redirect()->back()
            ->with('success', 'Recette ajoutée aux favoris !');
    }

    public function destroy(Recipe $recipe): RedirectResponse
    {
        auth()->user()->favoriteRecipes()->detach($recipe->id);

        return redirect()->back()
            ->with('success', 'Recette retirée des favoris !');
    }
}
