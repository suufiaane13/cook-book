<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use App\Models\Recipe;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class RecipeController extends Controller
{
    public function index(Request $request): View
    {
        $query = Recipe::with(['user', 'ingredients', 'etapes']);

        // Par défaut, afficher uniquement les recettes de l'utilisateur connecté
        // Sauf si le paramètre 'all' est présent ou si l'utilisateur n'est pas connecté
        if (auth()->check() && !$request->has('all')) {
            $query->where('user_id', auth()->id());
        }

        if ($request->has('categorie')) {
            $query->where('categorie', $request->categorie);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('titre', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('ingredients', function ($ingredientQuery) use ($search) {
                      $ingredientQuery->where('nom', 'like', "%{$search}%");
                  });
            });
        }

        $recipes = $query->latest()->paginate(12);

        return view('recipes.index', compact('recipes'));
    }

    public function show(Recipe $recipe): View
    {
        $recipe->load(['user', 'ingredients', 'etapes']);

        $isFavorite = false;
        if (auth()->check()) {
            $isFavorite = auth()->user()->favoriteRecipes()->where('recipe_id', $recipe->id)->exists();
        }

        return view('recipes.show', compact('recipe', 'isFavorite'));
    }

    public function create(): View
    {
        return view('recipes.create');
    }

    public function store(StoreRecipeRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('recipes', 'public');
        }

        $data['user_id'] = auth()->id();

        $recipe = Recipe::create($data);

        foreach ($request->ingredients as $ingredientData) {
            $recipe->ingredients()->create($ingredientData);
        }

        foreach ($request->etapes as $etapeData) {
            $recipe->etapes()->create($etapeData);
        }

        return redirect()->route('recettes.show', $recipe)
            ->with('success', 'Recette créée avec succès !');
    }

    public function edit(Recipe $recipe): View
    {
        $this->authorize('update', $recipe);

        $recipe->load(['ingredients', 'etapes']);

        return view('recipes.edit', compact('recipe'));
    }

    public function update(UpdateRecipeRequest $request, Recipe $recipe): RedirectResponse
    {
        $this->authorize('update', $recipe);

        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($recipe->image) {
                Storage::disk('public')->delete($recipe->image);
            }
            $data['image'] = $request->file('image')->store('recipes', 'public');
        }

        $recipe->update($data);

        $recipe->ingredients()->delete();
        foreach ($request->ingredients as $ingredientData) {
            $recipe->ingredients()->create($ingredientData);
        }

        $recipe->etapes()->delete();
        foreach ($request->etapes as $etapeData) {
            $recipe->etapes()->create($etapeData);
        }

        return redirect()->route('recettes.show', $recipe)
            ->with('success', 'Recette mise à jour avec succès !');
    }

    public function destroy(Recipe $recipe): RedirectResponse
    {
        $this->authorize('delete', $recipe);

        if ($recipe->image) {
            Storage::disk('public')->delete($recipe->image);
        }

        $recipe->delete();

        return redirect()->route('recettes.index')
            ->with('success', 'Recette supprimée avec succès !');
    }

    public function byCategory(string $category): View
    {
        $query = Recipe::with(['user', 'ingredients', 'etapes'])
            ->where('categorie', $category);

        // Par défaut, afficher uniquement les recettes de l'utilisateur connecté
        // Sauf si le paramètre 'all' est présent ou si l'utilisateur n'est pas connecté
        if (auth()->check() && !request()->has('all')) {
            $query->where('user_id', auth()->id());
        }

        if (request()->filled('search')) {
            $search = request()->search;
            $query->where(function ($q) use ($search) {
                $q->where('titre', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('ingredients', function ($ingredientQuery) use ($search) {
                      $ingredientQuery->where('nom', 'like', "%{$search}%");
                  });
            });
        }

        $recipes = $query->latest()->paginate(12);

        return view('recipes.index', compact('recipes', 'category'));
    }
}
