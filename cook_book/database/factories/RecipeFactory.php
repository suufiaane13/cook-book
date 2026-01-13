<?php

namespace Database\Factories;

use App\Enums\CategoryEnum;
use App\Enums\DifficultyEnum;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    protected $model = Recipe::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = CategoryEnum::cases();
        $difficulties = DifficultyEnum::cases();
        
        $titles = [
            'plat' => [
                'Poulet rôti aux herbes',
                'Lasagnes à la bolognaise',
                'Risotto aux champignons',
                'Tajine d\'agneau aux pruneaux',
                'Saumon grillé aux légumes',
                'Couscous royal',
                'Bœuf bourguignon',
                'Ratatouille provençale',
                'Pâtes carbonara',
                'Quiche lorraine',
            ],
            'dessert' => [
                'Tarte aux pommes',
                'Mousse au chocolat',
                'Crème brûlée',
                'Tiramisu',
                'Cheesecake aux fruits rouges',
                'Éclairs au café',
                'Macarons à la framboise',
                'Fondant au chocolat',
                'Tarte citron meringuée',
                'Profiteroles',
            ],
            'boisson' => [
                'Smoothie aux fruits',
                'Limonade maison',
                'Cocktail mojito',
                'Thé glacé à la pêche',
                'Jus de fruits frais',
                'Milkshake vanille',
                'Café latte',
                'Chocolat chaud',
                'Sangria',
                'Limonade citron vert',
            ],
        ];

        $descriptions = [
            'plat' => [
                'Un plat savoureux et réconfortant, parfait pour un repas en famille. Cette recette traditionnelle ravira tous les palais avec ses saveurs authentiques.',
                'Une recette qui combine harmonieusement les saveurs et les textures. Un délice culinaire qui impressionnera vos invités.',
                'Un plat raffiné et élégant, idéal pour une occasion spéciale. Les ingrédients de qualité font toute la différence.',
                'Une recette simple mais délicieuse, parfaite pour tous les jours. Facile à préparer et toujours appréciée.',
                'Un plat généreux qui réchauffe le cœur. Les arômes qui se dégagent pendant la cuisson sont un véritable régal.',
            ],
            'dessert' => [
                'Un dessert gourmand qui fera le bonheur de tous. Une douceur irrésistible pour terminer le repas en beauté.',
                'Un dessert raffiné qui émerveillera vos papilles. Une création sucrée qui allie légèreté et saveur.',
                'Un dessert classique revisité avec une touche moderne. Le parfait équilibre entre tradition et innovation.',
                'Une douceur onctueuse et délicate qui fond dans la bouche. Un moment de pur bonheur à partager.',
                'Un dessert qui éveille tous les sens. Les saveurs se marient à la perfection pour un résultat exceptionnel.',
            ],
            'boisson' => [
                'Une boisson rafraîchissante parfaite pour toutes les occasions. Un mélange délicieux de saveurs naturelles.',
                'Une boisson maison qui surprendra vos invités. Un breuvage savoureux et désaltérant, idéal en toutes saisons.',
                'Une boisson équilibrée qui réveillera vos sens. Les ingrédients frais apportent une note de fraîcheur incomparable.',
                'Un mélange harmonieux de saveurs qui se complètent à merveille. Parfait pour se désaltérer avec plaisir.',
                'Une boisson qui allie douceur et caractère. Un moment de détente et de plaisir à savourer sans modération.',
            ],
        ];

        $category = fake()->randomElement($categories);
        $categoryValue = $category->value;
        $title = fake()->randomElement($titles[$categoryValue]);
        $description = fake()->randomElement($descriptions[$categoryValue]);

        return [
            'user_id' => User::factory(),
            'titre' => $title,
            'description' => $description,
            'image' => null, // Pas d'image par défaut
            'temps_preparation' => fake()->numberBetween(15, 180),
            'nb_personnes' => fake()->numberBetween(2, 8),
            'categorie' => $category,
            'difficulte' => fake()->randomElement($difficulties),
        ];
    }
}
