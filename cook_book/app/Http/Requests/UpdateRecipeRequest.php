<?php

namespace App\Http\Requests;

use App\Enums\CategoryEnum;
use App\Enums\DifficultyEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRecipeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'temps_preparation' => ['required', 'integer', 'min:1'],
            'nb_personnes' => ['required', 'integer', 'min:1'],
            'categorie' => ['required', Rule::enum(CategoryEnum::class)],
            'difficulte' => ['required', Rule::enum(DifficultyEnum::class)],
            'ingredients' => ['required', 'array', 'max:10'],
            'ingredients.*.nom' => ['required', 'string', 'max:255'],
            'ingredients.*.quantite' => ['required', 'string', 'max:255'],
            'ingredients.*.unite' => ['nullable', 'string', 'max:50'],
            'etapes' => ['required', 'array', 'min:1'],
            'etapes.*.numero_etape' => ['required', 'integer', 'min:1'],
            'etapes.*.description' => ['required', 'string'],
        ];
    }
}
