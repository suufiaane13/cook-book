<?php

namespace Database\Factories;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
 */
class IngredientFactory extends Factory
{
    protected $model = Ingredient::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ingredients = [
            'Farine',
            'Sucre',
            'Beurre',
            'Œufs',
            'Lait',
            'Sel',
            'Poivre',
            'Ail',
            'Oignon',
            'Tomates',
            'Carottes',
            'Courgettes',
            'Pommes de terre',
            'Riz',
            'Pâtes',
            'Poulet',
            'Bœuf',
            'Porc',
            'Saumon',
            'Fromage',
            'Crème fraîche',
            'Huile d\'olive',
            'Vinaigre',
            'Citron',
            'Basilic',
            'Thym',
            'Romarin',
            'Persil',
            'Champignons',
            'Épinards',
            'Avocat',
            'Poivrons',
            'Aubergines',
            'Brocoli',
            'Champignons de Paris',
            'Échalotes',
            'Gingembre',
            'Curry',
            'Paprika',
            'Cumin',
            'Coriandre',
            'Menthe',
            'Yaourt',
            'Miel',
            'Chocolat noir',
            'Amandes',
            'Noix',
        ];

        $unites = [
            'g',
            'kg',
            'ml',
            'cl',
            'L',
            'c. à soupe',
            'c. à café',
            'tasse',
            'pièce',
            'tranche',
            'gousse',
            'branche',
            'feuille',
        ];

        return [
            'recipe_id' => Recipe::factory(),
            'nom' => fake()->randomElement($ingredients),
            'quantite' => fake()->numberBetween(1, 500),
            'unite' => fake()->randomElement($unites),
        ];
    }
}
